<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Usuarios</h1>
        <a href="<?= base_url('usuarios/admin/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Usuario
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
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->getId() ?></td>
                        <td><?= $usuario->getNombreCompleto() ?></td>
                        <td><?= $usuario->getEmail() ?></td>
                        <td><?= $usuario->getTelefono() ?></td>
                        <td><?= ucfirst($usuario->getRol()) ?></td>
                        <td>
                            <span class="badge <?= $usuario->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $usuario->getStatus() ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('usuarios/admin/ver/' . $usuario->getId()) ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="<?= base_url('usuarios/admin/editar/' . $usuario->getId()) ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('usuarios/admin/doEliminar/' . $usuario->getId()) ?>" 
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?> 