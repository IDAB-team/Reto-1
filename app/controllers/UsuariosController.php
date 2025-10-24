<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/AdminModel.php';


class UsuariosController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header por defecto
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            // Dependiendo del tipo de usuario, mostramos el header correspondiente
            switch ($user['tipo']) {
                case 'Gestor':
                    $header = 'headerSessionGestor.php';
                    break;
                case 'SuperAdmin':
                    $header = 'headerSessionAdmin.php';
                    break;
                default:
                    $header = 'headerSinSession.php';
                    break;
            }
        }


        $clientes = UsuarioModel::getClientes();
        $comerciantes = UsuarioModel::getComerciantes();
        $gestores = $user['tipo'] === 'SuperAdmin' ? AdminModel::getGestores() : [];


        $this->render('usuarios.view.php', 
        ['header' => $header, 
         'user' => $user, 
         'clientes' => $clientes, 
         'comerciantes' => $comerciantes, 
         'gestores' => $gestores]);
    }

    public function eliminar(){
        if (isset($_GET["usuario"])) {
            $usuarioEmail = $_GET["usuario"];
            UsuarioModel::deleteById($usuarioEmail);
        }

        $this->index();
    }

    public function eliminarg(){
        if (isset($_GET["usuario"])) {
            $usuarioEmail = $_GET["usuario"];
            AdminModel::deleteById($usuarioEmail);
        }

        $this->index();
    }

    public function editar(){
        if (isset($_GET["usuario"])) {
            $usuarioEmail = $_GET["usuario"];
            UsuarioModel::deleteById($usuarioEmail);
        }

        $this->index();
    }

    public function editarg(){
        if (isset($_GET["usuario"])) {
            $usuarioEmail = $_GET["usuario"];
            AdminModel::deleteById($usuarioEmail);
        }

        $this->index();
    }


    public function show() {
        
    }
    
    public function store() {
        
    }
    
    public function destroy() {
        
    }
    
    public function destroyAll() {
        
    }
}