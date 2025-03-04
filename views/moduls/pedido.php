<?php
$agre = new ControladorCarrito();
$res = $agre->agregarProductoCarrito();
$cont = $agre->totalCarrito();
$carrito = new ModeloCarrito();
$cart = $carrito->countCarrito();
?>
<form class="pedido-form" method="post" action="https://checkout.payulatam.com/ppp-web-gateway-payu/">
    <div class="contenido">
        <div class="pedido-container">
            <h2 id="direccionEnvio">Dirección de Envío</h2>

            <input type="hidden" name="lng" value="es">
            <input type="hidden" name="merchantId" value="1017725">
            <input type="hidden" name="accountId" value="1026679">
            <input type="hidden" name="algorithmSignature" value="MD5">
            <input type="hidden" name="signature" id="" value="<?php echo md5('CemTGaTCksDWEGJe90DuuChGxo~1017725~' . 'REF' . $GLOBALS['codigo_global'] . " " . date('Y/m/d H:i:s') . "~" . ($cont[0]['SUM(precio*cantidad)'] + 5000) . '.00' . '~COP') ?>">
            <input type="hidden" name="sourceUrl" value="https://proverpet.com.co/">
            <input type="hidden" name="responseUrl" value="https://proverpet.com.co/views/response.php">
            <input type="hidden" name="confirmationUrl" value="https://proverpet.com.co/confirmation">
            <input name="test" type="hidden" value="0">
            <!--RESUMEN DEL PEDIDO-->
            <input type="hidden" name="description" value="venta prueba">
            <input type="hidden" name="referenceCode" value="REF<?php echo $GLOBALS['codigo_global'] . " " . date('Y/m/d H:i:s') ?>">
            <input type="hidden" name="amount" value="<?php echo $cont[0]['SUM(precio*cantidad)'] + 5000 ?>">
            <input type="hidden" name="tax" value="0">
            <input type="hidden" name="taxReturnBase" value="0">
            <input type="hidden" name="currency" value="COP">
            <!--INFORMACION DE FACTURACION-->
            <input type="hidden" name="payerFullName" id="">
            <input type="hidden" name="payerEmail" value="empresaproverpet@gmail.com">
            <input type="hidden" name="payerOfficePhone">
            <input type="hidden" name="payerPhone">
            <input type="hidden" name="payerMobilePhone" id="">
            <input type="hidden" name="payerDocumentType" value="CC">
            <input type="hidden" name="payerDocument" value="1070586140">
            <input type="hidden" name="billingCountry" value="CO">
            <input type="hidden" name="payerState" value="CO-DC">
            <input type="hidden" name="billingCity">
            <input type="hidden" name="billingAddress">
            <input type="hidden" name="billingAddress2">
            <input type="hidden" name="zipCode">
            <div class="form-row">
                <div class="form-group">
                    <label id="labelNombres">Nombres</label>
                    <input class="form-control" required type="hidden" name="id_cliente" placeholder="John">
                    <input type="text" name="nombres" id="nombres" placeholder="John">
                </div>
                <div class="form-group">
                    <label id="labelApellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" placeholder="Doe">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label id="labelCorreo">Correo</label>
                    <input type="email" name="correo" id="buyerEmail" placeholder="example@email.com">
                </div>
                <div class="form-group">
                    <label id="labelTelefono">Número de Teléfono</label>
                    <input type="tel" name="telefono" id="" placeholder="+123 456 789">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label id="labelDireccion1">Dirección 1</label>
                    <input type="text" name="direccion1" id="direccion1" placeholder="123 Street">
                </div>
                <div class="form-group">
                    <label id="labelDireccion2">Apartamento, suite, etc</label>
                    <input type="text" name="direccion2" id="direccion2" placeholder="Apartament, suite, etc">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label id="labelCiudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" placeholder="BOGOTA D.C">
                </div>
                <div class="form-group">
                    <label id="labelBarrio">Estado</label>
                    <input type="text" name="barrio" id="barrio" placeholder="KENNEDY">
                </div>
            </div>

            <div class="form-group">
                <label id="labelCodigoPostal">Código Postal</label>
                <input type="text" name="codigoPostal" placeholder="123">
            </div>

        </div>

        <div class="resumen-container">
            <h2 id="totalPedido">Total del Pedido</h2>
            <p><span id="productos">Productos: </span></p>

            <?php
            foreach ($res as $key => $value) {
            ?>
                <p><span><?php echo "" . ($key + 1) . ". " . $value['nombre'] ?></span>
                    <span>$<?php echo number_format($value['precio_carrito']*$value['cant_carrito'], 2) ?></span>
                </p>
            <?php
            }
            ?>

            <p><strong id="metodoentrega">Selecciona el método de entrega:</strong></p>
            <div class="metodo-entrega">
                <div id="btnEnvio" class="opcion">
                    <img src="https://cdn-icons-png.flaticon.com/128/743/743131.png" alt="Envío" title="Envío a domicilio">
                </div>
                <div id="btnLocal" class="opcion">
                    <img src="https://cdn-icons-png.flaticon.com/128/2838/2838912.png" alt="Recoger en Local" title="Recoger en local">
                </div>
            </div>

            <!-- Opciones dinámicas -->
            <p id="opcionEnvio">
                <span id="envio">Tipo de Envío:</span>
                <br>
                <select id="envioDelibery">
                    <option id="tax1" value="15">Normal - $15.00</option>
                    <option id="tax2" value="45">Express - $45.00</option>
                </select>
            </p>

            <p id="opcionLocal" style="text-align: left;">
                <strong id="dire">Dirección:</strong> 1050 Sw 11 street Miami FI 33129 <br>
                <strong id="tel">Teléfono:</strong> +1 (786) 397-4240
            </p>

            <p><span id="tax3">Estimated tax to be collected:</span> <span id="taxes">$0</span></p>

            <p>
                <span id="total">Total:</span>
                <strong id="totalPed">
                    $<?php echo number_format($cont[0]['SUM(precio*cantidad)'] + 15, 0) ?>
                </strong>
            </p>

            <button id="realizarPedido" class="pedido-button">Realizar Pedido</button>
        </div>

    </div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnEnvio = document.getElementById("btnEnvio");
        const btnLocal = document.getElementById("btnLocal");
        const envioSelect = document.getElementById("envioDelibery");
        const opcionEnvio = document.getElementById("opcionEnvio");
        const opcionLocal = document.getElementById("opcionLocal");
        const taxesElement = document.getElementById("taxes");
        const totalElement = document.getElementById("totalPed");

        let subtotal = 0; // Inicializamos el subtotal en 0

        <?php
        // Calcular el subtotal sumando los productos en el `foreach`
        $subtotal = 0;
        foreach ($res as $key => $value) {
            $subtotal += $value['precio_carrito'] * $value['cant_carrito'];
        ?>
            console.log("Producto: <?php echo $value['nombre']; ?>, Precio: <?php echo $value['precio']; ?>, Cantidad: <?php echo $value['cantidad']; ?>");
        <?php
        }
        ?>

        // Asignamos el subtotal calculado desde PHP a JavaScript
        subtotal = <?php echo number_format($subtotal, 2, '.', ''); ?>;
        let metodoSeleccionado = ""; // Guarda si es 'envio' o 'local'

        function actualizarTotal() {
            let envio = metodoSeleccionado === "envio" ? parseFloat(envioSelect.value) : 0;
            let taxes = (subtotal + envio) * 0.07; // 7% de impuestos
            let total = subtotal + envio + taxes;
            taxesElement.textContent = `$${new Intl.NumberFormat().format(taxes.toFixed(2))}`;
            totalElement.textContent = `$${new Intl.NumberFormat().format(total.toFixed(2))}`;
        }

        // Evento al hacer clic en "Envío"
        btnEnvio.addEventListener("click", function() {
            metodoSeleccionado = "envio";
            opcionEnvio.style.display = "block";
            opcionLocal.style.display = "none";
            btnEnvio.classList.add("seleccionado");
            btnLocal.classList.remove("seleccionado");
            actualizarTotal();
        });

        // Evento al hacer clic en "Entrega en Local"
        btnLocal.addEventListener("click", function() {
            metodoSeleccionado = "local";
            opcionEnvio.style.display = "none";
            opcionLocal.style.display = "block";
            btnLocal.classList.add("seleccionado");
            btnEnvio.classList.remove("seleccionado");
            actualizarTotal();
        });

        // Detectar cambios en el tipo de envío
        envioSelect.addEventListener("change", actualizarTotal);

        // Inicializar cálculo
        actualizarTotal();
    });



    /*document.getElementById('buyerEmail').addEventListener('input', function() {
        const buyerEmail = this.value;
        const merchantId = "1017591";
        const apiKey = "870LCJE0C3c2xNt668k2OAjY64";
        const referenceCode = "REF<?php echo $GLOBALS['codigo_global'] . " " . date('Y/m/d H:i:s') ?>";
        const amount = "<?php echo $cont[0]['SUM(precio*cantidad)'] + 5000; ?>";
        const currency = "COP";
        const accountId = "1026541";

        // Generar el hash MD5 con los valores concatenados
        const signatureString = apiKey + merchantId + referenceCode + amount + currency;
        const signatureHash = CryptoJS.MD5(signatureString).toString();

        // Asignar el hash calculado al campo oculto
        document.getElementById('signature').value = signatureHash;
    });*/
</script>