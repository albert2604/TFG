<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles de la Sala</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5>Información General</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>ID:</strong> <?= $sala->getId() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Cine:</strong> <?= $sala->getCine()->getNombre() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Nombre:</strong> <?= $sala->getNombre() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Capacidad:</strong> <?= $sala->getCapacidad() ?> asientos
                            </li>
                            <li class="list-group-item">
                                <strong>Tipo:</strong> <?= $sala->getTipo() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Estado:</strong>
                                <span class="badge <?= $sala->estaActiva() ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $sala->estaActiva() ? 'Activa' : 'Inactiva' ?>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('salas/editar/' . $sala->getId()) ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Sala
                        </a>
                        <a href="<?= base_url('salas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 