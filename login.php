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
        echo json_encode(["error" => "userDoesNotExist"]);
        exit();
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['logged_in'] = true;


            // Verifica si el usuario es Super Admin y almacena esa información en la sesión
            $_SESSION['is_super_admin'] = ($user['email'] === 'superadmin@gmail.com'); // Reemplaza con el correo real

            echo json_encode(["success" => true]);
            exit();
        } else {
            echo json_encode(["error" => "incorrectPassword"]);
            exit();
        }
    }
} else {
    // Opcional: Redirige al usuario a la página de inicio de sesión si el método no es POST
    header("location: index.html");
    exit();
}
?>
