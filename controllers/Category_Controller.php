<?php
require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/Utils.php';
use models\Category_Model;
use models\Subcategory_Model;
use models\Utils;

class Category_Controller {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function listCategories() {
        $role = $_SESSION['rol'];
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();

        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        require_once '../views/category/category_subcategory_view.php';
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['category_name'])) {
                $categoryModel = new Category_Model();
                $name = Utils::limpiar_datos($_POST['category_name']);
                $categoryModel->createCategory($name);
                header('Location: Category_Controller.php?action=listCategories');
            } else {
                echo 'El nombre de la categoría es obligatorio';
            }
        }
    }

    public function editCategory() {
        $role =  $_SESSION['rol'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryModel = new Category_Model();
            $id = Utils::limpiar_datos($_POST['id']);
            $name = Utils::limpiar_datos($_POST['category_name']);
            $categoryModel->updateCategory($id, $name);
            header('Location: Category_Controller.php?action=listCategories');
        } else {
            $id = Utils::limpiar_datos($_GET['id']);
            $categoryModel = new Category_Model();
            $category = $categoryModel->getCategoryById($id);
            require_once '../views/category/category_form_view.php';
        }
    }
    

    public function deleteCategory() {
        if (isset($_GET['id'])) {
            $categoryModel = new Category_Model();
            $id = Utils::limpiar_datos($_GET['id']);
            $categoryModel->deleteCategory($id);
            header('Location: Category_Controller.php?action=listCategories');
        } else {
            echo 'ID de categoría no especificado';
        }
    }
}

if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $categoryController = new Category_Controller();
    switch ($action) {
        case 'listCategories':
            $categoryController->listCategories();
            break;
        case 'createCategory':
            $categoryController->createCategory();
            break;
        case 'editCategory':
            $categoryController->editCategory();
            break;
        case 'deleteCategory':
            $categoryController->deleteCategory();
            break;
        default:
            $categoryController->listCategories();
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
