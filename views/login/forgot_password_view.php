<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Título de la página -->
        <h2>Recuperar Contraseña</h2>
        <!-- Formulario para recuperar contraseña -->
        <form action="../controllers/Auth_Controller.php?action=forgotPassword" method="POST">
            <!-- Campo para el correo electrónico -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Enviar Enlace de Recuperación</button>
        </form>
    </div>
</body>
</html>
