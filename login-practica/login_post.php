<?php
    session_start();

    $user_valido = "admin";
    $clave_valida = "1234";

    $usuario = $_POST['usuario'];
    $clave = $_POST['password'];

    if($usuario === $user_valido && $clave === $clave_valida){
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php");
        exit();
    }else {
        header("Location: login.php?error=1");
    }







?>