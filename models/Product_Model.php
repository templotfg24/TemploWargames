<?php
namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class Product_Model {
    private $db;

    public function __construct() {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener la cantidad total de productos
    public function getProductCount() {
        try {
            $query = "SELECT COUNT(*) as count FROM productos";
            $stmt = $this->db->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    // Crear un nuevo producto
    public function createProduct($nombre, $descripcion, $precio, $stock, $categoria, $subcategoria, $imagenes = []) {
        try {
            $query = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock, category_id, subcategory_id, imagen1, imagen2, imagen3, imagen4, imagen5, imagen6) 
                      VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :subcategoria, :imagen1, :imagen2, :imagen3, :imagen4, :imagen5, :imagen6)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':subcategoria', $subcategoria);
            $stmt->bindParam(':imagen1', $imagenes[0]);
            $stmt->bindParam(':imagen2', $imagenes[1]);
            $stmt->bindParam(':imagen3', $imagenes[2]);
            $stmt->bindParam(':imagen4', $imagenes[3]);
            $stmt->bindParam(':imagen5', $imagenes[4]);
            $stmt->bindParam(':imagen6', $imagenes[5]);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener un producto por su ID
    public function getProductById($productId) {
        try {
            $query = "SELECT * FROM productos WHERE ID_Producto = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Reducir el stock de un producto
    public function reduceStock($productId, $quantity) {
        try {
            $query = "UPDATE productos SET Stock = Stock - :quantity WHERE ID_Producto = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener todos los productos
    public function getAllProducts() {
        try {
            $query = "SELECT p.*, c.name as category_name, s.name as subcategory_name 
                      FROM productos p 
                      JOIN categorias c ON p.category_id = c.id 
                      JOIN subcategorias s ON p.subcategory_id = s.id";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Actualizar un producto
    public function updateProduct($productId, $nombre, $descripcion, $precio, $stock, $categoria, $subcategoria, $imagenes = []) {
        try {
            // Comienza con la consulta base sin las imágenes
            $query = "UPDATE productos SET Nombre = :nombre, Descripcion = :descripcion, Precio = :precio, Stock = :stock, category_id = :categoria, subcategory_id = :subcategoria WHERE ID_Producto = :id";

            // Preparar los parámetros base
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':subcategoria', $subcategoria);
            $stmt->bindParam(':id', $productId);

            // Ejecutar la consulta base para actualizar los campos que no son imágenes
            $stmt->execute();

            // Verificar cada imagen y actualizar si está presente
            $imageFields = ['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5', 'imagen6'];
            foreach ($imageFields as $index => $field) {
                if (!empty($imagenes[$index])) {
                    $query = "UPDATE productos SET $field = :$field WHERE ID_Producto = :id";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":$field", $imagenes[$index]);
                    $stmt->bindParam(':id', $productId);
                    $stmt->execute();
                }
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar un producto por su ID
    public function deleteProduct($productId) {
        try {
            $query = "DELETE FROM productos WHERE ID_Producto = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener los últimos cinco productos
    public function getLastFiveProducts() {
        try {
            $query = "SELECT * FROM productos ORDER BY ID_Producto DESC LIMIT 6";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener productos por página
    public function getProductsByPage($page, $items_per_page) {
        $offset = ($page - 1) * $items_per_page;
        try {
            $query = "SELECT p.*, c.name as category_name, s.name as subcategory_name 
                      FROM productos p 
                      JOIN categorias c ON p.category_id = c.id 
                      JOIN subcategorias s ON p.subcategory_id = s.id LIMIT :offset, :items_per_page";
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

    // Obtener productos por página para la vista de la tienda
    public function getProductsByPageViewsStore($offset, $items_per_page) {
        try {
            $query = "SELECT * FROM productos LIMIT :offset, :items_per_page";
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
}


