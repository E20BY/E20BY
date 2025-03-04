<?php
$agregar = new ControladorProducto();
$res = $agregar->agregarProducto();
$precio = $agregar->listarPrecioFiltro();
$reviews = new ControladorReview();
$reviews->agregarReview();
?>

<!--<div class="filters">
    <label for="price-filter" id="selectPreci">Filtrar por precio:</label>
    <select id="price-filter" onchange="filterProducts()">
        <option value="all" id="optionAll">Todos</option>
        <?php
        foreach ($precio as $key => $value) {
        ?>
            <option value="<?php echo $value['precio'] ?>">Until $<?php echo number_format($value['precio'], 2) ?></option>
        <?php
        }
        ?>
    </select>

    <label for="quantity-filter" id="tableCat">Filtrar por cantidad de flores:</label>
    <input type="number" id="quantity-filter" min="1" placeholder="Example: 10" oninput="filterProducts()">
</div>-->

<main>
    <div class="product-list" id="product-list">
        <?php
        foreach ($res as $key => $value) {
        ?>
            <div class="product" data-price="<?php echo $value['precio'] ?>" data-quantity="<?php echo $value['cantidad_flores'] ?>">
                <img src="<?php echo $value['foto_protada'] ?>"
                    alt="<?php echo $value['nombre'] ?>" class="product-img">

                <img src="<?php echo $value['foto1'] ?>"
                    alt="<?php echo $value['nombre'] ?>" class="product-img hover-img">
                <h2 id="<?php echo $value['prefijoi_nom'] ?>"><?php echo $value['producto'] ?></h2>
                <input type="hidden" name="id" value="<?php echo $value['id_producto'] ?>">
                <p id="<?php echo $value['prefijo_descrip'] ?>"><?php echo $value['descripcion'] ?></p>
                <p>$<?php echo number_format($value['precio'], 2) ?></p>
                <div class="contenerdor-botones">
                    <!--<div class="row">
                        <div class="col"><button class="traducible boton-reviews" id="" data-traduccion="botonReviews"><a href="index.php?action=inicio&id=<?php echo $value['id_producto'] ?>">Reviews</a></button></div>
                        <div class="col"><button><a href="index.php?action=cart&id=<?php echo $value['id_producto'] ?>" class="traducible" data-traduccion="botonCarrito">Añadir al carrito</a></button></div>
                    </div>-->
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</main>
<script>
    function filterProducts() {
        let priceFilter = document.getElementById("price-filter").value;
        let quantityFilter = document.getElementById("quantity-filter").value;
        let products = document.querySelectorAll(".product");

        products.forEach(product => {
            let price = parseInt(product.getAttribute("data-price"));
            let quantity = parseInt(product.getAttribute("data-quantity"));
            let show = true;

            if (priceFilter !== "all" && price > parseInt(priceFilter)) {
                show = false;
            }
            if (quantityFilter && quantity < parseInt(quantityFilter)) {
                show = false;
            }

            product.style.display = show ? "block" : "none";
        });
    }

    const etiquetasTraducciones = {
        es: {
            <?php
            $traduccionesEs = [];
            foreach ($res as $key => $value) {
                $traduccionesEs[] = '"' . $value['prefijoi_nom'] . '": "' . addslashes($value['nombre_es']) . '",
                               "' . $value['prefijo_descrip'] . '": "' . addslashes($value['descripcion_es']) . '"';
            }
            echo implode(",", $traduccionesEs);
            ?>
        },
        en: {
            <?php
            $traduccionesEn = [];
            foreach ($res as $key => $value) {
                $traduccionesEn[] = '"' . $value['prefijoi_nom'] . '": "' . addslashes($value['producto']) . '",
                                "' . $value['prefijo_descrip'] . '": "' . addslashes($value['descripcion']) . '"';
            }
            echo implode(",", $traduccionesEn);
            ?>
        }
    };

    document.addEventListener("idiomaCambiado", function(event) {
        let idioma = event.detail.idioma;

        // Iteramos sobre las claves para actualizar elementos si existen en el DOM
        for (let key in etiquetasTraducciones[idioma]) {
            let element = document.getElementById(key);
            if (element) {
                element.textContent = etiquetasTraducciones[idioma][key];
            }
        }
    });


    /*document.addEventListener("DOMContentLoaded", () => {
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
    });*/
</script>