<?php
namespace controller;

require_once '../models/Product_Model.php';
require_once '../models/Category_Model.php';
require_once '../models/Subcategory_Model.php';
require_once '../models/Utils.php';
use models\Product_Model;
use models\Category_Model;
use models\Subcategory_Model;
use models\Utils;

class ProductController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function listProducts() {
        $role = $_SESSION['rol'];
        $productModel = new Product_Model();
        $categoryModel = new Category_Model();
        $categories = $categoryModel->getAllCategories();
        $subcategoryModel = new Subcategory_Model();
        $subcategories = $subcategoryModel->getAllSubcategories();

        $page = isset($_GET['page']) ? (int)Utils::limpiar_datos($_GET['page']) : 1;
        $items_per_page = 4; // Puedes cambiar este valor según tus necesidades
        $productos = $productModel->getProductsByPage($page, $items_per_page);
        $total_users = $productModel->getProductCount();
        $total_pages = ceil($total_users / $items_per_page);
        require_once '../views/product/product_list_views.php';
    }

    public function registerProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = Utils::limpiar_datos($_POST['nombre']);
            $descripcion = Utils::limpiar_datos($_POST['descripcion']);
            $precio = Utils::limpiar_datos($_POST['precio']);
            $stock = Utils::limpiar_datos($_POST['stock']);
            $categoria = Utils::limpiar_datos($_POST['categoria']);
            $subcategoria = Utils::limpiar_datos($_POST['subcategoria']);
            $imagenes = [];
            for ($i = 1; $i <= 6; $i++) {
                $imagen = isset($_FILES['imagen' . $i]) && $_FILES['imagen' . $i]['error'] === UPLOAD_ERR_OK ? $_FILES['imagen' . $i]['name'] : null;
                if ($imagen) {
                    $target_dir = "../Assets/images/uploads/";
                    $target_file = $target_dir . basename($imagen);
                    move_uploaded_file($_FILES['imagen' . $i]['tmp_name'], $target_file);
                    $imagenes[] = $imagen;
                } else {
                    $imagenes[] = null;
                }
            }

            $productModel = new Product_Model();
            $productModel->createProduct($nombre, $descripcion, $precio, $stock, $categoria, $subcategoria, $imagenes);

            header('Location: Product_Controller.php?action=listProducts');
        } else {
            $categoryModel = new Category_Model();
            $categories = $categoryModel->getAllCategories();
            require_once '../views/product/register_product_views.php';
        }
    }

    public function editProduct() {
        if (isset($_GET['id'])) {
            $role = $_SESSION['rol'];
            $productModel = new Product_Model();
            $producto = $productModel->getProductById(Utils::limpiar_datos($_GET['id']));
            $categoryModel = new Category_Model();
            $categories = $categoryModel->getAllCategories();
            $subcategoryModel = new Subcategory_Model();
            $subcategories = $subcategoryModel->getAllSubcategories();
            require_once '../views/product/edit_product_view.php';
        }
    }

    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = Utils::limpiar_datos($_POST['id']);
            $nombre = Utils::limpiar_datos($_POST['nombre']);
            $descripcion = Utils::limpiar_datos($_POST['descripcion']);
            $precio = Utils::limpiar_datos($_POST['precio']);
            $stock = Utils::limpiar_datos($_POST['stock']);
            $categoria = Utils::limpiar_datos($_POST['categoria']);
            $subcategoria = Utils::limpiar_datos($_POST['subcategoria']);
            $imagenes = [];
            for ($i = 1; $i <= 6; $i++) {
                $imagen = isset($_FILES['imagen' . $i]) && $_FILES['imagen' . $i]['error'] === UPLOAD_ERR_OK ? $_FILES['imagen' . $i]['name'] : null;
                if ($imagen) {
                    $target_dir = "../Assets/images/uploads/";
                    $target_file = $target_dir . basename($imagen);
                    move_uploaded_file($_FILES['imagen' . $i]['tmp_name'], $target_file);
                    $imagenes[] = $imagen;
                } else {
                    $imagenes[] = null;
                }
            }

            $productModel = new Product_Model();
            $productModel->updateProduct($id, $nombre, $descripcion, $precio, $stock, $categoria, $subcategoria, $imagenes);
            header('Location: Product_Controller.php?action=listProducts');
        }
    }
    public function deleteProduct() {
        if (isset($_POST['id'])) {
            $productId = Utils::limpiar_datos($_POST['id']);
            $productModel = new Product_Model();
            
            // Verificar si el producto está asociado a un pedido
            if ($productModel->isProductInOrder($productId)) {
                echo "<script>alert('Este producto está asociado a un pedido y no puede ser eliminado.'); window.location.href='Product_Controller.php?action=listProducts';</script>";
            } else {
                $productModel->deleteProduct($productId);
                echo "<script>alert('Producto eliminado correctamente.'); window.location.href='Product_Controller.php?action=listProducts';</script>";
            }
            exit();
        }
    }
    
    public function getSubcategories() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoryId'])) {
            $categoryId = Utils::limpiar_datos($_POST['categoryId']);
            $categoryModel = new Category_Model();
            $subcategories = $categoryModel->getSubcategoriesByCategoryId($categoryId);
            echo json_encode($subcategories);
        }
    }
    public function listLastFiveProducts() {
        $productModel = new Product_Model();
        $productos = $productModel->getLastFiveProducts();
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $productController = new ProductController();

    switch ($action) {
        case 'listProducts':
            $page = isset($_GET['page']) ? (int)Utils::limpiar_datos($_GET['page']) : 1;
            $productController->listProducts($page);
            break;
        case 'editProduct':
            $productController->editProduct();
            break;
        case 'updateProduct':
            $productController->updateProduct();
            break;
        case 'deleteProduct':
            $productController->deleteProduct();
            break;
        case 'registerProduct':
            $productController->registerProduct();
            break;
        case 'getSubcategories':
            $productController->getSubcategories();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
