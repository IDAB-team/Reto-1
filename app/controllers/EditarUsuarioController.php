<?php
    require_once __DIR__ . '/BaseController.php';

    class EditarUsuarioController extends BaseController {
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


            $this->render('editarUsuario.view.php', 
            ['header' => $header, 
            'user' => $user]);
        }
    }
?>