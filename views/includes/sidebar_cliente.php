<!-- Barra lateral de navegación -->
<div id="sidebar-wrapper" class="bg-light border-right">
  <!-- Encabezado de la barra lateral -->
  <div class="sidebar-heading text-center py-4">
    <!-- Ícono de usuario -->
    <i class="fas fa-user-circle fa-2x"></i>
  </div>
  <!-- Lista de enlaces de navegación -->
  <div class="list-group list-group-flush">
    <!-- Enlace a la tienda -->
    <a href="../public/index.php?" class="list-group-item list-group-item-action">
      <i class="fas fa-th-large me-2"></i> Ir a la Tienda
    </a>
    <!-- Enlace a la cuenta de usuario -->
    <a href="../controllers/ProfileController.php?action=index" class="list-group-item list-group-item-action">
      <i class="fas fa-user me-2"></i> Cuenta
    </a>
    <!-- Enlace al historial de pedidos -->
    <a href="../controllers/ProfileController.php?action=orderHistory" class="list-group-item list-group-item-action">
      <i class="fas fa-history me-2"></i> Historial de Pedidos
    </a>
    <!-- Enlace a mis inscripciones -->
    <a href="../controllers/ProfileController.php?action=myInscriptions" class="list-group-item list-group-item-action">
      <i class="fas fa-clipboard-list me-2"></i> Mis Inscripciones
    </a>
    <!-- Verificar si el usuario es admin o empleado -->
    <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado') : ?>
      <!-- Enlace a la administración (visible solo para admin o empleados) -->
      <a href="../controllers/Dashboard_Controller.php?action=index" class="list-group-item list-group-item-action">
        <i class="fas fa-cogs me-2"></i> Administración
      </a>
    <?php endif; ?>
    <!-- Enlace para cerrar sesión -->
    <a href="../controllers/ProfileController.php?action=logout" class="list-group-item list-group-item-action">
      <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
    </a>
  </div>
</div>


