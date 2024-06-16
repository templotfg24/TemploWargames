<?php

namespace controller;


require_once '../models/Product_Model.php';
require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/Tournament_Model.php';
require_once '../models/Inscripcion_Model.php';
require_once '../models/User_Model.php';
require_once '../models/Utils.php';

use models\Product_Model;
use models\Category_Model;
use models\Subcategory_Model;
use models\Tournament_Model;
use models\Inscripcion_Model;
use models\User_Model;
use models\Utils;

class TiendaController
{
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function listLastFiveProducts()
    {
        $productModel = new Product_Model();
        $productos = $productModel->getLastFiveProducts();
        require_once '../views/includes/hero.php';
        echo '<div class="container">';
        echo '<h1 class="mt-4">Novedades</h1>';
        echo '<p class="lead">Explora nuestra nueva colección de productos.</p>';
        require_once("../views/includes/New_Products.php");
        echo '</div>';
        require_once '../views/includes/footer.php'; 
    }

    public function viewProductDetail()
    {
        if (isset($_GET['id'])) {
            $productModel = new Product_Model();
            $categoryModel = new Category_Model();
            $subcategoryModel = new Subcategory_Model();
            $producto = $productModel->getProductById($_GET['id']);
            $categoriesById = $categoryModel->getCategoryById($producto['category_id']);
            $subcategoriesById = $subcategoryModel->getSubcategoryById($producto['subcategory_id']);
            $categories = $categoryModel->getAllCategories();
            $subcategories = $subcategoryModel->getAllSubcategories();

            require_once '../views/includes/menu_main.php';
            require_once '../views/product/product_details_views.php';
        } else {
            echo "No se ha especificado ningún producto.";
        }
    }

    public function listProducts()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $items_per_page = 9;

        $productModel = new Product_Model();
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();

        $productos = $productModel->getProductsByPageViewsStore(($page - 1) * $items_per_page, $items_per_page);
        $total_products = $productModel->getProductCount();
        $totalPages = ceil($total_products / $items_per_page);

        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
        $subcategoryId = isset($_GET['subcategory']) ? (int)$_GET['subcategory'] : null;

        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();

        require_once '../views/includes/menu_main.php';
        require_once '../views/tienda/store_all_Products_view.php';
    }

    public function listTournaments()
    {
        $tournamentModel = new Tournament_Model();
        $tournaments = $tournamentModel->getAllTournaments();
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        require_once '../views/includes/menu_main.php';
        require_once '../views/tienda/tournaments_list_view.php';
    }

    public function inscripcionTorneo()
    {
        $tournamentModel = new Tournament_Model();
        $tournamentId = $_GET['id'];
        $tournament = $tournamentModel->getTournamentById($tournamentId);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $email = $_SESSION['email'];
            $applicationId = htmlspecialchars($_POST['applicationId']);
            $phoneCode = htmlspecialchars($_POST['phoneCode']);
            $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
            $fullPhoneNumber = $phoneCode . $phoneNumber;
    
            $data = [
                'usuario_id' => $userId,
                'torneo_id' => $tournamentId,
                'fecha_inscripcion' => date('Y-m-d H:i:s'),
                'telefono' => $fullPhoneNumber,
                'id_aplicacion' => $applicationId
            ];
    
            $inscripcionModel = new Inscripcion_Model();
            $inscripcionModel->createInscripcion($data);
    
            $inscripcionData = [
                'nombre' => $_SESSION['user_name'],
                'email' => $email,
                'torneo' => $tournament['nombre'],
                'fecha' => date('Y-m-d H:i', strtotime($tournament['fecha'])),
                'id_aplicacion' => $applicationId,
                'telefono' => $fullPhoneNumber
            ];
    
            Utils::enviarConfirmacionInscripcion($email, $inscripcionData);
    
            header('Location: Tienda_Controller.php?action=listTournaments');
            exit();
        } else {
            $userName = $_SESSION['user_name'] ?? '';
            $email = $_SESSION['email'] ?? '';
            require_once '../views/tienda/inscripcion_form_view.php';
        }
    }    
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $tiendaController = new TiendaController();

    switch ($action) {
        case 'listLastFiveProducts':
            $tiendaController->listLastFiveProducts();
            break;
        case 'viewProductDetail':
            $tiendaController->viewProductDetail();
            break;
        case 'listProducts':
            $tiendaController->listProducts();
            break;
        case 'listTournaments':
            $tiendaController->listTournaments();
            break;
        case 'inscripcionTorneo':
            $tiendaController->inscripcionTorneo();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
