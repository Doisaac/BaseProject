//este archivo se agrego con el objetivo de GUARDAR en tiempo real los datos del formulario vehiculo
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formVehiculo');
    if (!form) return;

    const inputs = form.querySelectorAll('input, select, textarea');

    // Rellena los camps si hay datos guardados
    inputs.forEach(input => {
        const savedValue = sessionStorage.getItem(input.name);
        if (savedValue !== null) {
            input.value = savedValue;
        }
    });

    // Guarda los datos en tiempo real
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            sessionStorage.setItem(input.name, input.value);
        });
    });

    // Limpia los datos al enviar
    form.addEventListener('submit', () => {
        inputs.forEach(input => sessionStorage.removeItem(input.name));
    });
});
