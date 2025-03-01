

const traducciones = {
    es: {
        direccionEnvio: "Dirección de Envío",
        nombres: "Nombres",
        apellidos: "Apellidos",
        correo: "Correo",
        telefono: "Número de Teléfono",
        direccion1: "Dirección 1",
        direccion2: "Apartamento, suite, etc",
        ciudad: "Ciudad",
        barrio: "Estado",
        codigoPostal: "Código Postal",
        totalPedido: "Total del Pedido",
        productos: "Productos",
        envio: "Envío",
        total: "Total",
        realizarPedido: "Realizar Pedido",
        tituloTienda: "Tienda de Flores",
        menuInicio: "Inicio",
        menuProductos: "Flores",
        menuchocolate: "Fresas Cubiertas de Chocolate",
        menuCarrito: "Carrito",
        menuContacto: "Contacto",
        textoCarrito: "Carrito",
        contacto: "Contacto",
        mensaje: "Envíanos un mensaje",
        enviarEmail: "Enviar",
        confirmarCompra: "Confirmar Compra",
        inicioDes: "Encuentra las flores perfectas para cada ocasión",
        moduloCarrito: "Carrito de Compras",
        tableProduc: "Productos",
        tablePre: "Precio",
        tableCats: "Cantidad",
        tableTotal: "Total",
        describeInicio: "Encuentra las flores perfectas para cada ocasión",
        botonCarrito: "🛒 Añadir al carrito",
        descriProduc: "Explora nuestra colección de flores",
        selectPreci: "Filtrar por precio:",
        optionAll: "Todos",
        optionHasta: "Hasta",
        tableCat: "Filtrar por cantidad de flores:",
        inputCantExam: "Ejemplo: 10",
        nombreCorreo: "Tu Nombre",
        TuCorreo: "Tu Correo",
        TuEncabezado: "",
        mensajeTu: "Tu Mensaje",
        envioCart: "Envío de flores a Miami y Broward",
        menuCat: "Categoria",
        menuCli: "Cliente",
        menuRew: "Reviews",
        menuVen: "Ventas",
        menuSalir: "Salir",
        menuInv: "Inventario",
        tituloReviews: "Agregar Review",
        nameReviews: "Nombre Completo",
        reviewsEmail: "Correo",
        reviewsMessage: "Descripción",
        buttonReviews: "Agregar",
        siguenos: "Síguenos en nuestras redes sociales.",
        TuEncabezado: "Por favor, introduzca un asunto",
        tax1: "Condado de Miami-Dade $15",
        tax2: "Condado de Broward $45",
        mess: "Mensaje del carrito:",
        pago: "🔒 Pago seguro en línea",
        envioseguro: "🚚 Envío rápido",
        estamos: "📞 ¡Estamos aquí para ayudar!",
        descridetalle: "Valoramos cada detalle para nuestros clientes. Si tiene alguna solicitud específica para su producto, infórmenos en el cuadro de recomendaciones. La satisfacción del cliente es nuestra prioridad.",
        taxescalcu: "Los impuestos y los gastos de envío se calculan al finalizar la compra.",
        box1: "Recomendación",
        box2: "Recomendacion De La Caja",
        infoDes: "Información",
        infoDes1: "Descripción Producto",
        infoDes2: "Información Adicional",
        metodoentrega: "Selecciona el método de entrega:"
    },
    en: {
        direccionEnvio: "Shipping Address",
        nombres: "First Name",
        apellidos: "Last Name",
        correo: "Email",
        telefono: "Phone Number",
        direccion1: "Address 1",
        direccion2: "Apartament, suite, etc",
        ciudad: "City",
        barrio: "State",
        codigoPostal: "Postal Code",
        totalPedido: "Order Summary",
        productos: "Products",
        envio: "Shipping",
        total: "Total",
        realizarPedido: "Place Order",
        tituloTienda: "Flower Shop",
        menuInicio: "Home",
        menuProductos: "Flowers",
        menuchocolate: "Chocolate Covered Strawberries",
        menuCarrito: "Cart",
        menuContacto: "Contact",
        textoCarrito: "Cart",
        contacto: "Contact",
        mensaje: "Send us a message",
        enviarEmail: "To send",
        confirmarCompra: "Confirm Purchase",
        inicioDes: "Find the perfect flowers for every occasion.",
        moduloCarrito: "Shopping Cart",
        tableProduc: "Product",
        tablePre: "Price",
        tableCats: "Quantity",
        tableTotal: "Total",
        describeInicio: "Find the perfect flowers for every occasion",
        botonCarrito: "🛒 Add to cart",
        descriProduc: "Explore our flower collection",
        selectPreci: "Filter by price:",
        optionAll: "ALL",
        optionHasta: "Up to",
        tableCat: "Filter by number of flowers:",
        inputCantExam: "Example: 10",
        nombreCorreo: "Your Name",
        TuCorreo: "Your Email",
        mensajeTu: "Your Message",
        envioCart: "Miami and Broward Flower delivery",
        menuCat: "Category",
        menuCli: "Customer",
        menuRew: "Reviews",
        menuVen: "Sales",
        menuSalir: "Exit",
        menuInv: "Inventory",
        tituloReviews: "Add Review",
        nameReviews: "Name",
        reviewsEmail: "Mail",
        reviewsMessage: "Description",
        buttonReviews: "Add",
        siguenos: "Follow us on our social media.",
        TuEncabezado: "Please enter a subject",
        tax1: "Miami dade country $15",
        tax2: "Broward country $45",
        mess: "Card Message:",
        pago: "🔒 Secure online checkout",
        envioseguro: "🚚 Fast shipping",
        estamos: "📞 We´re here to help",
        descridetalle: "We value every detail for our customers. If you have specific requests for your product, please let us know in the recommendations box.Customer satisfaction is our priority.",
        taxescalcu: "Taxes and shipping calculated at checkout.",
        box1: "Recommendation",
        box2: "Recommendation",
        infoDes: "Information",
        infoDes1: "Product description",
        infoDes2: "Additional information",
        metodoentrega: "Select the delivery method:"
    }
};

