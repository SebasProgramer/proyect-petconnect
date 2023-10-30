<?php
session_start();
include_once('db.php');

if(isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verificar si el token es válido
    $stmt = $mysqli->prepare("SELECT * FROM reset_tokens WHERE email=? AND token=? AND expires > NOW()");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Token válido, mostrar formulario para cambiar la contraseña
        $stmt->close();
    } else {
        $_SESSION['message'] = "Enlace de restablecimiento no válido o expirado. Intenta nuevamente.";
        header("Location: error.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Falta el token o el correo electrónico.";
    header("Location: error.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password === $confirm_password) {
        // Actualizar la contraseña en la base de datos
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();
        $stmt->close();

        // Eliminar el token de reseteo
        $stmt = $mysqli->prepare("DELETE FROM reset_tokens WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Contraseña actualizada correctamente.";
        header("Location: index.html");
        exit();
    } else {
        $_SESSION['message'] = "Las contraseñas no coinciden.";
        header("Location: error.php");
        exit();
    }
}

$mysqli->close();
?>