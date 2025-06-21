document.addEventListener('DOMContentLoaded', function() {
    console.log('Cargo mi pagina');

    cargarTajetas();

    const btn = document.querySelector('#btn_crear_tarjeta');

    btn.addEventListener('click', crearTarjeta);

});

let tarjetas  = [
    { 
        titulo: 'Titulo 1', 
        descripcion: 'Some quick example text to build on the card title and make up the bulk of the card’s content.',
        boton: 'Button text',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    },
    {
        titulo: 'Titulo 2',
        descripcion: 'Some quick example text to build on the card title and make up the bulk of the card’s content.',
        boton: 'Button text',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    },
    {
        titulo: 'Titulo 3',
        descripcion: 'Some quick example text to build on the card title and make up the bulk of the card’s content.',
        boton: 'Button text',
        imagen: 'https://generacionxbox.com/wp-content/uploads/2025/02/dinamy_wallpaper_xbox_2025.jpg'
    }
];


const crearTarjeta = () => {
    console.log('mi funcion crear tarjeta')

    const form = document.querySelector('#formulario');
    const formData = new FormData(form);

    const entries = Object.fromEntries(formData.entries())
    const { titulo, descripcion, boton, imagen} = entries;
    const jsonEntries = JSON.stringify(entries);
    const objectEntries = JSON.parse(jsonEntries)

    const nuevaTarjeta = { titulo, descripcion, boton, imagen };

    console.log(nuevaTarjeta);

    tarjetas.push(nuevaTarjeta);
    localStorage.setItem('tarjetas', JSON.stringify(tarjetas));
    form.reset();
    cargarTajetas();

}

const cargarTajetas = () => {
    console.log('Llamando a mi funcion cargar tarjetas ...');

    const localStorageTarjetas = localStorage.getItem('tarjetas');
    if(localStorageTarjetas == null){
        localStorage.setItem('tarjetas', JSON.stringify(tarjetas))
    } else {
        const getTarjetas = localStorage.getItem('tarjetas');
        tarjetas = JSON.parse(getTarjetas);
    }

    console.log(localStorageTarjetas);

    const tarjetas_section = document.querySelector('#tarjetas_section');
    console.log(tarjetas_section);

    tarjetas_section.innerHTML = '';

    let content = '';
    tarjetas.forEach(tarjeta => {
        console.log(tarjeta);

        const { imagen, titulo, descripcion, boton } = tarjeta;

        const col = document.createElement('div');
        col.classList.add('col-4');
        col.classList.add('mb-3');

        col.innerHTML = `<div class="card" style="width: 18rem;">
                            <img src="${imagen}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">${titulo}</h5>
                                <p class="card-text">${descripcion}</p>
                                <a href="#" class="btn btn-primary">${boton}</a>
                            </div>
                        </div>`;

        tarjetas_section.append(col);

    });

    // const elemento = document.createElement('div');
    // tarjetas_section.append(content);



}































// const cargarTajetas = () => {
//     console.log('Llamando a mi funcion cargar tarjetas ...');

//     const tarjetas_section = document.querySelector('#tarjetas_section');
//     console.log(tarjetas_section);

//     tarjetas_section.innerHTML = '';

//     let content = '';
//     tarjetas.forEach(tarjeta => {
//         console.log(tarjeta);

//         const { imagen, titulo, descripcion, boton } = tarjeta;

//         content += `<div class="col-4">
//                         <div class="card" style="width: 18rem;">
//                             <img src="${imagen}" class="card-img-top" alt="...">
//                             <div class="card-body">
//                                 <h5 class="card-title">${titulo}</h5>
//                                 <p class="card-text">${descripcion}</p>
//                                 <a href="#" class="btn btn-primary">${boton}</a>
//                             </div>
//                         </div>
//                     </div>`;
//     });

//     // const elemento = document.createElement('div');
//     // tarjetas_section.append(content);

//     tarjetas_section.innerHTML = content;


// }