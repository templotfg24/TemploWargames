<?php
namespace controller;

require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\Category_Model;
use models\Subcategory_Model;
use models\User_Model;
use models\Utils;

class MenuController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function renderMenu() {
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $userModel = new User_Model();

        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();

        // Verificar si el usuario está logueado y obtener la información del usuario
        $usuario = null;
        if (isset($_SESSION['user_id'])) {
            $userId = Utils::limpiar_datos($_SESSION['user_id']);
            $usuario = $userModel->getUserById($userId);
        }

        require_once '../views/includes/menu_main.php';
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $menuController = new MenuController();

    switch ($action) {
        case 'renderMenu':
            $menuController->renderMenu();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
