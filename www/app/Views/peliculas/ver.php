<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $pelicula->getPosterUrl() ?: base_url('assets/img/no-poster.jpg') ?>" 
                     class="card-img-top" alt="<?= $pelicula->getTitulo() ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $pelicula->getTitulo() ?></h5>
                    <p class="card-text">
                        <span class="badge bg-primary"><?= $pelicula->getGenero() ?></span>
                        <span class="badge bg-secondary"><?= $pelicula->getClasificacion() ?></span>
                        <span class="badge bg-info"><?= $pelicula->getDuracionFormateada() ?></span>
                    </p>
                    <?php if ($pelicula->getTrailerUrl()): ?>
                        <a href="<?= $pelicula->getTrailerUrl() ?>" class="btn btn-primary" target="_blank">
                            <i class="fas fa-play"></i> Ver Tráiler
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Detalles de la Película</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5>Descripción</h5>
                        <p><?= $pelicula->getDescripcion() ?></p>
                    </div>

                    <div class="mb-3">
                        <h5>Información</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Género:</strong> <?= $pelicula->getGenero() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Clasificación:</strong> <?= $pelicula->getClasificacion() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Duración:</strong> <?= $pelicula->getDuracionFormateada() ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Estado:</strong>
                                <span class="badge <?= $pelicula->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $pelicula->estaActivo() ? 'Activo' : 'Eliminado' ?>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('peliculas/admin/editar/' . $pelicula->getId()) ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Película
                        </a>
                        <a href="<?= base_url('peliculas/admin/list') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 