<?php
// Iniciar la sesión si aún no ha sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar variable $usuario si el usuario ha iniciado sesión
$usuario = null;
if (isset($_SESSION['user_id'])) {
    $usuario = [
        'ID_Usuario' => $_SESSION['user_id'],
        'Nombre' => $_SESSION['user_name'],
        'Email' => $_SESSION['email'],
        'Rol' => $_SESSION['rol'],
        'imagen_perfil' => $_SESSION['imagen_perfil']
    ];
}
?>

<!-- Navegación principal -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo de la marca -->
        <a class="navbar-brand" href="../public/index.php">
            <img src="../Assets/images/JPG/logo_nobackground.png" alt="Logo TemploWargames" style="height: 70px;">
        </a>
        <!-- Botón de menú para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../public/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../controllers/Tienda_Controller.php?action=listTournaments">Torneos</a>
                </li>
                <!-- Enlace a la página de contacto -->
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/Contact_Controller.php?action=contact">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/Tienda_Controller.php?action=listProducts">Ver todos los productos</a>
                </li>
                <!-- Menú desplegable para categorías -->
                <?php foreach ($categories as $category) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink<?php echo $category['id']; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $category['name']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink<?php echo $category['id']; ?>">
                            <?php foreach ($subcategories as $subcategory) : ?>
                                <?php if ($subcategory['category_id'] == $category['id']) : ?>
                                    <li><a class="dropdown-item" href="../controllers/Tienda_Controller.php?action=listProducts&category=<?php echo $category['id']; ?>&subcategory=<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Sección de cuenta de usuario y carrito -->
            <?php if ($usuario) : ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo '../Assets/images/uploads/' . $usuario['imagen_perfil']; ?>" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">
                        <?php echo $usuario['Nombre']; ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="../controllers/ProfileController.php?action=index">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="../controllers/ProfileController.php?action=orderHistory">Historial de Pedidos</a></li>
                        <li><a class="dropdown-item" href="../controllers/ProfileController.php?action=myInscriptions">Mis Inscripciones</a></li>
                        <?php if ($usuario['Rol'] === 'admin' || $usuario['Rol'] === 'empleado') : ?>
                            <li><a class="dropdown-item" href="../controllers/Dashboard_Controller.php?action=index">Administración</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="../public/index.php?action=logout">Cerrar Sesión</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <button class="btn btn-outline-secondary my-2 my-sm-0" id="loginButton" type="button">Iniciar Sesión</button>
            <?php endif; ?>
            <!-- Botón del carrito -->
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#cartModal">
                <img src="../Assets/images/PNG/3144456.png" alt="icono carrito" style="width: 30px;">
                <i class="bi-cart-fill me-1"></i>
                Carrito
            </button>
        </div>
    </div>
</nav>

<!-- Modal para el carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Mi Cesta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cart-items"></div>
                <div class="cart-summary mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div><strong>Unidades</strong></div>
                        <div id="total-units">0</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div><strong>Total (IVA incluido)</strong></div>
                        <div id="total-price">€0.00</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="viewCartButton" class="btn btn-orange">Ver artículos en tu cesta</button>
            </div>
        </div>
    </div>
</div>
