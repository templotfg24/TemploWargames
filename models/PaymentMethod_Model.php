<?php

namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class PaymentMethod_Model
{
    private $db;

    public function __construct()
    {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener todos los métodos de pago disponibles
    public function getAllPaymentMethods()
    {
        try {
            $query = "SELECT * FROM formas_pago";
            $stmt = $this->db->query($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
