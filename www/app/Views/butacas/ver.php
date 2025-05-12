<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles de la Butaca</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Información de la Butaca</h4>
                            <dl class="row">
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8"><?= $butaca->getId() ?></dd>

                                <dt class="col-sm-4">Identificador:</dt>
                                <dd class="col-sm-8"><?= $butaca->getIdentificador() ?></dd>

                                <dt class="col-sm-4">Fila:</dt>
                                <dd class="col-sm-8"><?= $butaca->getFila() ?></dd>

                                <dt class="col-sm-4">Número:</dt>
                                <dd class="col-sm-8"><?= $butaca->getNumero() ?></dd>

                                <dt class="col-sm-4">Estado:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge <?= $butaca->estaDisponible() ? 'bg-success' : 
                                                        ($butaca->estaReservada() ? 'bg-warning' : 'bg-danger') ?>">
                                        <?= $butaca->getEstado() ?>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4>Información de la Sala</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Sala:</dt>
                                <dd class="col-sm-8"><?= $butaca->getSala()->getNombre() ?></dd>

                                <dt class="col-sm-4">Capacidad:</dt>
                                <dd class="col-sm-8"><?= $butaca->getSala()->getCapacidad() ?> asientos</dd>

                                <dt class="col-sm-4">Tipo:</dt>
                                <dd class="col-sm-8"><?= $butaca->getSala()->getTipo() ?></dd>

                                <dt class="col-sm-4">Cine:</dt>
                                <dd class="col-sm-8">
                                    <?= $butaca->getSala()->getCine()->getNombre() ?><br>
                                    <small class="text-muted">
                                        <?= $butaca->getSala()->getCine()->getDireccionCompleta() ?>
                                    </small>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= base_url('butacas/editar/' . $butaca->getId()) ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Butaca
                        </a>
                        <a href="<?= base_url('butacas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 