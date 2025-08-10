<?php include 'app/views/layouts/header.php'; ?>
<div class="container my-4">
    <h1 class="h4 mb-3">Crear encuesta (Sí/No)</h1>
    <?php if (!empty($_SESSION['flash_error'])): ?><div class="alert alert-danger"><?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div><?php endif; ?>
    <form action="/encuestas/encuestas/guardar" method="POST" id="formCrear">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="2" placeholder="Opcional"></textarea>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <label class="form-label mb-0">Preguntas</label>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAgregarPregunta">
                    <i class="fa fa-plus me-1"></i> Agregar pregunta
                </button>
            </div>
            <div id="contenedorPreguntas" class="mt-2"></div>
        </div>

        <button class="btn btn-primary">Guardar encuesta</button>
        <a href="/encuestas/encuestas/index" class="btn btn-secondary">Volver</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cont = document.getElementById('contenedorPreguntas');
    const btnAdd = document.getElementById('btnAgregarPregunta');

    function addPregunta(value='') {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" name="preguntas[]" class="form-control" placeholder="Texto de la pregunta" required value="${value}">
            <button class="btn btn-outline-danger" type="button" title="Quitar"><i class="fa fa-times"></i></button>
        `;
        div.querySelector('button').addEventListener('click', ()=> div.remove());
        cont.appendChild(div);
    }

    btnAdd.addEventListener('click', ()=> addPregunta());
    // al menos una por defecto
    addPregunta();
});
</script>
<?php include 'app/views/layouts/footer.php'; ?>
