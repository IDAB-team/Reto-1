<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';


class EditarAnuncioController extends BaseController {
    
    public function index() {
        session_start();

        try {
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos Gestores, SuperAdmin y Comerciantes
                if (!in_array($user['tipo'], ['Gestor', 'SuperAdmin', 'Comerciante'])) {
                    $this->render('error.view.php', [
                        'header' => 'headerSinSession.php',
                        'mensaje' => 'No tienes permisos para editar anuncios.'
                    ]);
                    return;
                }

                // Header según tipo
                switch ($user['tipo']) {
                    case 'Gestor':
                        $header = 'headerSessionGestor.php';
                        break;
                    case 'SuperAdmin':
                        $header = 'headerSessionAdmin.php';
                        break;
                    case 'Comerciante':
                        $header = 'headerSessionVendedor.php';
                        break;
                }
            } else {
                // Sin sesión → redirigir a error
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => 'Debes iniciar sesión para acceder a esta página.'
                ]);
                return;
            }

            $categorias = CategoriaModel::getAll();
            $this->render('editarAnuncio.view.php', [
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

    public function editarCategoria(){
        session_start();
        if(!empty($_POST["nombre"]) || !empty($_POST["descripcion"]) || !empty($_POST["imagen"]) || !empty($_POST["categoria"]) || !empty($_POST["precio"]) || !empty($_POST["stock"])){
            $nombreTmp = $_FILES["imagen"]["tmp_name"];
            $nombreOriginal = $_FILES["imagen"]["name"];
            $rutaFisica = __DIR__ . "/../assets/images/anuncios/" . time() . "_" . $nombreOriginal;
            $rutaWeb = "assets/images/anuncios/" . time() . "_" . $nombreOriginal;
            $carpeta = __DIR__ . "/../assets/images/anuncios/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            move_uploaded_file($nombreTmp, $rutaFisica);
            $id_categoria=CategoriaModel::devolverIdCategoria($_POST["categoria"]);
            $id_usuario = UsuarioModel::devolverIdUsuario();
            $data=array("imagen" => $rutaWeb,
                "usuario"=> $id_usuario,
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => $id_categoria,
                "fecha" => date("Y-m-d H:i:s"),
                "precio" => $_POST["precio"],
                "stock" => $_POST["stock"],
                "idAnuncio" => 17 
            );
            var_dump($data);
            AnuncioModel::modificarCategoria($data);
            header("Location: index.php?controller=EditarAnuncioController");
        }
    } 
    
    public function show() {
        
    }
    
    public function store() {
        
    }
    
    public function destroy() {
        
    }
    
    public function destroyAll() {
        
    }
}