<?php
require_once __DIR__ . '/BaseController.php';

class LoginController extends BaseController {

    public function login() {
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // ******* Validación real contra base de datos *******
        if ($email === 'comprador@test.com' && $password === '123') {
            $_SESSION['user'] = ['email' => $email, 'tipo' => 'comprador'];
        } elseif ($email === 'vendedor@test.com' && $password === '123') {
            $_SESSION['user'] = ['email' => $email, 'tipo' => 'vendedor'];
        } else {
            // Login fallido, volver al inicio
            $this->redirect('?controller=InicioController');
        }

        $this->redirect('?controller=InicioController');
    }

    public function logout() {
        session_start();
        session_destroy();
        $this->redirect('?controller=InicioController');
    }

    public function register() {
        session_start();

        $tipoCuenta = $_POST['tipoCuenta'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Inserts en base de datos
        // ...

        // Crear sesión directamente tras registro
        $_SESSION['user'] = ['email' => $email, 'tipo' => $tipoCuenta];
        $this->redirect('?controller=InicioController');
    }
}
