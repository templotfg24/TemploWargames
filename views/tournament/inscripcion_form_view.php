<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción al Torneo</title>
    <!-- Enlaces a hojas de estilo CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <!-- Título de la página -->
                <h1 class="mt-4">Inscripción al Torneo</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario de inscripción -->
                        <form action="Tournament_Controller.php?action=createInscripcion" method="post" onsubmit="return validateForm()">
                            <!-- Campo para el email del usuario -->
                            <div class="mb-3">
                                <label for="usuario_email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="usuario_email" name="usuario_email" required>
                                <input type="hidden" id="usuario_id" name="usuario_id">
                            </div>
                            <!-- Campo para el ID del torneo -->
                            <div class="mb-3">
                                <label for="torneo_id" class="form-label">ID del Torneo</label>
                                <input type="text" class="form-control" id="torneo_id" name="torneo_id" value="<?php echo htmlspecialchars($_GET['torneo_id']); ?>" required readonly>
                            </div>
                            <!-- Campo para el teléfono del usuario -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <!-- Campo para el ID de la aplicación -->
                            <div class="mb-3">
                                <label for="id_aplicacion" class="form-label">ID de Aplicación</label>
                                <input type="text" class="form-control" id="id_aplicacion" name="id_aplicacion">
                            </div>
                            <!-- Botón de envío del formulario -->
                            <button type="submit" class="btn btn-primary">Inscribir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enlaces a scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var searchUsuariosUrl = "../controllers/Tournament_Controller.php?action=searchUsuarios";
    </script>
    <!-- Enlace al script personalizado para la vista de inscripción -->
    <script src="../Assets/js/inscripcion_form_view.js"></script>
</body>

</html>

