<?php include 'app/views/layouts/header.php'; ?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Dashboard</h1>
        <a href="/encuestas/encuestas/crear" class="btn btn-primary"><i class="fa fa-plus me-1"></i> Nueva encuesta</a>
    </div>

    <?php if (!empty($_SESSION['flash_ok'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['flash_ok']; unset($_SESSION['flash_ok']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">Mis encuestas</div>
                <div class="card-body">
                    <?php if (empty($mias)): ?>
                        <p class="text-muted mb-0">Aún no has creado encuestas.</p>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach ($mias as $e): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($e['titulo']); ?></div>
                                        <small class="text-muted">Creada: <?php echo $e['created_at']; ?></small>
                                    </div>
                                    <div class="ms-3 d-flex gap-2">
                                        <?php if ((int)$e['total_respuestas'] === 0): ?>
                                            <form action="/encuestas/encuestas/eliminar" method="POST" class="m-0">
                                                <input type="hidden" name="id" value="<?php echo $e['id']; ?>">
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar encuesta sin respuestas?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <a class="btn btn-sm btn-outline-secondary" href="/encuestas/encuestas/resultados/<?php echo $e['id']; ?>">
                                                <i class="fa fa-chart-simple me-1"></i> Resultados
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">Encuestas de otros</div>
                <div class="card-body">
                    <?php if (empty($otras)): ?>
                        <p class="text-muted mb-0">No hay encuestas de otros usuarios por ahora.</p>
                    <?php else: ?>
                        <div class="list-group">
                            <?php foreach ($otras as $e): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($e['titulo']); ?></div>
                                        <small class="text-muted">Por <?php echo htmlspecialchars($e['creador']); ?> • <?php echo $e['created_at']; ?></small>
                                    </div>
                                    <a class="btn btn-sm btn-primary" href="/encuestas/encuestas/responder/<?php echo $e['id']; ?>">
                                        <i class="fa fa-pen-to-square me-1"></i> Responder
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'app/views/layouts/footer.php'; ?>
