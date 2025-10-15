<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/UsuarioModel.php';
//require_once __DIR__ . '/../models/AnuncioModel.php';

class VendedorController extends BaseController
{
    public function index()
    {
        session_start(); 

        // Header según tipo de usuario --DANEL
        $header = 'headerSinSession.php';
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['tipo'] === 'comprador') {
                $header = 'headerSessionComprador.php';
            } elseif ($_SESSION['user']['tipo'] === 'vendedor') {
                $header = 'headerSessionVendedor.php';
            }
        }
        // Verificar sesión --DASHA
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        $idUsuario = $_SESSION['id_usuario'];
        $usuarioModel = new UsuarioModel();
        $anuncioModel = new AnuncioModel();

        try {
            // Obtener usuario
            $user = $usuarioModel->getById($idUsuario);

            // Paginación
            [$paginaActual, $offset, $anunciosPorPagina] = $this->getPaginacionConfig();

            // Obtener anuncios
            $listaAnuncios = $anuncioModel->getByUsuario($idUsuario, $anunciosPorPagina, $offset);
            $totalAnuncios = $anuncioModel->countByUsuario($idUsuario);
            $totalPaginas = ceil($totalAnuncios / $anunciosPorPagina);

            // Renderizar vista
            $this->render('vendedor.view.php', [
                'header' => $header, //DANEL
                'user' => $user,
                'listaAnuncios' => $listaAnuncios,
                'paginaActual' => $paginaActual,
                'totalPaginas' => $totalPaginas
            ]);

        } catch (Exception $e) {
            // Manejar error
            error_log("Error en VendedorController::index - " . $e->getMessage());
            $this->render('error.view.php', [
                'mensaje' => 'Ha ocurrido un error al cargar los datos del vendedor.'
            ]);
        }

    
    public function show() {
        
    }
    
    public function store() {
        
    }
    
    public function destroy() {
        
    }

    private function getPaginacionConfig()
    {
        $anunciosPorPagina = 5;
        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        if ($paginaActual < 1) $paginaActual = 1;
        $offset = ($paginaActual - 1) * $anunciosPorPagina;

        return [$paginaActual, $offset, $anunciosPorPagina];
    }

}
