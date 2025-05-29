<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Función</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('funciones/admin/doEditar/' . $funcion->getId()) ?>" method="post">
                        <div class="mb-3">
                            <label for="pelicula_id" class="form-label">Película</label>
                            <select class="form-select" id="pelicula_id" name="pelicula_id" required>
                                <option value="">Seleccione una película</option>
                                <?php foreach ($peliculas as $pelicula): ?>
                                    <option value="<?= $pelicula->getId() ?>" 
                                            <?= $funcion->getPelicula() === $pelicula->getId() ? 'selected' : '' ?>>
                                        <?= $pelicula->getTitulo() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sala_id" class="form-label">Sala</label>
                            <select class="form-select" id="sala_id" name="sala_id" required>
                                <option value="">Seleccione una sala</option>
                                <?php foreach ($salas as $sala): ?>
                                    <option value="<?= $sala->getId() ?>" 
                                            <?= $funcion->getSalaId() === $sala->getId() ? 'selected' : '' ?>>
                                        <?= $sala->getNombre() ?> - <?= $sala->getCine()->getNombre() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" 
                                   value="<?= $funcion->getFecha() ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" 
                                           value="<?= $funcion->getHoraInicio() ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" 
                                           value="<?= $funcion->getHoraFin() ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio Base</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="precio" name="precio" 
                                       value="<?= $funcion->getPrecio() ?>" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status">
                                <option value="activo" <?= $funcion->estaActivo() ? 'selected' : '' ?>>Activo</option>
                                <option value="eliminado" <?= !$funcion->estaActivo() ? 'selected' : '' ?>>Eliminado</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Función</button>
                            <a href="<?= base_url('funciones/admin/list') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 