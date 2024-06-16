<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Metadatos básicos -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Pedidos</title>

  <!-- Enlaces a CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../Assets/css/menu_main.css">
  <link rel="stylesheet" href="../Assets/css/order_history_view.css">
</head>

<body>
  <!-- Inclusión del menú principal -->
  <?php include '../views/includes/menu_main.php'; ?>

  <div id="wrapper" class="d-flex">
    <!-- Inclusión de la barra lateral del cliente -->
    <?php include '../views/includes/sidebar_cliente.php'; ?>

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <h1 class="mt-4">Historial de Pedidos</h1>
        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title">Order History</h3>
          </div>
          <div class="card-body">
            <!-- Tabla de historial de pedidos -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Estado</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $order) : ?>
                  <tr class="order-header" data-toggle="collapse" data-target="#order-<?php echo $order['ID_Pedido']; ?>">
                    <td><?php echo $order['ID_Pedido']; ?></td>
                    <td><span class="badge bg-warning text-dark"><?php echo $order['Estado']; ?></span></td>
                    <td><?php echo $order['Fecha']; ?></td>
                    <td><?php echo $order['Total']; ?>€</td>
                    <td><a href="#" class="text-decoration-none text-primary">Ver detalles <i class="fas fa-arrow-right"></i></a></td>
                  </tr>
                  <!-- Detalles del pedido -->
                  <tr id="order-<?php echo $order['ID_Pedido']; ?>" class="collapse order-details">
                    <td colspan="5">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nombre producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($order['products'] as $product) : ?>
                            <tr>
                              <td><?php echo $product['Nombre']; ?></td>
                              <td><?php echo $product['Cantidad']; ?></td>
                              <td><?php echo $product['Precio']; ?>€</td>
                            </tr>
                          <?php endforeach; ?>
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

  <!-- Bootstrap y jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="../Assets/js/menu_main.js"></script>
  <script src="../Assets/js/carrito.js"></script>
  <script src="../Assets/js/order_history_view.js"></script>
</body>

</html>

