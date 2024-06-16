<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User_Model();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['Password'])) {
                if ($user['Activado']) {
                    if ($user['Estado'] == 'baneado') {
                        echo 'Tu cuenta está baneada. Contacta con el administrador para más información.';
                        return;
                    }

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Almacenar todos los datos del usuario necesarios en la sesión
                    $_SESSION['user_id'] = $user['ID_Usuario'];
                    $_SESSION['user_name'] = $user['Nombre'];
                    $_SESSION['email'] = $user['Email'];
                    $_SESSION['rol'] = $user['Rol'];
                    $_SESSION['imagen_perfil'] = $user['imagen_perfil'];

                    // Redirigir según el rol del usuario
                    switch ($user['Rol']) {
                        case 'admin':
                            header('Location: ../controllers/Dashboard_Controller.php?action=index');
                            break;
                        case 'empleado':
                            header('Location: ../controllers/User_Controller.php?action=listUsers');
                            break;
                        case 'cliente':
                            header('Location: ../public/index.php');
                            break;
                        default:
                            header('Location: ../public/index.php');
                            break;
                    }
                } else {
                    echo 'Tu cuenta aún no ha sido activada.';
                }
            } else {
                echo 'Correo electrónico o contraseña incorrectos';
            }
        } else {
            require_once '../views/login/login_views.php';
        }
    }

    public function showRegister() {
        require_once '../views/login/register_views.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $codigo_activacion = Utils::generar_codigo_activacion();
            $imagen_perfil = isset($_FILES['imagen_perfil']) ? $_FILES['imagen_perfil']['name'] : null;

            // Subir imagen de perfil si existe
            if ($imagen_perfil) {
                $target_dir = "../Assets/images/uploads/";
                $target_file = $target_dir . basename($imagen_perfil);
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $target_file);
            }

            $userModel = new User_Model();

            // Verificar si el correo electrónico ya existe
            if ($userModel->emailExists($email)) {
                echo 'Error: El correo electrónico ya está registrado.';
                return;
            }

            $userModel->createUser($nombre, $apellido, $direccion, $telefono, $email, $password, $codigo_activacion, $imagen_perfil);
            
            if (Utils::enviarCorreoActivacion($email, $codigo_activacion)) {
                echo 'Registro exitoso. Por favor, revisa tu correo electrónico para activar tu cuenta.';
            } else {
                echo 'Error al enviar el correo de activación.';
            }
        } else {
            require_once '../views/login/register_views.php';
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            $userModel = new User_Model();
            $user = $userModel->getUserByEmail($email);

            if ($user) {
                $resetToken = Utils::generar_codigo_activacion(); // Reutilizando función para generar un token
                $userModel->setPasswordResetToken($user['ID_Usuario'], $resetToken);
                
                if (Utils::enviarCorreoRecuperacion($email, $resetToken)) {
                    echo 'Correo de recuperación enviado. Por favor, revisa tu correo electrónico.';
                } else {
                    echo 'Error al enviar el correo de recuperación.';
                }
            } else {
                echo 'Correo electrónico no encontrado.';
            }
        } else {
            require_once '../views/login/forgot_password_view.php';
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword === $confirmPassword) {
                $userModel = new User_Model();
                $user = $userModel->getUserByResetToken($token);

                if ($user) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $userModel->updatePassword($user['ID_Usuario'], $hashedPassword);
                    $userModel->clearPasswordResetToken($user['ID_Usuario']);
                    require_once '../views/login/login_views.php';
                } else {
                    echo 'Token de recuperación inválido o expirado.';
                }
            } else {
                echo 'Las nuevas contraseñas no coinciden.';
            }
        } else {
            $token = $_GET['token'];
            require_once '../views/login/reset_password_view.php';
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: ../public/index.php');
        exit();
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $authController = new AuthController();

    switch ($action) {
        case 'login':
            $authController->login();
            break;
        case 'register':
            $authController->register();
            break;
        case 'showRegister':
            $authController->showRegister();
            break;
        case 'forgotPassword':
            $authController->forgotPassword();
            break;
        case 'resetPassword':
            $authController->resetPassword();
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    //echo 'No se especificó ninguna acción';
}

