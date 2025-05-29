<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ARCINEMA') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->renderSection('view_css') ?>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-cinesa, footer {
            background: linear-gradient(90deg, #003366 0%, #0055a5 100%);
        }

        .navbar-cinesa .navbar-brand,
        .navbar-cinesa .nav-link,
        .navbar-cinesa .nav-link.active {
            color: #fff !important;
            font-weight: bold;
        }

        .navbar-cinesa .nav-link:hover {
            color: #ffd700 !important;
        }

        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-cinesa">
        <div class="container">
            <a class="navbar-brand" href="/">ARCINEMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('usuario_rol') == "admin"): ?>
                        <li class="nav-item"><a class="nav-link" href="/peliculas/admin/list">Peliculas</a></li>
                        <li class="nav-item"><a class="nav-link" href="/reservas/admin/list">Reservas</a></li>
                        <li class="nav-item"><a class="nav-link" href="/cines/admin/list">Cines</a></li>
                        <li class="nav-item"><a class="nav-link" href="/usuarios/admin/list">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="/funciones/admin/list">Funciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="/salas/admin/list">Salas</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/cartelera">Cartelera</a></li>
                        <li class="nav-item"><a class="nav-link" href="/reservar">Reservar</a></li>
                    <?php endif; ?>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                👤 <?= esc(session()->get('usuario_nombre')) ?> (<?= esc(session()->get('usuario_rol')) ?>)
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                                <?php if (session()->get('usuario_rol') == "admin"): ?>

                                    <li><a class="dropdown-item" href="<?= base_url('usuarios/admin/ver/' . esc(session()->get('usuario_id'))) ?>">Mi perfil</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="<?= base_url('usuarios/ver/' . esc(session()->get('usuario_id'))) ?>">Mi perfil</a></li>
                                <?php endif; ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php if (session()->get('isLoggedIn')): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('reservas/mis-reservas/' . esc(session()->get('usuario_id'))) ?>">Mis reservas</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="/auth/logout">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/auth/login">Iniciar sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-4">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <div style="min-height: 50vh;"></div>
    <?= $this->include('layout/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-wizard@0.0.5">
    </script>
    <?= $this->renderSection('view_js') ?>

</body>

</html>