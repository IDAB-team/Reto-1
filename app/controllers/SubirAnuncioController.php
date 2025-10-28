<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/AnuncioModel.php';

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
    
    public function subirAnuncio(){
        session_start();
        if(!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["descripcion"]) && !empty($_POST["categoria"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])){
            $nombreTmp = $_FILES["imagen"]["tmp_name"];
            $nombreOriginal = $_FILES["imagen"]["name"];
            $rutaFisica = __DIR__ . "/../assets/images/anuncios/" . time() . "_" . $nombreOriginal;
            $rutaWeb = "assets/images/anuncios/" . time() . "_" . $nombreOriginal;
            $carpeta = __DIR__ . "/../assets/images/anuncios/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            move_uploaded_file($nombreTmp, $rutaFisica);
            $idCategoria=CategoriaModel::devolverIdCategoria($_POST["categoria"]);
            $idUsuario = UsuarioModel::devolverIdUsuario();
            $data=array("imagen" => $rutaWeb,
                "usuario"=> $idUsuario,
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => "$idCategoria",
                "fecha" => date("Y-m-d H:i:s"),
                "precio" => $_POST["precio"],
                "stock" => $_POST["stock"]
            );
            AnuncioModel::insertarAnuncio($data);
            $_SESSION["error"] ="Los cambios se han guardado con éxito";
            $_SESSION["tipoMensaje"] = "exito";
        }else {
            $_SESSION["error"]= "Error al editar el anuncio";
            $_SESSION["tipoMensaje"] = "error"; 
        }
        header("Location: index.php?controller=SubirAnuncioController&accion=index");
        exit;
    }

    public function show() {
        $id_categoria=CategoriaModel::devolverIdCategoria($_POST["categoria"]);
                echo $id_categoria;
                $id_usuario = UsuarioModel::devolverIdUsuario();
                echo $id_usuario;
                $data=array("imagen" => "assets/images/iconos/categorias/Moda.png",
                "usuario"=> $id_usuario,
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => $id_categoria,
                "fecha" => date("Y-m-d H:i:s"),
                "precio" => $_POST["precio"],
                "stock" => $_POST["stock"]
                );
                var_export($data);
    }
    
    public function store() {}
    
    public function destroy() {}
    
    public function destroyAll() {}

}