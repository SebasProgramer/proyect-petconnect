<?php
session_start();
require 'db.php';

// Función para obtener la imagen de perfil del usuario
function getUserProfileImage($email, $mysqli)
{
    // Primero, obtén el user_id de la tabla users
    $userStmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $userStmt->bind_param("s", $email);
    $userStmt->execute();
    $userResult = $userStmt->get_result();

    if ($userResult->num_rows === 1) {
        $userRow = $userResult->fetch_assoc();
        $user_id = $userRow['id'];

        // Ahora, utiliza el user_id para obtener la imagen de perfil de UserProfiles
        $stmt = $mysqli->prepare("SELECT profile_image FROM UserProfiles WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $userProfile = $result->fetch_assoc();
            return $userProfile['profile_image'];
        }
    }
    return null; // Si no se encuentra el usuario o la imagen de perfil, devuelve null
}

// Verificar si el usuario está autenticado
if (isset($_SESSION['email']) && $_SESSION['logged_in'] === true) {
    $email = $_SESSION['email'];
    $profileImage = getUserProfileImage($email, $mysqli);

    if ($profileImage) {
        $_SESSION['profile_image'] = $profileImage;
    } else {
        $_SESSION['profile_image'] = "Toji Fushiguro.jpeg"; // Asigna el avatar predeterminado
    }
}
?>
