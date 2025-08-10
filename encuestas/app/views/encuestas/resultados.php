<?php include 'app/views/layouts/header.php'; ?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Resultados: <?php echo htmlspecialchars($resultados['encuesta']['titulo']); ?></h1>
        <a href="/encuestas/encuestas/index" class="btn btn-secondary">Volver</a>
    </div>
    <p class="text-muted">Total de personas que respondieron: <span class="fw-bold"><?php echo $resultados['total_respondientes']; ?></span></p>

    <?php if ($soyCreador && $resultados['total_respondientes'] === 0): ?>
        <form action="/encuestas/encuestas/eliminar" method="POST" class="mb-3">
            <input type="hidden" name="id" value="<?php echo $resultados['encuesta']['id']; ?>">
            <button class="btn btn-outline-danger" onclick="return confirm('¿Eliminar encuesta?');">
                <i class="fa fa-trash me-1"></i> Eliminar encuesta (sin respuestas)
            </button>
        </form>
    <?php endif; ?>

    <div class="vstack gap-3">
        <?php foreach ($resultados['detalle'] as $fila): 
            $si = (int)$fila['si']; $no = (int)$fila['no']; $total = $si + $no;
            $psi = $total ? round($si*100/$total) : 0;
            $pno = $total ? round($no*100/$total) : 0;
        ?>
        <div class="card">
            <div class="card-body">
                <div class="fw-semibold mb-2"><?php echo htmlspecialchars($fila['texto_pregunta']); ?></div>
                <div class="mb-1">Sí: <?php echo $si; ?> (<?php echo $psi; ?>%)</div>
                <div class="progress mb-2" role="progressbar" aria-label="Sí">
                    <div class="progress-bar" style="width: <?php echo $psi; ?>%"></div>
                </div>
                <div class="mb-1">No: <?php echo $no; ?> (<?php echo $pno; ?>%)</div>
                <div class="progress" role="progressbar" aria-label="No">
                    <div class="progress-bar bg-secondary" style="width: <?php echo $pno; ?>%"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/layouts/footer.php'; ?>
