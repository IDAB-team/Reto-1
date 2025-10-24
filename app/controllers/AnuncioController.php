<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
class MisAnunciosController extends BaseController {

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
            $listaAnuncios=AnuncioModel::getByIdUser($user['id']);
        }
        $categorias = CategoriaModel::getAll();


        $this->render('anuncio.view.php', ['header' => $header,
        'user' => $user]);
    }
}