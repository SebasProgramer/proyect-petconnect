<?php
session_start();
require 'db.php';

// Redirigir si la sesión no está iniciada o si no hay un user_id.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Preparar la consulta SQL para obtener los datos del perfil de UserProfiles.
$stmt = $mysqli->prepare("SELECT nombre, apellido, edad, CI, telefono, direccion, profile_image FROM UserProfiles WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Si se encuentra el perfil, asignar los datos a las variables.
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $edad = $row['edad'];
    $ci = $row['CI'];
    $telefono = $row['telefono'];
    $direccion = $row['direccion'];
    $profileImage = $row['profile_image']; // Asignar la imagen de perfil
    $imagenPerfil = 'profile_images/' . $profileImage;

    if (!file_exists($imagenPerfil) || !is_readable($imagenPerfil)) {
        $imagenPerfil = 'profile_images/default.png';
    }

} else {
    // Si no hay perfil, posiblemente redirigir para crear uno
    header("Location: create_profile.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    
    <!-- Agrega tus enlaces a hojas de estilo (CSS) aquí -->
    <style>
        /* Agrega tu estilo para la página de perfil aquí */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fb;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container img {
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-container p {
            margin: 10px 0;
        }

        .edit-profile-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h1>Perfil de Usuario</h1>

        <div>
            <img src="<?php echo htmlspecialchars($imagenPerfil); ?>" alt="Imagen de perfil" width="150">
            <p><?php echo "Ruta de la imagen: " . htmlspecialchars($imagenPerfil); ?></p> <!-- Añadido para depuración -->
        </div>

        <div>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Apellido:</strong> <?php echo htmlspecialchars($apellido); ?></p>
            <p><strong>Edad:</strong> <?php echo htmlspecialchars($edad); ?></p>
            <p><strong>Cédula de Identidad:</strong> <?php echo htmlspecialchars($ci); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></p>
        </div>

        <a href="register_ref.html">¿Eres un Refugio?</a>
    </div>
</body>

</html>
