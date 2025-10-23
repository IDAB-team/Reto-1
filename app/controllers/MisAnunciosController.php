<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';


class MisAnunciosController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        $user = null;
        $listaAnuncios=[];

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }
            $listaAnuncios=AnuncioModel::getByIdUser($user['id']);
        }

        
        $categorias = CategoriaModel::getAll();

        $this->render('misAnuncios.view.php', ['header' => $header,
         'user' => $user,
          'categorias' => $categorias,
           'listaAnuncios'=>$listaAnuncios]);
    }
    
    public function buscarPorId() {
        header('Content-Type: application/json');
        $idUser=$_GET['user']['id'];
        $resultados=AnuncioModel::getByIdUser($idUser);
        echo json_encode($resultados);
    }
    
    public function store() {
        
    }
    
    public function destroy() {
        
    }
    
    public function destroyAll() {
        
    }
}