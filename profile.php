<?php
session_start();
require 'db.php'; // Asegúrate de que este archivo tiene la conexión correcta a la base de datos.

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
    $ci = $row['CI']; // CI está en mayúsculas según tu esquema de SQL.
    $telefono = $row['telefono'];
    $direccion = $row['direccion'];
    $profileImage = $row['profile_image']; // Asignar la imagen de perfil
    $imagenPerfil = 'profile_images/' . $profileImage;

    if (!file_exists($imagenPerfil) || !is_readable($imagenPerfil)) {
        $imagenPerfil = 'profile_images/default.png'; // Asegúrate de tener una imagen por defecto o manejar esto como consideres.
    }

} else {
    // Si no hay perfil, posiblemente redirigir para crear uno
    header("Location: create_profile.php");
    exit; // O manejar de otra manera.
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <!-- Agrega tus enlaces a hojas de estilo (CSS) aquí -->
</head>

<body>
    <h1>Perfil de Usuario</h1>

    <div>
        <img src="<?php echo htmlspecialchars($imagenPerfil); ?>" alt="Imagen de perfil" width="150">
    </div>

    <div>
        <p><strong>Nombre:</strong>
            <?php echo htmlspecialchars($nombre); ?>
        </p>
        <p><strong>Apellido:</strong>
            <?php echo htmlspecialchars($apellido); ?>
        </p>
        <p><strong>Edad:</strong>
            <?php echo htmlspecialchars($edad); ?>
        </p>
        <p><strong>Cédula de Identidad:</strong>
            <?php echo htmlspecialchars($ci); ?>
        </p>
        <p><strong>Teléfono:</strong>
            <?php echo htmlspecialchars($telefono); ?>
        </p>
        <p><strong>Dirección:</strong>
            <?php echo htmlspecialchars($direccion); ?>
        </p>
    </div>

    <!-- Agrega cualquier otro contenido o formulario para editar los datos del perfil -->

</body>

</html>