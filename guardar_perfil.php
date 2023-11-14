<?php
session_start();

// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    require 'db.php';

    // Obtén el user_id de la sesión
    $user_id = $_SESSION['user_id'];

    // Asegúrate de que user_id existe y es válido
    if (empty($user_id)) {
        die("El ID de usuario no está en la sesión.");
    }

    // Obtén los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $ci = $_POST['ci'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Configuración para la imagen de perfil
    $directorio_imagenes = 'profile_images/';
    $nombre_imagen = $_FILES["imagen"]["name"];
    $ruta_imagen = $directorio_imagenes . basename($nombre_imagen);

    // Intenta mover el archivo subido al directorio de destino
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen)) {
        // Prepara la consulta SQL para insertar el perfil en la base de datos
        $stmt = $mysqli->prepare("INSERT INTO UserProfiles (user_id, nombre, apellido, edad, ci, telefono, direccion, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Vincula los parámetros a la consulta SQL
        $stmt->bind_param("isssssss", $user_id, $nombre, $apellido, $edad, $ci, $telefono, $direccion, $ruta_imagen);

        // Ejecuta la consulta SQL
        if ($stmt->execute()) {
            // Redirige a la página principal si la inserción fue exitosa
            header("Location: homepage.php");
            exit();
        } else {
            // Imprime el error si la consulta no se ejecutó correctamente
            echo "Error al insertar en la base de datos: " . $mysqli->error;
        }
    } else {
        // Imprime el error si la imagen no pudo ser subida
        echo "Error al subir la imagen.";
    }
} else {
    // Redirige al formulario si la página fue accedida sin enviar el formulario
    header("Location: create_profile.php");
    exit();
}
?>