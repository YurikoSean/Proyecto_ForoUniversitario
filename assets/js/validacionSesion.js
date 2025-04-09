document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Con esto se evita el envío del formulario

        const email = document.getElementById("floatingInput").value.trim();
        const password = document.getElementById("floatingPassword").value.trim();

        // Limpiar los posibles errores anteriores
        limpiarErrores();

        let valid = true;

        if (!validarEmail(email)) {
            mostrarError("floatingInput", "Por favor, ingrese un email válido.");
            valid = false;
        }

        if (password.length < 6) {
            mostrarError("floatingPassword", "La contraseña debe tener al menos 6 caracteres.");
            valid = false;
        }

        // Si todo es válido, se envía el formulario
        if (valid) {
            form.submit();
        }
    });

    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function mostrarError(campoId, mensaje) {
        const campo = document.getElementById(campoId);
        campo.classList.add("is-invalid");  // Añade clase Bootstrap para resaltar el error

        const error = document.createElement("div");
        error.classList.add("invalid-feedback");
        error.textContent = mensaje;

        // Añadir el mensaje de error debajo del campo
        campo.parentElement.appendChild(error);
    }

    function limpiarErrores() {
        const camposInvalidos = document.querySelectorAll(".is-invalid");
        camposInvalidos.forEach(function(campo) {
            campo.classList.remove("is-invalid");
        });

        const mensajesError = document.querySelectorAll(".invalid-feedback");
        mensajesError.forEach(function(mensaje) {
            mensaje.remove();
        });
    }
});