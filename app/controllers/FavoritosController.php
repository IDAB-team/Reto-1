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

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user['tipo'] === 'Cliente') {
                $header = 'headerSessionComprador.php';
            } elseif ($user['tipo'] === 'Comerciante') {
                $header = 'headerSessionVendedor.php';
            }
        }

        $idUsuario= $user['ID_Usuario'] ?? null;
        $listaCategorias = CategoriaModel::getAll();
        $listaAnuncios = FavoritoModel::obtenerFavoritos($idUsuario);

        $this->render('favoritos.view.php', [
            'header' => $header,
            'user' => $user,
            'listaAnuncios' => $listaAnuncios,
            'listaCategorias' => $listaCategorias
        ]);
    }
    
    public function existeFavorito() {
        session_start();
        $idUsuario = $_SESSION['user']['ID_Usuario'] ?? null;
        $idAnuncio = $_GET['ID_Anuncio'] ?? null;

        if ($idUsuario && $idAnuncio) {
            $existe = FavoritoModel::existeFavorito($idUsuario, $idAnuncio);
                if ($existe) {
                    FavoritoModel::eliminarFavorito($idUsuario, $idAnuncio);
                    echo json_encode(['estado' => 'eliminado']);
                } else {
                    FavoritoModel::agregarFavorito($idUsuario, $idAnuncio);
                    echo json_encode(['estado' => 'agregado']);
                }
        } else {
            echo json_encode(['estado' => 'error']);
        }
        exit;
    }

    public function ordenarPorFecha() {
    session_start();
    $idUsuario = $_SESSION['user']['ID_Usuario'] ?? null;
    $resultados = FavoritoModel::ordenarPorFecha($idUsuario);
    echo json_encode($resultados);
    exit;
}

public function ordenarPorPrecio() {
    session_start();
    $idUsuario = $_SESSION['user']['ID_Usuario'] ?? null;
    $orden = $_GET['orden'] ?? 'ASC';
    $resultados = FavoritoModel::ordenarPorPrecio($idUsuario, $orden);
    echo json_encode($resultados);
    exit;
}

}