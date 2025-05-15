<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Sala</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('salas/admin/doEditar/' . $sala->getId()) ?>" method="post">
                        <div class="mb-3">
                            <label for="cine_id" class="form-label">Cine</label>
                            <select class="form-select" id="cine_id" name="cine_id" required>
                                <option value="">Seleccione un cine</option>
                                <?php foreach ($cines as $cine): ?>
                                    <option value="<?= $cine->getId() ?>" 
                                            <?= $sala->getCineId() === $cine->getId() ? 'selected' : '' ?>>
                                        <?= $cine->getNombre() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?= $sala->getNombre() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacidad" class="form-label">Capacidad</label>
                            <input type="number" class="form-control" id="capacidad" name="capacidad" 
                                   value="<?= $sala->getCapacidad() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_sala" class="form-label">Tipo de Sala</label>
                            <select class="form-select" id="tipo_sala" name="tipo_sala" required>
                                <option value="">Seleccione un tipo</option>
                                <<?php foreach ($tipos as $tipo): ?>
                                    <option value="<?= $tipo['value'] ?>"><?= $tipo['text'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status">
                                <option value="activo" <?= $sala->estaActivo() ? 'selected' : '' ?>>Activo</option>
                                <option value="eliminado" <?= !$sala->estaActivo() ? 'selected' : '' ?>>Eliminado</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Sala</button>
                            <a href="<?= base_url('salas/admin/list') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 