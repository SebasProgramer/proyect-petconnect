<?php include 'profile_verification.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetConnect</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Css/estilos.css"> <!-- Enlace al archivo CSS externo -->
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="Fotos/Logo.png" alt="Logo" class="custom-logo">
        <span class="custom-title">PetConnect</span>
    </a>
    <form class="form-inline mx-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar mascotas" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <button class="btn btn-info mr-2">Refugios</button>

    <?php
    if (isset($_SESSION['email']) && $_SESSION['logged_in'] === true) {
        $email = $_SESSION['email'];

        $stmt = $mysqli->prepare("SELECT profile_image FROM userprofiles WHERE user_id = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $profileImage = $user['profile_image'];
            echo '<a href="profile.php"><img src="profile_images/' . $profileImage . '" alt="Profile Image" class="avatar"></a>';
        } else {
            echo '<a href="profile.php"><img src="Toji Fushiguro.jpeg" alt="Default Avatar" class="avatar"></a>';
        }
    } else {
        echo '<a href="login.html" class="btn btn-primary">Iniciar Sesión o Registrarse</a>';
    }
    ?>
</nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded mb-3" style="width: 12rem;">
                    <img src="Fotos/Labrador.jpeg" class="card-img-top" alt="Mascota 1">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: Luna</h5>
                        <p class="card-text">Sexo: Hembra</p>
                        <p class="card-text">Raza: Labrador</p>
                        <p class="card-text">Edad: 2 años</p>
                        <p class="card-text">Color: Negro y dorado</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded mb-3" style="width: 12rem;">
                    <img src="Fotos/Pastor.jpeg" class="card-img-top" alt="Mascota 2">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: Max</h5>
                        <p class="card-text">Sexo: Macho</p>
                        <p class="card-text">Raza: Pastor Alemán</p>
                        <p class="card-text">Edad: 3 años</p>
                        <p class="card-text">Color: Marrón y Negro</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded mb-3" style="width: 12rem;">
                    <img src="Fotos/Golden.jpg" class="card-img-top" alt="Mascota 3">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: Bella</h5>
                        <p class="card-text">Sexo: Hembra</p>
                        <p class="card-text">Raza: Golden Retriever</p>
                        <p class="card-text">Edad: 4 años</p>
                        <p class="card-text">Color: Dorado</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded mb-3" style="width: 12rem;">
                    <img src="Fotos/Golden.jpg" class="card-img-top" alt="Mascota 4">
                    <div class="card-body">
                        <h5 class="card-title">Nombre: Bruno</h5>
                        <p class="card-text">Sexo: Macho</p>
                        <p class="card-text">Raza: Golden Retriever</p>
                        <p class="card-text">Edad: 1 año</p>
                        <p class="card-text">Color: Marrón</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="my-login.js"></script>
</body>
</html>