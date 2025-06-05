
document.querySelector('.login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita envío por defecto

    const email = document.getElementById('mail').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!email || !password) {
      Swal.fire({
        icon: 'warning',
        title: 'Campos incompletos',
        text: 'Por favor complete todos los campos.',
        confirmButtonColor: '#0077ff'
      });
      return;
    }

    // Si todo está correcto, enviar el formulario
    this.submit();
});

