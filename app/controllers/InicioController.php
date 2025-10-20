<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';


class InicioController extends BaseController {
    
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

        // Obtener categorías desde la base de datos
        $categorias = CategoriaModel::getAll();
        $anuncios = AnuncioModel::getUltimos(8);
        //var_dump($anuncios); exit;


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