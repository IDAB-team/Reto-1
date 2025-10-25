<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AdminModel.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class CrearGestorController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header por defecto
        $header = 'headerSinSession.php';
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            // Dependiendo del tipo de usuario, mostramos el header correspondiente
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
                    break;
            }
        }

        $this->render('crearGestor.view.php', ['header' => $header, 'user' => $user]);
    }
    public function crear(){
        session_start();
        if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["contraseña"]) && !empty($_POST["repetirContraseñaGestor"])){
            if($_POST["contraseña"] == $_POST["repetirContraseñaGestor"]){
                $data = array(
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "password" => $_POST["contraseña"],
                "tipo" =>"Gestor"
                );
                $resultado = AdminModel::crearGestor($data);
                if ($resultado) {
                    $_SESSION["error"] = "El gestor se ha insertado con éxito";
                    $_SESSION["tipoMensaje"] = "exito";
                } else {
                    $_SESSION["error"] = " El username ya existe, prueba con otro";
                    $_SESSION["tipoMensaje"] = "error";
                }
            } else {
                $_SESSION["error"] = "Las contraseñas no coinciden";
                $_SESSION["tipoMensaje"] = "error";
            } 
        header("Location: index.php?controller=CrearGestorController");   
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