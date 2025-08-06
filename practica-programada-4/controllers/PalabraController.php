<?php

header('Content-Type: application/json');

ob_start();

require_once __DIR__ . '/../models/PalabraModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $palabra = $data['palabra'] ?? '';
    $definicion = $data['definicion'] ?? '';
    $ejemplo = $data['ejemplo'] ?? '';
    $audio = $data['audio'] ?? '';

    if (!empty($palabra)) {
        $guardado = PalabraModel::guardar($palabra, $definicion, $ejemplo, $audio);
        echo json_encode(['success' => $guardado]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Palabra vacía']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

ob_end_flush();
