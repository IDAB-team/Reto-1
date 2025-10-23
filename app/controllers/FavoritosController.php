<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/FavoritoModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';

class FavoritosController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        $user = null;
        $listaAnunciosFavoritos=[];

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }

            $listaAnunciosFavoritos=FavoritoModel::obtenerFavoritos($user['id']);

        }

        $listaCategorias = CategoriaModel::getAll();

        $this->render('favoritos.view.php', [
            'header' => $header,
            'user' => $user,
            'listaAnuncios' => $listaAnunciosFavoritos,
            'listaCategorias' => $listaCategorias
        ]);
    }

    /* USO EL SESSION_START() EN CADA FUNCION PORQUE PHP 
    NO MANTIENE LA SESION AUTOMATICAMENTE, SI NO LO HAGO
    $_SESSION['USER'] ESTARIA VACIO */
    
    public function existeFavorito() {
        session_start();
        $id_usuario = $_SESSION['user']['id'] ?? null;
        $id_anuncio = $_GET['ID_Anuncio'] ?? null;

        if ($id_usuario && $id_anuncio) {
            $existe = FavoritoModel::existeFavorito($id_usuario, $id_anuncio);
                if ($existe) {
                    FavoritoModel::eliminarFavorito($id_usuario, $id_anuncio);
                } else {
                    FavoritoModel::agregarFavorito($id_usuario, $id_anuncio);
                }
        }

        // Redirige a la vista de favoritos o a donde quieras volver
        header('Location: index.php?controller=FavoritosController&accion=index');
        exit;
    }

    public function ordenarPorFecha() {
    session_start();
    $id_usuario = $_SESSION['user']['id'] ?? null;
    $resultados = FavoritoModel::ordenarPorFecha($id_usuario);
    echo json_encode($resultados);
    exit;
}

public function ordenarPorPrecio() {
    session_start();
    $id_usuario = $_SESSION['user']['id'] ?? null;
    $orden = $_GET['orden'] ?? 'ASC';
    $resultados = FavoritoModel::ordenarPorPrecio($id_usuario, $orden);
    echo json_encode($resultados);
    exit;
}




}