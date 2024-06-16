<?php
session_start();

// Incluye los controladores necesarios
require_once __DIR__ . '/../controllers/Auth_Controller.php';
require_once __DIR__ . '/../controllers/Dashboard_Controller.php';
require_once __DIR__ . '/../controllers/Menu_Controller.php';
require_once __DIR__ . '/../controllers/Tienda_Controller.php';

// Usa los espacios de nombres de los controladores
use controller\AuthController;
use controller\DashController;
use controller\UserController;
use controller\MenuController;
use controller\TiendaController;

// Obtén la acción desde la URL, por defecto 'tienda'
$action = $_GET['action'] ?? 'tienda';  // Usa el operador de coalescencia nula para un código más limpio

switch ($action) {
    case 'login':
        // Maneja la acción de inicio de sesión
        $authController = new AuthController();
        $authController->login();
        break;
    case 'logout':
        // Maneja la acción de cierre de sesión
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'dashboard':
        // Verifica si el usuario está autenticado y tiene el rol adecuado
        if (isset($_SESSION['user_id']) && in_array($_SESSION['rol'], ['empleado', 'admin'])) {
            $dashController = new DashController();
            $dashController->index();
        } else {
            // Redirige al usuario a la página de inicio de sesión si no está autenticado
            header('Location: index.php?action=login');
            exit;
        }
        break;
    case 'tienda':
        // Renderiza el menú y la lista de los últimos cinco productos
        $menuController = new MenuController();
        $menuController->renderMenu();
        $tiendaController = new TiendaController();
        $tiendaController->listLastFiveProducts();
        require_once __DIR__ . '/../views/tienda/index.php';
        break;
    default:
        // Redirige a una página por defecto o muestra un error si la acción no es válida
        header('Location: index.php');
        exit;
}
