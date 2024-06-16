<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <!-- Enlace a Bootstrap CSS para estilos predeterminados y componentes responsivos -->
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
                <h1 class="mt-4">Editar Pedido</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para editar el pedido -->
                        <form id="formPedido" action="Order_Controller.php?action=editOrder" method="post">
                            <!-- Campo oculto para el ID del pedido -->
                            <input type="hidden" name="id" value="<?php echo $order['ID_Pedido']; ?>">

                            <!-- Campo para mostrar el nombre del usuario (deshabilitado) -->
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" value="<?php echo $order['Nombre_Usuario']; ?>" disabled>
                            </div>
                            <!-- Campo para mostrar el email del usuario (deshabilitado) -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="<?php echo $order['Email']; ?>" disabled>
                            </div>
                            <!-- Campo para mostrar la forma de pago (deshabilitado) -->
                            <div class="mb-3">
                                <label for="forma_pago" class="form-label">Forma de Pago</label>
                                <input type="text" class="form-control" id="forma_pago" value="<?php echo $order['Forma_Pago']; ?>" disabled>
                            </div>

                            <!-- Campo para la dirección -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $order['Direccion']; ?>" required>
                            </div>
                            <!-- Campo para el país -->
                            <div class="mb-3">
                                <label for="pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $order['Pais']; ?>" required>
                            </div>
                            <!-- Campo para la región -->
                            <div class="mb-3">
                                <label for="region" class="form-label">Región</label>
                                <input type="text" class="form-control" id="region" name="region" value="<?php echo $order['Region']; ?>" required>
                            </div>
                            <!-- Campo para la ciudad -->
                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $order['Ciudad']; ?>" required>
                            </div>
                            <!-- Campo para el código postal -->
                            <div class="mb-3">
                                <label for="codigo_postal" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?php echo $order['Codigo_Postal']; ?>" required>
                            </div>
                            <!-- Campo para las notas -->
                            <div class="mb-3">
                                <label for="notas" class="form-label">Notas</label>
                                <textarea class="form-control" id="notas" name="notas" required><?php echo $order['Notas']; ?></textarea>
                            </div>
                            <!-- Campo para el total -->
                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control" id="total" name="total" value="<?php echo $order['Total']; ?>" required>
                            </div>
                            <!-- Campo para seleccionar el estado del pedido -->
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-select" required>
                                    <option value="Pendiente" <?php if ($order['Estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                                    <option value="Enviado" <?php if ($order['Estado'] == 'Enviado') echo 'selected'; ?>>Enviado</option>
                                    <option value="Entregado" <?php if ($order['Estado'] == 'Entregado') echo 'selected'; ?>>Entregado</option>
                                    <option value="Cancelado" <?php if ($order['Estado'] == 'Cancelado') echo 'selected'; ?>>Cancelado</option>
                                </select>
                            </div>

                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

