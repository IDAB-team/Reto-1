<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/FavoritoModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';

class AnuncioController extends BaseController {

    // Página principal del anuncio
    public function index() {
        session_start(); 

        $infoUsuario = $this->obtenerHeaderYUsuario();

        // Renderizamos la vista principal de anuncios
        $this->render('anuncio.view.php', [
            'header' => $infoUsuario['header'],
            'user' => $infoUsuario['user'],
            'anuncio' => null
        ]);
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

        // Revisar si el anuncio es favorito del usuario
        $esFavorito = false;
        if ($infoUsuario['user']) {
            $idUsuario = $infoUsuario['user']['id'];
            $esFavorito = FavoritoModel::existeFavorito($idUsuario, $idAnuncio);
        }

        $this->render('anuncio.view.php', [
            'header' => $infoUsuario['header'],
            'user' => $infoUsuario['user'],
            'anuncio' => $anuncio,
            'esFavorito' => $esFavorito
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

        header('Location: index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=' . $id_anuncio);
        exit;
    }

    // Método privado para evitar repetir código: obtiene header según tipo de usuario
    private function obtenerHeaderYUsuario() {
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            switch ($user['tipo']) {
                case 'Cliente':
                    $header = 'headerSessionComprador.php';
                    break;
                case 'Comerciante':
                    $header = 'headerSessionVendedor.php';
                    break;
                case 'Gestor':
                    $header = 'headerSessionGestor.php';
                    break;
                case 'SuperAdmin':
                    $header = 'headerSessionAdmin.php';
                    break;
                default:
                    $header = 'headerSinSession.php';
            }
        }

        return ['header' => $header, 'user' => $user];
    }
}
