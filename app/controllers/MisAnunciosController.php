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

    public function eliminar() {
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

// Buscar anuncios por nombre solo del usuario
public function apiBuscarPorNombre() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode([]);
        exit;
    }

    $user = $_SESSION['user'];
    $texto = $_GET['texto'] ?? '';

    // Método en el modelo que busque por nombre + userId
    $resultados = AnuncioModel::buscarPorNombreUsuario($texto, $user['id']);
    echo json_encode($resultados);
    exit;
}

// Ordenar por fecha más reciente
public function apiOrdenarPorFecha() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode([]);
        exit;
    }

    $user = $_SESSION['user'];
    $resultados = AnuncioModel::getByIdUserOrdenados($user['id'], 'fecha', 'DESC'); // DESC = más reciente primero
    echo json_encode($resultados);
    exit;
}

// Ordenar por precio ASC o DESC
public function apiOrdenarPorPrecio() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode([]);
        exit;
    }

    $user = $_SESSION['user'];
    $orden = $_GET['orden'] ?? 'ASC';
    $resultados = AnuncioModel::getByIdUserOrdenados($user['id'], 'precio', $orden);
    echo json_encode($resultados);
    exit;
}

// Filtrar anuncios por categoría solo del usuario
public function apiPorCategoria() {
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['user'])) {
        echo json_encode([]);
        exit;
    }

    $user = $_SESSION['user'];
    $categoria = $_GET['categoria'] ?? '';

    if (empty($categoria)) {
        // Si no se envía categoría, devolver todos los anuncios del usuario
        $resultados = AnuncioModel::getByIdUser($user['id']);
    } else {
        // Método en el modelo que filtre por categoría + userId
        $resultados = AnuncioModel::getByIdUserPorCategoria($user['id'], $categoria);
    }

    echo json_encode($resultados);
    exit;
}


}