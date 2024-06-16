<?php

namespace controller;

require_once '../models/Product_Model.php';
require_once '../models/Order_Model.php';
require_once '../models/OrderProduct_Model.php';
require_once '../models/PaymentMethod_Model.php';
require_once '../models/Utils.php';

use models\Product_Model;
use models\Order_Model;
use models\OrderProduct_Model;
use models\PaymentMethod_Model;
use models\Utils;

class CheckoutController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getPaymentMethods()
    {
        $paymentMethodModel = new PaymentMethod_Model();
        return $paymentMethodModel->getAllPaymentMethods();
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['products'])) {
            $products = json_decode($_POST['products'], true);

            // Recalculate the total and validate prices
            $productModel = new Product_Model();
            $validProducts = [];
            $total = 0;

            foreach ($products as $product) {
                $dbProduct = $productModel->getProductById($product['id']);
                if ($dbProduct) {
                    $dbProduct['quantity'] = $product['quantity'];
                    $dbProduct['subtotal'] = $dbProduct['Precio'] * $product['quantity'];
                    $total += $dbProduct['subtotal'];
                    $validProducts[] = $dbProduct;
                }
            }
            $paymentMethods = new PaymentMethod_Model();
            $paymentMethods = $this->getPaymentMethods();
            // Pass valid products and total to the checkout view
            require_once '../views/cart/checkout_view.php';
        } else {
            echo "No se han recibido productos para procesar.";
        }
    }

    public function hacerPedido()
    {
        // Recoger y sanitizar los datos del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $pais = htmlspecialchars($_POST['pais']);
        $region = htmlspecialchars($_POST['region']);
        $ciudad = htmlspecialchars($_POST['ciudad']);
        $codigo_postal = htmlspecialchars($_POST['codigo_postal']);
        $email = htmlspecialchars($_POST['email']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $paymentMethod = (int)htmlspecialchars($_POST['paymentMethod']);
        $notas = htmlspecialchars($_POST['notas']);
        $userId = $_SESSION['user_id']; // Puedes reemplazar esto con el ID de usuario real si está en la sesión

        // Validar los productos en el carrito
        $products = json_decode($_POST['products'], true);

        // Validar y recalcular los productos
        $productModel = new Product_Model();
        $total = 0;
        $validProducts = [];

        foreach ($products as $product) {
            $dbProduct = $productModel->getProductById($product['id']);
            if ($dbProduct) {
                if ($dbProduct['Stock'] < $product['quantity']) {
                    $this->alertAndRedirect("Lo sentimos, no hay suficiente stock para el producto " . $dbProduct['Nombre'] . ".", "../controllers/CheckoutController.php?action=processCheckout");
                }
                $dbProduct['quantity'] = $product['quantity'];
                $dbProduct['subtotal'] = $dbProduct['Precio'] * $product['quantity'];
                $total += $dbProduct['subtotal'];
                $validProducts[] = $dbProduct;
            }
        }

        // Calcular el total del pedido
        $total = 0;
        foreach ($validProducts as $product) {
            $total += $product['Precio'] * $product['quantity'];
        }

        // Validar que la forma de pago es válida
        if (!in_array($paymentMethod, [1, 2, 3, 4])) {
            $this->alertAndRedirect("Forma de pago no válida.", "../controllers/CheckoutController.php?action=processCheckout");
        }

        // Insertar el pedido en la base de datos
        $orderModel = new Order_Model();
        $orderProductModel = new OrderProduct_Model();
        $orderId = $orderModel->insertOrder($userId, $total, $paymentMethod, 'Pendiente', $direccion, $pais, $region, $ciudad, $codigo_postal, $notas);

        if ($orderId) {
            // Insertar los productos del pedido en la base de datos
            foreach ($validProducts as $product) {
                $orderProductModel->insertOrderProduct($orderId, $product['ID_Producto'], $product['quantity']);
                $productModel->reduceStock($product['ID_Producto'], $product['quantity']);
            }

            // Preparar los datos para la factura
            $orderData = [
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'region' => $region,
                'codigo_postal' => $codigo_postal,
                'order_id' => $orderId,
                'total' => $total
            ];

            // Enviar la factura por correo
            Utils::enviarCorreoFactura($email, $orderData, $validProducts);

            // Redirigir a la página de confirmación del pedido
            header('Location: ../views/order_confirmation.php?order_id=' . $orderId);
            exit();
        } else {
            $this->alertAndRedirect("Error al procesar el pedido.", "../controllers/CheckoutController.php?action=processCheckout");
        }
    }

    public function alertAndRedirect($message, $redirectUrl)
    {
        echo '<script>alert("' . $message . '"); window.location.href="' . $redirectUrl . '";</script>';
        exit();
    }
    public function checkStock()
    {
        $products = json_decode(file_get_contents('php://input'), true);
        $productModel = new Product_Model();
        $insufficientStock = [];

        foreach ($products as $product) {
            $dbProduct = $productModel->getProductById($product['id']);
            if ($dbProduct['Stock'] < $product['quantity']) {
                $insufficientStock[] = [
                    'id' => $product['id'],
                    'name' => $dbProduct['Nombre'],
                    'available' => $dbProduct['Stock']
                ];
            }
        }

        if (!empty($insufficientStock)) {
            $message = "Lo sentimos, algunos productos no tienen suficiente stock:\n";
            foreach ($insufficientStock as $item) {
                $message .= "{$item['name']}: Disponible: {$item['available']}\n";
            }
            echo json_encode(['success' => false, 'message' => $message, 'insufficientStock' => $insufficientStock]);
        } else {
            echo json_encode(['success' => true]);
        }

        exit();
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $checkoutController = new CheckoutController();

    switch ($action) {
        case 'processCheckout':
            $checkoutController->processCheckout();
            break;
        case 'hacerPedido':
            $checkoutController->hacerPedido();
            break;
        case 'checkStock':
            $checkoutController->checkStock();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    echo 'No se especificó ninguna acción';
}
