<?php
require_once "db.php"; // Usa el mismo archivo de conexión que login.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Encriptar contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Preparar la sentencia SQL
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    
    // Ejecutar sentencia y comprobar si fue exitosa
    if ($stmt->execute()) {
        header("Location: index.html"); // Redirigir al inicio de sesión
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
}

// Cerrar la conexión a la BD
$mysqli->close();
?>
