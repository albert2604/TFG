<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<style>
  .form-step {
    opacity: 0;
    visibility: hidden;
    display: none;
    /* Oculta completamente y no ocupa espacio */
    transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
  }

  .form-step.active {
    opacity: 1;
    visibility: visible;
    display: block;
    transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
  }

  .progress-bar {
    transition: width 0.5s ease-in-out;
  }


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

    font-size: 18px;
    cursor: pointer;
  }

  .butaca.excluida {
    background-color: rgba(248, 215, 218, 0);
    color: red;
    pointer-events: none;
  }

  .butaca.reservada {
    color: gray;
    pointer-events: none;
  }

  .butaca.reservada>i {
    color: gray !important;
  }

  .cine-card {
  display: inline-block;
  position: relative;
  border: 4px solid transparent;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: border 0.3s;
}

.cine-card input[type="radio"] {
  display: none;
}

.cine-card .card-background {
  background-size: cover;
  background-position: center;
  width: 300px;
  height: 180px;
  display: flex;
  align-items: end;
}

.cine-card .card-overlay {
  width: 100%;
  background: rgba(0, 0, 0, 0.5);
  padding: 12px;
  color: white;
  font-size: 18px;
  font-weight: bold;
}
.cine-card:has(input[type="radio"]:checked) {
  border: 4px solid orange;
}

.cine-card input[type="radio"]:checked ~ .card-border {
  border-color: orange;
}

</style>

<div class="container mt-5">
  <h2 class="mb-4">Selecciona tu cine y función</h2>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="progress mb-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="25"
        aria-labelledby="form-progress">
        <div class="progress-bar" id="form-progress" style="width: 25%;"></div>
      </div>
    </div>
  </div>

  <div id="basicwizard">
    <ul class="nav nav-tabs nav-justified mb-3">
      <li class="nav-item" data-target-form="#cineForm">
        <a
          href="#cine"
          class="nav-link icon-btn ">
          <i class="bx bxs-contact me-1"></i>
          <span class="d-none d-sm-inline">Seleccionar Cine</span>
        </a>
      </li>
      <li class="nav-item" data-target-form="#peliculaForm">
        <a
          href="#pelicula"
          class="nav-link icon-btn ">
          <i class="bx bxs-contact me-1"></i>
          <span class="d-none d-sm-inline">Seleccionar Pelicula</span>
        </a>
      </li>
      <li class="nav-item" data-target-form="#salaForm">
        <a
          href="#sala"
          class="nav-link icon-btn">
          <i class="bx bxs-building me-1"></i>
          <span class="d-none d-sm-inline">Seleccionar Sala y Hora</span>
        </a>
      </li>

      <li class="nav-item" data-target-form="#butacaForm">
        <a
          href="#butaca"
          class="nav-link icon-btn">
          <i class="bx bxs-book me-1"></i>
          <span class="d-none d-sm-inline">Seleccionar Butacas</span>
        </a>
      </li>
      <li class="nav-item">
        <a
          href="#finalizacion"
          class="nav-link icon-btn">
          <i class="bx bxs-check-circle me-1"></i>
          <span class="d-none d-sm-inline">Finalizacion</span>
        </a>
      </li>
    </ul>

    <div class="tab-content mb-0 pt-0">

      <form id="multiStepForm" action="<?= base_url('wizard/doCrear') ?>" method="post">

        <div class="form-step active" id="cineForm">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Cines</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cines as $cine): ?>
                <tr>
                  <td>
                    <label class="cine-card hover-card">
                      <input
                        type="radio"
                        name="cine_id"
                        value="<?= $cine->getId(); ?>"
                        data-name="<?= $cine->getNombre() ?> - <?= $cine->getCiudad() ?>"
                        required />
                      <div class="card-background" style="background-image: url('<?= base_url('/img/cine.jpg') ?>');">
                        <div class="card-overlay">
                          <div class="cine-info">
                            Arcinema <?= $cine->getNombre() ?><br />
                            <?= $cine->getCiudad() ?>
                          </div>
                        </div>
                      </div>
                    </label>

                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <button type="button" class="btn btn-primary next-step">Siguiente</button>
        </div>

        <div class="form-step">
          <div class="mb-3">
            <label for="peliculaSelect" class="form-label">Selecciona una Película</label>
            <select id="peliculaSelect" name="pelicula_id" class="form-select" required>
              <option value="">Seleccione una película</option>
            </select>
          </div>
          <button type="button" class="btn btn-secondary prev-step">Anterior</button>
          <button type="button" class="btn btn-primary next-step">Siguiente</button>
        </div>

        <div class="form-step" id="funcionForm">
          <div class="mb-3">
            <label for="funcionSelect" class="form-label">Selecciona una Función</label>
            <select id="funcionSelect" id="funcion_id" class="form-select" required>
              <option value="">Seleccione una función</option>
            </select>
          </div>
          <button type="button" class="btn btn-secondary prev-step">Anterior</button>
          <button type="button" class="btn btn-primary next-step">Siguiente</button>
        </div>

        <div class="form-step" id="butacasForm">
          <div class="mb-3 d-flex justify-content-center flex-column align-items-center">
            <input type="hidden" id="filas_excluidas" name="filas_excluidas" value="">
            <input type="hidden" id="columnas_excluidas" name="columnas_excluidas" value="">
            <input type="hidden" id="butacas_excluidas" name="butacas_excluidas" value="">
            <input type="hidden" id="butacas_seleccionadas" name="butacas_seleccionadas" value="">
            <input type="hidden" id="butacas_reservadas" name="butacas_reservadas" value="">

            <input type="hidden" id="valFilas" name="valFilas" value="">
            <input type="hidden" id="valColumnas" name="valColumnas" value="">

            <div id="contenedorSala">

            </div>
          </div>
          <button type="button" class="btn btn-secondary prev-step">Anterior</button>
          <button type="button" class="btn btn-primary next-step">Siguiente</button>
        </div>

        <div class="form-step">
          <h4>Confirmacion</h4>
          <div class="review-info">
            <p><strong>Cine:</strong> <span id="reviewCine"></span></p>
            <p><strong>Pelicula:</strong> <span id="reviewPelicula"></span></p>
            <p><strong>sala y Hora:</strong> <span id="reviewSala"></span></p>
            <p><strong>Butacas:</strong> <span id="reviewButacas"></span></p>
            <p><strong>Total:</strong> <span id="reviewTotal"></span></p>
          </div>
          <div>
            <input type="hidden" name="funcion_id" id="inputFuncionId">
            <input type="hidden" name="usuario_id" id="inputUsuarioId" value="<?php echo $usuario_id; ?>">
            <input type="hidden" name="total" id="inputTotal">
            <input type="hidden" name="butacas" id="inputButacas">
            <input type="hidden" name="status" id="inputStatus">
          </div>
          <button type="button" class="btn btn-secondary prev-step">Anterior</button>
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="error" class="alert alert-danger mt-3" style="display: none;"></div>
</div>

<?= $this->endSection() ?>
<?= $this->section('view_js') ?>
<script src="/js/wizard.js"></script>
<?= $this->endSection() ?>