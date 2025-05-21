<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Reservas</h1>
        <a href="<?= base_url('reservas/admin/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Reserva
        </a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Película</th>
                    <th>Sala</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?= $reserva->getId() ?></td>
                        <td><?= $reserva->getFuncion()->getPelicula()->getTitulo() ?></td>
                        <td><?= $reserva->getFuncion()->getSala()->getNombre() ?></td>
                        <td><?= $reserva->getUsuario()->getNombreCompleto() ?></td>
                        <td><?= $reserva->getFechaReservaFormateada() ?></td>
                        <td><?= $reserva->getTotalFormateado() ?></td>
                        <td>
                            <span class="badge <?= $reserva->estaCompletada() ? 'bg-success' : 'bg-warning' ?>">
                                <?= $reserva->getStatus() ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('reservas/ver/' . $reserva->getId()) ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('reservas/editar/' . $reserva->getId()) ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        onclick="confirmarEliminacion(<?= $reserva->getId() ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmarEliminacion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta reserva?')) {
        window.location.href = '<?= base_url('reservas/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?> 