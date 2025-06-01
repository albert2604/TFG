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
            columnasExcluidas.push(index); 
        } else {
            columnasExcluidas.splice(i, 1);         }
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

        dibujarSala();
    }

    filasSlider.addEventListener("input", dibujarSala);
    columnasSlider.addEventListener("input", dibujarSala);

    // Inicial
    actualizar();