// Obtener los elementos del DOM
const modal = document.getElementById("productModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");

// Abrir el modal cuando el botón es presionado
openModalBtn.onclick = function() {
    modal.style.display = "block";
}

// Cerrar el modal cuando se hace clic en el botón de cerrar
closeModalBtn.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal si el usuario hace clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
