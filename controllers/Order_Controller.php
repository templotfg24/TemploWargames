<?php

namespace controller;

require_once '../models/Order_Model.php';

use models\Order_Model;

class OrderController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function listOrders()
    {
        $role = $_SESSION['rol'];
        $orderModel = new Order_Model();
        $limit = 10; // Número de pedidos por página
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $total_orders = $orderModel->getTotalOrders();
        $total_pages = ceil($total_orders / $limit);

        $orders = $orderModel->getOrders($start, $limit);

        require_once '../views/order/order_list_views.php';
    }

    public function editOrder()
    {
        $role = $_SESSION['rol'];
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $orderId = $_GET['id'];
            $orderModel = new Order_Model();

            $order = $orderModel->getOrderById($orderId);

            require_once '../views/order/edit_order_view.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['id'];
            $orderData = [
                'Direccion' => $_POST['direccion'],
                'Pais' => $_POST['pais'],
                'Region' => $_POST['region'],
                'Ciudad' => $_POST['ciudad'],
                'Codigo_Postal' => $_POST['codigo_postal'],
                'Notas' => $_POST['notas'],
                'Total' => $_POST['total'],
                'Estado' => $_POST['estado']
            ];

            $orderModel = new Order_Model();
            $result = $orderModel->updateOrder($orderId, $orderData);

            if ($result) {
                // Redirige a la lista de pedidos o muestra un mensaje de éxito
                header("Location: Order_Controller.php?action=listOrders");
            } else {
                // Muestra un mensaje de error
                echo "Error al actualizar el pedido.";
            }
        }
    }

    public function updateOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['id'];
            $status = $_POST['status'];
            $address = $_POST['address'];
            $notes = $_POST['notes'];

            $orderModel = new Order_Model();
            $orderModel->updateOrder($orderId, $status, $address, $notes);

            header('Location: Order_Controller.php?action=listOrders');
        }
    }

    public function deleteOrder()
    {
        if (isset($_POST['id'])) {
            $orderId = $_POST['id'];

            $orderModel = new Order_Model();
            $orderModel->deleteOrder($orderId);

            header('Location: Order_Controller.php?action=listOrders');
        }
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $orderController = new OrderController();

    switch ($action) {
        case 'listOrders':
            $orderController->listOrders();
            break;
        case 'editOrder':
            $orderController->editOrder();
            break;
        case 'updateOrder':
            $orderController->updateOrder();
            break;
        case 'deleteOrder':
            $orderController->deleteOrder();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    echo 'No se especificó ninguna acción';
}
