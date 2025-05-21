<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Crear Nueva Reserva</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/reservas/admin/doCrear') ?>" method="post">
                        <div class="mb-3">
                            <label for="funcion_id" class="form-label">Función</label>
                            <select class="form-select" id="funcion_id" name="funcion_id" required>
                                <option value="">Seleccione una función</option>
                                <?php foreach ($funciones as $funcion): ?>
                                    <option value="<?= $funcion->getId() ?>">
                                        <?= $funcion->getPelicula()->getTitulo() ?> - 
                                        <?= $funcion->getSala()->getNombre() ?> - 
                                        <?= $funcion->getFechaFormateada() ?> 
                                        <?= $funcion->getHoraInicio() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="usuario_id" class="form-label">Usuario</label>
                            <select class="form-select" id="usuario_id" name="usuario_id" required>
                                <option value="">Seleccione un usuario</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= $usuario->getId() ?>">
                                        <?= $usuario->getNombreCompleto() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_hora" class="form-label">Fecha de Reserva</label>
                            <input type="datetime-local" class="form-control" id="fecha_hora" 
                                   name="fecha_hora" required>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="total" name="total" 
                                       step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pendiente">Pendiente</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Crear Reserva</button>
                            <a href="<?= base_url('reservas/admin/list') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 