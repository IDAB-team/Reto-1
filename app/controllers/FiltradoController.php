<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/FavoritoModel.php';


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
        //Para rellenar los favoritos si tiene y mostrarlo al ingresar a la página
        $favoritos = [];
        if (!empty($user)) {
            $favoritos = FavoritoModel::obtenerIdsFavoritos($user['id']);
        }


        // Si hay texto de búsqueda
        if (!empty($_GET['buscarAnuncio'])) {
            $listaAnuncios = AnuncioModel::getByName($_GET['buscarAnuncio']);
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
            'header' => $header,
            'user' => $user,
            'favoritos' => $favoritos
        ]);    
    }

    /*
    Usa header('Content-Type: application/json') solo en funciones que devuelven JSON.
    */ 
    public function getAll() {
        header('Content-Type: application/json');
        $resultados = AnuncioModel::getAll();
        echo json_encode($resultados);
        exit;
    }


    //Buscar anuncios por nombre
    public function apiBuscarPorNombre() {
        header('Content-Type: application/json');
        $texto = $_GET['buscarAnuncio'] ?? '';
        $resultados = AnuncioModel::getByName($texto);
        echo json_encode($resultados);
        exit;
    }

    //Filtrar por categoría
    public function apiPorCategoria() {
        header('Content-Type: application/json');
        $categoria = $_GET['categoria'] ?? '';
        $resultados = AnuncioModel::getByCategoryName($categoria);
        echo json_encode($resultados);
        exit;
    }
    //Ordenar por fecha
    public function apiOrdenarPorFecha(){
        header('Content-Type: application/json');
        $resultados = AnuncioModel::orderByDate();
        echo json_encode($resultados);
        exit;
    }

    // Ordenar por precio
    public function apiOrdenarPorPrecio() {
        header('Content-Type: application/json');
        $orden = $_GET['orden'] ?? 'ASC';
        $resultados = AnuncioModel::orderByPrice($orden);
        echo json_encode($resultados);
        exit;
    }
    
}