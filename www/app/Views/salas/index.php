<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Salas</h1>
        <a href="<?= base_url('salas/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Sala
        </a>
    </div>

    <?php if (session()->has('mensaje')): ?>
        <div class="alert alert-success">
            <?= session('mensaje') ?>
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
                    <th>Cine</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salas as $sala): ?>
                    <tr>
                        <td><?= $sala->getId() ?></td>
                        <td><?= $sala->getCine()->getNombre() ?></td>
                        <td><?= $sala->getNombre() ?></td>
                        <td><?= $sala->getCapacidad() ?></td>
                        <td><?= $sala->getTipo() ?></td>
                        <td>
                            <span class="badge <?= $sala->estaActiva() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $sala->estaActiva() ? 'Activa' : 'Inactiva' ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('salas/ver/' . $sala->getId()) ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('salas/editar/' . $sala->getId()) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="confirmarEliminacion(<?= $sala->getId() ?>)">
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
    if (confirm('¿Está seguro de que desea eliminar esta sala?')) {
        window.location.href = '<?= base_url('salas/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?> 