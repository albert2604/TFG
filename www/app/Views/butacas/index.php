<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Butacas</h1>
        <a href="<?= base_url('butacas/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Butaca
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
                    <th>Sala</th>
                    <th>Cine</th>
                    <th>Fila</th>
                    <th>Número</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($butacas as $butaca): ?>
                    <tr>
                        <td><?= $butaca->getId() ?></td>
                        <td><?= $butaca->getSala()->getNombre() ?></td>
                        <td><?= $butaca->getSala()->getCine()->getNombre() ?></td>
                        <td><?= $butaca->getFila() ?></td>
                        <td><?= $butaca->getNumero() ?></td>
                        <td>
                            <span class="badge <?= $butaca->estaDisponible() ? 'bg-success' : 
                                                ($butaca->estaReservada() ? 'bg-warning' : 'bg-danger') ?>">
                                <?= $butaca->getEstado() ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('butacas/ver/' . $butaca->getId()) ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('butacas/editar/' . $butaca->getId()) ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        onclick="confirmarEliminacion(<?= $butaca->getId() ?>)">
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
    if (confirm('¿Está seguro de que desea eliminar esta butaca?')) {
        window.location.href = '<?= base_url('butacas/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?> 