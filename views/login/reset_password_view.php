<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <!-- Enlace a Bootstrap CSS para estilos predeterminados y componentes responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-5">
        <h2>Restablecer Contraseña</h2>
        <!-- Formulario para restablecer la contraseña -->
        <form action="../controllers/Auth_Controller.php?action=resetPassword" method="POST">
            <!-- Campo oculto para el token de restablecimiento -->
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <!-- Campo para la nueva contraseña -->
            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <!-- Campo para confirmar la nueva contraseña -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>

