<?php require_once __DIR__.'/partials/header.php' ?>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Edad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student ['Id']) ?></td>
                <td><?= htmlspecialchars($student ['Nombre']) ?></td>
                <td><?= htmlspecialchars($student ['Apellido1']) ?></td>
                <td><?= htmlspecialchars($student ['Apellido1']) ?></td>
                <td><?= htmlspecialchars($student ['Edad']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__.'/partials/footer.php' ?>