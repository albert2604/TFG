<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4 fw-bold">¡Pago Completado!</h1>
        <div class="mt-4">
            <a href="<?= base_url('/') ?>" class="btn btn-primary btn-lg me-2">Volver</a>
            </div>
    </div>
</div>
<?= $this->endSection() ?>