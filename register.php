<?php
require_once "db.php"; // Usa el mismo archivo de conexión que login.php

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Verificar si el correo ya existe
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario ya existe
        $response['error'] = 'userAlreadyExists';
    } else {
        // Encriptar contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Preparar la sentencia SQL para insertar usuario
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        // Ejecutar sentencia y comprobar si fue exitosa
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'insertFailed';
        }
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    $response['error'] = 'invalidRequest';
}

// Cerrar la conexión a la BD
$mysqli->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>
