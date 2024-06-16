<?php

namespace models;

require_once '../models/utils.php';

use PDO;
use PDOException;

class Order_Model
{
    private $db;

    public function __construct()
    {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Listar todos los pedidos filtrados por fecha
    public function getOrders($start, $limit)
    {
        $query = "SELECT 
                    p.ID_Pedido, 
                    p.Direccion, 
                    p.Pais, 
                    p.Region, 
                    p.Ciudad, 
                    p.Codigo_Postal, 
                    p.Notas, 
                    p.Fecha, 
                    p.Total, 
                    p.Estado, 
                    u.Nombre as Nombre_Usuario, 
                    u.Email, 
                    fp.Descripcion as Forma_Pago
                  FROM 
                    pedidos p
                  JOIN 
                    usuarios u ON p.ID_Usuario = u.ID_Usuario
                  JOIN 
                    formas_pago fp ON p.ID_FormaPago = fp.ID_FormaPago
                  ORDER BY 
                    p.Fecha DESC
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $start, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el total de todos los pedidos
    public function getTotalOrders()
    {
        $query = "SELECT COUNT(*) as total FROM pedidos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Contar el número total de pedidos
    public function getOrderCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM pedidos";
            $stmt = $this->db->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    // Listar los pedidos más recientes
    public function getLatestOrders()
    {
        try {
            $query = "SELECT * FROM pedidos ORDER BY fecha DESC LIMIT 5";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Insertar un nuevo pedido en la base de datos
    public function insertOrder($userId, $total, $paymentMethod, $status, $direccion, $pais, $region, $ciudad, $codigoPostal, $notas)
    {
        try {
            $query = "
                INSERT INTO pedidos (ID_Usuario, Total, ID_FormaPago, Estado, Direccion, Pais, Region, Ciudad, Codigo_Postal, Notas, Fecha)
                VALUES (:user_id, :total, :payment_method, :status, :address, :country, :region, :city, :postal_code, :notes, NOW())
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':payment_method', $paymentMethod);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':address', $direccion);
            $stmt->bindParam(':country', $pais);
            $stmt->bindParam(':region', $region);
            $stmt->bindParam(':city', $ciudad);
            $stmt->bindParam(':postal_code', $codigoPostal);
            $stmt->bindParam(':notes', $notas);
            $stmt->execute();
            return $this->db->lastInsertId(); // Retorna la ID del pedido recién insertado
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Crear un nuevo pedido con datos proporcionados
    public function createOrder($orderData)
    {
        $query = "INSERT INTO pedidos (ID_Usuario, Fecha, Total, Estado, ID_FormaPago, Direccion, Pais, Region, Ciudad, Codigo_Postal, Notas) 
                  VALUES (:ID_Usuario, :Fecha, :Total, :Estado, :ID_FormaPago, :Direccion, :Pais, :Region, :Ciudad, :Codigo_Postal, :Notas)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':ID_Usuario', $orderData['ID_Usuario']);
        $stmt->bindParam(':Fecha', $orderData['Fecha']);
        $stmt->bindParam(':Total', $orderData['Total']);
        $stmt->bindParam(':Estado', $orderData['Estado']);
        $stmt->bindParam(':ID_FormaPago', $orderData['ID_FormaPago']);
        $stmt->bindParam(':Direccion', $orderData['Direccion']);
        $stmt->bindParam(':Pais', $orderData['Pais']);
        $stmt->bindParam(':Region', $orderData['Region']);
        $stmt->bindParam(':Ciudad', $orderData['Ciudad']);
        $stmt->bindParam(':Codigo_Postal', $orderData['Codigo_Postal']);
        $stmt->bindParam(':Notas', $orderData['Notas']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    // Obtener un pedido por su ID
    public function getOrderById($orderId)
    {
        try {
            $query = "SELECT 
                        p.ID_Pedido, 
                        p.Direccion, 
                        p.Pais, 
                        p.Region, 
                        p.Ciudad, 
                        p.Codigo_Postal, 
                        p.Notas, 
                        p.Fecha, 
                        p.Total, 
                        p.Estado, 
                        p.ID_Usuario, 
                        u.Nombre as Nombre_Usuario, 
                        u.Email, 
                        p.ID_FormaPago, 
                        fp.Descripcion as Forma_Pago 
                      FROM 
                        pedidos p
                      JOIN 
                        usuarios u ON p.ID_Usuario = u.ID_Usuario
                      JOIN 
                        formas_pago fp ON p.ID_FormaPago = fp.ID_FormaPago
                      WHERE 
                        p.ID_Pedido = :orderId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Actualizar los datos de un pedido existente
    public function updateOrder($orderId, $orderData)
    {
        try {
            $query = "UPDATE pedidos SET 
                        Direccion = :Direccion, 
                        Pais = :Pais, 
                        Region = :Region, 
                        Ciudad = :Ciudad, 
                        Codigo_Postal = :Codigo_Postal, 
                        Notas = :Notas, 
                        Total = :Total, 
                        Estado = :Estado 
                      WHERE 
                        ID_Pedido = :ID_Pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':Direccion', $orderData['Direccion']);
            $stmt->bindParam(':Pais', $orderData['Pais']);
            $stmt->bindParam(':Region', $orderData['Region']);
            $stmt->bindParam(':Ciudad', $orderData['Ciudad']);
            $stmt->bindParam(':Codigo_Postal', $orderData['Codigo_Postal']);
            $stmt->bindParam(':Notas', $orderData['Notas']);
            $stmt->bindParam(':Total', $orderData['Total']);
            $stmt->bindParam(':Estado', $orderData['Estado']);
            $stmt->bindParam(':ID_Pedido', $orderId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar un pedido por su ID
    public function deleteOrder($orderId)
    {
        try {
            $query = "DELETE FROM pedidos WHERE ID_Pedido = :orderId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Listar todos los pedidos
    public function getAllOrders()
    {
        try {
            $query = "SELECT * FROM pedidos";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener el historial de pedidos de un usuario
    public function getOrdersByUserId($userId)
    {
        try {
            $query = "SELECT 
                        p.ID_Pedido, 
                        p.Direccion, 
                        p.Pais, 
                        p.Region, 
                        p.Ciudad, 
                        p.Codigo_Postal, 
                        p.Notas, 
                        p.Fecha, 
                        p.Total, 
                        p.Estado, 
                        u.Nombre as Nombre_Usuario, 
                        u.Email, 
                        fp.Descripcion as Forma_Pago 
                      FROM 
                        pedidos p
                      JOIN 
                        usuarios u ON p.ID_Usuario = u.ID_Usuario
                      JOIN 
                        formas_pago fp ON p.ID_FormaPago = fp.ID_FormaPago
                      WHERE 
                        p.ID_Usuario = :userId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener datos de ventas por mes para Highcharts
    public function getSalesByMonth()
    {
        try {
            $query = "SELECT MONTH(Fecha) as mes, SUM(Total) as total FROM pedidos GROUP BY MONTH(Fecha)";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener tipos de pago y su cantidad para Highcharts
    public function getPaymentTypes()
    {
        try {
            $query = "SELECT fp.Descripcion as forma_pago, COUNT(*) as cantidad 
                      FROM pedidos p
                      JOIN formas_pago fp ON p.ID_FormaPago = fp.ID_FormaPago
                      GROUP BY fp.Descripcion";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
