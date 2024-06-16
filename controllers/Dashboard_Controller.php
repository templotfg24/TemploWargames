<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Order_Model.php';
require_once '../models/Product_Model.php';
use models\User_Model;
use models\Order_Model;
use models\Product_Model;

class DashController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Verificar que el usuario esté logueado y tenga los permisos adecuados
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function index() {
        $userModel = new User_Model();
        $orderModel = new Order_Model();
        $productModel = new Product_Model();

        $role = $_SESSION['rol'];
        // Obtener datos para mostrar en el dashboard
        $userCount = $userModel->getUserCount();
        $clientCount = $userModel->getClientCount();
        $productCount = $productModel->getProductCount();
        $orderCount = $orderModel->getOrderCount();

        // Obtener últimos pedidos
        $latestOrders = $orderModel->getLatestOrders();

        // Obtener datos de ventas por mes
        $salesByMonth = $orderModel->getSalesByMonth();

        // Obtener datos de tipos de pago
        $paymentTypes = $orderModel->getPaymentTypes();

        // Pasar datos a la vista
        require_once '../views/dashboard/dashboard_views.php';
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $dashboardController = new DashController();

    switch ($action) {
        case 'index':
            $dashboardController->index();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}

