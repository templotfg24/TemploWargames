<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscripciones</title>
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
                <h1 class="mt-4">Lista de Inscripciones</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <!-- Título de la tarjeta y botón para nueva inscripción -->
                        <h3 class="card-title">Inscripciones</h3>
                        <a href="../controllers/Tournament_Controller.php?action=createInscripcion&torneo_id=<?php echo $_GET['torneo_id']; ?>" class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Nueva Inscripción</a>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de inscripciones -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>ID Aplicación</th>
                                    <th>Teléfono</th>
                                    <th>Fecha de Inscripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inscripciones as $inscripcion) : ?>
                                    <tr>
                                        <td><?php echo $inscripcion['id']; ?></td>
                                        <td><?php echo $inscripcion['nombre']; ?></td>
                                        <td><?php echo $inscripcion['email']; ?></td>
                                        <td><?php echo $inscripcion['id_aplicacion']; ?></td>
                                        <td><?php echo $inscripcion['telefono']; ?></td>
                                        <td><?php echo $inscripcion['fecha_inscripcion']; ?></td>
                                        <td>
                                            <!-- Botón para eliminar inscripción -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $inscripcion['id']; ?>', '<?php echo $_GET['torneo_id']; ?>')"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta inscripción?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var deleteInscripcionUrl = "../controllers/Tournament_Controller.php?action=deleteInscripcion";
    </script>
    <!-- Enlace al script personalizado para la vista de inscripciones -->
    <script src="../Assets/js/inscripciones_list_view.js"></script>
</body>
</html>

