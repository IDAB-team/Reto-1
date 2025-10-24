<?php
    require_once __DIR__ . '/BaseController.php';
    require_once __DIR__ . '/../models/UsuarioModel.php';


    class EditarUsuarioController extends BaseController {
        public function index() {
            session_start(); 

            // Header por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Dependiendo del tipo de usuario, mostramos el header correspondiente
                switch ($user['tipo']) {
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


            $this->render('editarUsuario.view.php', 
            ['header' => $header, 
            'user' => $user]);
        }

        public function editar(){
            session_start();

            if(!empty($_POST["email"]) && !empty($_POST["nuevaContraseña"]) && !empty($_POST["repetirNuevaContraseña"])){
                if(($_POST["nuevaContraseña"]==$_POST["repetirNuevaContraseña"])){
                    $data = array(
                        "emailAnterior" => $_GET["email"],
                        "email" => $_POST["email"],
                        "nuevaContraseña" => $_POST["nuevaContraseña"], 
                        "repetirNuevaContraseña" => $_POST["repetirNuevaContraseña"]
                    );
                    UsuarioModel::editarUsuario($data);
                    $_SESSION["error"] ="Los cambios se han guardado con éxito";
                    $_SESSION["tipoMensaje"] = "exito";
                }else {
                    $_SESSION["error"]= "Las contraseñas no coinciden o la actual es incorrecta";
                    $_SESSION["tipoMensaje"] = "error";
                }    
                header("Location: index.php?controller=EditarUsuarioController&usuario=" . $_GET['usuario'] . "&email=" . $_GET['email']);
                exit;
            }


        }
    }

    
?>