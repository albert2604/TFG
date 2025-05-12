<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Cines</h1>
        <a href="<?= base_url('cines/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Cine
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cines as $cine): ?>
                    <tr>
                        <td><?= $cine->getId() ?></td>
                        <td><?= $cine->getNombre() ?></td>
                        <td><?= $cine->getCiudad() ?></td>
                        <td><?= $cine->getTelefono() ?></td>
                        <td>
                            <span class="badge <?= $cine->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $cine->getEstado() ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('cines/ver/' . $cine->getId()) ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('cines/editar/' . $cine->getId()) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="confirmarEliminacion(<?= $cine->getId() ?>)">
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
    if (confirm('¿Está seguro de que desea eliminar este cine?')) {
        window.location.href = '<?= base_url('cines/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?> 