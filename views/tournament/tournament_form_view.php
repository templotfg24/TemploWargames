<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($tournaments) ? 'Editar Torneo' : 'Crear Torneo'; ?></title>
    <!-- Enlaces a hojas de estilo CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <!-- Título de la página -->
                <h1 class="mt-4"><?php echo isset($tournaments) ? 'Editar Torneo' : 'Crear Torneo'; ?></h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para crear o editar un torneo -->
                        <form action="Tournament_Controller.php?action=<?php echo isset($tournaments) ? 'editTournament' : 'createTournament'; ?>" method="post" enctype="multipart/form-data">
                            <?php if (isset($tournaments)) : ?>
                                <!-- Campo oculto para el ID del torneo -->
                                <input type="hidden" name="id" value="<?php echo $tournaments['id']; ?>">
                            <?php endif; ?>
                            <!-- Campo para el nombre del torneo -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($tournaments) ? $tournaments['nombre'] : ''; ?>" required>
                            </div>
                            <!-- Campo para la fecha y hora del torneo -->
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha y Hora</label>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="<?php echo isset($tournaments) ? date('Y-m-d\TH:i', strtotime($tournaments['fecha'])) : ''; ?>" required>
                            </div>
                            <!-- Campo para la descripción del torneo -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo isset($tournaments) ? $tournaments['descripcion'] : ''; ?></textarea>
                            </div>
                            <!-- Campo para la imagen del torneo -->
                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen">
                                <?php if (isset($tournaments) && !empty($tournaments['imagen'])) : ?>
                                    <img src="../Assets/images/uploads/<?php echo $tournaments['imagen']; ?>" alt="Imagen Torneo" height="100">
                                <?php endif; ?>
                            </div>
                            <!-- Botón para guardar el torneo -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enlaces a scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

