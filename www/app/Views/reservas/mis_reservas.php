<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Mis Reservas</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Función</th>
            <th>Fecha Reserva</th>
            <th>Estado</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservas as $reserva): ?>
            <tr>
                <td><?= esc($reserva['funcion_id']) ?></td>
                <td><?= esc($reserva['fecha_hora']) ?></td>
                <td>
                    <?php if ($reserva['status'] === 'completada'): ?>
                        <span class="badge bg-success">Completada</span>
                    <?php elseif ($reserva['status'] === 'pendiente'): ?>
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    <?php elseif ($reserva['status'] === 'cancelada'): ?>
                        <span class="badge bg-danger">Cancelada</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><?= esc($reserva['status']) ?></span>
                    <?php endif; ?>
                </td>
                <td><?= esc($reserva['total']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?> 