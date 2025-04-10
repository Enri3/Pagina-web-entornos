<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

function enviarCorreoRegistro($nombre, $emailDestino) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'altiora.descuentos@gmail.com'; // <-- tu cuenta de Gmail
        $mail->Password = 'yfny hynp sntq phdl'; // <-- contraseña de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('altiora.descuentos@gmail.com', 'Altiora');
        $mail->addAddress($emailDestino, $nombre);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = '¡Bienvenido a Altiora!';
        $mail->Body = "
            <h2>Hola, $nombre</h2>
            <p>Gracias por registrarte en <strong>Altiora</strong>, tu portal de descuentos favoritos.</p>
            <p>Ya podés acceder a las mejores promociones en tu shopping preferido.</p>
            <hr>
            <p>Equipo de Altiora</p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Error al enviar el correo: {$mail->ErrorInfo}");
        return false;
    }
}