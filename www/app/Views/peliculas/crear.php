<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Crear Nueva Película</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('peliculas/admin/doCrear') ?>" method="post"  enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="duracion" class="form-label">Duración (minutos)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" required>
                        </div>

                        <div class="mb-3">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-select" id="genero" name="genero" required>
                                <option value="">Seleccione un género</option>
                                <option value="Acción">Acción</option>
                                <option value="Aventura">Aventura</option>
                                <option value="Comedia">Comedia</option>
                                <option value="Drama">Drama</option>
                                <option value="Fantasía">Fantasía</option>
                                <option value="Ciencia Ficción">Ciencia Ficción</option>
                                <option value="Terror">Terror</option>
                                <option value="Romántica">Romántica</option>
                                <option value="Animación">Animación</option>
                                <option value="Documental">Documental</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="clasificacion" class="form-label">Clasificación</label>
                            <select class="form-select" id="clasificacion" name="clasificacion" required>
                                <option value="">Seleccione una clasificación</option>
                                <option value="TP">Todo Público</option>
                                <option value="+7">Mayores de 7 años</option>
                                <option value="+12">Mayores de 12 años</option>
                                <option value="+16">Mayores de 16 años</option>
                                <option value="+18">Mayores de 18 años</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="poster_url" class="form-label">URL del Póster</label>
                            <input type="file" class="form-control" id="poster_url" name="poster_url">
                        </div>

                        <div class="mb-3">
                            <label for="trailer_url" class="form-label">URL del Tráiler</label>
                            <input type="url" class="form-control" id="trailer_url" name="trailer_url">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status">
                                <option value="activo">Activo</option>
                                <option value="eliminado">Eliminado</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Crear Película</button>
                            <a href="<?= base_url('peliculas/admin/list') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 