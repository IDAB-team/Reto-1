<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class CrearGestorController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header por defecto
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            // Dependiendo del tipo de usuario, mostramos el header correspondiente
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
                default:
                    $header = 'headerSinSession.php';
                    break;
            }
        }

        $this->render('crearGestor.view.php', ['header' => $header, 'user' => $user]);
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