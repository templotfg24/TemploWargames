<?php

namespace models;

require_once '../models/utils.php';

use PDO;
use PDOException;

class Inscripcion_Model
{
    private $db;

    public function __construct()
    {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener todas las inscripciones de un torneo específico por su ID
    public function getInscripcionesByTorneoId($torneoId)
    {
        try {
            $query = "SELECT i.*, u.Nombre as nombre, u.Email as email 
                      FROM inscripciones_torneo i
                      JOIN usuarios u ON i.usuario_id = u.ID_Usuario
                      WHERE i.torneo_id = :torneo_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':torneo_id', $torneoId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Crear una nueva inscripción en un torneo
    public function createInscripcion($data)
    {
        $query = "INSERT INTO inscripciones_torneo (usuario_id, torneo_id, fecha_inscripcion, telefono, id_aplicacion) 
                  VALUES (:usuario_id, :torneo_id, :fecha_inscripcion, :telefono, :id_aplicacion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $data['usuario_id']);
        $stmt->bindParam(':torneo_id', $data['torneo_id']);
        $stmt->bindParam(':fecha_inscripcion', $data['fecha_inscripcion']);
        $stmt->bindParam(':telefono', $data['telefono']);
        $stmt->bindParam(':id_aplicacion', $data['id_aplicacion']);
        $stmt->execute();
    }

    // Eliminar una inscripción por su ID
    public function deleteInscripcion($id)
    {
        $query = "DELETE FROM inscripciones_torneo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Verificar si un usuario ya está inscrito en un torneo específico
    public function isUserInscrito($usuario_id, $torneo_id)
    {
        $query = "SELECT COUNT(*) FROM inscripciones_torneo WHERE usuario_id = :usuario_id AND torneo_id = :torneo_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':torneo_id', $torneo_id);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Obtener todas las inscripciones de un usuario específico por su ID
    public function getUserInscriptions($userId)
    {
        try {
            $query = "SELECT i.*, t.nombre as torneo_nombre 
                      FROM inscripciones_torneo i
                      JOIN torneos t ON i.torneo_id = t.id
                      WHERE i.usuario_id = :userId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}

