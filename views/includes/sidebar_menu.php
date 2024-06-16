<!-- Barra lateral de navegación -->
<div id="sidebar-wrapper">
  <!-- Encabezado de la barra lateral -->
  <div class="sidebar-heading text-center py-4">
    <!-- Ícono de usuario -->
    <i class="fas fa-user-circle fa-2x"></i>
  </div>
  <!-- Lista de enlaces de navegación -->
  <div class="list-group list-group-flush">
    <!-- Enlace a la página de inicio del panel -->
    <a href="Dashboard_Controller.php?action=index" class="list-group-item list-group-item-action">
      <i class="fas fa-th-large me-2"></i> Inicio
    </a>
    <!-- Enlace a la tienda -->
    <a href="../public/index.php?" class="list-group-item list-group-item-action">
      <i class="fas fa-th-large me-2"></i> Ir a la Tienda
    </a>
    <!-- Enlace a la cuenta de usuario -->
    <a href="ProfileController.php?action=index" class="list-group-item list-group-item-action">
      <i class="fas fa-user me-2"></i> Cuenta
    </a>
    <!-- Enlace a la lista de usuarios (CRUD de usuarios) -->
    <a href="User_Controller.php?action=listUsers" class="list-group-item list-group-item-action">
      <i class="fas fa-users me-2"></i> Usuarios
    </a>
    <!-- Enlace a la lista de productos (CRUD de productos) -->
    <a href="Product_Controller.php?action=listProducts" class="list-group-item list-group-item-action">
      <i class="fas fa-boxes me-2"></i> Productos
    </a>
    <!-- Verificar si el usuario es admin para mostrar enlace de categorías -->
    <?php if ($role == 'admin') { ?>
      <!-- Enlace a la lista de categorías (CRUD de categorías) -->
      <a href="Category_Controller.php?action=listCategories" class="list-group-item list-group-item-action">
        <i class="fas fa-tags me-2"></i> Categorías
      </a>
    <?php } ?>
    <!-- Enlace a la lista de torneos (CRUD de torneos) -->
    <a href="Tournament_Controller.php?action=listTournaments" class="list-group-item list-group-item-action">
      <i class="fa-solid fa-dice"></i> Torneos
    </a>
    <!-- Enlace a la lista de pedidos (CRUD de pedidos) -->
    <a href="Order_Controller.php?action=listOrders" class="list-group-item list-group-item-action">
      <i class="fas fa-receipt me-2"></i> Pedidos
    </a>
    <!-- Enlace para cerrar sesión -->
    <a href="../public/index.php?action=logout" class="list-group-item list-group-item-action">
      <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
    </a>
  </div>
</div>
