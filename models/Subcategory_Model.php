<?php

namespace models;

require_once '../models/utils.php';

use PDO;
use PDOException;

class Subcategory_Model
{
    private $db;

    public function __construct()
    {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener todas las subcategorías
    public function getAllSubcategories()
    {
        try {
            $query = "SELECT * FROM subcategorias";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener una subcategoría por su ID
    public function getSubcategoryById($subcategoryId)
    {
        try {
            $query = "SELECT * FROM subcategorias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $subcategoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Crear una nueva subcategoría
    public function createSubcategory($categoryId, $name)
    {
        try {
            $query = "INSERT INTO subcategorias (category_id, name) VALUES (:categoryId, :name)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar una subcategoría
    public function updateSubcategory($subcategoryId, $categoryId, $name)
    {
        try {
            $query = "UPDATE subcategorias SET category_id = :categoryId, name = :name WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $subcategoryId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar una subcategoría por su ID
    public function deleteSubcategory($subcategoryId)
    {
        try {
            $query = "DELETE FROM subcategorias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $subcategoryId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener subcategorías por el ID de la categoría
    public function getSubcategoriesByCategoryId($categoryId)
    {
        try {
            $query = "SELECT * FROM subcategorias WHERE category_id = :category_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}

