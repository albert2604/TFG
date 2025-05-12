<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Crear Nueva Butaca</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('butacas/crear') ?>" method="post">
                        <div class="mb-3">
                            <label for="sala_id" class="form-label">Sala</label>
                            <select class="form-select" id="sala_id" name="sala_id" required>
                                <option value="">Seleccione una sala</option>
                                <?php foreach ($salas as $sala): ?>
                                    <option value="<?= $sala->getId() ?>">
                                        <?= $sala->getNombre() ?> - <?= $sala->getCine()->getNombre() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fila" class="form-label">Fila</label>
                                    <input type="text" class="form-control" id="fila" name="fila" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número</label>
                                    <input type="number" class="form-control" id="numero" name="numero" 
                                           min="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="disponible">Disponible</option>
                                <option value="reservada">Reservada</option>
                                <option value="ocupada">Ocupada</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Crear Butaca</button>
                            <a href="<?= base_url('butacas') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 