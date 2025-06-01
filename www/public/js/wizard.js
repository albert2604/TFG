const steps = document.querySelectorAll(".form-step");
  const navItems = document.querySelectorAll(".nav-link.icon-btn");
  const nextBtns = document.querySelectorAll(".next-step");
  const prevBtns = document.querySelectorAll(".prev-step");
  const progressBar = document.querySelector(".progress-bar");

  let currentStep = 0;

  const valFilas = document.getElementById("valFilas");
  const valColumnas = document.getElementById("valColumnas");
  const sala = document.getElementById("contenedorSala");

  const inputFilasExcluidas = document.getElementById("filas_excluidas");
  const inputColumnasExcluidas = document.getElementById("columnas_excluidas");
  const inputButacasExcluidas = document.getElementById("butacas_excluidas");
  const inputButacasSeleccionadas = document.getElementById("butacas_seleccionadas");
  const inputButacasReservadas = document.getElementById("butacas_reservadas");

  let butacasSeleccionadas = inputButacasSeleccionadas.value.trim() === '' ? [] :
    JSON.parse(inputButacasSeleccionadas.value);


  // Inicializar dataLayer si aun no esta inicializado
  window.dataLayer = window.dataLayer || [];

  function seleccionarButaca(fila, columna) {
    const index = butacasSeleccionadas.findIndex(b => b[0] === fila && b[1] === columna);
    const seleccionada = index !== -1;
    console.log(seleccionada);
    if (!seleccionada) {
      console.log('anado_butaca')
      butacasSeleccionadas.push([fila, columna]);
    } else {
      console.log('elimino_butaca')
      butacasSeleccionadas.splice(index, 1);
    }

    // Actualizar el input hidden
    document.getElementById("butacas_seleccionadas").value = JSON.stringify(butacasSeleccionadas);
    dibujarSala();
  }

  function dibujarSala() {
    const filas = parseInt(valFilas.value);
    const columnas = parseInt(valColumnas.value);

    let filasExcluidas = inputFilasExcluidas.value.trim() === '' ? [] :
      inputFilasExcluidas.value.split(',').map(Number);

    let columnasExcluidas = inputColumnasExcluidas.value.trim() === '' ? [] :
      inputColumnasExcluidas.value.split(',').map(Number);

    let butacasExcluidas = inputButacasExcluidas.value.trim() === '' ? [] :
      JSON.parse(inputButacasExcluidas.value);

    let butacasReservadas = inputButacasReservadas.value.trim() === '' ? [] :
      JSON.parse(inputButacasReservadas.value);


    sala.innerHTML = "";
    console.log(`filas: ${filas} columnas:${columnas}`);

    // Dibujar filas
    for (let i = 1; i <= filas; i++) {
      const fila = document.createElement("div");
      fila.classList.add("fila");

      for (let j = 1; j <= columnas; j++) {
        const butaca = document.createElement("div");
        butaca.id = `butaca-${i}-${j}`;
        butaca.classList.add("elemento", "butaca");

        if (filasExcluidas.includes(i) || columnasExcluidas.includes(j)) {
          butaca.classList.add("excluida");
        }

        const excluida = butacasExcluidas.some(b => b[0] === i && b[1] === j);
        if (excluida) {
          butaca.classList.add('excluida');
        }

        const reservada = butacasReservadas.some(b => b[0] === i && b[1] === j);
        if (reservada) {
          butaca.classList.add('reservada');
        }

        const seleccionada = butacasSeleccionadas.some(b => b[0] === i && b[1] === j);
        if (seleccionada) {
          butaca.classList.add('seleccionada');
        }

        if (!butaca.classList.contains('excluida')) {
          butaca.innerHTML = `<i class="fa-solid fa-couch ${seleccionada ? 'text-danger' : 'text-success'}"></i>`;
          butaca.onclick = () => seleccionarButaca(i, j);
        }

        fila.appendChild(butaca);

      }

      sala.appendChild(fila);
    }

  }

  async function cargarPeliculas(cineId) {
    try {
      const respuesta = await fetch(`http://localhost/wizard/filtrar/${cineId}`);
      if (!respuesta.ok) throw new Error(`Error en la petición: ${respuesta.status}`);

      const funciones = await respuesta.json();
      const select = document.getElementById("peliculaSelect");
      select.innerHTML = '<option value="">Seleccione una película</option>'; // limpia

      const peliculasUnicas = {};
      funciones.forEach(funcion => {
        const id = funcion.pelicula_id.id;
        const titulo = funcion.pelicula_id.titulo;

        if (!peliculasUnicas[id]) {
          peliculasUnicas[id] = titulo;
          const option = document.createElement("option");
          option.value = id;
          option.textContent = titulo;
          select.appendChild(option);
        }
      });

    } catch (error) {
      console.error('Error al cargar películas:', error);
      document.getElementById("error").textContent = error.message;
      document.getElementById("error").style.display = "block";
    }
  }

  async function cargarFunciones(cineId, peliculaId) {
    try {
      const respuesta = await fetch(`http://localhost/wizard/filtrar/${cineId}/${peliculaId}`);
      if (!respuesta.ok) throw new Error(`Error en la petición: ${respuesta.status}`);

      const funciones = await respuesta.json();
      const select = document.getElementById("funcionSelect");
      select.innerHTML = '<option value="">Seleccione una función</option>';

      funciones.forEach(funcion => {
        const option = document.createElement("option");
        option.value = funcion.sala_id.id + "/" + funcion.id;
        option.textContent = `${funcion.fecha} / ${funcion.sala_id.nombre} / ${funcion.hora_inicio} - ${funcion.hora_fin}`;
        document.getElementById('inputFuncionId').value = funcion.id;
        select.appendChild(option);
      });

    } catch (error) {
      console.error('Error al cargar funciones:', error);
      document.getElementById("error").textContent = error.message;
      document.getElementById("error").style.display = "block";
    }
  }

  async function cargarEstructura(identificador) {
    try {
      const respuesta = await fetch(`http://localhost/wizard/estructura/${identificador}`);
      if (!respuesta.ok) throw new Error(`Error en la petición: ${respuesta.status}`);

      const estructura = await respuesta.json();

      console.log(estructura);
      valFilas.value = estructura.numero_filas;
      valColumnas.value = estructura.numero_columnas;
      inputFilasExcluidas.value = estructura.filas_excluidas;
      inputColumnasExcluidas.value = estructura.columnas_excluidas;
      inputButacasExcluidas.value = estructura.butacas_excluidas;
      inputButacasReservadas.value = estructura.butacas_reservadas;

      dibujarSala()
    } catch (error) {
      console.error('Error al cargar funciones:', error);
      document.getElementById("error").textContent = error.message;
      document.getElementById("error").style.display = "block";
    }
  }

  function updateProgressBar() {
    const progress = ((currentStep + 1) / steps.length) * 100;
    progressBar.style.width = `${progress}%`;
    progressBar.setAttribute("aria-valuenow", progress);
  }

  function showCurrentStep() {

    console.log(`Current Step: ${currentStep}`);
    steps.forEach((step, index) => {
      if (index === currentStep) {
        step.classList.add("active");
      } else {
        step.classList.remove("active");
      }
    });

    navItems.forEach((navItem, index) => {
      if (index === currentStep) {
        navItem.classList.add("active");
      } else {
        navItem.classList.remove("active");
      }
    });

    window.dataLayer.push({
      'event': `form_step_${currentStep + 1}`
    });

    updateProgressBar();
  }
  showCurrentStep();

  nextBtns.forEach((button) => {
    button.addEventListener("click", () => {

      const currentInputs = steps[currentStep].querySelectorAll("input, select");
      let valid = true;

      currentInputs.forEach((input) => {
        if (!input.checkValidity()) {
          input.classList.add("is-invalid");
          valid = false;
        } else {
          input.classList.remove("is-invalid");
          input.classList.add("is-valid");
        }
      });

      if (valid) {

        switch (currentStep) {
          case 0:
            let valor = document.querySelector('input[name="cine_id"]:checked').value;

            console.log(`Paso actual: ${currentStep}`);
            console.log(`cine: ${valor}`);
            console.log(`Paso siguiente: ${currentStep + 1}`);

            funciones = cargarPeliculas(valor);
            // Obtener las peliculas con el cine_id
            break;
          case 1:
            console.log(`Paso actual: ${currentStep}`);
            console.log(`Paso siguiente: ${currentStep + 1}`);

            const cineId = document.querySelector('input[name="cine_id"]:checked')?.value;
            const peliculaId = document.getElementById("peliculaSelect").value;

            if (cineId && peliculaId) {
              cargarFunciones(cineId, peliculaId);
            }
            // Obtener las funciones con cine_id y pelicula_id
            break;
          case 2:
            console.log(`Paso actual: ${currentStep}`);
            console.log(`Paso siguiente: ${currentStep + 1}`);

            const identificador = document.getElementById("funcionSelect").value;

            if (identificador) {
              cargarEstructura(identificador);
            }
            // Obtener la estructura de la sala
            break;
          case 3:
            console.log(`Paso actual: ${currentStep}`);
            console.log(`Paso siguiente: ${currentStep + 1}`);

            // Confirmación
            break;
          default:
            console.log(`Paso actual: ${currentStep}`);
        }

        steps[currentStep].classList.remove("active");
        currentStep++;

        // Populate review fields if on the final step
        //if (currentStep === steps.length) {
        const cineSeleccionado = document.querySelector('input[name="cine_id"]:checked');
        const peliculaSeleccionada = document.getElementById('peliculaSelect');
        const funcionSeleccionada = document.getElementById('funcionSelect');
        const butacasSeleccionadas = document.getElementById('butacas_seleccionadas');

        console.log(cineSeleccionado);
        document.getElementById('reviewCine').textContent = cineSeleccionado ? cineSeleccionado.getAttribute('data-name') : '';
        document.getElementById('reviewPelicula').textContent = peliculaSeleccionada ? peliculaSeleccionada.options[peliculaSeleccionada.selectedIndex].text : '';
        document.getElementById('reviewSala').textContent = funcionSeleccionada ? funcionSeleccionada.options[funcionSeleccionada.selectedIndex].text : '';
        document.getElementById('reviewButacas').textContent = butacasSeleccionadas ? butacasSeleccionadas.value : '';
        if (butacasSeleccionadas && butacasSeleccionadas.value) {
          // Convertimos el string en un array real
          const seleccionadas = JSON.parse(butacasSeleccionadas.value);
          const total = seleccionadas.length * 8;
          document.getElementById('reviewTotal').textContent = `${total} €`;
          document.getElementById('inputTotal').value = total;

        }
        showCurrentStep();
      }
    });
  });

  // Previous button event listeners
  prevBtns.forEach((button) => {
    button.addEventListener("click", () => {
      currentStep--;
      showCurrentStep();
    });
  });

  // Add event listener for form submission to fire the generate_lead event
  document.getElementById("multiStepForm").addEventListener("submit", async function(e) {
    e.preventDefault(); // Prevent the default form submission for this example
    // Obtener el formulario
    const form = document.getElementById("multiStepForm");
    const actionUrl = form.action;

    // Crear objeto FormData con los valores de los inputs hidden
    const formData = new FormData();
    formData.append('funcion_id', document.getElementById('inputFuncionId').value);
    formData.append('usuario_id', document.getElementById('inputUsuarioId').value);
    formData.append('total', document.getElementById('inputTotal').value);
    formData.append('butacas', document.getElementById('butacas_seleccionadas').value);

    try {
      const response = await fetch(actionUrl, {
        method: 'POST',
        body: formData
      });
      if (response.ok) {
        const resultado = await response.json();
        window.location.href = resultado.url;
      } else {
        console.error("Error en la respuesta del servidor");
      }
    } catch (error) {
      console.error("Error al enviar el formulario:", error);
    }
  });