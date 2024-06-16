<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Hoja de estilos personalizada -->
    <link rel="stylesheet" href="../Assets/css/registre.css">
    <!-- Iconos de FontAwesome -->
    <script src="https://kit.fontawesome.com/ffec4ec2ed.js" crossorigin="anonymous"></script>
</head>
<?php if (isset($error_message)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<body class="bg-light">
    <!-- Contenedor principal -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!-- Contenedor del formulario de registro -->
        <div class="row g-0 login-container">
            <!-- Columna para la imagen (visible solo en pantallas grandes) -->
            <div class="col-lg-7 d-none d-lg-block">
                <img src="../Assets/images/JPG/Login.jpg" alt="Login Image" class="img-fluid min-vh-100">
            </div>
            <!-- Columna para el formulario de registro -->
            <div class="col-lg-5 d-flex flex-column align-items-start min-vh-100 p-4">
                <!-- Logo de la empresa -->
                <div class="w-100">
                    <img src="../Assets/images/JPG/logo_nobackground.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <!-- Formulario de registro -->
                <div class="align-self-start w-100 mt-4">
                    <h1 class="font-weight-bold mb-4 text-dark">Registro</h1>
                    <form action="../controllers/Auth_Controller.php?action=register" method="post" class="mb-5" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="nombre" class="form-label font-weight-bold text-dark">Nombre</label>
                            <input type="text" class="form-control bg-muted border-0" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="mb-4">
                            <label for="apellido" class="form-label font-weight-bold text-dark">Apellido</label>
                            <input type="text" class="form-control bg-muted border-0" id="apellido" name="apellido" placeholder="Apellido" required>
                        </div>
                        <div class="mb-4">
                            <label for="direccion" class="form-label font-weight-bold text-dark">Dirección</label>
                            <input type="text" class="form-control bg-muted border-0" id="direccion" name="direccion" placeholder="Dirección">
                        </div>
                        <div class="mb-4">
                            <label for="telefono" class="form-label font-weight-bold text-dark">Teléfono</label>
                            <input type="text" class="form-control bg-muted border-0" id="telefono" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label font-weight-bold text-dark">Correo electrónico</label>
                            <input type="email" class="form-control bg-muted border-0" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label font-weight-bold text-dark">Contraseña</label>
                            <input type="password" class="form-control bg-muted border-0 mb-2" id="password" name="password" placeholder="Contraseña" required minlength="8">
                        </div>
                        <div class="mb-4">
                            <label for="imagen_perfil" class="form-label font-weight-bold text-dark">Imagen de Perfil</label>
                            <input type="file" class="form-control bg-muted border-0" id="imagen_perfil" name="imagen_perfil">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
