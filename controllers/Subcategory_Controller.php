<?php
require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/Utils.php';

use models\Category_Model;
use models\Subcategory_Model;
use models\Utils;

class Subcategory_Controller
{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function createSubcategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subcategyModel = new Subcategory_Model();
            $name = Utils::limpiar_datos($_POST['subcategory_name']);
            $category_id = Utils::limpiar_datos($_POST['category_id']);
            $subcategyModel->createSubcategory($name, $category_id);
            header('Location: Category_Controller.php?action=listCategories');
        }
    }

    public function editSubcategory()
    {
        $role = $_SESSION['rol'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subcategyModel = new Subcategory_Model();
            $id = Utils::limpiar_datos($_POST['id']);
            $name = Utils::limpiar_datos($_POST['subcategory_name']);
            $category_id = Utils::limpiar_datos($_POST['category_id']);
            $subcategyModel->updateSubcategory($id, $category_id, $name);
            header('Location: Category_Controller.php?action=listCategories');
        } else {
            $subcategyModel = new Subcategory_Model();
            $id = Utils::limpiar_datos($_GET['id']);
            $categoryModel = new Category_Model();
            $categories = $categoryModel->getAllCategories();
            $subcategory = $subcategyModel->getSubcategoryById($id);
            require_once '../views/category/subcategory_form_view.php';
        }
    }

    public function deleteSubcategory()
    {
        $subcategyModel = new Subcategory_Model();
        $id = Utils::limpiar_datos($_GET['id']);
        $subcategyModel->deleteSubcategory($id);
        header('Location: Category_Controller.php?action=listCategories');
    }
}

if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $subcategoryController = new Subcategory_Controller();

    switch ($action) {
        case 'createSubcategory':
            $subcategoryController->createSubcategory();
            break;
        case 'editSubcategory':
            $subcategoryController->editSubcategory();
            break;
        case 'deleteSubcategory':
            $subcategoryController->deleteSubcategory();
            break;
        default:
            header('Location: Category_Controller.php?action=listCategories');
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
