<?php

require_once '../models/Tournament_Model.php';
require_once '../models/Inscripcion_Model.php';
require_once '../models/User_Model.php';
require_once '../models/Utils.php';

use models\Inscripcion_Model;
use models\Tournament_Model;
use models\User_Model;
use models\Utils;

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
            $id = Utils::limpiar_datos($_POST['id']);
            $data = [
                'nombre' => Utils::limpiar_datos($_POST['nombre']),
                'fecha' => Utils::limpiar_datos($_POST['fecha']),
                'descripcion' => Utils::limpiar_datos($_POST['descripcion']),
            ];

            if (!empty($_FILES['imagen']['name'])) {
                $data['imagen'] = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../Assets/images/uploads/' . $_FILES['imagen']['name']);
            }

            $Tournament->updateTournament($id, $data);
            header('Location: Tournament_Controller.php?action=listTournament');
        } else {
            $id = Utils::limpiar_datos($_GET['id']);
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
                'nombre' => Utils::limpiar_datos($_POST['nombre']),
                'fecha' => Utils::limpiar_datos($_POST['fecha']),
                'descripcion' => Utils::limpiar_datos($_POST['descripcion']),
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
        $id = Utils::limpiar_datos($_POST['id']);
        $Tournament->deleteTournament($id);
        header('Location: Tournament_Controller.php?action=listTournament');
    }

    public function listInscripciones()
    {
        $role = $_SESSION['rol'];
        $inscripcionModel = new Inscripcion_Model();
        $torneo_id = Utils::limpiar_datos($_GET['torneo_id']);
        $inscripciones = $inscripcionModel->getInscripcionesByTorneoId($torneo_id);
        require_once '../views/tournament/inscripciones_list_view.php';
    }

    public function createInscripcion()
    {
        $role = $_SESSION['rol'];
        $inscripcionModel = new Inscripcion_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = Utils::limpiar_datos($_POST['usuario_id']);
            $torneo_id = Utils::limpiar_datos($_POST['torneo_id']);

            // Verificar si el usuario ya está inscrito en el torneo
            if ($inscripcionModel->isUserInscrito($usuario_id, $torneo_id)) {
                echo "<script>alert('El usuario ya está inscrito en este torneo.'); window.location.href='Tournament_Controller.php?action=listInscripciones&torneo_id={$torneo_id}';</script>";
                exit();
            }

            $data = [
                'usuario_id' => $usuario_id,
                'torneo_id' => $torneo_id,
                'fecha_inscripcion' => date('Y-m-d H:i:s'),
                'telefono' => Utils::limpiar_datos($_POST['telefono']),
                'id_aplicacion' => Utils::limpiar_datos($_POST['id_aplicacion'])
            ];
            $inscripcionModel->createInscripcion($data);
            header('Location: Tournament_Controller.php?action=listInscripciones&torneo_id=' . Utils::limpiar_datos($_POST['torneo_id']));
        } else {
            $usuarioModel = new User_Model();
            $usuarios = $usuarioModel->getAllUsers();
            $torneo_id = Utils::limpiar_datos($_GET['torneo_id']);
            require_once '../views/tournament/inscripcion_form_view.php';
        }
    }

    public function deleteInscripcion()
    {
        $inscripcionModel = new Inscripcion_Model();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = Utils::limpiar_datos($_POST['id']);
            $inscripcionModel->deleteInscripcion($id);
            header('Location: Tournament_Controller.php?action=listInscripciones&torneo_id=' . Utils::limpiar_datos($_POST['torneo_id']));
        } else {
            echo "Invalid request method.";
        }
    }

    public function searchUsuarios()
    {
        $term = Utils::limpiar_datos($_GET['term']);
        $userModel = new User_Model();
        $usuarios = $userModel->searchUsuariosByEmail($term);
        echo json_encode($usuarios);
    }
}

if (isset($_GET['action'])) {
    $action = Utils::limpiar_datos($_GET['action']);
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
