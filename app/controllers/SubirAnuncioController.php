<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class SubirAnuncioController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['tipo'] === 'comprador') {
                $header = 'headerSessionComprador.php';
            } elseif ($_SESSION['user']['tipo'] === 'vendedor') {
                $header = 'headerSessionVendedor.php';
            }
        }
        
        $this->render('subirAnuncio.view.php', ['header' => $header]);
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