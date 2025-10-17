<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';


class AnuncioController extends BaseController {
    
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

    $listaAnuncios = AnuncioModel::getAll();
    $listaCategorias = CategoriaModel::getAll();

    $this->render('anuncio.view.php', [
    'listaAnuncios' => $listaAnuncios,
    'listaCategorias' => $listaCategorias,
    'header' => $header
    ]);    
}

    public function getAll(){
        $listaAnuncios=AnuncioModel::getAll();
        $this->render('anuncio.view.php', ['listaAnuncios' => $listaAnuncios]);
    }

    public function getByNameCategory(){
        $nameCategoria = $_GET['categoria'] ?? '';
        $listaCategorias = CategoriaModel::getAll();

        if ($nameCategoria !== '') {
            $listaAnuncios = AnuncioModel::getByCategoryName($nameCategory);
        } else {
            $listaAnuncios = AnuncioModel::getAll();
        }

        $this->render('anuncio.view.php', ['listaAnuncios' => $listaAnuncios]);
    }

  

}