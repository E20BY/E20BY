<?php
$carrito = new ModeloCarrito();
$cart = $carrito->countCarrito();

$reviews = new ControladorReview();
$res = $reviews->agregarReview();
$resReviews = $reviews->listarReviewsInfo();
?>
<div class="social-icons">
    <a href="https://www.facebook.com/share/18FPiTZjCY/?mibextid=wwXIfr" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/e20_miami?igsh=NzMxazl4ZjI5OWNm&utm_source=qr" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="http://www.tiktok.com/@karensarmientoj" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
</div>
<header>
    <!-- Carrusel de imágenes -->
    <div class="carousel">
        <!--<img src="https://la-flora.net/image/cache/catalog/tovars/2201-600x600.jpeg" class="active" alt="Flor 1">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLDlfFzcdemzRNRsCAgjN6eaDPrBOcBTARpA&s" alt="Flor 2">
        <img src="https://la-flora.net/image/cache/catalog/tovars/1417-600x600.jpeg" alt="Flor 3">-->
        <img src="views/img/header.jpeg" alt="Flor 4">
    </div>

    <!-- Contenido del header (logo y título) -->
    <div class="header-content">
        <img src="views/img/logo.png" alt="Logo de la Tienda">
        <h1 id="tituloTienda" style="">Flower Shop</h1>
    </div>
</header>

<nav class="menu <?php if (isset($_SESSION['validarPagina'])) { ?> menu2 <?php } ?>">
    <div class="menu-toggle" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <a href="inicio" id="menuInicio">Home</a>
    <a href="productos" id="menuProductos">Products</a>
    <a href="cart" id="menuCarrito">Cart</a>
    <a href="contacto" id="menuContacto">Contact</a>
    <?php
    if (isset($_SESSION['validarPagina'])) {
    ?>
        <a href="producto" id="menuInv">Inventario</a>
        <a href="categoria" id="menuCat">Categoria</a>
        <a href="cliente" id="menuCli">Cliente</a>
        <a href="reviews" id="menuRew">Reviews</a>
        <a href="ventas" id="menuVen">Ventas</a>
        <a href="salir" id="menuSalir">Salir</a>
    <?php
    }
    ?>
</nav>

<!-- Contenedor para los botones flotantes -->
<div id="container-btn">
    <div id="cart">🛒 <span id="textoCarrito">Cart</span> (<span id="cart-count"><?php echo $cart[0]['COUNT(precio)'] ?></span>)</div>
    <button id="btnIdioma" data-idioma="en">ES/EN</button>
    <a href="ingresar" id="btnLogin"><i class="fa-regular fa-user"></i></a>
</div>


<div id="reviewPopup" class="review-popup">
    <span id="closePopup" class="close-btn">&times;</span>
    <div class="review-content">
        <img id="reviewLogo" src="" alt="Logo del producto">
        <h3 id="reviewName"></h3>
        <p id="reviewDescription"></p>
    </div>
</div>
<script>
    function toggleMenu() {
        document.querySelector(".menu").classList.toggle("open");
    }
</script>

<script>
    // JavaScript para el carrusel automático
    let index = 0;
    const images = document.querySelectorAll('.carousel img');

    function changeImage() {
        images[index].classList.remove('active');
        index = (index + 1) % images.length;
        images[index].classList.add('active');
    }

    setInterval(changeImage, 3000); // Cambia cada 3 segundos


    // Generar el array de objetos usando PHP y JSON
    const reviews = <?php echo json_encode(array_map(function ($item) {
                        return [
                            'logo' => $item['foto_protada'],
                            'nombre' => $item['nombre'],
                            'descripcion' => $item['info']
                        ];
                    }, $resReviews)); ?>;

    let currentReview = 0;
    let popupVisible = true; // Control de visibilidad
    let reviewInterval;

    function showReview() {
        const popup = document.getElementById("reviewPopup");
        const logo = document.getElementById("reviewLogo");
        const name = document.getElementById("reviewName");
        const description = document.getElementById("reviewDescription");

        logo.src = reviews[currentReview].logo;
        name.textContent = reviews[currentReview].nombre;
        description.textContent = reviews[currentReview].descripcion;

        if (popupVisible) {
            popup.style.display = "flex";
        }

        setTimeout(() => {
            popup.style.display = "none";
            currentReview = (currentReview + 1) % reviews.length;
        }, 10000);
    }

    function startReviewCycle() {
        popupVisible = true;
        showReview();
        reviewInterval = setInterval(showReview, 10000);
    }

    setTimeout(startReviewCycle, 10000);

    // Botón de cerrar ventana
    document.getElementById("closePopup").addEventListener("click", function() {
        document.getElementById("reviewPopup").style.display = "none";
        popupVisible = false;

        setTimeout(() => {
            popupVisible = true;
        }, 10000); // Rehabilita la visibilidad después de un ciclo
    });
</script>