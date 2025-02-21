<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ruta del archivo donde se guardarán los códigos únicos
define("ARCHIVO_SESIONES", "sesiones.txt");

// Obtener la IP del usuario
function obtenerIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Generar un identificador único basado en IP + User-Agent + ID de sesión
function generarIdentificadorUnico()
{
    $ip = obtenerIP();
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $sessionId = session_id(); // ID de sesión único

    return hash('sha256', $ip . $userAgent . $sessionId);
}

// Buscar si el identificador único ya tiene un código asignado
function obtenerCodigoPorIdentificador($identificador)
{
    if (!file_exists(ARCHIVO_SESIONES)) {
        return false;
    }
    $lineas = file(ARCHIVO_SESIONES, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($hashGuardado, $codigo) = explode('|', $linea);
        if ($hashGuardado === $identificador) {
            return $codigo; // Retorna el código si ya existe
        }
    }
    return false;
}

// Generar un nuevo código aleatorio y guardarlo
function generarCodigoUnico($identificador)
{
    $codigoUnico = uniqid(); // Código basado en tiempo para evitar colisiones
    $entrada = $identificador . '|' . $codigoUnico . PHP_EOL;

    // Guardar en el archivo evitando duplicaciones
    file_put_contents(ARCHIVO_SESIONES, $entrada, FILE_APPEND | LOCK_EX);

    return $codigoUnico;
}

// Obtener identificador único del usuario
$identificadorUsuario = generarIdentificadorUnico();

// Verificar si ya tiene un código asignado
$codigoUsuario = obtenerCodigoPorIdentificador($identificadorUsuario);
if (!$codigoUsuario) {
    $codigoUsuario = generarCodigoUnico($identificadorUsuario);
}

// Guardar el código en una variable global
$GLOBALS['codigo_global'] = $codigoUsuario;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Flores</title>
    <link rel="stylesheet" href="views/css/styles.css">
    <link rel="stylesheet" href="views/css/alertas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="views/img/logo.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="views/css/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>

    <?php include("views/moduls/narvar.php"); ?>

    <?php
    $mvc = new controladorViews();
    $mvc->enlacesPaginaControlador();
    ?>

    <?php include("views/moduls/footer.php"); ?>

    <script src="views/js/traductores.js"></script>
    <script src="views/js/alertas.js"></script>
    <script src="views/js/modal.js"></script>
    <script src="views/js/js.js"></script>

    <script>
        let cartCount = 0;

        function addToCart(id, name, price) {
            cartCount++;
            document.getElementById('cart-count').innerText = cartCount;
            alert(`${name} añadido al carrito`);
        }
    </script>
</body>
</html>
<?php ob_end_flush(); // Finaliza el buffer de salida ?>
