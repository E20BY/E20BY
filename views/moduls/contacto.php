<div class="contact-container">
    <h2 id="contacto">Contacto</h2>
    <div class="contact-info-container">
        <div class="contact-info">
            📞 <a href="tel:+17863974240">+1 (786) 397-4240</a>
        </div>
        <div class="contact-info">
            📧 <a href="mailto:contacto@flores.com">contacto@flores.com</a>
        </div>
        <!--<div class="contact-info">
            📍 <a href="https://www.google.com/maps?q=Calle+Falsa+123,+Ciudad+Jardín" target="_blank">Calle Falsa 123, Ciudad Jardín</a>
        </div>-->
    </div>
    <?php if (isset($_GET['status'])): ?>
        <div class="alert <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $_GET['status'] === 'success' ? '✅ Correo enviado correctamente.' : '❌ Error al enviar el correo. Inténtalo de nuevo.'; ?>
        </div>
    <?php endif; ?>
    <div class="contact-form">
        <h3 id="mensaje">Envíanos un mensaje</h3>
        <form action="" method="POST">
            <input type="text" id="nombreCorreo" name="name" placeholder="Tu Nombre" required>
            <input type="email" id="TuCorreo" name="email" placeholder="Tu Correo" required>
            <input type="text" id="TuEncabezado" name="encabezado" placeholder="Tu Encabezado" required>
            <textarea name="message" id="mensajeTu" placeholder="Tu Mensaje" rows="5" required></textarea>
            <button id="enviarEmail" type="submit">Enviar</button>
        </form>
    </div>
</div>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';
// Si usas Composer
// require 'PHPMailer/src/PHPMailer.php'; // Si lo descargaste manualmente
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/SMTP.php';
if (isset($_POST['name'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $encabezado = htmlspecialchars($_POST['encabezado']);
        $mensaje = htmlspecialchars($_POST['message']);

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambiar según el proveedor de correo
            $mail->SMTPAuth = true;
            $mail->Username = 'feliperenjifoz@gmail.com'; // Tu email
            $mail->Password = 'eojcvtovqfdueobs'; // Tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('feliperenjifoz@gmail.com', 'E20FLOWERS');
            $mail->addAddress('anasofiaochicamartinez@gmail.com', 'E20FLOWERS');
            $mail->addAddress($_POST['email'], 'E20FLOWERS');
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Body = '
    <html>
    <head>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");

            body {
                font-family: "Poppins", sans-serif;
                background-color: #f8f1f1;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                background: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                position: relative;
                overflow: hidden;
            }

            .header {
                text-align: center;
                font-size: 22px;
                font-weight: 600;
                color: #d6336c;
                margin-bottom: 20px;
                position: relative;
            }

            .message {
                font-size: 16px;
                color: #333;
                line-height: 1.6;
                padding: 10px;
                background: #ffe6ea;
                border-left: 5px solid #d6336c;
                border-radius: 5px;
            }

            .footer {
                font-size: 14px;
                text-align: center;
                color: #555;
                margin-top: 20px;
            }

            /* Animación de Flores */
            .flower {
                position: absolute;
                width: 40px;
                opacity: 0.5;
                animation: float 5s linear infinite;
            }

            .flower:nth-child(1) {
                left: 5%;
                top: -50px;
                animation-duration: 6s;
            }
            .flower:nth-child(2) {
                right: 10%;
                top: -30px;
                animation-duration: 8s;
            }
            .flower:nth-child(3) {
                left: 50%;
                top: -60px;
                animation-duration: 7s;
            }

            @keyframes float {
                0% { transform: translateY(-100px) rotate(0deg); opacity: 0.8; }
                100% { transform: translateY(600px) rotate(360deg); opacity: 0; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h3 class="header">🌸 Nuevo Mensaje de ' . htmlspecialchars($nombre) . ' 🌸</h3>
            <p class="message">' . nl2br(htmlspecialchars($mensaje)) . '</p>
            <p><strong>Email de contacto:</strong> <a href="mailto:' . htmlspecialchars($email) . '">' . htmlspecialchars($email) . '</a></p>
            <div class="footer">🌿 Gracias por tu mensaje 🌿</div>

            <!-- Flores Animadas -->
            <img src="https://cdn-icons-png.flaticon.com/128/3105/3105863.png" class="flower">
            <img src="https://cdn-icons-png.flaticon.com/128/3105/3105859.png" class="flower">
            <img src="https://cdn-icons-png.flaticon.com/128/3105/3105861.png" class="flower">
        </div>
    </body>
    </html>';

            $mail->AltBody = "Mensaje de: $nombre\n\n$mensaje\n\nEmail: $email";


            // Enviar correo
            if ($mail->send()) {
                echo "<script type='text/javascript'>window.location.href = 'index.php?action=contacto&status=success';</script>";
            } else {
                echo "<script type='text/javascript'>window.location.href = 'index.php?action=contacto&status=error';</script>";
            }
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
        }
    } else {
        echo "Acceso no permitido.";
    }
}
?>