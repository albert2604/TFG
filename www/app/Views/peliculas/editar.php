<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Película</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('peliculas/editar/' . $pelicula->getId()) ?>" method="post">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" 
                                   value="<?= $pelicula->getTitulo() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" 
                                      rows="3" required><?= $pelicula->getDescripcion() ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="duracion" class="form-label">Duración (minutos)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" 
                                   value="<?= $pelicula->getDuracion() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-select" id="genero" name="genero" required>
                                <option value="">Seleccione un género</option>
                                <option value="Acción" <?= $pelicula->getGenero() === 'Acción' ? 'selected' : '' ?>>Acción</option>
                                <option value="Aventura" <?= $pelicula->getGenero() === 'Aventura' ? 'selected' : '' ?>>Aventura</option>
                                <option value="Comedia" <?= $pelicula->getGenero() === 'Comedia' ? 'selected' : '' ?>>Comedia</option>
                                <option value="Drama" <?= $pelicula->getGenero() === 'Drama' ? 'selected' : '' ?>>Drama</option>
                                <option value="Fantasía" <?= $pelicula->getGenero() === 'Fantasía' ? 'selected' : '' ?>>Fantasía</option>
                                <option value="Ciencia Ficción" <?= $pelicula->getGenero() === 'Ciencia Ficción' ? 'selected' : '' ?>>Ciencia Ficción</option>
                                <option value="Terror" <?= $pelicula->getGenero() === 'Terror' ? 'selected' : '' ?>>Terror</option>
                                <option value="Romántica" <?= $pelicula->getGenero() === 'Romántica' ? 'selected' : '' ?>>Romántica</option>
                                <option value="Animación" <?= $pelicula->getGenero() === 'Animación' ? 'selected' : '' ?>>Animación</option>
                                <option value="Documental" <?= $pelicula->getGenero() === 'Documental' ? 'selected' : '' ?>>Documental</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="clasificacion" class="form-label">Clasificación</label>
                            <select class="form-select" id="clasificacion" name="clasificacion" required>
                                <option value="">Seleccione una clasificación</option>
                                <option value="TP" <?= $pelicula->getClasificacion() === 'TP' ? 'selected' : '' ?>>Todo Público</option>
                                <option value="+7" <?= $pelicula->getClasificacion() === '+7' ? 'selected' : '' ?>>Mayores de 7 años</option>
                                <option value="+12" <?= $pelicula->getClasificacion() === '+12' ? 'selected' : '' ?>>Mayores de 12 años</option>
                                <option value="+16" <?= $pelicula->getClasificacion() === '+16' ? 'selected' : '' ?>>Mayores de 16 años</option>
                                <option value="+18" <?= $pelicula->getClasificacion() === '+18' ? 'selected' : '' ?>>Mayores de 18 años</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="poster_url" class="form-label">URL del Póster</label>
                            <input type="url" class="form-control" id="poster_url" name="poster_url" 
                                   value="<?= $pelicula->getPosterUrl() ?>">
                        </div>

                        <div class="mb-3">
                            <label for="trailer_url" class="form-label">URL del Tráiler</label>
                            <input type="url" class="form-control" id="trailer_url" name="trailer_url" 
                                   value="<?= $pelicula->getTrailerUrl() ?>">
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="activo" <?= $pelicula->estaActiva() ? 'selected' : '' ?>>Activa</option>
                                <option value="inactivo" <?= !$pelicula->estaActiva() ? 'selected' : '' ?>>Inactiva</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Película</button>
                            <a href="<?= base_url('peliculas') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 