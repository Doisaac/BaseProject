import axios from 'axios';

// Variables
const $formulario = document.querySelector("#formulario");
const $resultado = document.querySelector("#resultado");
const $paginacion = document.querySelector("#paginacion");
const registrosPorPagina = 40;
let $terminoBusqueda;
let iterador;
let totalPaginas;
let paginaActual = 1;

window.onload = () => {
    $formulario.addEventListener("submit", validarFormulario);
};

function validarFormulario(e) {
    e.preventDefault();

    // Si el campo está vacío imprime mensaje de alerta
    $terminoBusqueda = document.querySelector("#termino").value.trim();
    if ($terminoBusqueda === "") {
        mostrarAlerta("Agrega un término de busqueda");
        // Limpiar el resultado previo
        limpiarHTML();
        return;
    }

    buscarImagenes();
}

async function buscarImagenes() {
    const KEY = "45791498-a05fbafcc7709e81d43f95a7f";
    const URL = `https://pixabay.com/api/?key=${KEY}&q=${$terminoBusqueda}&per_page=${registrosPorPagina}&page=${paginaActual}`;

    try {
        const response = await axios.get(URL);
        const result = response.data;

        totalPaginas = calcularPaginas(result.totalHits);
        mostarImagenes(result.hits);
    } catch (error) {
        console.error("Error al obtener imágenes:", error);
    }
}

function mostarImagenes(imagenes) {
    while ($resultado.firstChild) $resultado.firstChild.remove();

    // Iterar las imagenes
    imagenes.forEach((imagen) => {
        const { previewURL, likes, views, largeImageURL } = imagen;

        $resultado.innerHTML += `
        <div class="col-6 col-md-4 col-lg-3 mb-4 px-2">
          <div class="bg-white shadow-sm rounded overflow-hidden h-100 d-flex flex-column">
            <img src="${previewURL}" class="img-fluid w-100 m-h-200" />

            <div class="p-3 flex-grow-1 d-flex flex-column justify-content-between">
              <div>
                <p class="fw-bold mb-2">
                  ${likes} 
                  <span class="fw-light">Me Gusta</span>
                </p>

                <p class="fw-bold">
                  ${views} 
                  <span class="fw-light">Veces vista</span>
                </p>
              </div>

              <a
                href="${largeImageURL}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-primary text-uppercase fw-bold w-100 mt-3"
              >
                Ver Imagen HD
              </a>
            </div>
          </div>
        </div>
    `;
    });

    // Limpiar paginador previo
    while ($paginacion.firstChild) $paginacion.firstChild.remove();
    imprimirPaginador();
}

function calcularPaginas(total) {
    return parseInt(Math.ceil(total / registrosPorPagina));
}

// Generador para crear la cantiad de elementos dependiendo a las páginas
function* crearPaginador(total) {
    for (let i = 1; i <= total; i++) {
        yield i;
    }
}

function imprimirPaginador() {
    iterador = crearPaginador(totalPaginas);

    while (true) {
        const { value, done } = iterador.next();

        if (done) return;

        // Genera un boton por cada elemento en el generador
        const boton = document.createElement("a");
        boton.href = "#";
        boton.dataset.pagina = value;
        boton.textContent = value;
        boton.classList.add(
            "btn",
            "btn-secondary",
            "fw-bold",
            "mb-1",
            "me-2",
            "px-3",
            "py-1",
            "rounded",
            "text-uppercase",
            "siguiente"
        );

        boton.onclick = () => {
            paginaActual = value;
            buscarImagenes();
        };

        $paginacion.appendChild(boton);
    }
}

// Alerta HTML
function mostrarAlerta(message) {
    // Verifica si existe para eliminarla
    document.querySelector(".alerta")?.remove();

    const alerta = document.createElement("p");

    alerta.classList.add(
        "alert",
        "alert-danger",
        "px-4",
        "py-3",
        "rounded",
        "w-100",
        "mt-3",
        "text-center"
    );

    alerta.innerHTML = `
        <strong class="fw-bold">Error!</strong>
        <span class="d-block">${message}</span>
    `;

    $formulario.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 2500);
}

function limpiarHTML() {
    while ($resultado.firstChild) $resultado.firstChild.remove();
    while ($paginacion.firstChild) $paginacion.firstChild.remove();
}
