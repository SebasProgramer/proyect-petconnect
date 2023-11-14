<?php
include_once('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Obtén el correo electrónico que el usuario ingresó en el formulario
$email = $_POST['email'];

// Genera un token único
$token = bin2hex(random_bytes(50));

// Crea una fecha de vencimiento para el token
$expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

// Inserta el token, la fecha de vencimiento y el correo electrónico del usuario en la tabla reset_tokens
$stmt = $mysqli->prepare("INSERT INTO reset_tokens (email, token, expires) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $token, $expires);
$stmt->execute();
$stmt->close();

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->SMTPDebug = 0;  
    $mail->isSMTP();  
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true; 
    $mail->Username = 'contactpetconn@gmail.com'; 
    $mail->Password = 'lprm iwjm smkb xjmc'; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587; 

    // Destinatarios
    $mail->setFrom('contactpetconn@gmail.com', 'PetConnect');
    $mail->addAddress($email, ''); //en el espacio en blanco se puede colocar el nombre de la persona que recibe 

    // Contenido
    $mail->isHTML(true); 
    $mail->Subject = 'Restablecer password';
    $mail->Body    = 'Haga clic en el siguiente enlace para restablecer su contraseña: <a href="http://localhost/proyect-petconnect/reset.php?email=' . urlencode($email) . '&token=' . $token . '">Restablecer contraseña</a>';

    $mail->send();
    header('Location: check_email.html');
    exit();
} catch (Exception $e) {
    echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
}
?>