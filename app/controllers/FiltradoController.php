<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';

class FiltradoController extends BaseController {
    
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

        // Modelos
        $listaCategorias = CategoriaModel::getAll();

        // Si hay texto de búsqueda
        if (!empty($_GET['texto'])) {
            $listaAnuncios = AnuncioModel::getByName($_GET['texto']);
        }
        // Si hay una categoría seleccionada
        elseif (!empty($_GET['categoria'])) {
            $listaAnuncios = AnuncioModel::getByCategoryName($_GET['categoria']);
        }
        // Si no hay filtros, mostrar todos
        else {
            $listaAnuncios = AnuncioModel::getAll();
        }

        $this->render('filtrado.view.php', [
            'listaAnuncios' => $listaAnuncios,
            'listaCategorias' => $listaCategorias,
            'header' => $header
        ]);    
    }

    public function getAll() {
        $listaAnuncios = AnuncioModel::getAll();
        $this->render('filtrado.view.php', ['listaAnuncios' => $listaAnuncios]);
    }

    // 🔍 Buscar anuncios por nombre
    public function apiBuscarPorNombre() {
        header('Content-Type: application/json');
        $texto = $_GET['texto'] ?? '';
        $resultados = AnuncioModel::getByName($texto);
        echo json_encode($resultados);
        exit;
    }

    // 📂 Filtrar por categoría
    public function apiPorCategoria() {
        header('Content-Type: application/json');
        $categoria = $_GET['categoria'] ?? '';
        $resultados = AnuncioModel::getByCategoryName($categoria);
        echo json_encode($resultados);
        exit;
    }

    // 💰 Ordenar por precio
    public function apiOrdenarPorPrecio() {
        header('Content-Type: application/json');
        $orden = $_GET['orden'] ?? 'ASC';
        $resultados = AnuncioModel::orderByPrice($orden);
        echo json_encode($resultados);
        exit;
    }
}