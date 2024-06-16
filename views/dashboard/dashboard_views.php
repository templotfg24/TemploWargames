<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Enlace a Bootstrap CSS para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Enlace a los estilos personalizados -->
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>
<body>
  <div id="wrapper">
    <!-- Barra de navegación lateral -->
    <?php include '../views/includes/sidebar_menu.php'; ?>
    <!-- Contenido principal -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="app-title mt-4">
          <div>
            <!-- Título del panel de administración -->
            <h1><i class="fas fa-tachometer-alt"></i> Panel de Administración</h1>
          </div>
        </div>

        <div class="row">
          <!-- Tarjeta de Usuarios -->
          <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
              <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                  <div>
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text"><b><?php echo $userCount; ?></b></p>
                  </div>
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </a>
          </div>

          <!-- Tarjeta de Clientes -->
          <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
              <div class="card text-white bg-info mb-3">
                <div class="card-body">
                  <div>
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text"><b><?php echo $clientCount; ?></b></p>
                  </div>
                  <i class="fas fa-user"></i>
                </div>
              </div>
            </a>
          </div>

          <!-- Tarjeta de Productos -->
          <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
              <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                  <div>
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text"><b><?php echo $productCount; ?></b></p>
                  </div>
                  <i class="fas fa-archive"></i>
                </div>
              </div>
            </a>
          </div>

          <!-- Tarjeta de Pedidos -->
          <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
              <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                  <div>
                    <h5 class="card-title">Pedidos</h5>
                    <p class="card-text"><b><?php echo $orderCount; ?></b></p>
                  </div>
                  <i class="fas fa-shopping-cart"></i>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="row">
          <!-- Sección de Últimos Pedidos -->
          <div class="col-md-6">
            <div class="card mb-4">
              <div class="card-header">
                <h3 class="card-title">Últimos Pedidos</h3>
              </div>
              <div class="card-body">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Dirección</th>
                      <th>Estado</th>
                      <th class="text-end">Monto</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Listado de últimos pedidos -->
                    <?php foreach ($latestOrders as $order): ?>
                    <tr>
                      <td><?php echo $order['ID_Pedido']; ?></td>
                      <td><?php echo $order['Direccion']; ?></td>
                      <td><?php echo $order['Estado']; ?></td>
                      <td class="text-end">$<?php echo number_format($order['Total'], 2); ?></td>
                      <td><a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Sección de Tipo de Pagos por Mes -->
          <div class="col-md-6">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Tipo de pagos por mes</h3>
              </div>
              <div class="card-body">
                <!-- Contenedor para la gráfica de pagos por mes -->
                <div id="pagosMesAnio"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enlaces a las librerías de jQuery, Bootstrap y Highcharts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>
    // Script para alternar el menú lateral
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    // Ejemplo de gráfico con Highcharts
    Highcharts.chart('pagosMesAnio', {
      chart: {
        type: 'pie'
      },
      title: {
        text: 'Ventas por tipo de pago'
      },
      series: [{
        name: 'Ventas',
        data: [
          <?php foreach ($paymentTypes as $paymentType): ?>
            { name: '<?php echo $paymentType['forma_pago']; ?>', y: <?php echo $paymentType['cantidad']; ?> },
          <?php endforeach; ?>
        ]
      }]
    });
  </script>
</body>
</html>
