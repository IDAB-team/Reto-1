<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';


class AnunciosController extends BaseController {

    public function index() {
        session_start();

        try {
            // Header y usuario por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos Gestores y SuperAdmin
                if (!in_array($user['tipo'], ['Gestor', 'SuperAdmin'])) {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header según tipo
                switch ($user['tipo']) {
                    case 'Gestor':
                        $header = 'headerSessionGestor.php';
                        break;
                    case 'SuperAdmin':
                        $header = 'headerSessionAdmin.php';
                        break;
                }
            } else {
                // Si no hay sesión, mostramos error
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => 'No tienes permisos para acceder a esta página.'
                ]);
                return;
            }

            // Renderizamos la vista principal de anuncios
            $this->render('anuncios.view.php', [
                'header' => $header,
                'user' => $user
            ]);

        } catch (Exception $e) {
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }
    }
    
    public function show() {}
    
    public function store() {}
    
    public function destroy() {}
    
    public function destroyAll() {}
}