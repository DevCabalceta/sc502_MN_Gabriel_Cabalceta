document.addEventListener('DOMContentLoaded', function() {
    console.log('mi funcion anonima');

    const btn = document.querySelector('#button')
    console.log(btn);

    btn.addEventListener('click', accion);
});


const accion = () => {
    console.log('presionando un boton...')
}

// document.addEventListener('DOMContentLoaded', function() {
//     console.log('mi funcion anonima');
// });

// document.addEventListener('DOMContentLoaded', miFuncion);

// function miFuncion(param) {
//     console.log('Se ejecuto mi funcion con nombre');
// }

// const miFuncionConst = (param) => {
//     console.log('Se ejecuto const')
// }

// document.addEventListener('DOMContentLoaded', miFuncionConst);