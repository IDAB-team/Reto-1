<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';

//require_once __DIR__ . '/../models/XxxxxModel.php';

class SubirAnuncioController extends BaseController {
    
    public function index() {
        session_start(); 

        try {
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo Comerciantes
                if ($user['tipo'] !== 'Comerciante') {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header para Comerciantes
                $header = 'headerSessionVendedor.php';
            } else {
                // Sin sesión → redirigir a error
                header('Location: index.php?controller=ErrorController');
                exit;
            }

            $categorias = CategoriaModel::getAll();
            $this->render('subirAnuncio.view.php', [
                'header' => $header,
                'user' => $user,
                'categorias' => $categorias
            ]);

        } catch (Exception $e) {
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }
    }
    
    public function show() {}
    
    public function store() {}
    
    public function destroy() {}
    
    public function destroyAll() {}
}