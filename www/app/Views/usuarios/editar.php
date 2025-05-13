<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Usuario</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('usuarios/admin/doEditar/' . $usuario->getId()) ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" 
                                           value="<?= $usuario->getNombre() ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" 
                                           value="<?= $usuario->getApellidos() ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= $usuario->getEmail() ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Dejar en blanco para mantener la actual">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" 
                                   value="<?= $usuario->getTelefono() ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rol" class="form-label">Rol</label>
                                    <select class="form-select" id="rol" name="rol" required>
                                        <option value="usuario" <?= $usuario->getRol() === 'usuario' ? 'selected' : '' ?>>
                                            Usuario
                                        </option>
                                        <option value="admin" <?= $usuario->getRol() === 'admin' ? 'selected' : '' ?>>
                                            Administrador
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="activo" <?= $usuario->estaActivo() ? 'selected' : '' ?>>
                                            Activo
                                        </option>
                                        <option value="eliminado" <?= !$usuario->estaActivo() ? 'selected' : '' ?>>
                                            Eliminado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                            <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 