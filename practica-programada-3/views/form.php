<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Transacciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Registrar Transacción</h1>
        <?php if ($mensajeError): ?>
            <div class="alert alert-warning text-center">
                <?= $mensajeError ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="index.php">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="monto" class="form-label">Monto (₡)</label>
                <input type="number" step="0.01" name="monto" class="form-control" required>
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar Transacción</button>
            <button type="submit" name="generar" class="btn btn-primary">Generar Estado de Cuenta</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const btnGenerar = document.querySelector("button[name='generar']");

            btnGenerar.addEventListener("click", function() {
                // Quitar "required" de todos los inputs para evitar bloqueo
                form.querySelectorAll("input").forEach(input => {
                    input.removeAttribute("required");
                });
            });
        });        
    </script>
</body>
</html>

