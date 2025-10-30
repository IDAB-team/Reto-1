<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';

class AnunciosController extends BaseController {

    public function index() {
        session_start();

        try {
            $header = 'headerSinSession.php';
            $user = $_SESSION['user'] ?? null;

            // Solo Gestor o SuperAdmin
            if (!$user || !in_array($user['tipo'], ['Gestor', 'SuperAdmin'])) {
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => 'No tienes permisos para acceder a esta página.'
                ]);
                return;
            }

            $header = $user['tipo'] === 'SuperAdmin'
                ? 'headerSessionAdmin.php'
                : 'headerSessionGestor.php';

            // Todos los anuncios y categorías
            $listaAnuncios = AnuncioModel::getTodos();
            $categorias = CategoriaModel::getAll();

            $this->render('anuncios.view.php', [
                'header' => $header,
                'user' => $user,
                'categorias' => $categorias,
                'listaAnuncios' => $listaAnuncios
            ]);

        } catch (Exception $e) {
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }
    }

    // Eliminar anuncio
    public function eliminar() {
        if (!empty($_GET["anuncio"])) {
            $idAnuncio = $_GET["anuncio"];
            AnuncioModel::deleteById($idAnuncio);
        }
        header("Location: index.php?controller=AnunciosController");
        exit;
    }

    // Buscar anuncios por nombre 
    public function apiBuscarPorNombre() {
        header('Content-Type: application/json');
        $texto = $_GET['buscarAnuncio'] ?? '';
        $resultados = empty($texto) ? AnuncioModel::getTodos() : AnuncioModel::getByName($texto);
        echo json_encode($resultados);
        exit;
    }

    // Filtrar anuncios por categoría
    public function apiPorCategoria() {
        header('Content-Type: application/json');
        $categoria = $_GET['categoria'] ?? '';
        $resultados = AnuncioModel::getByCategoryName($categoria);
        echo json_encode($resultados);
        exit;
    }

    // Ordenar por fecha 
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
