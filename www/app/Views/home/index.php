<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<div id="carouselPeliculas" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <div class="d-flex align-items-center justify-content-center bg-light border border-secondary rounded shadow" style="height: 500px;">
                <div class="container text-center">
                    <h1 class="display-4 fw-bold">¡Bienvenido a ARCINEMA!</h1>
                    <p class="lead">Tu plataforma para reservar entradas y gestionar cines de forma sencilla y moderna.</p>
                    <div class="mt-4">
                        <a href="/cartelera" class="btn btn-primary btn-lg me-2">Ver Cartelera</a>
                        <a href="/reservar" class="btn btn-success btn-lg me-2">Reservar Entradas</a>
                        <?php if (!session()->get('isLoggedIn')): ?>
                            <a href="/auth/login" class="btn btn-outline-dark btn-lg">Iniciar Sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($peliculas)): ?>
            <?php foreach (array_slice($peliculas, 0, 2) as $pelicula): ?>
                <div class="carousel-item">
                    <?php if ($pelicula->getPosterUrl()): ?>
                        <img src="<?= $pelicula->getPosterUrl() ?>" class="d-block w-100" alt="<?= esc($pelicula->getTitulo()) ?>" style="max-height: 500px; object-fit: cover;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 500px;">
                            <i class="fas fa-film fa-4x"></i>
                        </div>
                    <?php endif; ?>
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-3">
                        <h5><?= esc($pelicula->getTitulo()) ?></h5>
                        <p><?= esc(substr($pelicula->getDescripcion(), 0, 100)) ?>...</p>
                        <a href="/reservas" class="btn btn-success">Reservar Entrada</a>
                    </div>
                </div>
            <?php endforeach; ?>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPeliculas" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselPeliculas" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
<?php endif; ?>


<div class="container mt-5">
    <h2 class="mb-4 text-center">Nuevas Peliculas</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach (array_slice($peliculas, 0, 3) as $pelicula): ?>
            <?php if ($pelicula->estaActivo()): ?>
                <div class="col">
                    <div class="card hover-card h-100 " style="width:400px;">
                        <?php if ($pelicula->getPosterUrl()): ?>
                            <?php if (session()->get('usuario_rol') == "admin"): ?>
                                <a href="<?= base_url('peliculas/admin/ver/' . $pelicula->getId()) ?>"><img src="<?= $pelicula->getPosterUrl() ?>" class="card-img-top" style="height: 500px;" alt="<?= $pelicula->getTitulo() ?>"></a>
                            <?php else: ?>
                                <a href="<?= base_url('cartelera/pelicula/' . $pelicula->getId()) ?>"><img src="<?= $pelicula->getPosterUrl() ?>" class="card-img-top" style="height: 500px;" alt="<?= $pelicula->getTitulo() ?>"></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <i class="fas fa-film fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body  shadow-sm">
                            <h5 class="card-title"><?= $pelicula->getTitulo() ?></h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-clock"></i> <?= $pelicula->getDuracionFormateada() ?> |
                                    <i class="fas fa-film"></i> <?= $pelicula->getGenero() ?> |
                                    <i class="fas fa-ticket-alt"></i> <?= $pelicula->getClasificacion() ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>