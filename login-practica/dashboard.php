<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]) ?></h2>
    <p>Haz iniciado sesion correctamente</p>
    <br>
    <a href="logout.php">Cerrar Sesion</a>
</body>
</html>