<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';


class MisAnunciosController extends BaseController {
    
    public function index() {
        session_start(); 

        try {
            $header = 'headerSinSession.php';
            $user = null;
            $listaAnuncios = [];

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo Comerciantes
                if ($user['tipo'] !== 'Comerciante') {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header para Comerciantes
                $header = 'headerSessionVendedor.php';

                // Obtener anuncios del usuario
                $listaAnuncios = AnuncioModel::getByIdUser($user['id']);
            } else {
                // Sin sesión → redirigir a error
                header('Location: index.php?controller=ErrorController');
                exit;
            }

            $categorias = CategoriaModel::getAll();

            $this->render('misAnuncios.view.php', [
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

    public function getAll() {
        header('Content-Type: application/json');
        $resultados = AnuncioModel::getAll();
        echo json_encode($resultados);
        exit;
    }
    public function apiBuscarAnuncios() {
    session_start();
    header('Content-Type: application/json');

    $userId = $_SESSION['user']['id'] ?? null;
    $texto = $_GET['texto'] ?? '';
    $categoria = $_GET['categoria'] ?? '';

    if (!$userId) {
        echo json_encode([]);
        exit;
    }

    if ($categoria) {
        $anuncios = AnuncioModel::getByIdUserAndCategoria($userId, $categoria);
    } else {
        $anuncios = AnuncioModel::getByIdUser($userId);
    }

    if ($texto) {
        $anuncios = array_filter($anuncios, fn($a) => stripos($a->nombreAnuncio, $texto) !== false);
    }

    echo json_encode(array_values($anuncios));
    exit;
}



    public function buscarPorId() {
        session_start();
        header('Content-Type: application/json');
        $idUser=$_GET['user']['id'];
        $resultados=AnuncioModel::getByIdUser($idUser);
        echo json_encode($resultados);
    }
    
    public function eliminarById() {
        session_start();
        $idUsuario=$_SESSION['user']['id'];
        $idAnuncio=$_GET['anuncio']['id'];

        if($idUsuario && $idAnuncio){
            AnuncioModel::eliminarById($idUsuario,$idAnuncio);
        }
        header('Location : index.php?controller=MisAnunciosController&accion=index');
        exit;
    }

    public function eliminar(){
        if (!empty($_GET["anuncio"])) {
            $idAnuncio = $_GET["anuncio"];
            AnuncioModel::deleteById($idAnuncio);
        }

        header("Location: index.php?controller=MisAnunciosController");
        exit;
    }
    public function getPaginas() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode(['error' => 'Usuario no autenticado']);
        exit;
    }

    $user = $_SESSION['user'];
    $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
    $limit = 1;
    $offset = ($pagina - 1) * $limit;

    $listaAnuncios = AnuncioModel::getByIdUser($user['id'], $limit, $offset);
    echo json_encode($listaAnuncios);
    exit;
}

public function apiFiltrarPorCategoria() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode([]);
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $categoria = $_GET['categoria'] ?? '';

    if (!$categoria) {
        $anuncios = AnuncioModel::getByIdUser($userId); // Todos los anuncios del usuario
    } else {
        $anuncios = AnuncioModel::getByIdUserAndCategoria($userId, $categoria); // Solo anuncios de esa categoría
    }

    echo json_encode($anuncios);
    exit;
}

}