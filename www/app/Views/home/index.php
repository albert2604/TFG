<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4 fw-bold">¡Bienvenido a ARCINEMA!</h1>
        <p class="lead">Tu plataforma para reservar entradas y gestionar cines de forma sencilla y moderna.</p>
        <div class="mt-4">
            <a href="/peliculas" class="btn btn-primary btn-lg me-2">Ver Cartelera</a>
            <a href="/reservas" class="btn btn-success btn-lg me-2">Reservar Entradas</a>
            <?php if (!session()->get('isLoggedIn')): ?>
                <a href="auth/login" class="btn btn-outline-dark btn-lg">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 