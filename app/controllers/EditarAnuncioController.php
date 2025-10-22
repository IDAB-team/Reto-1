<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class EditarAnuncioController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }
        }
        $categorias = CategoriaModel::getAll();
        $this->render('editarAnuncio.view.php', ['header' => $header, 'user' => $user,'categorias' => $categorias]);
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