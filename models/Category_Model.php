<?php
namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class Category_Model {
    private $db;

    public function __construct() {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener todas las categorías
    public function getAllCategories() {
        try {
            $query = "SELECT * FROM categorias";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener una categoría por su ID
    public function getCategoryById($categoryId) {
        try {
            $query = "SELECT * FROM categorias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Crear una nueva categoría
    public function createCategory($name) {
        try {
            $query = "INSERT INTO categorias (name) VALUES (:name)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar una categoría existente por su ID
    public function updateCategory($categoryId, $name) {
        try {
            $query = "UPDATE categorias SET name = :name WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar una categoría por su ID
    public function deleteCategory($categoryId) {
        try {
            $query = "DELETE FROM categorias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener todas las subcategorías de una categoría específica por su ID
    public function getSubcategoriesByCategoryId($categoryId) {
        try {
            $query = "SELECT * FROM subcategorias WHERE category_id = :categoryId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}


