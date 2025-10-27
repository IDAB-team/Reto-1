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

    public function eliminar() {
        if (!empty($_GET["anuncio"])) {
            $idAnuncio = $_GET["anuncio"];
            AnuncioModel::deleteById($idAnuncio);
        }
        header("Location: index.php?controller=AnunciosController");
        exit;
    }
}
