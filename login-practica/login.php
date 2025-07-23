<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        header("Location: dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesion</h2>

    <?php if(isset($_GET['error'])): ?>
        <p style="color:red";>Usuario o clave incorrecto</p>
    <?php endif; ?>

    <form method="POST" action="login_post.php">

        <label for="usuario">Usuario</label> <br>
        <input type="text" name="usuario" required> <br><br>

        <label for="password">Password</label> <br>
        <input type="password" name="password" required> <br><br>

        <input type="submit" value="Ingresar">

    </form>

</body>
</html>
