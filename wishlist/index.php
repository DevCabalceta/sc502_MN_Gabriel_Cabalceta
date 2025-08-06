
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Deseos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4 text-center">Lista de Deseos</h1>

    <form id="wishForm" class="row g-3">
      <div class="col-md-10">
        <input type="text" id="wishInput" class="form-control" placeholder="Escribe tu deseo..." required>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Agregar</button>
      </div>
    </form>

    <ul id="wishList" class="list-group mt-4">
      <!-- Deseos -->
    </ul>
  </div>

  <!-- Modal para editar deseo -->
  <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarModalLabel">Editar deseo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editId">
          <input type="text" id="editDescripcion" class="form-control" placeholder="Nuevo deseo...">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar</button>
        </div>
      </div>
    </div>
  </div>


  <script src="js/deseos.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
