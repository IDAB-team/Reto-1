<?php
    require_once __DIR__ . '/BaseController.php';
    require_once __DIR__ . '/../models/UsuarioModel.php';
    require_once __DIR__ . '/../models/AdminModel.php';


    class EditarUsuarioController extends BaseController {
        public function index() {
            session_start(); 

            try {
                // Header y usuario por defecto
                $header = 'headerSinSession.php';
                $user = null;
                $tipo = $_GET['tipo'] ?? 'Usuario';

                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];

                    // Solo permitimos Gestores y SuperAdmin
                    if (!in_array($user['tipo'], ['Gestor', 'SuperAdmin'])) {
                        header('Location: index.php?controller=ErrorController');
                        exit;
                    }

                    // Header según tipo
                    switch ($user['tipo']) {
                        case 'Gestor':
                            $header = 'headerSessionGestor.php';
                            break;
                        case 'SuperAdmin':
                            $header = 'headerSessionAdmin.php';
                            break;
                    }
                } else {
                    // Sin sesión → redirigir a error
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Renderizamos la vista de edición
                $this->render('editarUsuario.view.php', [
                    'header' => $header,
                    'user' => $user,
                    'email' => $_GET['email'] ?? '',
                    'usuario' => $_GET['usuario'] ?? '',
                    'tipo' => $tipo
                ]);

            } catch (Exception $e) {
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => $e->getMessage()
                ]);
            }
        }

        public function editar() {
            session_start();

            if (
                !empty($_POST["email"]) &&
                !empty($_POST["nuevaContraseña"]) &&
                !empty($_POST["repetirNuevaContraseña"])
            ) {
                if ($_POST["nuevaContraseña"] == $_POST["repetirNuevaContraseña"]) {
                    $data = [
                        "emailAnterior" => $_POST["emailAnterior"], // ← ahora viene del hidden input
                        "email" => $_POST["email"],
                        "nuevaContraseña" => $_POST["nuevaContraseña"]
                    ];



                    $tipo = $_POST['tipo'] ?? 'Usuario';
                    if ($tipo === 'Gestor') {
                        $resultado = AdminModel::editarGestor($data);
                    } else {
                        $resultado = UsuarioModel::editarUsuario($data);
                    }



                    if ($resultado) {
                        $_SESSION["error"] = "Los cambios se han guardado con éxito";
                        $_SESSION["tipoMensaje"] = "exito";
                    } else {
                        $_SESSION["error"] = "No se pudo actualizar el usuario (verifica los datos)";
                        $_SESSION["tipoMensaje"] = "error";
                    }

                } else {
                    $_SESSION["error"] = "Las contraseñas no coinciden";
                    $_SESSION["tipoMensaje"] = "error";
                }

                header("Location: index.php?controller=EditarUsuarioController&usuario=" . urlencode($_POST['usuario']) . "&email=" . urlencode($_POST['email']) . "&tipo=" . urlencode($_POST['tipo']));
                exit;
            }
        }

    }

    
?>