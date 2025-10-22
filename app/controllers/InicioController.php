<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';


class InicioController extends BaseController {
    
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

        // Obtener categorías y anuncios
        $categorias = CategoriaModel::getAll();
        $anuncios = AnuncioModel::getUltimos(8);

        $this->render('inicio.view.php', [
            'header' => $header, 
            'user' => $user,
            'categorias' => $categorias,
            'anuncios' => $anuncios
        ]);
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