<?php
$agregar = new ControladorProducto();
$res = $agregar->agregarProducto();
$reviews = new ControladorReview();
$reviews->agregarReview();
?>

<div class="hero">
    <button class="arrow left" onclick="cambiarTexto(-1)">&#9665;</button>
    <span id="describeInicio" class="active">Encuentra las flores perfectas para cada ocasión</span>
    <span id="descriProduc">Explora nuestra colección de flores</span>
    <span id="envioCart">Envíos rápidos y seguros</span>
    <button class="arrow right" onclick="cambiarTexto(1)">&#9655;</button>
</div>

<main>
    <div class="product-list">
        <?php
        foreach ($res as $key => $value) {
        ?>
            <div class="product">
                <img src="<?php echo $value['foto_protada'] ?>"
                    alt="<?php echo $value['nombre'] ?>" class="product-img">

                <img src="<?php echo $value['foto1'] ?>"
                    alt="<?php echo $value['nombre'] ?>" class="product-img hover-img">

                <h2 id="Ramo_de_Rosasu"><?php echo $value['producto'] ?></h2>
                <p>$<?php echo number_format($value['precio'], 2) ?></p>
                <div class="contenerdor-botones">
                    <div class="row">
                        <div class="col"><button class="traducible boton-reviews" id="" data-traduccion="botonReviews"><a href="index.php?action=inicio&id=<?php echo $value['id_producto'] ?>">Reviews</a></button></div>
                        <div class="col"><button><a href="index.php?action=cart&id=<?php echo $value['id_producto'] ?>" class="traducible" data-traduccion="botonCarrito">Añadir al carrito</a></button></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</main>
<div id="productModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 id="tituloReviews">Agregar Review</h5>
            <span id="closeModalBtn" class="close-btn">&times;</span>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label id="nameReviews">Nombre</label>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label id="reviewsEmail">Correo</label>
                        <input type="email" name="email" class="form-control precio">
                    </div>
                    <div class="col-md-6 form-group">
                        <label id="reviewsMessage">Descripción</label>
                        <textarea name="message" id=""></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="agregarReview" id="buttonReviews" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>
<script>
    let spans;
    let currentIndex = 0;
    let intervalo;

    function cambiarTexto(direccion = 1) {
        spans[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + direccion + spans.length) % spans.length;
        spans[currentIndex].classList.add("active");
        reiniciarIntervalo();
    }

    function reiniciarIntervalo() {
        clearInterval(intervalo);
        intervalo = setInterval(() => cambiarTexto(1), 10000); // Cambio automático cada 10 segundos
    }

    document.addEventListener("DOMContentLoaded", function() {
        spans = document.querySelectorAll(".hero span");
        spans[currentIndex].classList.add("active");
        intervalo = setInterval(() => cambiarTexto(1), 10000);
    });


    const etiquetasTraducciones = {
        es: {
            Ramo_de_Rosas: "Ramo de Rosas",
            Tulipanes_Elegantes: "Tulipanes Elegantes",
            Orquídeas_de_Lujo: "Orquídeas de Lujo"
        },
        en: {
            Ramo_de_Rosas: "Bouquet of Roses",
            Tulipanes_Elegantes: "Elegant Tulips",
            Orquídeas_de_Lujo: "Luxury Orchids"
        }
    };

    document.addEventListener("idiomaCambiado", function(event) {
        let idioma = event.detail.idioma;
        document.getElementById("Ramo_de_Rosas").textContent = etiquetasTraducciones[idioma].Ramo_de_Rosas;
        document.getElementById("Tulipanes_Elegantes").textContent = etiquetasTraducciones[idioma].Tulipanes_Elegantes;
        document.getElementById("Orquídeas_de_Lujo").textContent = etiquetasTraducciones[idioma].Orquídeas_de_Lujo;
    });

    document.addEventListener("DOMContentLoaded", () => {
        const params = new URLSearchParams(window.location.search);

        // Verificar si existe el parámetro 'id' en la URL
        if (params.has('id')) {
            const modal = document.getElementById('productModal');
            modal.style.display = "block"; // Mostrar el modal
        }

        // Evento para cerrar el modal al hacer clic en la 'X'
        const closeModalBtn = document.getElementById('closeModalBtn');
        closeModalBtn.addEventListener('click', function() {
            const modal = document.getElementById('productModal');
            window.location.href = 'inicio';
        });

        // Cerrar el modal si el usuario hace clic fuera del modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('productModal');
            if (event.target === modal) {
                modal.style.display = "none"; // Ocultar el modal si se hace clic fuera de él
            }
        });
    });
</script>