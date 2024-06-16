<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>

    <!-- Enlace al CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cambiar Contraseña</h2>
        <!-- Formulario para cambiar la contraseña -->
        <form action="../controllers/ProfileController.php?action=changePassword" method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>

