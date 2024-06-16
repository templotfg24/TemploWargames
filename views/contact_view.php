<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la fuente Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace a la hoja de estilos personalizada -->
    <link rel="stylesheet" href="../Assets/css/contact_view.css">
</head>
<body>
    <!-- Inclusión del menú principal -->
    <?php include '../views/includes/menu_main.php'; ?>

    <div class="container mt-5">
        <h1>Contacto</h1>
        <!-- Formulario de contacto -->
        <form id="contactForm" action="../controllers/Contact_Controller.php?action=send" method="POST">
            <div class="mb-3">
                <label for="subject" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <!-- Inclusión de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclusión de la validación de formulario -->
    <script src="../Assets/js/validation_contact_view.js"></script>
    <script src="../Assets/js/menu_main.js"></script>
    <script src="../Assets/js/carrito.js"></script>

    <!-- Inclusión del pie de página -->
    <?php include '../views/includes/footer.php';?>
</body>
</html>

