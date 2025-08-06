function buscarPalabra() {
    const palabra = document.getElementById("inputPalabra").value.trim();
    if (palabra === "") return;

    fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${palabra}`)
        .then(res => res.json())
        .then(data => {
            if (!Array.isArray(data)) throw new Error("No encontrada");
            const definicion = data[0].meanings[0].definitions[0].definition || '';
            const ejemplo = data[0].meanings[0].definitions[0].example || 'No disponible';
            const audio = data[0].phonetics[0]?.audio || '';

            document.getElementById("palabraTitulo").innerText = palabra;
            document.getElementById("definicion").innerText = definicion;
            document.getElementById("ejemplo").innerText = ejemplo;
            document.getElementById("audio").src = audio;
            document.getElementById("resultado").classList.remove("d-none");

            // guardar en atributos
            document.getElementById("resultado").dataset.palabra = palabra;
            document.getElementById("resultado").dataset.definicion = definicion;
            document.getElementById("resultado").dataset.ejemplo = ejemplo;
            document.getElementById("resultado").dataset.audio = audio;

        }).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Palabra no encontrada'
            });
        });
}

function guardarPalabra() {
    const resultado = document.getElementById("resultado");
    const data = {
        palabra: resultado.dataset.palabra,
        definicion: resultado.dataset.definicion,
        ejemplo: resultado.dataset.ejemplo,
        audio: resultado.dataset.audio
    };

    fetch("controllers/PalabraController.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(res => res.json())
      .then(res => {
        if (res.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: 'Palabra guardada correctamente.'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la palabra.'
            });
        }
        
    });
}
