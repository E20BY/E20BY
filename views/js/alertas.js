document.addEventListener("DOMContentLoaded", function () {
    // Obtener la URL actual
    const params = new URLSearchParams(window.location.search);
    // Si la URL tiene ?action=loginFallido, mostrar alerta
    if (params.get("action") === "loginFallido") {
        mostrarAlerta("⚠️ Error en el inicio de sesión. Verifica tus credenciales.");
    }
});

// Función para crear y mostrar la alerta
function mostrarAlerta(mensaje) {
    // Crear el contenedor de la alerta
    const alerta = document.createElement("div");
    alerta.classList.add("alerta-emergente");
    alerta.innerHTML = `
        <span>${mensaje}</span>
        <button onclick="cerrarAlerta()">✖</button>
    `;

    // Agregar la alerta al body
    document.body.appendChild(alerta);

    // Cerrar la alerta después de 4 segundos
    setTimeout(cerrarAlerta, 10000);
}

// Función para cerrar la alerta
function cerrarAlerta() {
    const alerta = document.querySelector(".alerta-emergente");
    if (alerta) {
        alerta.style.opacity = "0";
        setTimeout(() => alerta.remove(), 500);
    }
}
