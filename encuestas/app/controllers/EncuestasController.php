<?php
class EncuestasController {

    private function requireLogin() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /encuestas/auth/login');
            exit();
        }
    }

    public function index() {
        $this->requireLogin();
        $encuesta = new Encuesta();
        $mias = $encuesta->listarMias($_SESSION['user_id']);
        $otras = $encuesta->listarOtras($_SESSION['user_id']);
        require 'app/views/encuestas/dashboard.php';
    }

    public function crear() {
        $this->requireLogin();
        require 'app/views/encuestas/crear.php';
    }

    public function guardar() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /encuestas/encuestas/crear');
            exit();
        }
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $preguntas = $_POST['preguntas'] ?? [];

        if ($titulo === '' || empty($preguntas)) {
            $_SESSION['flash_error'] = 'Debes ingresar título y al menos una pregunta.';
            header('Location: /encuestas/encuestas/crear');
            exit();
        }
        $encuesta = new Encuesta();
        $id = $encuesta->crearEncuesta($_SESSION['user_id'], $titulo, $descripcion, $preguntas);
        header("Location: /encuestas/encuestas/index");
        exit();
    }

    public function responder($id = null) {
        $this->requireLogin();
        if (!$id) { echo "Encuesta no válida"; return; }
        $encuesta = new Encuesta();
        $data = $encuesta->obtener($id);
        if (!$data) { echo "Encuesta no encontrada"; return; }
        require 'app/views/encuestas/responder.php';
    }

    public function guardar_respuesta() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /encuestas/encuestas/index'); exit();
        }
        $encuestaId = (int)($_POST['encuesta_id'] ?? 0);
        $respuestas = $_POST['respuesta'] ?? [];
        try {
            $encuesta = new Encuesta();
            $encuesta->guardarRespuesta($encuestaId, $_SESSION['user_id'], $respuestas);
            $_SESSION['flash_ok'] = '¡Respuesta registrada!';
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'Error al guardar: ' . $e->getMessage();
        }
        header("Location: /encuestas/encuestas/index");
        exit();
    }

    public function resultados($id = null) {
        $this->requireLogin();
        if (!$id) { echo "Encuesta no válida"; return; }
        $encuesta = new Encuesta();
        $resultados = $encuesta->obtenerResultados($id);
        if (!$resultados) { echo "Encuesta no encontrada"; return; }
        $soyCreador = ($resultados['encuesta']['id_creador'] == $_SESSION['user_id']);
        require 'app/views/encuestas/resultados.php';
    }

    public function eliminar() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /encuestas/encuestas/index'); exit(); }
        $id = (int)($_POST['id'] ?? 0);
        $encuesta = new Encuesta();
        $ok = $encuesta->eliminarSiSinRespuestas($id, $_SESSION['user_id']);
        $_SESSION['flash_' . ($ok ? 'ok' : 'error')] = $ok ? 'Encuesta eliminada.' : 'No se puede eliminar (tiene respuestas) o no eres el creador.';
        header('Location: /encuestas/encuestas/index'); exit();
    }
}
