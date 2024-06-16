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

class ContactController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function contact() {
        $categoryModel = new Category_Model();
        $subcategoryModel = new Subcategory_Model();
        $userModel = new User_Model();
        
        $categories = $categoryModel->getAllCategories();
        $subcategories = $subcategoryModel->getAllSubcategories();
        
        // Verificar si el usuario está logueado y obtener la información del usuario
        $usuario = null;
        if (isset($_SESSION['user_id'])) {
            $usuario = $userModel->getUserById($_SESSION['user_id']);
        }
        require_once "../views/contact_view.php";
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = Utils::limpiar_datos($_POST['subject']);
            $message = Utils::limpiar_datos($_POST['message']);
            
            if (isset($_SESSION['user_id'])) {
                $userModel = new User_Model();
                $usuario = $userModel->getUserById(Utils::limpiar_datos($_SESSION['user_id']));
                
                if ($usuario) {
                    $userName = $usuario['Nombre'];
                    $userEmail = $usuario['Email'];

                    if (Utils::enviarCorreoContacto($userName, $userEmail, $subject, $message)) {
                        echo '<script>alert("Mensaje enviado exitosamente."); window.location.href="../controllers/Contact_Controller.php?action=contact";</script>';
                    } else {
                        echo '<script>alert("Error al enviar el mensaje. Por favor, inténtelo de nuevo."); window.location.href="../controllers/Contact_Controller.php?action=contact";</script>';
                    }
                } else {
                    echo '<script>alert("Error al obtener la información del usuario."); window.location.href="../controllers/Contact_Controller.php?action=contact";</script>';
                }
            } else {
                echo '<script>alert("Usuario no autenticado."); window.location.href="../controllers/Contact_Controller.php?action=contact";</script>';
            }
        }
    }
}

if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $contactController = new ContactController();

    switch ($action) {
        case 'contact':
            $contactController->contact();
            break;
        case 'send':
            $contactController->send();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    echo 'No se especificó ninguna acción';
}


