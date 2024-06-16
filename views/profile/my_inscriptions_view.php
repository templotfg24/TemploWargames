<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Metadatos básicos -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Inscripciones</title>

  <!-- Enlaces a CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../Assets/css/menu_main.css">
  <link rel="stylesheet" href="../Assets/css/my_inscriptions_view.css">
</head>

<body>
  <!-- Inclusión del menú principal -->
  <?php include '../views/includes/menu_main.php'; ?>

  <div id="wrapper" class="d-flex">
    <!-- Inclusión de la barra lateral del cliente -->
    <?php include '../views/includes/sidebar_cliente.php'; ?>

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <h1 class="mt-4">Mis Inscripciones</h1>
        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title">Mis Inscripciones</h3>
          </div>
          <div class="card-body">
            <!-- Tabla de inscripciones -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Torneo</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($inscriptions as $inscription) : ?>
                  <tr class="inscription-header">
                    <td><?php echo $inscription['id']; ?></td>
                    <td><?php echo $inscription['torneo_nombre']; ?></td>
                    <td><?php echo $inscription['fecha_inscripcion']; ?></td>
                    <td>
                      <!-- Botones de acción -->
                      <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $inscription['id']; ?>')"><i class="fas fa-trash"></i></button>
                      <button type="button" class="btn btn-info btn-sm" onclick="toggleDetails('<?php echo $inscription['id']; ?>')"><i class="fas fa-info-circle"></i></button>
                    </td>
                  </tr>
                  <!-- Detalles de la inscripción -->
                  <tr id="inscription-<?php echo $inscription['id']; ?>" class="collapse inscription-details">
                    <td colspan="4">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Teléfono</th>
                            <th>ID Aplicación</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo $inscription['telefono']; ?></td>
                            <td><?php echo $inscription['id_aplicacion']; ?></td>
                          </tr>
                        </tbody>
                      </table>
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

  <!-- Inclusión del pie de página -->
  <?php include '../views/includes/footer.php'; ?>

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

  <!-- Bootstrap y jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Inclusión del script para la vista de inscripciones -->
  <script src="../Assets/js/my_inscriptions_view.js"></script>
</body>

</html>
