<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles de la Reserva</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <?php if ($reserva->getFuncion()->getPelicula()->getPosterUrl()): ?>
                                <img src="<?= $reserva->getFuncion()->getPelicula()->getPosterUrl() ?>" 
                                     alt="<?= $reserva->getFuncion()->getPelicula()->getTitulo() ?>" 
                                     class="img-fluid rounded">
                            <?php else: ?>
                                <div class="bg-light rounded p-4 text-center">
                                    <i class="fas fa-film fa-3x text-muted"></i>
                                    <p class="mt-2 mb-0">Sin póster</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h3><?= $reserva->getFuncion()->getPelicula()->getTitulo() ?></h3>
                            <p class="text-muted">
                                <i class="fas fa-clock"></i> 
                                <?= $reserva->getFuncion()->getPelicula()->getDuracionFormateada() ?> |
                                <i class="fas fa-film"></i> 
                                <?= $reserva->getFuncion()->getPelicula()->getGenero() ?> |
                                <i class="fas fa-user"></i> 
                                <?= $reserva->getFuncion()->getPelicula()->getClasificacion() ?>
                            </p>
                            <p><?= $reserva->getFuncion()->getPelicula()->getDescripcion() ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Información de la Reserva</h4>
                            <dl class="row">
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8"><?= $reserva->getId() ?></dd>

                                <dt class="col-sm-4">Usuario:</dt>
                                <dd class="col-sm-8"><?= $reserva->getUsuario()->getNombreCompleto() ?></dd>

                                <dt class="col-sm-4">Fecha:</dt>
                                <dd class="col-sm-8"><?= $reserva->getFechaReservaFormateada() ?></dd>

                                <dt class="col-sm-4">Total:</dt>
                                <dd class="col-sm-8"><?= $reserva->getTotalFormateado() ?></dd>

                                <dt class="col-sm-4">Estado:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge <?= $reserva->estaConfirmada() ? 'bg-success' : 'bg-warning' ?>">
                                        <?= $reserva->getEstado() ?>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4>Información de la Función</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Sala:</dt>
                                <dd class="col-sm-8">
                                    <?= $reserva->getFuncion()->getSala()->getNombre() ?> - 
                                    <?= $reserva->getFuncion()->getSala()->getCine()->getNombre() ?>
                                </dd>

                                <dt class="col-sm-4">Fecha:</dt>
                                <dd class="col-sm-8"><?= $reserva->getFuncion()->getFechaFormateada() ?></dd>

                                <dt class="col-sm-4">Horario:</dt>
                                <dd class="col-sm-8">
                                    <?= $reserva->getFuncion()->getHoraInicio() ?> - 
                                    <?= $reserva->getFuncion()->getHoraFin() ?>
                                </dd>

                                <dt class="col-sm-4">Precio Base:</dt>
                                <dd class="col-sm-8"><?= $reserva->getFuncion()->getPrecioBaseFormateado() ?></dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= base_url('reservas/editar/' . $reserva->getId()) ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Reserva
                        </a>
                        <a href="<?= base_url('reservas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 