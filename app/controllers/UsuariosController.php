<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/AdminModel.php';


class UsuariosController extends BaseController {
    
    public function index() {
        session_start(); 

        try {
            // Header y usuario por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos Gestor y SuperAdmin
                if (!in_array($user['tipo'], ['Gestor', 'SuperAdmin'])) {
                    header('Location: index.php?controller=ErrorController');
                    exit;                
                }

                // Elegir header según tipo
                switch ($user['tipo']) {
                    case 'Gestor':
                        $header = 'headerSessionGestor.php';
                        break;
                    case 'SuperAdmin':
                        $header = 'headerSessionAdmin.php';
                        break;
                }
            }

            // Obtener datos según permisos
            $clientes = UsuarioModel::getClientes();
            $comerciantes = UsuarioModel::getComerciantes();
            $gestores = ($user && $user['tipo'] === 'SuperAdmin') ? AdminModel::getGestores() : [];

            $this->render('usuarios.view.php', [
                'header' => $header,
                'user' => $user,
                'clientes' => $clientes,
                'comerciantes' => $comerciantes,
                'gestores' => $gestores
            ]);

        } catch (Exception $e) {
            // Renderizamos la vista de error solo si hay usuario con permisos inválidos
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }
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