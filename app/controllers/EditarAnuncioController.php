<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class EditarAnuncioController extends BaseController {
    
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
        $categorias = CategoriaModel::getAll();
        $this->render('editarAnuncio.view.php', ['header' => $header, 'user' => $user,'categorias' => $categorias]);
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