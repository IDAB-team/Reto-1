<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';

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

    $listaAnuncios = AnuncioModel::getAll(); // ✅ Añadido
    $this->render('anuncio.view.php', [
        'listaAnuncios' => $listaAnuncios,
        'header' => $header // ✅ También pasamos el header
    ]);    
}

    public function getAll(){
        $listaAnuncios=AnuncioModel::getAll();
        $this->render('anuncio.view.php', ['listaAnuncios' => $listaAnuncios]);
    }

    public function getByNameCategory(){
        $nameCategoria = $_GET['categoria'] ?? '';

        if ($nameCategoria !== '') {
            $listaAnuncios = AnuncioModel::getByNameCategory($nameCategoria);
        } else {
            $listaAnuncios = AnuncioModel::getAll();
        }

        $this->render('anuncio.view.php', ['listaAnuncios' => $listaAnuncios]);
    }

}
