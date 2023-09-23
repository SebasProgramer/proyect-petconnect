<?php
require 'db.php';  
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Uso de sentencia preparada para evitar inyección SQL
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['error_message'] = "El usuario con ese correo electrónico no existe.";
        header("location: index.html");
        exit();
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['logged_in'] = true;
            header("location: primerapag.html");
            exit();
        } else {
            echo "Has ingresado una contraseña incorrecta, intenta nuevamente.";
        }
    }
} else {
    // Opcional: Redirige al usuario a la página de inicio de sesión si el método no es POST
    header("location: index.html");
    exit();
}
?>
