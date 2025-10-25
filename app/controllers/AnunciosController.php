<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/FavoritoModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';

class AnunciosController extends BaseController {

    // Página principal del anuncio
    public function index() {
        session_start(); 

        $infoUsuario = $this->obtenerHeaderYUsuario();

        // No cargamos un anuncio específico aquí
        $this->render('anuncio.view.php', [
            'header' => $infoUsuario['header'],
            'user' => $infoUsuario['user'],
            'anuncio' => null
        ]);
    }

    // Método privado para evitar repetir código
    private function obtenerHeaderYUsuario() {
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

        return ['header' => $header, 'user' => $user];
    }

    // Obtener un anuncio específico por ID
    public function getAnuncioById() {
        session_start();

        $idAnuncio = $_GET['idAnuncio'] ?? null;
        if (!$idAnuncio) {
            die("No se proporcionó el ID del anuncio");
        }

        $anuncio = AnuncioModel::getAnuncioById($idAnuncio);
        $infoUsuario = $this->obtenerHeaderYUsuario();

        $this->render('anuncio.view.php', [
            'header' => $infoUsuario['header'],
            'user' => $infoUsuario['user'],
            'anuncio' => $anuncio
        ]);
    }

    // Activar/desactivar favorito
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

        header('Location: index.php?controller=AnunciosController&accion=getAnuncioById&idAnuncio=' . $id_anuncio);
        exit;
    }


}
