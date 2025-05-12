<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles de la Función</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <?php if ($funcion->getPelicula()->getPosterUrl()): ?>
                                <img src="<?= $funcion->getPelicula()->getPosterUrl() ?>" 
                                     alt="<?= $funcion->getPelicula()->getTitulo() ?>" 
                                     class="img-fluid rounded">
                            <?php else: ?>
                                <div class="bg-light rounded p-4 text-center">
                                    <i class="fas fa-film fa-3x text-muted"></i>
                                    <p class="mt-2 mb-0">Sin póster</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h3><?= $funcion->getPelicula()->getTitulo() ?></h3>
                            <p class="text-muted">
                                <i class="fas fa-clock"></i> <?= $funcion->getPelicula()->getDuracionFormateada() ?> |
                                <i class="fas fa-film"></i> <?= $funcion->getPelicula()->getGenero() ?> |
                                <i class="fas fa-user"></i> <?= $funcion->getPelicula()->getClasificacion() ?>
                            </p>
                            <p><?= $funcion->getPelicula()->getDescripcion() ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Información de la Función</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Sala:</dt>
                                <dd class="col-sm-8">
                                    <?= $funcion->getSala()->getNombre() ?> - 
                                    <?= $funcion->getSala()->getCine()->getNombre() ?>
                                </dd>

                                <dt class="col-sm-4">Fecha:</dt>
                                <dd class="col-sm-8"><?= $funcion->getFechaFormateada() ?></dd>

                                <dt class="col-sm-4">Horario:</dt>
                                <dd class="col-sm-8">
                                    <?= $funcion->getHoraInicio() ?> - <?= $funcion->getHoraFin() ?>
                                </dd>

                                <dt class="col-sm-4">Precio Base:</dt>
                                <dd class="col-sm-8"><?= $funcion->getPrecioBaseFormateado() ?></dd>

                                <dt class="col-sm-4">Estado:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge <?= $funcion->estaActiva() ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $funcion->estaActiva() ? 'Activa' : 'Inactiva' ?>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4>Información de la Sala</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Capacidad:</dt>
                                <dd class="col-sm-8"><?= $funcion->getSala()->getCapacidad() ?> asientos</dd>

                                <dt class="col-sm-4">Tipo:</dt>
                                <dd class="col-sm-8"><?= $funcion->getSala()->getTipo() ?></dd>

                                <dt class="col-sm-4">Cine:</dt>
                                <dd class="col-sm-8">
                                    <?= $funcion->getSala()->getCine()->getNombre() ?><br>
                                    <small class="text-muted">
                                        <?= $funcion->getSala()->getCine()->getDireccionCompleta() ?>
                                    </small>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= base_url('funciones/editar/' . $funcion->getId()) ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Función
                        </a>
                        <a href="<?= base_url('funciones') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 