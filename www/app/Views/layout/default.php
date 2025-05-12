<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ARCINEMA') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-cinesa {
            background: linear-gradient(90deg, #003366 0%, #0055a5 100%);
        }
        .navbar-cinesa .navbar-brand, .navbar-cinesa .nav-link, .navbar-cinesa .nav-link.active {
            color: #fff !important;
            font-weight: bold;
        }
        .navbar-cinesa .nav-link:hover {
            color: #ffd700 !important;
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
                <li class="nav-item"><a class="nav-link" href="/cines">Cines</a></li>
                <li class="nav-item"><a class="nav-link" href="/peliculas">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="/funciones">Funciones</a></li>
                <li class="nav-item"><a class="nav-link" href="/salas">Salas</a></li>
                <li class="nav-item"><a class="nav-link" href="/butacas">Butacas</a></li>
                <li class="nav-item"><a class="nav-link" href="reservas/crear">Reservas</a></li>
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item"><a class="nav-link" href="/mis-reservas">Mis reservas</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/usuarios/index">Usuarios</a></li>
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item">
                        <span class="nav-link disabled">👤 <?= esc(session()->get('usuario_nombre')) ?> (<?= esc(session()->get('usuario_rol')) ?>)</span>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/auth/logout">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/auth/login">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?= $this->renderSection('content') ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 