<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

class VendedorController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        $user = null;
        $listaAnuncios =[];
        $datosUsuario =[];

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }
        $listaAnuncios=AnuncioModel::getByIdUser($user['id']);
        $datosUsuario=UsuarioModel::devolverDatosUsuario($user['id']);
        }
        

        $this->render('vendedor.view.php', ['header' => $header, 'user' => $user, 'listaAnuncios'=>$listaAnuncios, 'datosUsuario'=>$datosUsuario]);
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