<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$autoloadPath = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath)) {
    require $autoloadPath;
} else {
    // Código alternativo en caso de error
    error_log("Error: No se encontró el archivo autoload.php en {$autoloadPath}");
    die("No se pudo cargar el sistema. Contacte al administrador.");
}

class ControladorFactura
{
    function agregarFactrua()
    {
        $dato = array(
            'token' => $GLOBALS['codigo_global'],
            'envio' => 5000,
            'total' => $_REQUEST['TX_VALUE']
        );
        $agregar = new ModeloFactura();
        $res = $agregar->agregarFacturaModelo($dato);
        if ($res == true) {
            $id = $agregar->obtenerUltimoId();
            $agre = new ControladorCarrito();
            $res = $agre->agregarProductoCarrito();
            foreach ($res as $key => $value) {
                $datoVenta = array(
                    'id_fac' => $id[0]['MAX(id_factura)'],
                    'id_pro' => $value['id_producto'],
                    'precio' => $value['precio_carrito'],
                    'cant' => $value['cant_carrito'],
                    'total' => $value['precio_carrito'] * $value['cant_carrito']
                );
                $agregarVenta = new ControladorVenta();
                $resventa = $agregarVenta->agregarVenta($datoVenta);
                if ($resventa == true) {
                    $carr = new ControladorCarrito();
                    $carr->actualizarPagoCarrito();
                }
            }
            //correo
            // Listar información del cliente
            $listarCli = new ControladorCliente();
            $res = $listarCli->listarclientetoken($GLOBALS['codigo_global']);

            $listarMenss = new ControladorMensaje();
            $resMenss = $listarMenss->listarMensajeToken($GLOBALS['codigo_global']);

            // Listar información de la venta
            $lis = new ControladorVenta();
            $resventa = $lis->listarVentaFactura($id[0]['MAX(id_factura)']);
            if ($res && $resventa && $resMenss) {
                $cliente = $res[0];
                $venta = $resventa[0];
                $mess = $resMenss[0];

                // Información del cliente
                $nombres = $cliente['nombres'] . ' ' . $cliente['apellidos'];
                $correo = $cliente['correo'];
                $telefono = $cliente['tel'];
                $direccion = $cliente['dire1'];
                $comple = $cliente['dire2'];
                $ciudad = $cliente['ciudad'];
                $barrio = $cliente['barrio'];

                // Información de la venta
                $producto = $venta['nombre'];
                $cantidad = $venta['cantidad'];
                $precio = $venta['precio'];
                $precioTotal = $venta['precio_cantidad'];
                $idFactura = $venta['id_factura'];

                // Informacion tarjeta
                $box = $mess['box'];
                $tarjeta = $mess['mensaje'];
                $fecha = $mess['fecha'];
                $hora = $mess['hora'];
                $boxcolor = $mess['fecha'];
                $flowerColor = $mess['hora'];

                // Crear el contenido de la factura en HTML
                $facturaHTML = "
        <h1>Factura Electrónica</h1>
        <p><strong>Cliente:</strong> $nombres</p>
        <p><strong>Teléfono:</strong> $telefono</p>
        <p><strong>Dirección:</strong> $direccion, $ciudad, $barrio, $comple</p>
        <p><strong>Caja:</strong> $box</p>
        <p><strong>Mensaje Tarjeta:</strong> $tarjeta</p>
        <p><strong>Fecha:</strong> $fecha</p>
        <p><strong>Hora:</strong> $hora</p>
        <p><strong>Caja:</strong> $boxcolor</p>
        <p><strong>Flores:</strong> $flowerColor</p>
        <hr>
        <h2>Detalles de la Compra</h2>
        <table border='1' cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$producto</td>
                    <td>$cantidad</td>
                    <td>$$precio</td>
                    <td>$$precioTotal</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p><strong>Número de Factura:</strong> $idFactura</p>
    ";

                // Configurar PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor de correo
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambiar según el proveedor de correo
                    $mail->SMTPAuth = true;
                    $mail->Username = 'feliperenjifoz@gmail.com'; // Tu email
                    $mail->Password = 'eojcvtovqfdueobs'; // Tu contraseña
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Destinatario
                    $mail->setFrom('empresaproverpet@gmail.com', 'PROVERPET');
                    $mail->addAddress($correo, $nombres);
                    $mail->addAddress('empresaproverpet@gmail.com', 'PROVERPET');
                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = "Factura Electrónica #$idFactura";
                    $mail->Body = $facturaHTML;

                    // Enviar correo
                    $mail->send();
                    echo "Factura enviada a $correo correctamente.";
                } catch (Exception $e) {
                    //echo "Error al enviar el correo: {$mail->ErrorInfo}";
                }
            } else {
                //echo "No se pudo obtener la información del cliente o la venta.";
            }
        }
    }

    function listarFactura()
    {
        if (isset($_POST['buscar'])) {
            $agregar = new ModeloFactura();
            $res = $agregar->listarFactura($_POST['fecha']);
            return $res;
        }
        $agregar = new ModeloFactura();
        $res = $agregar->listarFactura('');
        return $res;
    }
}
