<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Funciones</h1>
        <a href="<?= base_url('funciones/crear') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Función
        </a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($funciones as $funcion): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <?php if ($funcion->getPelicula()->getPosterUrl()): ?>
                        <img src="<?= $funcion->getPelicula()->getPosterUrl() ?>" 
                             class="card-img-top" 
                             alt="<?= $funcion->getPelicula()->getTitulo() ?>">
                    <?php else: ?>
                        <div class="bg-light p-4 text-center">
                            <i class="fas fa-film fa-3x text-muted"></i>
                            <p class="mt-2 mb-0">Sin póster</p>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= $funcion->getPelicula()->getTitulo() ?></h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <?= $funcion->getPelicula()->getDuracionFormateada() ?> |
                                <i class="fas fa-film"></i> <?= $funcion->getPelicula()->getGenero() ?>
                            </small>
                        </p>

                        <div class="mb-3">
                            <strong>Sala:</strong> <?= $funcion->getSala()->getNombre() ?><br>
                            <strong>Cine:</strong> <?= $funcion->getSala()->getCine()->getNombre() ?><br>
                            <strong>Fecha:</strong> <?= $funcion->getFechaFormateada() ?><br>
                            <strong>Horario:</strong> <?= $funcion->getHoraInicio() ?> - <?= $funcion->getHoraFin() ?><br>
                            <strong>Precio:</strong> <?= $funcion->getPrecioBaseFormateado() ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge <?= $funcion->estaActiva() ? 'bg-success' : 'bg-danger' ?>">
                                <?= $funcion->estaActiva() ? 'Activa' : 'Inactiva' ?>
                            </span>
                            <div class="btn-group">
                                <a href="<?= base_url('funciones/ver/' . $funcion->getId()) ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('funciones/editar/' . $funcion->getId()) ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        onclick="confirmarEliminacion(<?= $funcion->getId() ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function confirmarEliminacion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta función?')) {
        window.location.href = '<?= base_url('funciones/eliminar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?> 