<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

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

            $idAnuncio = $_GET['anuncio'];
            $anuncio=AnuncioModel::getAnuncioById($idAnuncio);
            $nombreArray=CategoriaModel::devolverNombreCategoria($anuncio->ID_Categoria);
            $nombre = $nombreArray['Nombre'];
            $categorias = CategoriaModel::getAll();
            $this->render('editarAnuncio.view.php', ['header' => $header, 'user' => $user,'categorias' => $categorias,'anuncio' => $anuncio,'nombre' =>$nombre,'idAnuncio' => $idAnuncio]);

        } catch (Exception $e) {
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }

        
    }

    public function editarAnuncio(){
        session_start();
        if(!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["categoria"]) && !empty($_POST["precio"]) && !empty($_POST["stock"])){
            $anuncioActual = AnuncioModel::getAnuncioById($_GET["anuncio"]);
            if (!empty($_FILES["imagen"]["name"])) {
                $rutaFisicaAntigua = realpath(__DIR__ . "/../" . $anuncioActual->urlImagen);
                if ($rutaFisicaAntigua && file_exists($rutaFisicaAntigua)) {
                    unlink($rutaFisicaAntigua);
                } 
                $nombreTmp = $_FILES["imagen"]["tmp_name"];
                $nombreOriginal = $_FILES["imagen"]["name"];
                $rutaFisica = __DIR__ . "/../assets/images/anuncios/" . time() . "_" . $nombreOriginal;
                $rutaWeb = "assets/images/anuncios/" . time() . "_" . $nombreOriginal;
                move_uploaded_file($nombreTmp, $rutaFisica);
            } else {
                $rutaWeb = $anuncioActual->urlImagen;
            }
            $id_categoria=CategoriaModel::devolverIdCategoria($_POST["categoria"]);
            $data=array("imagen" => $rutaWeb,
                "usuario"=> $anuncioActual->ID_Usuario,
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => $id_categoria,
                "fecha" => date("Y-m-d H:i:s"), 
                "precio" => $_POST["precio"],
                "stock" => $_POST["stock"],
                "idAnuncio" => $_GET["anuncio"] 
            );
            var_dump($data);
            AnuncioModel::modificarAnuncio($data);
            $_SESSION["error"] ="Los cambios se han guardado con éxito";
            $_SESSION["tipoMensaje"] = "exito";
        }else {
            $_SESSION["error"]= "Error al editar el anuncio";
            $_SESSION["tipoMensaje"] = "error";
        }  
            header("Location: index.php?controller=EditarAnuncioController&anuncio=".$data['idAnuncio']);
            exit;
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