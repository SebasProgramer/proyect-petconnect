<?php
include_once('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Obtén los datos del formulario
$refugio_name = $_POST['refugio_name'];
$refugio_direction = $_POST['refugio_direction'];
$refugio_cellphone = $_POST['refugio_cellphone'];
$refugio_information = $_POST['refugio_information'];

// Inserta los datos del refugio en la base de datos (ajusta esto según tu esquema de base de datos)
$stmt = $mysqli->prepare("INSERT INTO refugios (nombre, direccion, telefono, informacion) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $refugio_name, $refugio_direction, $refugio_cellphone, $refugio_information);

// Verifica si la inserción fue exitosa
if ($stmt->execute()) {
    $stmt->close();

    // Configura el correo electrónico
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (ajusta esto según tus configuraciones)
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contactpetconn@gmail.com';
        $mail->Password = 'lprm iwjm smkb xjmc';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinatarios y contenido del correo
        $mail->setFrom('contactpetconn@gmail.com', 'PetConnect');
        $mail->addAddress('contactpetconn@gmail.com', ''); // Cambia esto al destinatario real
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo Registro de Refugio';
        $mail->Body    = 'Nombre del Refugio: ' . htmlspecialchars($refugio_name) . '<br>'
                        . 'Dirección del Refugio: ' . htmlspecialchars($refugio_direction) . '<br>'
                        . 'Teléfono del Refugio: ' . htmlspecialchars($refugio_cellphone) . '<br>'
                        . 'Información Adicional: ' . htmlspecialchars($refugio_information);

        // Adjuntar las imágenes al correo electrónico
        $targetDir = "refugio_images/";
        foreach ($_FILES["refugio_images"]["name"] as $key => $fileName) {
            $targetFilePath = $targetDir . basename($fileName);
            move_uploaded_file($_FILES["refugio_images"]["tmp_name"][$key], $targetFilePath);
            $mail->addAttachment($targetFilePath);
        }

        // Enviar el correo electrónico
        $mail->send();

        // Redireccionar a la página de éxito
        header('Location: register_ref_ok.html');
        exit();
    } catch (Exception $e) {
        echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
} else {
    // Manejar el caso de fallo en la inserción a la base de datos
    echo "Error al registrar el refugio en la base de datos";
}
?>
