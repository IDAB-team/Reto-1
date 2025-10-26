<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AdminModel.php';

class CrearGestorController extends BaseController {

    public function index() {
        session_start();

        try {
            // Header y usuario por defecto
            $header = 'headerSinSession.php';
            $user = null;

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // Solo permitimos SuperAdmin
                if ($user['tipo'] !== 'SuperAdmin') {
                    header('Location: index.php?controller=ErrorController');
                    exit;
                }

                // Header para SuperAdmin
                $header = 'headerSessionAdmin.php';
            } else {
                // Sin sesión → mostramos error
                $this->render('error.view.php', [
                    'header' => 'headerSinSession.php',
                    'mensaje' => 'No tienes permisos para acceder a esta página.'
                ]);
                return;
            }

            // Renderizamos la vista principal para crear gestor
            $this->render('crearGestor.view.php', [
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

    public function crear() {
        session_start();

        if (
            !empty($_POST["username"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["contraseña"]) &&
            !empty($_POST["repetirContraseñaGestor"])
        ) {
            if ($_POST["contraseña"] == $_POST["repetirContraseñaGestor"]) {
                $data = [
                    "username" => $_POST["username"],
                    "email" => $_POST["email"],
                    "password" => $_POST["contraseña"],
                    "tipo" => "Gestor"
                ];

                $resultado = AdminModel::crearGestor($data);

                if ($resultado) {
                    $_SESSION["error"] = "El gestor se ha insertado con éxito";
                    $_SESSION["tipoMensaje"] = "exito";
                } else {
                    $_SESSION["error"] = "El username ya existe, prueba con otro";
                    $_SESSION["tipoMensaje"] = "error";
                }
            } else {
                $_SESSION["error"] = "Las contraseñas no coinciden";
                $_SESSION["tipoMensaje"] = "error";
            }

            header("Location: index.php?controller=CrearGestorController");
        }
    }

    public function show() {}

    public function store() {}

    public function destroy() {}

    public function destroyAll() {}
}
