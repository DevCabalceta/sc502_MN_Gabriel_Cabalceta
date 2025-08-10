<?php
class Encuesta {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDOConnection();
    }

    // Crea encuesta + preguntas (array de strings)
    public function crearEncuesta($idCreador, $titulo, $descripcion, $preguntas) {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("INSERT INTO encuestas (id_creador, titulo, descripcion) VALUES (?,?,?)");
            $stmt->execute([$idCreador, $titulo, $descripcion]);
            $encuestaId = $this->pdo->lastInsertId();

            $stmtP = $this->pdo->prepare("INSERT INTO preguntas (id_encuesta, texto_pregunta) VALUES (?, ?)");
            foreach ($preguntas as $texto) {
                $texto = trim($texto);
                if ($texto !== "") {
                    $stmtP->execute([$encuestaId, $texto]);
                }
            }

            $this->pdo->commit();
            return $encuestaId;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function listarMias($userId) {
        $stmt = $this->pdo->prepare("SELECT e.*,
            (SELECT COUNT(r.id) FROM preguntas p LEFT JOIN respuestas r ON r.id_pregunta=p.id WHERE p.id_encuesta=e.id) AS total_respuestas
            FROM encuestas e WHERE e.id_creador=? ORDER BY e.created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarOtras($userId) {
        $stmt = $this->pdo->prepare("SELECT e.*, u.nombre AS creador
            FROM encuestas e INNER JOIN usuarios u ON u.id=e.id_creador
            WHERE e.id_creador<>? ORDER BY e.created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($encuestaId) {
        $stmt = $this->pdo->prepare("SELECT * FROM encuestas WHERE id=?");
        $stmt->execute([$encuestaId]);
        $encuesta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$encuesta) return false;

        $stmtP = $this->pdo->prepare("SELECT * FROM preguntas WHERE id_encuesta=? ORDER BY id ASC");
        $stmtP->execute([$encuestaId]);
        $encuesta['preguntas'] = $stmtP->fetchAll(PDO::FETCH_ASSOC);

        return $encuesta;
    }

    public function tieneRespuestas($encuestaId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(r.id) AS c FROM preguntas p
            INNER JOIN respuestas r ON r.id_pregunta=p.id
            WHERE p.id_encuesta=?");
        $stmt->execute([$encuestaId]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function eliminarSiSinRespuestas($encuestaId, $userId) {
        if ($this->tieneRespuestas($encuestaId)) return false;

        // asegurar que sea del creador
        $stmt = $this->pdo->prepare("DELETE FROM encuestas WHERE id=? AND id_creador=?");
        $stmt->execute([$encuestaId, $userId]);
        return $stmt->rowCount() > 0;
    }

    // Agrega/guarda respuestas (valor_respuesta 0/1)
    public function guardarRespuesta($encuestaId, $userId, $respuestas) {
        $encuesta = $this->obtener($encuestaId);
        if (!$encuesta) throw new Exception("Encuesta no encontrada");

        $this->pdo->beginTransaction();
        try {
            // Registrar participante (único por encuesta/usuario)
            $stmtPart = $this->pdo->prepare("INSERT IGNORE INTO participantes (id_encuesta, id_usuario) VALUES (?,?)");
            $stmtPart->execute([$encuestaId, $userId]);

            $stmt = $this->pdo->prepare("INSERT INTO respuestas (id_pregunta, id_usuario, valor_respuesta) VALUES (?,?,?)
                ON DUPLICATE KEY UPDATE valor_respuesta=VALUES(valor_respuesta)");
            foreach ($respuestas as $idPregunta => $valor) {
                $valor = ($valor == 1) ? 1 : 0;
                $stmt->execute([$idPregunta, $userId, $valor]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    // Resultados: totales por pregunta (conteo de 1 y 0)
    public function obtenerResultados($encuestaId) {
        $encuesta = $this->obtener($encuestaId);
        if (!$encuesta) return false;

        $stmtTotal = $this->pdo->prepare("SELECT COUNT(DISTINCT id_usuario) FROM respuestas r
            INNER JOIN preguntas p ON p.id=r.id_pregunta WHERE p.id_encuesta=?");
        $stmtTotal->execute([$encuestaId]);
        $totalRespondientes = (int)$stmtTotal->fetchColumn();

        $stmt = $this->pdo->prepare("SELECT p.id AS pregunta_id, p.texto_pregunta,
            SUM(CASE WHEN r.valor_respuesta=1 THEN 1 ELSE 0 END) AS si,
            SUM(CASE WHEN r.valor_respuesta=0 THEN 1 ELSE 0 END) AS no
            FROM preguntas p
            LEFT JOIN respuestas r ON r.id_pregunta=p.id
            WHERE p.id_encuesta=?
            GROUP BY p.id, p.texto_pregunta
            ORDER BY p.id ASC");
        $stmt->execute([$encuestaId]);
        $detalle = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'encuesta' => $encuesta,
            'total_respondientes' => $totalRespondientes,
            'detalle' => $detalle
        ];
    }
}
