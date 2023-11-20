<?php
require 'db.php';  
session_start();

// Verifica si el usuario es un Super Admin
if (!isset($_SESSION['is_super_admin']) || !$_SESSION['is_super_admin']) {
    echo 'No tienes permiso para ver esta página.';
    exit();
}

// Prepara una sentencia SQL para seleccionar todos los usuarios
$stmt = $mysqli->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Codifica los usuarios en formato JSON para que puedan ser utilizados en el frontend
echo json_encode($users);
?>
