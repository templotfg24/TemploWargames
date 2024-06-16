<?php

namespace models;

require_once '../models/utils.php';

use PDO;
use PDOException;

class User_Model
{
    private $db;

    public function __construct()
    {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Crear un nuevo usuario
    public function createUser($nombre, $apellido, $direccion, $telefono, $email, $password, $codigo_activacion, $imagen_perfil = null)
    {
        $rol = 'cliente'; // Rol por defecto
        $estado = 'activo'; // Estado por defecto
        try {
            $query = "INSERT INTO usuarios (Nombre, Apellido, Direccion, Telefono, Email, Password, CodigoActivacion, Activado, Rol, Estado, imagen_perfil, fecha_registro) 
                      VALUES (:nombre, :apellido, :direccion, :telefono, :email, :password, :codigo_activacion, 0, :rol, :estado, :imagen_perfil, CURRENT_TIMESTAMP)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':codigo_activacion', $codigo_activacion);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':imagen_perfil', $imagen_perfil);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener un usuario por su email
    public function getUserByEmail($email)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Activar un usuario
    public function activateUser($email)
    {
        try {
            $query = "UPDATE usuarios SET Activado = 1, CodigoActivacion = NULL WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Actualizar un usuario
    public function updateUser($userId, $nombre, $apellido, $direccion, $telefono, $email, $rol, $estado, $imagen_perfil = null)
    {
        try {
            if ($imagen_perfil) {
                $query = "UPDATE usuarios SET Nombre = :nombre, Apellido = :apellido, Direccion = :direccion, Telefono = :telefono, Email = :email, Rol = :rol, Estado = :estado, imagen_perfil = :imagen_perfil WHERE ID_Usuario = :id";
            } else {
                $query = "UPDATE usuarios SET Nombre = :nombre, Apellido = :apellido, Direccion = :direccion, Telefono = :telefono, Email = :email, Rol = :rol, Estado = :estado WHERE ID_Usuario = :id";
            }

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':estado', $estado);

            if ($imagen_perfil) {
                $stmt->bindParam(':imagen_perfil', $imagen_perfil);
            }

            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar un usuario
    public function deleteUser($userId)
    {
        try {
            $query = "DELETE FROM usuarios WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener todos los usuarios
    public function getAllUsers()
    {
        try {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener un usuario por su ID
    public function getUserById($userId)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Banear un usuario
    public function banUser($userId)
    {
        try {
            $query = "UPDATE usuarios SET Estado = 'baneado' WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Desbanear un usuario
    public function unbanUser($userId)
    {
        try {
            $query = "UPDATE usuarios SET Estado = 'activo' WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener un usuario por email y código de activación
    public function getUserByEmailAndCode($email, $codigoActivacion)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE Email = :email AND CodigoActivacion = :codigo AND Activado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':codigo', $codigoActivacion);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Obtener el total de usuarios
    public function getUserCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM usuarios";
            $stmt = $this->db->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    // Obtener usuarios por página
    public function getUsersByPage($page, $items_per_page)
    {
        $offset = ($page - 1) * $items_per_page;
        try {
            $query = "SELECT * FROM usuarios LIMIT :offset, :items_per_page";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener el total de clientes
    public function getClientCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM usuarios WHERE Rol = 'cliente'";
            $stmt = $this->db->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    // Verificar si un email ya existe en la base de datos
    public function emailExists($email)
    {
        try {
            $query = "SELECT COUNT(*) FROM usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Buscar usuarios por email
    public function searchUsuariosByEmail($term)
    {
        try {
            $query = "SELECT ID_Usuario, Email FROM usuarios WHERE Email LIKE :term";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':term', '%' . $term . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Establecer un token de restablecimiento de contraseña para un usuario
    public function setPasswordResetToken($userId, $resetToken)
    {
        try {
            $query = "UPDATE usuarios SET reset_token = :resetToken, reset_token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':resetToken', $resetToken);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener un usuario por su token de restablecimiento de contraseña
    public function getUserByResetToken($resetToken)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE reset_token = :resetToken AND reset_token_expiration > NOW()";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':resetToken', $resetToken);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Actualizar la contraseña de un usuario
    public function updatePassword($userId, $newPassword)
    {
        try {
            $query = "UPDATE usuarios SET Password = :password WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':password', $newPassword);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Limpiar el token de restablecimiento de contraseña de un usuario
    public function clearPasswordResetToken($userId)
    {
        try {
            $query = "UPDATE usuarios SET reset_token = NULL, reset_token_expiration = NULL WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar el perfil de un usuario
    public function updateUserProfile($userId, $nombre, $email, $telefono, $imagen_perfil = null)
    {
        try {
            if ($imagen_perfil) {
                $query = "UPDATE usuarios SET Nombre = :nombre, Email = :email, Telefono = :telefono, imagen_perfil = :imagen_perfil WHERE ID_Usuario = :id";
            } else {
                $query = "UPDATE usuarios SET Nombre = :nombre, Email = :email, Telefono = :telefono WHERE ID_Usuario = :id";
            }

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);

            if ($imagen_perfil) {
                $stmt->bindParam(':imagen_perfil', $imagen_perfil);
            }

            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar la dirección de un usuario
    public function updateUserAddress($userId, $direccion)
    {
        try {
            $query = "UPDATE usuarios SET Direccion = :direccion WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //Comprobar si tiene pedidos asociados de un usuario
    public function userHasOrders($userId) {
        try {
            $query = "SELECT COUNT(*) FROM pedidos WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}

