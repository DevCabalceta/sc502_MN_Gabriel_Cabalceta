let estudiantes = JSON.parse(localStorage.getItem('estudiantes')) || [
    { nombre: "Maria", apellidos: "Mora Perez", nota: 90 },
    { nombre: "Pedro", apellidos: "Sibaja Lopez", nota: 60 },
    { nombre: "Marco", apellidos: "Rojas Castro", nota: 78 }
];

//Guardar en localStorage
function guardarEstudiantes() {
    localStorage.setItem('estudiantes', JSON.stringify(estudiantes));
}

// Función para mostrar la tabla y el resumen
function mostrarEstudiantes() {
    const tbody = document.getElementById('tabla_estudiantes');
    tbody.innerHTML = "";
    estudiantes.forEach(e => {
        let color = "";
        if (e.nota >= 80) color = "table-success";
        else if (e.nota < 65) color = "table-danger";
        tbody.innerHTML += `
            <tr>
                <td>${e.nombre}</td>
                <td>${e.apellidos}</td>
                <td class="${color} fw-bold">${e.nota}</td>
            </tr>
        `;
    });

    // Resumen
    if (estudiantes.length > 0) {
        let mayor = estudiantes.reduce((a, b) => a.nota > b.nota ? a : b);
        let menor = estudiantes.reduce((a, b) => a.nota < b.nota ? a : b);
        let promedio = (estudiantes.reduce((s, e) => s + Number(e.nota), 0) / estudiantes.length).toFixed(2);
        document.getElementById('resumen_estudiantes').innerHTML = `
            <div class="alert alert-info">
                <b>Estudiante con mayor nota:</b> ${mayor.nombre} ${mayor.apellidos} (${mayor.nota})<br>
                <b>Promedio de notas:</b> ${promedio}<br>
                <b>Nota más baja:</b> ${menor.nota}
            </div>
        `;
    }
}

// Evento para agregar estudiante
document.getElementById('formEstudiantes').addEventListener('submit', function(e) {
    e.preventDefault();
    let nombre = document.getElementById('nombreEstudiante').value.trim();
    let apellidos = document.getElementById('apellidosEstudiante').value.trim();
    let nota = document.getElementById('notaEstudiante').value.trim();

    if (!nombre || !apellidos || nota === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Campos obligatorios',
            text: 'Todos los campos son obligatorios.'
        });
        return;
    }
    nota = Number(nota);
    if (isNaN(nota) || nota < 0 || nota > 100) {
        Swal.fire({
            icon: 'warning',
            title: 'Nota inválida',
            text: 'La nota debe ser un número entre 0 y 100.'
        });
        return;
    }
    estudiantes.push({ nombre, apellidos, nota });
    guardarEstudiantes();
    mostrarEstudiantes();
    this.reset();
    Swal.fire({
        icon: 'success',
        title: 'Estudiante agregado',
        showConfirmButton: false,
        timer: 1200
    });
});

mostrarEstudiantes();