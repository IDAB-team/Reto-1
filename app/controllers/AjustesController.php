<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class AjustesController extends BaseController {
    public function index() {
        session_start();

        try {
            // Header y usuario por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos Clientes y Comerciantes
                if (!in_array($user['tipo'], ['Cliente', 'Comerciante'])) {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header según tipo
                switch ($user['tipo']) {
                    case 'Cliente':
                        $header = 'headerSessionComprador.php';
                        break;
                    case 'Comerciante':
                        $header = 'headerSessionVendedor.php';
                        break;
                }
            } else {
                // Sin sesión → redirigir a error
                header('Location: index.php?controller=ErrorController');
                exit;
            }

            // Renderizamos la vista de ajustes
            $this->render('ajustes.view.php', [
                'header' => $header,
                'user' => $user
            ]);

        } catch (Exception $e) {
            $this->render('error.view.php', [
                'header' => 'headerSinSession.php',
                'mensaje' => $e->getMessage()
            ]);
        }
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