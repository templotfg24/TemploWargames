<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = Utils::limpiar_datos($_POST['email']);
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
                echo 'Todos los campos son obligatorios';
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
            if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                $nombre = Utils::limpiar_datos($_POST['nombre']);
                $apellido = Utils::limpiar_datos($_POST['apellido']);
                $direccion = Utils::limpiar_datos($_POST['direccion']);
                $telefono = Utils::limpiar_datos($_POST['telefono']);
                $email = Utils::limpiar_datos($_POST['email']);
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Correo electrónico no válido';
                    return;
                }

                if ($password !== $confirmPassword) {
                    echo 'Las contraseñas no coinciden';
                    return;
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
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

                $userModel->createUser($nombre, $apellido, $direccion, $telefono, $email, $hashedPassword, $codigo_activacion, $imagen_perfil);
                
                if (Utils::enviarCorreoActivacion($email, $codigo_activacion)) {
                    echo 'Registro exitoso. Por favor, revisa tu correo electrónico para activar tu cuenta.';
                } else {
                    echo 'Error al enviar el correo de activación.';
                }
            } else {
                echo 'Todos los campos son obligatorios';
            }
        } else {
            require_once '../views/login/register_views.php';
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'])) {
                $email = Utils::limpiar_datos($_POST['email']);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Correo electrónico no válido';
                    return;
                }

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
                echo 'El campo de correo electrónico es obligatorio';
            }
        } else {
            require_once '../views/login/forgot_password_view.php';
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['token']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $token = Utils::limpiar_datos($_POST['token']);
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                if ($newPassword !== $confirmPassword) {
                    echo 'Las nuevas contraseñas no coinciden.';
                    return;
                }

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
                echo 'Todos los campos son obligatorios';
            }
        } else {
            $token = isset($_GET['token']) ? Utils::limpiar_datos($_GET['token']) : '';
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
