import './bootstrap';
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formVehiculo");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valido = true;

        document.querySelectorAll(".invalid-feedback").forEach(e => e.remove());
        document.querySelectorAll(".is-invalid").forEach(e => e.classList.remove("is-invalid"));

        const placa = document.querySelector("[name='placa']");
        if (placa.value.trim().length < 6) {
            mostrarError(placa, "La placa es obligatoria.");
            valido = false;
        }

        const marca = document.querySelector("[name='marca']");
        if (marca.value.trim() === "") {
            mostrarError(marca, "La marca es obligatoria.");
            valido = false;
        }

        const modelo = document.querySelector("[name='modelo']");
        if (modelo.value.trim() === "") {
            mostrarError(modelo, "El modelo es obligatorio.");
            valido = false;
        }

        const año = document.querySelector("[name='año']");
        const valor = año.value.trim();
        if (!/^\d{4}$/.test(valor)) {
            mostrarError(año, 'Por favor, ingrese un año válido de 4 cifras.');
            valido = false;
        }

        const estado = document.querySelector("[name='estado']");
        if (estado.value === "") {
            mostrarError(estado, "Debes seleccionar un estado.");
            valido = false;
        }

        if (!valido) {
            e.preventDefault();
        }
    });

    function mostrarError(input, mensaje) {
        input.classList.add("is-invalid");
        const errorDiv = document.createElement("div");
        errorDiv.className = "invalid-feedback";
        errorDiv.innerText = mensaje;
        input.parentNode.appendChild(errorDiv);
    }
});
