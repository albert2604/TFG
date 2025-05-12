<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles del Cine</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID:</div>
                        <div class="col-md-8"><?= $cine->getId() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nombre:</div>
                        <div class="col-md-8"><?= $cine->getNombre() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Dirección:</div>
                        <div class="col-md-8"><?= $cine->getDireccion() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Ciudad:</div>
                        <div class="col-md-8"><?= $cine->getCiudad() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Teléfono:</div>
                        <div class="col-md-8"><?= $cine->getTelefono() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8"><?= $cine->getEmail() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Estado:</div>
                        <div class="col-md-8">
                            <span class="badge <?= $cine->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $cine->getEstado() ?>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Dirección Completa:</div>
                        <div class="col-md-8"><?= $cine->getDireccionCompleta() ?></div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('cines/editar/' . $cine->getId()) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="<?= base_url('cines') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 