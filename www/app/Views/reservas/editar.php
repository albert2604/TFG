<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Reserva</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('reservas/editar/' . $reserva->getId()) ?>" method="post">
                        <div class="mb-3">
                            <label for="funcion_id" class="form-label">Función</label>
                            <select class="form-select" id="funcion_id" name="funcion_id" required>
                                <option value="">Seleccione una función</option>
                                <?php foreach ($funciones as $funcion): ?>
                                    <option value="<?= $funcion->getId() ?>" 
                                            <?= $reserva->getFuncionId() === $funcion->getId() ? 'selected' : '' ?>>
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
                                    <option value="<?= $usuario->getId() ?>" 
                                            <?= $reserva->getUsuarioId() === $usuario->getId() ? 'selected' : '' ?>>
                                        <?= $usuario->getNombreCompleto() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_reserva" class="form-label">Fecha de Reserva</label>
                            <input type="datetime-local" class="form-control" id="fecha_reserva" 
                                   name="fecha_reserva" value="<?= $reserva->getFechaReserva() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="total" name="total" 
                                       value="<?= $reserva->getTotal() ?>" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="pendiente" <?= $reserva->getEstado() === 'pendiente' ? 'selected' : '' ?>>
                                    Pendiente
                                </option>
                                <option value="confirmada" <?= $reserva->getEstado() === 'confirmada' ? 'selected' : '' ?>>
                                    Confirmada
                                </option>
                                <option value="cancelada" <?= $reserva->getEstado() === 'cancelada' ? 'selected' : '' ?>>
                                    Cancelada
                                </option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
                            <a href="<?= base_url('reservas') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 