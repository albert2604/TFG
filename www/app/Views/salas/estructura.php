<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<style>
    .sala {
        display: inline-block;
        margin-top: 20px;
    }

    .fila {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }

    .fila-cabecera {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .elemento {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1px;
        font-size: 18px;
    }

    .boton-control {
        background-color: #f8d7da;
        border: 1px solid #f5c2c7;
        cursor: pointer;
        font-weight: bold;
    }

    .boton-control:hover {
        background-color: #f1b0b7;
    }

    .butaca {
        background-color: #d1e7dd;
        font-size: 18px;
        cursor: pointer;
    }

    .butaca.excluida {
        background-color: #f8d7da;
        color: red;
        pointer-events: none;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <form action="<?= base_url('salas/admin/doEstructura/' . $sala->getId()) ?>" method="post">
                        <h5 class="card-title mb-4">Configuración de la sala</h5>

                        <div class="mb-3">
                            <label class="form-label">Filas: <strong><span id="valFilas"><?= $sala->getNumeroFilas() ?></span></strong></label>
                            <input type="range" class="form-range" id="numero_filas" name="numero_filas" min="1" max="11" value="<?= $sala->getNumeroFilas() ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Columnas: <strong><span id="valColumnas"><?= $sala->getNumeroColumnas() ?></span></strong></label>
                            <input type="range" class="form-range" id="numero_columnas" name="numero_columnas" min="1" max="11" value="<?= $sala->getNumeroColumnas() ?>">
                        </div>

                        <div class="d-grid gap-2">
                            <input type="hidden" id="filas_excluidas" name="filas_excluidas" value="<?= $sala->getFilasExcluidas() ?>">
                            <input type="hidden" id="columnas_excluidas" name="columnas_excluidas" value="<?= $sala->getColumnasExcluidas() ?>">
                            <input type="hidden" id="butacas_excluidas" name="butacas_excluidas" value="<?= $sala->getButacasExcluidas() ?>">

                        </div>
                        <div class="col-12 mt-4">
                            <div id="sala" class="sala"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar estructura</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('view_js') ?>
<script src="/js/estructura.js"></script>
<?= $this->endSection() ?>