<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diccionario Inglés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">📘 Diccionario de Inglés</h1>
        <div class="input-group mb-3">
            <input type="text" id="inputPalabra" class="form-control" placeholder="Escribe una palabra en inglés">
            <button class="btn btn-primary" onclick="buscarPalabra()">Buscar</button>
        </div>

        <div id="resultado" class="card shadow p-4 d-none">
            <h3 id="palabraTitulo" class="text-capitalize text-primary"></h3>
            <p><strong>Definición:</strong> <span id="definicion"></span></p>
            <p><strong>Ejemplo:</strong> <span id="ejemplo"></span></p>
            <audio id="audio" controls class="mt-2"></audio>
            <button class="btn btn-success mt-3" onclick="guardarPalabra()">Guardar en la base de datos</button>
        </div>
    </div>

    <script src="public/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
