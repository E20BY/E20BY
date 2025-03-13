<?php
$agregar = new ControladorProducto();
$res = $agregar->listarProductoIdControlador();
$reviews = new ControladorReview();
$reviews->agregarReview();
$resRev = $reviews->listarReviewsId();
?>
<style>
    .reseñas-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        /* Permite que se acomoden en columnas en pantallas pequeñas */
        justify-content: space-between;
        width: 100%;
    }

    .reseñas,
    .formulario {
        flex: 1;
        min-width: 300px;
        /* Evita que se reduzcan demasiado */
    }

    /* 📱 Responsivo para pantallas menores a 768px */
    @media (max-width: 768px) {
        .reseñas-container {
            flex-direction: column;
            /* Hace que los elementos se apilen verticalmente */
        }

        .reseñas,
        .formulario {
            width: 100%;
            /* Ocuparán toda la pantalla en dispositivos móviles */
        }

    }

    @media screen and (max-width: 390px) {

        .reseñas,
        .formulario {
            flex: 1;
            min-width: 240px;
            /* Evita que se reduzcan demasiado */
        }
    }

    .color-selection {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .color-row {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .color-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        /* 🖥 6 columnas en pantallas grandes */
        gap: 8px;
    }

    .color-btn {
        border: 1px solid #ccc;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        background-color: white;
        color: black;
        min-width: 80px;
        text-align: center;
    }

    .color-btn.active {
        background-color: #ff7f9e;
        color: white;
    }

    /* 📱 Pantallas medianas (tablets) */
    @media (max-width: 1024px) {
        .color-grid {
            grid-template-columns: repeat(4, 1fr);
            /* 🔹 4 columnas */
        }
    }

    /* 📱 Pantallas pequeñas (celulares) */
    @media (max-width: 768px) {
        .color-grid {
            grid-template-columns: repeat(5, 1fr);
            /* 🔹 3 columnas */
        }
    }

    /* 📱 Pantallas muy pequeñas */
    @media (max-width: 480px) {
        .color-grid {
            grid-template-columns: repeat(4, 1fr);
            /* 🔹 2 columnas */
        }
    }
</style>
<section class="detalle-producto">
    <div class="contenedor-producto">
        <div class="imagen-producto">
            <img src="<?php echo $res[0]['foto_protada'] ?>" alt="Imagen del producto">
        </div>
        <div class="info-producto">
            <h1 id="<?php echo $res[0]['prefijoi_nom'] ?>"><?php echo $res[0]['producto'] ?></h1>
            <p class="precio">$<?php echo number_format($res[0]['precio'], 2) ?></p>
            <p class="descripcion">
            <p id="<?php echo $res[0]['prefijo_descrip'] ?>"><?php echo $res[0]['descripcion'] ?></span></p>
            </p>

            <?php
            if ($res[0]['box'] != 1) {
            ?>

                <!--Aqui nuevos botones-->
                <div class="color-selection">
                    <!-- 📍 Selección de Box Color -->
                    <?php
                    if ($res[0]['box'] == 2) {
                    ?>
                        <div class="color-row">
                            <p><strong>Box Color:</strong> <span id="selected-box-color"></span></p>
                            <div class="color-grid" id="box-colors">
                                <?php
                                if ($res[0]['boxColor'] == 1) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 2) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 3) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                    <button class="color-btn boxColor" data-color="Pink">Pink</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 4) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                    <button class="color-btn boxColor" data-color="Pink">Pink</button>
                                    <button class="color-btn boxColor" data-color="Blue">Blue</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 5) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Silver">Silver</button>
                                    <button class="color-btn boxColor" data-color="Gold">Gold</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($res[0]['box'] == 3) {
                    ?>
                        <!-- 📍 Selección de Flower Color -->
                        <div class="color-row">
                            <p><strong>Flower Color:</strong> <span id="selected-flower-color"></span></p>
                            <div class="color-grid" id="flower-colors">
                                <?php
                                if ($res[0]['flowersColor'] == 1) {
                                ?>

                                    <button class="color-btn active flowerCol" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="Pink">Pink</button>
                                    <button class="color-btn flowerCol" data-color="Lavander">Lavander</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 2) {
                                ?>
                                    <button class="color-btn active flowerCol" data-color="Rosado-blanco">Rosado-blanco</button>
                                    <button class="color-btn flowerCol" data-color="Amarrillo-Naranja">Amarrillo-Naranja</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 3) {
                                ?>
                                    <button class="color-btn flowerCol active" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="purple">Purple</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 4) {
                                ?>
                                    <button class="color-btn active flowerCol" data-color="Red">Red</button>
                                    <button class="color-btn flowerCol" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="Pink">Pink</button>
                                    <button class="color-btn flowerCol" data-color="Lavander">Lavander</button>
                                    <button class="color-btn flowerCol" data-color="Yellow">Yellow</button>
                                    <button class="color-btn flowerCol" data-color="Orange">Orange</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($res[0]['box'] == 4) {
                    ?>
                        <div class="color-row">
                            <p><strong>Box Color:</strong> <span id="selected-box-color"></span></p>
                            <div class="color-grid" id="flower-colors">
                                <?php
                                if ($res[0]['boxColor'] == 1) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 2) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 3) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                    <button class="color-btn boxColor" data-color="Pink">Pink</button>
                                <?php
                                } elseif ($res[0]['boxColor'] == 4) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Black">Black</button>
                                    <button class="color-btn boxColor" data-color="White">White</button>
                                    <button class="color-btn boxColor" data-color="Pink">Pink</button>
                                    <button class="color-btn boxColor" data-color="Blue">Blue</button>
                                    <?php
                                } elseif ($res[0]['boxColor'] == 5) {
                                ?>
                                    <button class="color-btn active boxColor" data-color="Silver">Silver</button>
                                    <button class="color-btn boxColor" data-color="Gold">Gold</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- 📍 Selección de Flower Color -->
                        <div class="color-row">
                            <p><strong>Flower Color:</strong> <span id="selected-flower-color"></span></p>
                            <div class="color-grid" id="flower-colors">
                                <?php
                                if ($res[0]['flowersColor'] == 1) {
                                ?>
                                    <button class="color-btn active flowerCol" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="Pink">Pink</button>
                                    <button class="color-btn flowerCol" data-color="Lavander">Lavander</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 2) {
                                ?>
                                    <button class="color-btn active flowerCol" data-color="Rosado-blanco">Rosado-blanco</button>
                                    <button class="color-btn flowerCol" data-color="Amarrillo-Naranja">Amarrillo-Naranja</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 3) {
                                ?>
                                    <button class="color-btn flowerCol active" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="purple">Purple</button>
                                <?php
                                } elseif ($res[0]['flowersColor'] == 4) {
                                ?>
                                    <button class="color-btn active flowerCol" data-color="Red">Red</button>
                                    <button class="color-btn flowerCol" data-color="White">White</button>
                                    <button class="color-btn flowerCol" data-color="Pink">Pink</button>
                                    <button class="color-btn flowerCol" data-color="Lavander">Lavander</button>
                                    <button class="color-btn flowerCol" data-color="Yellow">Yellow</button>
                                    <button class="color-btn flowerCol" data-color="Orange">Orange</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <br>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="agregar-carrito">
                <button class="btn-restar">-</button>
                <input type="text" value="1" name="cant" class="cantidad">
                <button class="btn-sumar">+</button>
                <button id="btnAgregarCarrito" class="traducible" data-traduccion="botonCarrito">🛒 Agregar al carrito</button>
            </div>
            <div class="timecart-container">
                <div class="timecart">
                    <label id="selectdate">Select a delivery date:</label>
                    <input type="date" name="fecha">
                    <select name="hora" id="">
                        <option value="" id="selectime">Select Time</option>
                        <option value="8:30 AM - 02:00 PM">8:30 AM - 02:00 PM</option>
                        <option value="2:00 PM - 06:30 PM">2:00 PM - 06:30 PM</option>
                    </select>
                </div>
            </div>
            <div class="agregar-cart">
                <label id="mess">Mensaje del carrito:</label>
                <textarea name="mensaje" id="" required cols="30" rows="5"></textarea>
            </div>
            <div class="info-checks">
                <p id="pago">🔒 Pago seguro en línea</p>
                <p id="envioseguro">🚚 Envío rápido</p>
                <p class="url" id="estamos">📞 ¡Estamos aquí para ayudar!</p>
            </div>
        </div>
    </div>
    <p>
    <p id="descridetalle">"We value every detail for our customers. If you have specific requests for your product, please let us know in the recommendations box.Customer satisfaction is our priority"</p>
    </p>
    <div class="detalle-inferior">
        <ul class="tabs">
            <li class="activo" id="box1">Recomendación</li>
            <!--<li id="infoDes">Information</li>-->
            <li>Reviews (<?php $conn = 0;
                            foreach ($resRev as $key => $value) {
                                $conn = $key + 1;
                            }
                            echo $conn; ?>)</li>
        </ul>

        <div class="contenido-tab activo">
            <h2 id="box2">Recomendacion De La Caja</h2>
            <textarea name="box" id="" cols="30" rows="5"></textarea>
        </div>

        <!--<div class="contenido-tab">
            <h2 id="infoDes1">Product description</h2>
            <p>
                <?php echo $res[0]['descripcion'] ?></span>
            </p>
            <h2 id="infoDes2">Additional information</h2>
            <p><?php echo $res[0]['informacion_adicional'] ?></p>
        </div>-->

        <div class="contenido-tab">
            <div class="container">
                <div class="reseñas-container">
                    <div class="col-md-6 reseñas">
                        <h4 class="mb-4">
                            <?php $conn = 0;
                            foreach ($resRev as $key => $value) {
                                $conn = $key + 1;
                            }
                            echo $conn; ?> reseña(s) para "<?php echo $res[0]['producto'] ?>"
                        </h4>
                        <?php foreach ($resRev as $key => $value) { ?>
                            <div class="media mb-4">
                                <div class="media-body">
                                    <h6><?php echo $value['nombre'] ?>
                                        <small> - <i><?php echo $value['fecha'] ?></i></small>
                                    </h6>
                                    <p><?php echo $value['info'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 formulario">
                        <h4 class="mb-4" id="resena">Deja una reseña</h4>
                        <small id="small">Tu dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con *</small>
                        <form method="post">
                            <div class="form-group">
                                <label for="message" id="message">Tu opinión *</label>
                                <textarea  required name="message" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name" id="nombrefor">Su nombre *</label>
                                <input type="text" required class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email" id="email">Su correo electrónico *</label>
                                <input type="email" required class="form-control" name="email">
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" name="agregarReview" value="Deja tu opinión" id="opinion" class="btn btn-primary px-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<script>

    document.querySelectorAll('.boxColor').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.boxColor').forEach(btn => btn.classList.remove('active')); // Quitar active de todos
            this.classList.add('active'); // Agregar active al seleccionado
            //document.getElementById('selected-box-color').textContent = this.dataset.color; // Actualizar texto
        });
    });

    document.querySelectorAll('.flowerCol').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.flowerCol').forEach(btn => btn.classList.remove('active')); // Quitar active de todos
            this.classList.add('active'); // Agregar active al seleccionado
            //document.getElementById('selected-flower-color').textContent = this.dataset.color; // Actualizar texto
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".tabs li");
        const tabContents = document.querySelectorAll(".contenido-tab");

        tabs.forEach((tab, index) => {
            tab.addEventListener("click", function() {
                // Remover clase activa de todos los tabs y contenidos
                tabs.forEach(t => t.classList.remove("activo"));
                tabContents.forEach(content => content.classList.remove("activo"));

                // Activar el tab y el contenido correspondiente
                this.classList.add("activo");
                tabContents[index].classList.add("activo");
            });
        });
    });

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
</script>