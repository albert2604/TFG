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


<script type="text/javascript">
    const filasSlider = document.getElementById("numero_filas");
    const columnasSlider = document.getElementById("numero_columnas");
    const valFilas = document.getElementById("valFilas");
    const valColumnas = document.getElementById("valColumnas");
    const sala = document.getElementById("sala");

    const inputFilasExcluidas = document.getElementById("filas_excluidas");
    const inputColumnasExcluidas = document.getElementById("columnas_excluidas");
    const inputButacasExcluidas = document.getElementById("butacas_excluidas");

    let filasExcluidas = inputFilasExcluidas.value.trim() === '' ?
        [] :
        inputFilasExcluidas.value.split(',').map(Number);

    let columnasExcluidas = inputColumnasExcluidas.value.trim() === '' ?
        [] :
        inputColumnasExcluidas.value.split(',').map(Number);

    let butacasExcluidas = inputButacasExcluidas.value.trim() === '' ?
        [] :
        JSON.parse(inputButacasExcluidas.value);

    function dibujarSala() {
        const filas = parseInt(filasSlider.value);
        const columnas = parseInt(columnasSlider.value);

        valFilas.textContent = filas;
        valColumnas.textContent = columnas;

        sala.innerHTML = "";

        // CABECERA DE COLUMNAS
        // Fila de botones de columnas
        const filaCabecera = document.createElement("div");
        filaCabecera.classList.add("fila-cabecera");

        const espacio = document.createElement("div");
        espacio.classList.add("elemento"); // espacio vacío
        filaCabecera.appendChild(espacio);

        for (let c = 1; c <= columnas; c++) {
            const btn = document.createElement("div");
            btn.classList.add("elemento", "boton-control");
            btn.textContent = "X";
            btn.onclick = () => excluirColumna(c);
            filaCabecera.appendChild(btn);
        }
        sala.appendChild(filaCabecera);

        // Dibujar filas
        for (let i = 1; i <= filas; i++) {
            const fila = document.createElement("div");
            fila.classList.add("fila");

            const btnFila = document.createElement("div");
            btnFila.classList.add("elemento", "boton-control");
            btnFila.textContent = "X";
            btnFila.onclick = () => excluirFila(i);
            fila.appendChild(btnFila);

            for (let j = 1; j <= columnas; j++) {
                const butaca = document.createElement("div");
                butaca.classList.add("elemento", "butaca");

                if (filasExcluidas.includes(i) || columnasExcluidas.includes(j)) {
                    butaca.classList.add("excluida");
                }

                const excluida = butacasExcluidas.some(b => b[0] === i && b[1] === j);
                butaca.innerHTML = `<i class="fa-solid fa-couch ${excluida ? 'text-danger' : 'text-success'}"></i>`;
                butaca.onclick = () => excluirButaca(i, j);
                fila.appendChild(butaca);

            }

            sala.appendChild(fila);
        }

    }

    function actualizar() {
        // También puedes actualizar los inputs hidden si lo necesitas
        document.getElementById("filas_excluidas").value = filasExcluidas.join(',');
        document.getElementById("columnas_excluidas").value = columnasExcluidas.join(',');

        dibujarSala(); // Redibuja la matriz con los cambios
    }

    function excluirFila(index) {
        const i = filasExcluidas.indexOf(index);
        if (i === -1) {
            filasExcluidas.push(index); // excluir
        } else {
            filasExcluidas.splice(i, 1); // desexcluir
        }
        actualizar();
    }

    function excluirColumna(index) {
        const i = columnasExcluidas.indexOf(index);
        if (i === -1) {
            columnasExcluidas.push(index); // excluir
        } else {
            columnasExcluidas.splice(i, 1); // desexcluir
        }
        actualizar();
    }

    function actualizarInputsOcultos() {
        inputFilasExcluidas.value = JSON.stringify(filasExcluidas);
        inputColumnasExcluidas.value = JSON.stringify(columnasExcluidas);
    }

    function excluirButaca(fila, columna) {
        console.log(fila + "-" + columna)
        const index = butacasExcluidas.findIndex(b => b[0] === fila && b[1] === columna);

        if (index === -1) {
            butacasExcluidas.push([fila, columna]);
        } else {
            butacasExcluidas.splice(index, 1);
        }

        // Actualizar el input hidden
        document.getElementById("butacas_excluidas").value = JSON.stringify(butacasExcluidas);

        // Redibujar
        dibujarSala();
    }

    // Listeners
    filasSlider.addEventListener("input", dibujarSala);
    columnasSlider.addEventListener("input", dibujarSala);

    // Inicial
    actualizar();
</script>
<?= $this->endSection() ?>