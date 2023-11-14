<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>PetConnect &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Css/my-login.css">
</head>
<body class="my-login-page">
    <?php
        $reset_link = 'reset_password.php?email=' . urlencode($_GET['email']) . '&token=' . $_GET['token'];
    ?>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="petconnect.jpeg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Restablecer Contraseña</h4>
							<form method="POST" action="<?php echo $reset_link; ?>" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="new-password">Nueva Contraseña</label>
									<input id="new-password" type="password" class="form-control" name="new_password" required autofocus data-eye>
									<div class="invalid-feedback">
										Se requiere contraseña
									</div>
								</div>

								<div class="form-group">
									<label for="confirm-password">Confirmar Contraseña</label>
									<input id="confirm-password" type="password" class="form-control" name="confirm_password" required data-eye>
									<div class="invalid-feedback">
										Necesitas confirmar tu contraseña
									</div>
								</div>

								<input type="hidden" id="email" name="email">
								<input type="hidden" id="token" name="token">

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Cambiar Contraseña
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2023 &mdash; PetConnect
					</div>
				</div>
			</div>
        </div>
    </section>

    <!-- Incluir la versión completa de jQuery -->
    <script src="my-login.js"></script>

    <script>
        // Parsea los parámetros de la URL
        var urlParams = new URLSearchParams(window.location.search);

        // Agrega los parámetros como campos ocultos en el formulario
        document.getElementById('email').value = urlParams.get('email');
        document.getElementById('token').value = urlParams.get('token');
    </script>

</body>
</html>