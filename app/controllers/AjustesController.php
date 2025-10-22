<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class AjustesController extends BaseController {
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

        $this->render('ajustes.view.php', ['header' => $header, 'user' => $user]);
    }

    public function editar(){
        session_start();
        if(!empty($_POST["email"]) && !empty($_POST["contraseña"]) && !empty($_POST["nuevaContraseña"]) && !empty($_POST["repetirNuevaContraseña"])){
            $contraseña=UsuarioModel::devolverContraseña();
            if(($contraseña==$_POST["contraseña"]) && ($_POST["nuevaContraseña"]==$_POST["repetirNuevaContraseña"])){
                $data = array(
                    "usuario" => $_SESSION["user"]["nombre"],
                    "email" => $_POST["email"],
                    "contraseña" => $_POST["contraseña"], 
                    "nuevaContraseña" => $_POST["nuevaContraseña"], 
                    "repetirNuevaContraseña" => $_POST["repetirNuevaContraseña"]
                );
                UsuarioModel::editarDatos($data);
                $_SESSION["error"] ="Los cambios se han guardado con éxito";
                $_SESSION["tipoMensaje"] = "exito";
            }else {
                $_SESSION["error"]= "Las contraseñas no coinciden o la actual es incorrecta";
                $_SESSION["tipoMensaje"] = "error";
            }    
            header("Location: index.php?controller=AjustesController");
            exit;
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