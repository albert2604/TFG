<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles del Usuario</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Información Personal</h4>
                            <dl class="row">
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8"><?= $usuario->getId() ?></dd>

                                <dt class="col-sm-4">Nombre:</dt>
                                <dd class="col-sm-8"><?= $usuario->getNombre() ?></dd>

                                <dt class="col-sm-4">Apellidos:</dt>
                                <dd class="col-sm-8"><?= $usuario->getApellidos() ?></dd>

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8"><?= $usuario->getEmail() ?></dd>

                                <dt class="col-sm-4">Teléfono:</dt>
                                <dd class="col-sm-8"><?= $usuario->getTelefono() ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4>Información de la Cuenta</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Rol:</dt>
                                <dd class="col-sm-8"><?= ucfirst($usuario->getRol()) ?></dd>

                                <dt class="col-sm-4">Estado:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge <?= $usuario->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $usuario->getEstado() ?>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= base_url('usuarios/editar/' . $usuario->getId()) ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Usuario
                        </a>
                        <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 