<?php

require_once '../models/Tournament_Model.php';
require_once '../models/Inscripcion_Model.php';
require_once '../models/User_Model.php';

use models\Inscripcion_Model;
use models\Tournament_Model;
use models\User_Model;

class Tournament_Controller
{
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function listTournament()
    {
        $role = $_SESSION['rol'];
        $Tournament = new Tournament_Model();
        $tournaments = $Tournament->getAllTournaments();
        require_once '../views/tournament/tournament_list_views.php';
    }

    public function editTournament()
    {
        $role = $_SESSION['rol'];
        $Tournament = new Tournament_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $data = [
                'nombre' => $_POST['nombre'],
                'fecha' => $_POST['fecha'],
                'descripcion' => $_POST['descripcion'],
            ];
    
            if (!empty($_FILES['imagen']['name'])) {
                $data['imagen'] = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../Assets/images/uploads/' . $_FILES['imagen']['name']);
            }
    
            $Tournament->updateTournament($id, $data);
            header('Location: Tournament_Controller.php?action=listTournament');
        } else {
            $id = $_GET['id'];
            $tournaments = $Tournament->getTournamentById($id);
            require_once '../views/tournament/tournament_form_view.php';
        }
    }
    
    public function createTournament()
    {
        $role = $_SESSION['rol'];
        $Tournament = new Tournament_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'fecha' => $_POST['fecha'],
                'descripcion' => $_POST['descripcion'],
                'imagen' => $_FILES['imagen']['name']
            ];
            move_uploaded_file($_FILES['imagen']['tmp_name'], '../Assets/images/uploads/' . $_FILES['imagen']['name']);
            $Tournament->createTournament($data);
            header('Location: Tournament_Controller.php?action=listTournament');
        } else {
            require_once '../views/tournament/tournament_form_view.php';
        }
    }
    
    

    public function deleteTournament()
    {
        $Tournament = new Tournament_Model();
        $id = $_POST['id'];
        $Tournament->deleteTournament($id);
        header('Location: Tournament_Controller.php?action=listTournament');
    }

    public function listInscripciones()
    {
        $role = $_SESSION['rol'];
        $inscripcionModel = new Inscripcion_Model();
        $torneo_id = $_GET['torneo_id'];
        $inscripciones = $inscripcionModel->getInscripcionesByTorneoId($torneo_id);
        require_once '../views/tournament/inscripciones_list_view.php';
    }

    public function createInscripcion()
    {
        $role = $_SESSION['rol'];
        $inscripcionModel = new Inscripcion_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = htmlspecialchars($_POST['usuario_id']);
            $torneo_id = htmlspecialchars($_POST['torneo_id']);

            // Verificar si el usuario ya está inscrito en el torneo
            if ($inscripcionModel->isUserInscrito($usuario_id, $torneo_id)) {
                echo "<script>alert('El usuario ya está inscrito en este torneo.'); window.location.href='Tournament_Controller.php?action=listInscripciones&torneo_id={$torneo_id}';</script>";
                exit();
            }

            $data = [
                'usuario_id' => $usuario_id,
                'torneo_id' => $torneo_id,
                'fecha_inscripcion' => date('Y-m-d H:i:s'),
                'telefono' => htmlspecialchars($_POST['telefono']),
                'id_aplicacion' => htmlspecialchars($_POST['id_aplicacion'])
            ];
            $inscripcionModel->createInscripcion($data);
            header('Location: Tournament_Controller.php?action=listInscripciones&torneo_id=' . $_POST['torneo_id']);
        } else {
            $usuarioModel = new User_Model();
            $usuarios = $usuarioModel->getAllUsers();
            $torneo_id = htmlspecialchars($_GET['torneo_id']);
            require_once '../views/tournament/inscripcion_form_view.php';
        }
    }

    public function deleteInscripcion()
    {
        $inscripcionModel = new Inscripcion_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $inscripcionModel->deleteInscripcion($id);
            header('Location: Tournament_Controller.php?action=listInscripciones&torneo_id=' . $_POST['torneo_id']);
        } else {
            echo "Invalid request method.";
        }
    }
    

    public function searchUsuarios()
    {
        $term = htmlspecialchars($_GET['term']);
        $userModel = new User_Model();
        $usuarios = $userModel->searchUsuariosByEmail($term);
        echo json_encode($usuarios);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $TournamentController = new Tournament_Controller();

    switch ($action) {
        case 'listTournament':
            $TournamentController->listTournament();
            break;
        case 'createTournament':
            $TournamentController->createTournament();
            break;
        case 'editTournament':
            $TournamentController->editTournament();
            break;
        case 'deleteTournament':
            $TournamentController->deleteTournament();
            break;
        case 'listInscripciones':
            $TournamentController->listInscripciones();
            break;
        case 'createInscripcion':
            $TournamentController->createInscripcion();
            break;
        case 'deleteInscripcion':
            $TournamentController->deleteInscripcion();
            break;
        case 'searchUsuarios':
            $TournamentController->searchUsuarios();
            break;
        default:
            $TournamentController->listTournament();
            break;
    }
} else {
    $TournamentController->listTournament();
}
