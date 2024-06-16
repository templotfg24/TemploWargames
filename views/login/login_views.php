<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Hoja de estilos personalizada -->
    <link rel="stylesheet" href="../Assets/css/registre.css">
    <!-- Iconos de FontAwesome -->
    <script src="https://kit.fontawesome.com/ffec4ec2ed.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <!-- Contenedor principal -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!-- Contenedor del formulario de login -->
        <div class="row g-0 login-container">
            <!-- Columna para la imagen (visible solo en pantallas grandes) -->
            <div class="col-lg-7 d-none d-lg-block">
                <img src="../Assets/images/JPG/Login.jpg" alt="Login Image" class="img-fluid min-vh-100">
            </div>
            <!-- Columna para el formulario de login -->
            <div class="col-lg-5 d-flex flex-column align-items-end min-vh-100 p-4">
                <!-- Logo de la empresa -->
                <div class="w-100 mb-auto">
                    <img src="../Assets/images/JPG/logo_nobackground.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <!-- Formulario de login -->
                <div class="align-self-center w-100">
                    <h1 class="font-weight-bold mb-4 text-dark">Iniciar sesión</h1>
                    <form action="../controllers/Auth_Controller.php?action=login" method="post" class="mb-5">
                        <div class="mb-4">
                            <label for="email" class="form-label font-weight-bold text-dark">Correo electrónico</label>
                            <input type="email" class="form-control bg-muted border-0" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label font-weight-bold text-dark">Contraseña</label>
                            <input type="password" class="form-control bg-muted border-0 mb-2" id="password" name="password" placeholder="Contraseña" required>
                            <a href="../controllers/Auth_Controller.php?action=forgotPassword" class="form-text text-muted text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                    <!-- Botones para iniciar sesión con Google y Facebook-->
                    <!--
                    <p class="font-weight-bold text-center text-muted">O inicia sesión con</p>
                    <div class="d-flex justify-content-around mb-4">
                        <button type="button" class="btn btn-outline-dark flex-grow-1 mr-2"><i class="fab fa-google lead mr-2"></i> Google</button>
                        <button type="button" class="btn btn-outline-dark flex-grow-1 ml-2"><i class="fab fa-facebook-f lead mr-2"></i> Facebook</button>
                    </div>
                    -->
                </div>
                <!-- Enlace para registrarse -->
                <div class="text-center w-100 mt-auto">
                    <p class="d-inline-block mb-0 text-dark">¿No tienes una cuenta?</p> <a href="../controllers/Auth_Controller.php?action=showRegister" class="text-dark font-weight-bold text-decoration-none">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
