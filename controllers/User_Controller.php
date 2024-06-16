<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class UserController {
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

    public function register_Admin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = Utils::limpiar_datos($_POST['nombre']);
            $apellido = Utils::limpiar_datos($_POST['apellido']);
            $direccion = Utils::limpiar_datos($_POST['direccion']);
            $telefono = Utils::limpiar_datos($_POST['telefono']);
            $email = Utils::limpiar_datos($_POST['email']);

            $userModel = new User_Model();

            // Comprobar si el correo electrónico ya está registrado
            if ($userModel->emailExists($email)) {
                echo 'Error: El correo electrónico ya está registrado.';
                return;
            }

            // Generar contraseña aleatoria
            $password = Utils::generateRandomPassword();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $codigo_activacion = Utils::generar_codigo_activacion();
            $imagen_perfil = isset($_FILES['imagen_perfil']) ? $_FILES['imagen_perfil']['name'] : null;

            if ($imagen_perfil) {
                $target_dir = __DIR__ . "/../Assets/images/uploads/";
                $target_file = $target_dir . basename($imagen_perfil);
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $target_file);
            }

            $userModel->createUser($nombre, $apellido, $direccion, $telefono, $email, $hashedPassword, $codigo_activacion, $imagen_perfil);

            if (Utils::enviarCorreoActivacionAdmin($email, $codigo_activacion, $password)) {
                //echo 'Registro exitoso. Por favor, revisa tu correo electrónico para activar tu cuenta.';
                header('Location: User_Controller.php?action=listUsers');
            } else {
                echo 'Error al enviar el correo de activación.';
            }
        } else {
            require_once '../views/login/register_views.php';
        }
    }
    
    public function listUsers() {
        $role = $_SESSION['rol'];
        $page = isset($_GET['page']) ? (int)Utils::limpiar_datos($_GET['page']) : 1;
        $items_per_page = 10; // Puedes cambiar este valor según tus necesidades
    
        $userModel = new User_Model();
        $usuarios = $userModel->getUsersByPage($page, $items_per_page);
        $total_users = $userModel->getUserCount();
        $total_pages = ceil($total_users / $items_per_page);
    
        require_once '../views/user/user_list_views.php';
    }

    public function editUser() {
        if (isset($_GET['id'])) {
            $role = $_SESSION['rol'];
            $userModel = new User_Model();
            $usuario = $userModel->getUserById(Utils::limpiar_datos($_GET['id']));
            require_once '../views/user/edit_user_views.php';
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = Utils::limpiar_datos($_POST['id']);
            $nombre = Utils::limpiar_datos($_POST['nombre']);
            $apellido = Utils::limpiar_datos($_POST['apellido']);
            $direccion = Utils::limpiar_datos($_POST['direccion']);
            $telefono = Utils::limpiar_datos($_POST['telefono']);
            $email = Utils::limpiar_datos($_POST['email']);
            $rol = Utils::limpiar_datos($_POST['rol']);
            $estado = Utils::limpiar_datos($_POST['estado']);
            $imagen_perfil = isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK ? $_FILES['imagen_perfil']['name'] : null;
    
            // Subir imagen de perfil si existe
            if ($imagen_perfil) {
                $target_dir = "../Assets/images/uploads/";
                $target_file = $target_dir . basename($imagen_perfil);
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $target_file);
            }
    
            $userModel = new User_Model();
            $userModel->updateUser($id, $nombre, $apellido, $direccion, $telefono, $email, $rol, $estado, $imagen_perfil);
    
            header('Location: User_Controller.php?action=listUsers');
        }
    }
    
    public function deleteUser() {
        if (isset($_POST['id'])) {
            $userId = Utils::limpiar_datos($_POST['id']);
            $userModel = new User_Model();
    
            // Comprobar si el usuario tiene pedidos
            if ($userModel->userHasOrders($userId)) {
                echo 'El usuario no se puede eliminar porque tiene pedidos asociados.';
                return;
            }
    
            $userModel->deleteUser($userId);
            echo 'Usuario eliminado correctamente.';
        }
    }
    
    public function banUser() {
        if (isset($_POST['id'])) {
            $userId = Utils::limpiar_datos($_POST['id']);
            $action = Utils::limpiar_datos($_POST['action']);

            $userModel = new User_Model();

            if ($action == 'ban') {
                $userModel->banUser($userId);
            } else {
                $userModel->unbanUser($userId);
            }

            header('Location: User_Controller.php?action=listUsers');
        }
    }

    public function activate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['codigoActivacion'])) {
            $email = Utils::limpiar_datos($_POST['email']);
            $codigo = Utils::limpiar_datos($_POST['codigoActivacion']);

            $userModel = new User_Model();
            $user = $userModel->getUserByEmailAndCode($email, $codigo);

            if ($user) {
                $userModel->activateUser($email);
                echo 'Cuenta activada con éxito. Ahora puedes iniciar sesión.';
            } else {
                echo 'Código de activación incorrecto o cuenta ya activada.';
            }
        } else {
            echo 'Datos de activación no válidos.';
        }
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
    $userController = new UserController();

    switch ($action) {
        case 'listUsers':
            $page = isset($_GET['page']) ? (int)Utils::limpiar_datos($_GET['page']) : 1;
            $userController->listUsers($page);
            break;
        case 'editUser':
            $userController->editUser();
            break;
        case 'updateUser':
            $userController->updateUser();
            break;
        case 'deleteUser':
            $userController->deleteUser();
            break;
        case 'banUser':
            $userController->banUser();
            break;
        case 'activate':
            $userController->activate();
            break;
        case 'register':
            $userController->register_Admin();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}
