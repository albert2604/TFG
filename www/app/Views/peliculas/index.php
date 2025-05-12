<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Películas</h1>
        <a href="<?= base_url('peliculas/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Película
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

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($peliculas as $pelicula): ?>
            <div class="col">
                <div class="card h-100">
                    <?php if ($pelicula->getPosterUrl()): ?>
                        <img src="<?= $pelicula->getPosterUrl() ?>" class="card-img-top" alt="<?= $pelicula->getTitulo() ?>">
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
                                <i class="fas fa-ticket-alt"></i> <?= $pelicula->getClasificacion() ?>
                            </small>
                        </p>
                        <p class="card-text"><?= substr($pelicula->getDescripcion(), 0, 100) ?>...</p>
                    </div>
                    
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100" role="group">
                            <a href="<?= base_url('peliculas/ver/' . $pelicula->getId()) ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="<?= base_url('peliculas/editar/' . $pelicula->getId()) ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button type="button" class="btn btn-danger" 
                                    onclick="confirmarEliminacion(<?= $pelicula->getId() ?>)">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function confirmarEliminacion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta película?')) {
        window.location.href = '<?= base_url('peliculas/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>