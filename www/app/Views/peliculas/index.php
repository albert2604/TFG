<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">

        <?php if (session()->get('usuario_rol') == "admin"): ?>
            <h1>Gestión de Películas</h1>
            <a href="<?= base_url('peliculas/admin/crear') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Película
            </a>
        <?php else: ?>
            <h1>Cartelera</h1>
        <?php endif; ?>
    </div>
    <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar Pelicula...">

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

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($peliculas as $pelicula): ?>
            <div class="col">
                <div class="card hover-card h-100 pelicula-card">
                    <?php if ($pelicula->getPosterUrl()): ?>
                        <?php if (session()->get('usuario_rol') == "admin"): ?>

                            <a href="<?= base_url('peliculas/admin/ver/' . $pelicula->getId()) ?>"><img src="<?= $pelicula->getPosterUrl() ?>" class="card-img-top" style="height: 650px;" alt="<?= $pelicula->getTitulo() ?>"></a>
                        <?php else: ?>
                            <a href="<?= base_url('cartelera/pelicula/' . $pelicula->getId()) ?>"><img src="<?= $pelicula->getPosterUrl() ?>" class="card-img-top" style="height: 650px;" alt="<?= $pelicula->getTitulo() ?>"></a>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-film fa-3x text-muted"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= $pelicula->getTitulo() ?></h5>
                        <p class="card-text text-muted">
                            <small>
                                <i class="fas fa-clock"></i> <?= $pelicula->getDuracionFormateada() ?> |
                                <i class="fas fa-film"></i> <?= $pelicula->getGenero() ?> |
                                <i class="fas fa-ticket-alt"></i> <?= $pelicula->getClasificacion() ?> |
                                <span class="badge <?= $pelicula->estaActivo() ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $pelicula->estaActivo() ? 'Activo' : 'Eliminado' ?>
                                </span>
                            </small>
                        </p>
                        <p class="card-text"><?= substr($pelicula->getDescripcion(), 0, 100) ?>... (Continuar Sinopsis)</p>
                    </div>
                    <?php if (session()->get('usuario_rol') == "admin"): ?>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="<?= base_url('peliculas/admin/ver/' . $pelicula->getId()) ?>" class="btn btn-info">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="<?= base_url('peliculas/admin/editar/' . $pelicula->getId()) ?>" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="<?= base_url('peliculas/admin/doEliminar/' . $pelicula->getId()) ?>" class="btn btn-danger">
                                    <i class="fa fa-edit"></i> Eliminar
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('view_js') ?>
<script src="/js/buscador.js"></script>
<?= $this->endSection() ?>