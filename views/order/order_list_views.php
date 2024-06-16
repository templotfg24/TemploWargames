<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Pedidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Gestión de Pedidos</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Pedidos</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de pedidos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Pais</th>
                                    <th>Region</th>
                                    <th>Ciudad</th>
                                    <th>Código Postal</th>
                                    <th>Notas</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Forma de Pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order) : ?>
                                    <tr>
                                        <td><?php echo $order['ID_Pedido']; ?></td>
                                        <td><?php echo $order['Nombre_Usuario']; ?></td>
                                        <td><?php echo $order['Email']; ?></td>
                                        <td><?php echo $order['Direccion']; ?></td>
                                        <td><?php echo $order['Pais']; ?></td>
                                        <td><?php echo $order['Region']; ?></td>
                                        <td><?php echo $order['Ciudad']; ?></td>
                                        <td><?php echo $order['Codigo_Postal']; ?></td>
                                        <td><?php echo $order['Notas']; ?></td>
                                        <td><?php echo $order['Fecha']; ?></td>
                                        <td><?php echo $order['Total']; ?></td>
                                        <td><?php echo $order['Estado']; ?></td>
                                        <td><?php echo $order['Forma_Pago']; ?></td>
                                        <td>
                                            <a href="Order_Controller.php?action=editOrder&id=<?php echo $order['ID_Pedido']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <!-- Botón de eliminación comentado -->
                                            <!--<button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $order['ID_Pedido']; ?>')"><i class="fas fa-trash"></i></button>-->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                        <a class="page-link" href="Order_Controller.php?action=listOrders&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <!--
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este pedido?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    -->

    <!-- Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /*
        function showDeleteModal(orderId) {
            // Configura el formulario del modal para enviar la eliminación con el ID correcto
            var deleteButton = document.getElementById('confirmDelete');
            deleteButton.onclick = function() {
                var form = document.createElement('form');
                form.action = 'Order_Controller.php?action=deleteOrder';
                form.method = 'post';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = orderId;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            };

            // Muestra el modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        }
        */
    </script>
</body>

</html>

