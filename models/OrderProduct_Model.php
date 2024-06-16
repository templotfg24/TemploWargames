<?php
namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class OrderProduct_Model {
    
    private $db;

    public function __construct() {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Crear una nueva entrada en la tabla pedidos_productos
    public function createOrderProduct($data)
    {
        try {
            $sql = "INSERT INTO pedidos_productos (ID_Pedido, ID_Producto, Cantidad) VALUES (:ID_Pedido, :ID_Producto, :Cantidad)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ID_Pedido', $data['ID_Pedido'], PDO::PARAM_INT);
            $stmt->bindParam(':ID_Producto', $data['ID_Producto'], PDO::PARAM_INT);
            $stmt->bindParam(':Cantidad', $data['Cantidad'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Insertar un producto en un pedido específico
    public function insertOrderProduct($orderId, $productId, $quantity)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pedidos_productos (ID_Pedido, ID_Producto, Cantidad) VALUES (?, ?, ?)");
            $stmt->execute([$orderId, $productId, $quantity]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Obtener los productos asociados a un pedido específico por su ID
    public function getProductsByOrderId($orderId)
    {
        try {
            $query = "SELECT p.Nombre, p.Precio, pp.Cantidad 
                      FROM pedidos_productos pp
                      JOIN productos p ON pp.ID_Producto = p.ID_Producto
                      WHERE pp.ID_Pedido = :orderId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}


