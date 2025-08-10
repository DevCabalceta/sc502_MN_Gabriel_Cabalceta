<?php include 'app/views/layouts/header.php'; ?>
<div class="container my-4">
    <h1 class="h4 mb-3"><?php echo htmlspecialchars($data['titulo']); ?></h1>
    <?php if (!empty($data['descripcion'])): ?>
        <p class="text-muted"><?php echo nl2br(htmlspecialchars($data['descripcion'])); ?></p>
    <?php endif; ?>
    <form action="/encuestas/encuestas/guardar_respuesta" method="POST">
        <input type="hidden" name="encuesta_id" value="<?php echo $data['id']; ?>">
        <div class="vstack gap-3">
            <?php foreach ($data['preguntas'] as $p): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="fw-semibold mb-2"><?php echo htmlspecialchars($p['texto_pregunta']); ?></div>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="respuesta[<?php echo $p['id']; ?>]" value="1" required id="p<?php echo $p['id']; ?>si">
                                <label class="form-check-label" for="p<?php echo $p['id']; ?>si">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="respuesta[<?php echo $p['id']; ?>]" value="0" id="p<?php echo $p['id']; ?>no">
                                <label class="form-check-label" for="p<?php echo $p['id']; ?>no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-primary">Enviar respuestas</button>
            <a href="/encuestas/encuestas/index" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php include 'app/views/layouts/footer.php'; ?>
