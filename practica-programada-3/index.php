<?php
require_once 'controllers/TransaccionController.php';
$controller = new TransaccionController();

session_start();

$mensajeError = null; 

if (!isset($_SESSION['transacciones'])) {
    $_SESSION['transacciones'] = [];
}

foreach ($_SESSION['transacciones'] as $t) {
    $controller->registrarTransaccion($t['id'], $t['descripcion'], $t['monto']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        // Autogenerar ID basado en cantidad de transacciones ya registradas
        $id = count($_SESSION['transacciones']) + 1;
        $descripcion = $_POST['descripcion'];
        $monto = $_POST['monto'];
        $controller->registrarTransaccion($id, $descripcion, $monto);
        $_SESSION['transacciones'][] = compact('id', 'descripcion', 'monto');
    }

    if (isset($_POST['generar'])) {
        if (empty($_SESSION['transacciones'])) {
            $mensajeError = "Aún no ha registrado ninguna transacción.";
            include 'views/form.php';
            exit;
        } else {
            $data = $controller->generarEstadoDeCuenta();
            include 'views/form.php';
            include 'views/estado_cuenta.php';
            exit;
        }
    }
    
}
if (!isset($mensajeError)) {
    $mensajeError = null;
}

include 'views/form.php';
