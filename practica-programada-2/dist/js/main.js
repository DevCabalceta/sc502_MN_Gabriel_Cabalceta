// ===== EJERCICIO 1: CARGAS SOCIALES =====

// Función para calcular las deducciones según leyes de Costa Rica
const calcularDeducciones = () => {
    const salarioBrutoInput = document.querySelector('#salarioBruto');
    const resultadoDiv = document.querySelector('#resultadoSalario');
    
    const salarioBruto = parseFloat(salarioBrutoInput.value);
    
    if (!salarioBruto || salarioBruto <= 0) {
        resultadoDiv.innerHTML = '<div class="alert alert-danger">Por favor ingrese un salario válido</div>';
        return;
    }
    
    // Cálculo de cargas sociales (aproximado según CCSS Costa Rica)
    const cargasSociales = salarioBruto * 0.1067; // 10.67% empleado
    
    // Cálculo del impuesto sobre la renta (simplificado)
    let impuestoRenta = 0;
    if (salarioBruto > 929000) { // Exento hasta ₡929,000 (aproximado 2024)
        const baseImponible = salarioBruto - 929000;
        if (baseImponible <= 467000) {
            impuestoRenta = baseImponible * 0.10; // 10%
        } else if (baseImponible <= 1400000) {
            impuestoRenta = 467000 * 0.10 + (baseImponible - 467000) * 0.15; // 15%
        } else {
            impuestoRenta = 467000 * 0.10 + 933000 * 0.15 + (baseImponible - 1400000) * 0.20; // 20%
        }
    }
    
    const totalDeducciones = cargasSociales + impuestoRenta;
    const salarioNeto = salarioBruto - totalDeducciones;
    
    resultadoDiv.innerHTML = `
        <div class="alert alert-success">
            <h5>Resultados del Cálculo:</h5>
            <p><strong>Salario Bruto:</strong> ₡${salarioBruto.toLocaleString('es-CR', {minimumFractionDigits: 2})}</p>
            <p><strong>Cargas Sociales (10.67%):</strong> ₡${cargasSociales.toLocaleString('es-CR', {minimumFractionDigits: 2})}</p>
            <p><strong>Impuesto sobre la Renta:</strong> ₡${impuestoRenta.toLocaleString('es-CR', {minimumFractionDigits: 2})}</p>
            <p><strong>Total Deducciones:</strong> ₡${totalDeducciones.toLocaleString('es-CR', {minimumFractionDigits: 2})}</p>
            <hr>
            <p class="text-success"><strong>Salario Neto:</strong> ₡${salarioNeto.toLocaleString('es-CR', {minimumFractionDigits: 2})}</p>
        </div>
    `;
};

// Event listener para el botón de calcular salario
document.querySelector('#calcularSalario').addEventListener('click', calcularDeducciones);

// ===== EJERCICIO 2: MANIPULACIÓN DEL DOM =====

let textoOriginal = true;

const cambiarContenidoParrafo = () => {
    const parrafo = document.querySelector('#parrafoTexto');
    
    if (textoOriginal) {
        parrafo.innerHTML = '¡El contenido del párrafo ha sido cambiado usando JavaScript y DOM!';
        parrafo.className = 'alert alert-success';
        textoOriginal = false;
    } else {
        parrafo.innerHTML = 'Este es el texto original del párrafo.';
        parrafo.className = 'alert alert-info';
        textoOriginal = true;
    }
};

// Event listener para cambiar texto
document.querySelector('#cambiarTexto').addEventListener('click', cambiarContenidoParrafo);

// ===== EJERCICIO 3: ESTRUCTURA DE CONTROL =====

const verificarEdadUsuario = () => {
    const edadInput = document.querySelector('#edadUsuario');
    const resultadoDiv = document.querySelector('#resultadoEdad');
    
    const edad = parseInt(edadInput.value);
    
    if (!edad || edad < 0) {
        resultadoDiv.innerHTML = '<div class="alert alert-danger">Por favor ingrese una edad válida</div>';
        return;
    }
    
    let mensaje = '';
    let tipoAlerta = '';
    
    if (edad >= 18) {
        mensaje = 'Eres mayor de edad';
        tipoAlerta = 'alert-success';
    } else {
        mensaje = 'Eres menor de edad';
        tipoAlerta = 'alert-warning';
    }
    
    resultadoDiv.innerHTML = `<div class="alert ${tipoAlerta}"><strong>${mensaje}</strong> (Edad: ${edad} años)</div>`;
};

// Event listener para verificar edad
document.querySelector('#verificarEdad').addEventListener('click', verificarEdadUsuario);

// ===== EJERCICIO 4: MANIPULACIÓN DE ARREGLOS =====

// Arreglo de estudiantes
const estudiantes = [
    { nombre: 'Juan', apellido: 'Pérez', nota: 85 },
    { nombre: 'María', apellido: 'González', nota: 92 },
    { nombre: 'Carlos', apellido: 'Rodríguez', nota: 78 },
    { nombre: 'Ana', apellido: 'Martínez', nota: 88 },
    { nombre: 'Luis', apellido: 'Jiménez', nota: 95 },
    { nombre: 'Sofia', apellido: 'Herrera', nota: 82 }
];

const mostrarListaEstudiantes = () => {
    const listaDiv = document.querySelector('#listaEstudiantes');
    
    let contenidoHTML = '<div class="row">';
    
    // Recorrer arreglo con forEach
    estudiantes.forEach((estudiante, index) => {
        contenidoHTML += `
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">${estudiante.nombre} ${estudiante.apellido}</h6>
                        <p class="card-text">Nota: <span class="badge bg-primary">${estudiante.nota}</span></p>
                    </div>
                </div>
            </div>
        `;
    });
    
    contenidoHTML += '</div>';
    
    // Calcular promedio de notas
    let sumaNotas = 0;
    estudiantes.forEach(estudiante => {
        sumaNotas += estudiante.nota;
    });
    
    const promedio = sumaNotas / estudiantes.length;
    
    contenidoHTML += `
        <div class="alert alert-primary mt-3">
            <h5>Estadísticas:</h5>
            <p><strong>Total de estudiantes:</strong> ${estudiantes.length}</p>
            <p><strong>Promedio general:</strong> ${promedio.toFixed(2)}</p>
        </div>
    `;
    
    listaDiv.innerHTML = contenidoHTML;
};

// Event listener para mostrar estudiantes
document.querySelector('#mostrarEstudiantes').addEventListener('click', mostrarListaEstudiantes);


        