<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Torneos</title>
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
                <h1 class="mt-4">Lista de Torneos</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <!-- Título de la tarjeta y botón para agregar un nuevo torneo -->
                        <h3 class="card-title">Torneos</h3>
                        <a href="Tournament_Controller.php?action=createTournament" class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Nuevo Torneo</a>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de torneos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Iteración a través de la lista de torneos -->
                                <?php foreach ($tournaments as $tournament) : ?>
                                    <tr>
                                        <td><?php echo $tournament['id']; ?></td>
                                        <td><?php echo $tournament['nombre']; ?></td>
                                        <td><?php echo $tournament['fecha']; ?></td>
                                        <td><?php echo $tournament['descripcion']; ?></td>
                                        <td><img src="../Assets/images/uploads/<?php echo $tournament['imagen']; ?>" alt="Imagen Torneo" width="50"></td>
                                        <td>
                                            <!-- Botones de acciones: editar, ver inscripciones y eliminar -->
                                            <a href="Tournament_Controller.php?action=editTournament&id=<?php echo $tournament['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="Tournament_Controller.php?action=listInscripciones&torneo_id=<?php echo $tournament['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $tournament['id']; ?>')"><i class="fas fa-trash"></i></button>
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
                    <!-- Título del modal -->
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mensaje de confirmación -->
                    ¿Estás seguro de que deseas eliminar este torneo?
                </div>
                <div class="modal-footer">
                    <!-- Botones de cancelación y confirmación -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var deleteTournamentUrl = "../controllers/Tournament_Controller.php?action=deleteTournament";
    </script>
    <!-- Enlace a archivo JS específico para la vista de lista de torneos -->
    <script src="../Assets/js/tournament_list_views.js"></script>
</body>

</html>

