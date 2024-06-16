<?php

namespace controller;

require_once '../models/Order_Model.php';
require_once '../models/OrderProduct_Model.php';
require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/User_Model.php';
require_once '../models/Inscripcion_Model.php';

use models\Order_Model;
use models\OrderProduct_Model;
use models\Category_Model;
use models\Subcategory_Model;
use models\User_Model;
use models\Inscripcion_Model;

class ProfileController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function index()
    {
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        $user = $this->getUserDetails();
        require_once '../views/profile/profile_view.php';
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $imagenPerfil = null;

            if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {
                $imagenPerfil = basename($_FILES['imagen_perfil']['name']);
                $targetDir = "../Assets/images/uploads/";
                $targetFile = $targetDir . $imagenPerfil;
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $targetFile);
            }

            $userModel = new User_Model();
            $userModel->updateUserProfile($userId, $nombre, $email, $telefono, $imagenPerfil);

            // Actualizar la sesión con la nueva información
            $_SESSION['user_name'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['telefono'] = $telefono;
            if ($imagenPerfil) {
                $_SESSION['imagen_perfil'] = $imagenPerfil;
            }

            echo 'Perfil actualizado exitosamente.';
        }
    }



    public function updateAddress()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $direccion = $_POST['direccion'];

            $userModel = new User_Model();
            $userModel->updateUserAddress($userId, $direccion);

            echo 'Dirección actualizada exitosamente.';
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            $userModel = new User_Model();
            $user = $userModel->getUserById($userId);

            if ($user && password_verify($currentPassword, $user['Password'])) {
                if ($newPassword === $confirmPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $userModel->updatePassword($userId, $hashedPassword);
                    echo 'Contraseña actualizada exitosamente.';
                } else {
                    echo 'Las nuevas contraseñas no coinciden.';
                }
            } else {
                echo 'La contraseña actual es incorrecta.';
            }
        }
    }

    public function orderHistory()
    {
        $user = $this->getUser();
        $orderModel = new Order_Model();
        $orderProductModel = new OrderProduct_Model();
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        $orders = $orderModel->getOrdersByUserId($user['ID_User']);

        foreach ($orders as &$order) {
            $order['products'] = $orderProductModel->getProductsByOrderId($order['ID_Pedido']);
        }
        require_once '../views/profile/order_history_view.php';
    }

    public function myInscriptions()
    {
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        $user = $this->getUser();
        $inscripcionModel = new Inscripcion_Model();
        $inscriptions = $inscripcionModel->getUserInscriptions($user['ID_User']);
        require_once '../views/profile/my_inscriptions_view.php';
    }

    public function deleteInscription() {
        $inscripcionModel = new Inscripcion_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $inscripcionModel->deleteInscripcion($id);
            echo 'Inscripción eliminada exitosamente.';
        }
    }
    

    private function getUser()
    {
        return [
            'ID_User' => $_SESSION['user_id'],
            'Name' => $_SESSION['user_name'],
            'Email' => $_SESSION['email'],
            'Role' => $_SESSION['rol'],
            'profile_image' => $_SESSION['imagen_perfil']
        ];
    }

    private function getUserDetails()
    {
        $userId = $_SESSION['user_id'];
        $userModel = new User_Model();
        return $userModel->getUserById($userId);
    }

    private function getMyInscriptions($userId)
    {
        return [];
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $profileController = new ProfileController();

    switch ($action) {
        case 'index':
            $profileController->index();
            break;
        case 'updateProfile':
            $profileController->updateProfile();
            break;
        case 'updateAddress':
            $profileController->updateAddress();
            break;
        case 'changePassword':
            $profileController->changePassword();
            break;
        case 'orderHistory':
            $profileController->orderHistory();
            break;
        case 'myInscriptions':
            $profileController->myInscriptions();
            break;
        case 'deleteInscription':
            $profileController->deleteInscription();
            break;

        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
