<?php
require_once __DIR__ . '/BaseController.php';

class ErrorController extends BaseController {

    public function index($mensaje = "Ha ocurrido un error.") {
        session_start();

        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            // Asignar header según tipo
            switch ($user['tipo']) {
                case 'Cliente':
                    $header = 'headerSessionComprador.php';
                    break;
                case 'Comerciante':
                    $header = 'headerSessionVendedor.php';
                    break;
                case 'Gestor':
                    $header = 'headerSessionGestor.php';
                    break;
                case 'SuperAdmin':
                    $header = 'headerSessionAdmin.php';
                    break;
            }
        }

        // Renderizamos la vista de error con el mensaje y el header correspondiente
        $this->render('error.view.php', [
            'header' => $header,
            'user' => $user,
            'mensaje' => $mensaje
        ]);
    }
}
