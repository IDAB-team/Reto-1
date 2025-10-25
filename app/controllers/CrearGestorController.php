<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class CrearGestorController extends BaseController {

    public function index() {
        session_start();

        try {
            // Header y usuario por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos SuperAdmin
                if ($user['tipo'] !== 'SuperAdmin') {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header para SuperAdmin
                $header = 'headerSessionAdmin.php';
            } else {
                // Sin sesión → mostramos error
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => 'No tienes permisos para acceder a esta página.'
                ]);
                return;
            }

            // Renderizamos la vista principal para crear gestor
            $this->render('crearGestor.view.php', [
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
