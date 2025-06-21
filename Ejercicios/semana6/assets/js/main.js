document.addEventListener('DOMContentLoaded', () => {
    console.log('Página cargada correctamente');

    inicializarTarjetas();
    document.querySelector('#btn_crear_tarjeta').addEventListener('click', manejarCrearTarjeta);
});

// Lista de tarjetas (puede venir de localStorage o usar esta como base)
let tarjetas = [
    {
        titulo: 'Titulo 1',
        descripcion: 'Descripción ejemplo para la tarjeta 1.',
        boton: 'Ver más',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    },
    {
        titulo: 'Titulo 2',
        descripcion: 'Descripción ejemplo para la tarjeta 2.',
        boton: 'Ver más',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    },
    {
        titulo: 'Titulo 3',
        descripcion: 'Descripción ejemplo para la tarjeta 3.',
        boton: 'Ver más',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    }
];

/**
 * Inicializa las tarjetas en la página, leyendo desde localStorage si existe.
 */
function inicializarTarjetas() {
    const tarjetasGuardadas = localStorage.getItem('tarjetas');

    if (tarjetasGuardadas) {
        tarjetas = JSON.parse(tarjetasGuardadas);
    } else {
        localStorage.setItem('tarjetas', JSON.stringify(tarjetas));
    }

    renderizarTarjetas();
}

/**
 * Maneja la creación de una nueva tarjeta cuando se da clic al botón.
 */
function manejarCrearTarjeta() {
    const form = document.querySelector('#formulario');
    const formData = new FormData(form);
    const nuevaTarjeta = Object.fromEntries(formData.entries());

    // Validación básica
    if (!nuevaTarjeta.titulo || !nuevaTarjeta.descripcion || !nuevaTarjeta.boton || !nuevaTarjeta.imagen) {
        alert('Por favor completa todos los campos.');
        return;
    }

    tarjetas.push(nuevaTarjeta);
    localStorage.setItem('tarjetas', JSON.stringify(tarjetas));

    form.reset(); // Limpia el formulario
    renderizarTarjetas();
}

/**
 * Renderiza todas las tarjetas en la sección correspondiente.
 */
function renderizarTarjetas() {
    const contenedor = document.querySelector('#tarjetas_section');
    contenedor.innerHTML = ''; // Limpia el contenido anterior

    tarjetas.forEach(({ titulo, descripcion, boton, imagen }) => {
        const tarjetaHTML = crearElementoTarjeta(titulo, descripcion, boton, imagen);
        contenedor.appendChild(tarjetaHTML);
    });
}

/**
 * Crea un elemento DOM representando una tarjeta Bootstrap.
 * @returns {HTMLElement} Elemento div con la tarjeta
 */
function crearElementoTarjeta(titulo, descripcion, boton, imagen) {
    const columna = document.createElement('div');
    columna.className = 'col-12 col-md-6 col-lg-4 mb-3';

    columna.innerHTML = `
        <div class="card h-100 shadow-sm">
            <img src="${imagen}" class="card-img-top" alt="${titulo}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">${titulo}</h5>
                <p class="card-text flex-grow-1">${descripcion}</p>
                <a href="#" class="btn btn-primary mt-auto">${boton}</a>
            </div>
        </div>
    `;

    return columna;
}
