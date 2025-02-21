<?php
session_start();

foreach (glob("../controllers/*.php") as $filename) {
    require_once $filename;
}

// Requiere todos los archivos en la carpeta 'models'
foreach (glob("../models/*.php") as $filename) {
    require_once $filename;
}

$factura = new ControladorFactura();
$factura->agregarFactrua();


$ApiKey = "870LCJE0C3c2xNt668k2OAjY64";
$merchant_id = $_REQUEST['merchantId'];
$referenceCode = $_REQUEST['referenceCode'];
$TX_VALUE = $_REQUEST['TX_VALUE'];
$New_value = number_format($TX_VALUE, 0, '.', '');
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['signature'];
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];

if ($_REQUEST['transactionState'] == 4) {
	$estadoTx = "Transacción aprobada";
} else if ($_REQUEST['transactionState'] == 6) {
	$estadoTx = "Transacción rechazada";
} else if ($_REQUEST['transactionState'] == 104) {
	$estadoTx = "Error";
} else if ($_REQUEST['transactionState'] == 7) {
	$estadoTx = "Pago pendiente";
} else {
	$estadoTx = $_REQUEST['mensaje'];
}
//if (strtoupper($firma) == strtoupper($firmacreada)) {
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PROVERPET | Resumen de la Transacción</title>
	<link href="img/logo2.jpeg" rel="icon">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			color: #333;
			margin: 20px;
		}

		h2 {
			text-align: center;
			color: #4CAF50;
			margin-bottom: 20px;
		}

		.table-container {
			max-width: 600px;
			margin: 0 auto;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			overflow: hidden;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin: 0;
		}

		th,
		td {
			text-align: left;
			padding: 12px 20px;
			border-bottom: 1px solid #eaeaea;
		}

		th {
			background-color: #4CAF50;
			color: #fff;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 14px;
		}

		tr:last-child td {
			border-bottom: none;
		}

		td {
			font-size: 16px;
			color: #555;
		}

		.table-container td:first-child {
			font-weight: bold;
			color: #4CAF50;
		}

		.total-value {
			font-weight: bold;
			font-size: 18px;
			color: #000;
		}

		.currency {
			text-transform: uppercase;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<h2>Resumen de la Transacción</h2>
	<div class="table-container">
		<table class="table">
			<tr>
				<td>Estado de la transacción</td>
				<td><?php echo $estadoTx; ?></td>
			</tr>
			<tr>
				<td>ID de la transacción</td>
				<td><?php echo $transactionId; ?></td>
			</tr>
			<tr>
				<td>Referencia de venta</td>
				<td><?php echo $reference_pol; ?></td>
			</tr>
			<tr>
				<td>Referencia de la transacción</td>
				<td><?php echo $referenceCode; ?></td>
			</tr>
			<tr>
				<td>CUS</td>
				<td><?php echo $cus; ?></td>
			</tr>
			<tr>
				<td>Banco</td>
				<td><?php echo $pseBank; ?></td>
			</tr>
			<tr>
				<td>Valor total</td>
				<td class="total-value">$<?php echo number_format($TX_VALUE); ?></td>
			</tr>
			<tr>
				<td>Moneda</td>
				<td class="currency"><?php echo $currency; ?></td>
			</tr>
			<tr>
				<td>Descripción</td>
				<td><?php echo $extra1; ?></td>
			</tr>
			<tr>
				<td>Entidad</td>
				<td><?php echo $lapPaymentMethod; ?></td>
			</tr>
		</table>
	</div>
	<a href="#" id="redirectHome">Volver al inicio</a>

	<script>
		document.getElementById('redirectHome').addEventListener('click', function(e) {
			const currentUrl = window.location.href;

			// Detectar si la URL contiene "views/response.php"
			if (currentUrl.includes('/views/response.php')) {
				// Redirigir al inicio eliminando "views/response.php" y los parámetros GET
				window.location.href = '/';
			}
		});
	</script>
</body>

</html>

<?php
/*}
else
{
?>
	<h1>Error validando la firma digital.</h1>
<?php
}*/
?>