function cambiarIdioma(idioma) {
    document.getElementById("tituloTienda").textContent = traducciones[idioma].tituloTienda;
    document.getElementById("menuInicio").textContent = traducciones[idioma].menuInicio;
    document.getElementById("menuProductos").textContent = traducciones[idioma].menuProductos;
    document.getElementById("menuchocolate").textContent = traducciones[idioma].menuchocolate;
    document.getElementById("menuCarrito").textContent = traducciones[idioma].menuCarrito;
    document.getElementById("menuContacto").textContent = traducciones[idioma].menuContacto;
    /*document.getElementById("describeInicio").textContent = traducciones[idioma].describeInicio;
    document.getElementById("descriProduc").textContent = traducciones[idioma].descriProduc;
    document.getElementById("envioCart").textContent = traducciones[idioma].envioCart;*/
    if (document.getElementById("menuCat")) {
        document.getElementById("menuCat").textContent = traducciones[idioma].menuCat;
        document.getElementById("menuCli").textContent = traducciones[idioma].menuCli;
        document.getElementById("menuRew").textContent = traducciones[idioma].menuRew;
        document.getElementById("menuVen").textContent = traducciones[idioma].menuVen;
        document.getElementById("menuSalir").textContent = traducciones[idioma].menuSalir;
        document.getElementById("menuInv").textContent = traducciones[idioma].menuInv;
    }

    if (document.getElementById("mess")) {
        document.getElementById("mess").textContent = traducciones[idioma].mess;
        document.getElementById("pago").textContent = traducciones[idioma].pago;
        document.getElementById("envioseguro").textContent = traducciones[idioma].envioseguro;
        document.getElementById("estamos").textContent = traducciones[idioma].estamos;
        document.getElementById("descridetalle").textContent = traducciones[idioma].descridetalle;
        document.getElementById("box1").textContent = traducciones[idioma].box1;
        document.getElementById("box2").textContent = traducciones[idioma].box2;
    }

    if (document.getElementById("direccionEnvio")) {
        document.getElementById("direccionEnvio").textContent = traducciones[idioma].direccionEnvio;
        document.getElementById("labelNombres").textContent = traducciones[idioma].nombres;
        document.getElementById("labelApellidos").textContent = traducciones[idioma].apellidos;
        document.getElementById("labelCorreo").textContent = traducciones[idioma].correo;
        document.getElementById("labelTelefono").textContent = traducciones[idioma].telefono;
        document.getElementById("labelDireccion1").textContent = traducciones[idioma].direccion1;
        document.getElementById("labelDireccion2").textContent = traducciones[idioma].direccion2;
        document.getElementById("labelCiudad").textContent = traducciones[idioma].ciudad;
        document.getElementById("labelBarrio").textContent = traducciones[idioma].barrio;
        document.getElementById("labelCodigoPostal").textContent = traducciones[idioma].codigoPostal;
        document.getElementById("totalPedido").textContent = traducciones[idioma].totalPedido;
        document.getElementById("productos").textContent = traducciones[idioma].productos;
        document.getElementById("envio").textContent = traducciones[idioma].envio;
        document.getElementById("total").textContent = traducciones[idioma].total;
        document.getElementById("realizarPedido").textContent = traducciones[idioma].realizarPedido;
        document.getElementById("tax1").textContent = traducciones[idioma].tax1;
        document.getElementById("tax2").textContent = traducciones[idioma].tax2;
        document.getElementById("metodoentrega").textContent = traducciones[idioma].metodoentrega;
    }

    if (document.getElementById("selectPreci")) {
        document.getElementById("selectPreci").textContent = traducciones[idioma].selectPreci;
        document.getElementById("optionAll").textContent = traducciones[idioma].optionAll;
        document.getElementById("tableCat").textContent = traducciones[idioma].tableCat;
    }

    if (document.getElementById("moduloCarrito")) {
        document.getElementById("moduloCarrito").textContent = traducciones[idioma].moduloCarrito;
        document.getElementById("tableProduc").textContent = traducciones[idioma].tableProduc;
        document.getElementById("tablePre").textContent = traducciones[idioma].tablePre;
        document.getElementById("tableCats").textContent = traducciones[idioma].tableCats;
        document.getElementById("tableTotal").textContent = traducciones[idioma].tableTotal;
        document.getElementById("taxescalcu").textContent = traducciones[idioma].taxescalcu;
    }

    if (document.getElementById("tituloReviews")) {
        document.getElementById("tituloReviews").textContent = traducciones[idioma].tituloReviews;
        document.getElementById("nameReviews").textContent = traducciones[idioma].nameReviews;
        document.getElementById("reviewsEmail").textContent = traducciones[idioma].reviewsEmail;
        document.getElementById("reviewsMessage").textContent = traducciones[idioma].reviewsMessage;
        document.getElementById("buttonReviews").textContent = traducciones[idioma].buttonReviews;
    }

    if (document.getElementById("cart-total")) {
        document.getElementById("textoCarrito").textContent = traducciones[idioma].textoCarrito;
        document.getElementById("confirm-purchase").textContent = traducciones[idioma].confirmarCompra;
    }

    if (document.getElementById("contacto")) {
        document.getElementById("contacto").textContent = traducciones[idioma].contacto;
        document.getElementById("mensaje").textContent = traducciones[idioma].mensaje;
        document.getElementById("enviarEmail").textContent = traducciones[idioma].enviarEmail;
    }
    if (document.getElementById("siguenos")) {
        document.getElementById("siguenos").textContent = traducciones[idioma].siguenos;
    }

    // Aplicar traducción a elementos con la misma clase
    const elementos = document.getElementsByClassName("traducible");
    for (let i = 0; i < elementos.length; i++) {
        const key = elementos[i].getAttribute("data-traduccion");
        if (traducciones[idioma][key]) {
            elementos[i].textContent = traducciones[idioma][key];
        }
    }

    // Cambiar placeholders de los inputs
    const placeholders = {
        nombres: "nombres",
        apellidos: "apellidos",
        correo: "correo",
        telefono: "telefono",
        direccion1: "direccion1",
        direccion2: "direccion2",
        ciudad: "ciudad",
        barrio: "barrio",
        codigoPostal: "codigoPostal",
        nombreCorreo: "nombreCorreo",
        TuCorreo: "TuCorreo",
        mensajeTu: "mensajeTu",
        inputCantExam: "inputCantExam",
        TuEncabezado: "TuEncabezado"
    };

    for (let key in placeholders) {
        let input = document.getElementById(key);
        if (input) {
            input.placeholder = traducciones[idioma][placeholders[key]];
        }
    }

    document.dispatchEvent(new CustomEvent("idiomaCambiado", { detail: { idioma } }));
}

document.getElementById("btnIdioma").addEventListener("click", function () {
    let idiomaActual = this.getAttribute("data-idioma");
    let nuevoIdioma = idiomaActual === "es" ? "en" : "es";
    cambiarIdioma(nuevoIdioma);
    this.setAttribute("data-idioma", nuevoIdioma);
    this.textContent = nuevoIdioma === "es" ? "🇪🇸" : "🇺🇸";
});

document.addEventListener("DOMContentLoaded", function () {
    cambiarIdioma("en");
    document.getElementById("btnIdioma").setAttribute("data-idioma", "en");
    document.getElementById("btnIdioma").textContent = "🇺🇸";
});


