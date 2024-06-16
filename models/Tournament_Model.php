<?php
namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class Tournament_Model
{
    private $db;

    public function __construct() {
        // Conectar a la base de datos utilizando el método conectar de la clase Utils
        $this->db = Utils::conectar();
    }

    // Obtener todos los torneos
    public function getAllTournaments()
    {
        try {
            $query = "SELECT * FROM torneos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Obtener un torneo por su ID
    public function getTournamentById($id)
    {
        try {
            $query = "SELECT * FROM torneos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Crear un nuevo torneo
    public function createTournament($data)
    {
        try {
            $query = "INSERT INTO torneos (nombre, fecha, descripcion, imagen) VALUES (:nombre, :fecha, :descripcion, :imagen)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':imagen', $data['imagen'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar un torneo
    public function updateTournament($id, $data)
    {
        try {
            $setClause = [];
            $params = [':id' => $id];
    
            if (isset($data['nombre'])) {
                $setClause[] = "nombre = :nombre";
                $params[':nombre'] = $data['nombre'];
            }
            if (isset($data['fecha'])) {
                $setClause[] = "fecha = :fecha";
                $params[':fecha'] = $data['fecha'];
            }
            if (isset($data['descripcion'])) {
                $setClause[] = "descripcion = :descripcion";
                $params[':descripcion'] = $data['descripcion'];
            }
            if (isset($data['imagen'])) {
                $setClause[] = "imagen = :imagen";
                $params[':imagen'] = $data['imagen'];
            }
    
            $query = "UPDATE torneos SET " . implode(', ', $setClause) . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar un torneo por su ID
    public function deleteTournament($id)
    {
        try {
            $query = "DELETE FROM torneos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
