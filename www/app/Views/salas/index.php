<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Salas</h1>
        <a href="<?= base_url('salas/admin/crear') ?>" class="btn btn-primary">
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
                        <td><?= $sala->getTipoSala() ?></td>
                        <td>
                            <span class="badge <?= $sala->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $sala->estaActivo() ? 'Activo' : 'Eliminado' ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('salas/admin/ver/' . $sala->getId()) ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('salas/admin/editar/' . $sala->getId()) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="<?= base_url('salas/admin/estructura/'.$sala->getId()) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-couch"></i>
                                </a>

                                <a href="<?= base_url('salas/admin/doEliminar/' . $sala->getId()) ?>" class="btn btn-danger">
                                <i class="fa fa-trash"></i> 
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