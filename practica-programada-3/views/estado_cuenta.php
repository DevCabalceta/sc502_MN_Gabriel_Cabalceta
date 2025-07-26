<div class="container mt-5">
    <h2>Estado de Cuenta</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Descripción</th><th>Monto (₡)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['transacciones'] as $t): ?>
                <tr>
                    <td><?= $t->id ?></td>
                    <td><?= $t->descripcion ?></td>
                    <td>₡<?= number_format($t->monto, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <ul class="list-group mt-4">
        <li class="list-group-item">Total de contado: ₡<?= number_format($data['contado'], 2) ?></li>
        <li class="list-group-item">Interés (2.6%): ₡<?= number_format($data['interes'], 2) ?></li>
        <li class="list-group-item">Cashback (0.1%): ₡<?= number_format($data['cashback'], 2) ?></li>
        <li class="list-group-item fw-bold">Monto final a pagar: ₡<?= number_format($data['final'], 2) ?></li>
    </ul>
</div>
