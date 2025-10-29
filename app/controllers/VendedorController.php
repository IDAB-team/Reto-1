<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/AnuncioModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

class VendedorController extends BaseController {
    
    public function index() {
    session_start(); 

    $header = 'headerSinSession.php';
    $user = $_SESSION['user'] ?? null;
    $listaAnuncios = [];
    $datosUsuario = [];

    // Si se pasa un id por GET, lo usamos. Si no, usamos el id del usuario logueado (si lo hay)
    $idUsuario = $_GET['id'] ?? ($user['id'] ?? null);

    if (!$idUsuario) {
        die("No se especificó ningún usuario para mostrar anuncios.");
    }

    // Header según tipo de usuario logueado
    if ($user) {
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
        }
    }

    // Obtener los datos y anuncios del comerciante cuyo ID queremos ver
    $datosUsuario = UsuarioModel::devolverDatosUsuario($idUsuario);

    if ($datosUsuario) {
        $listaAnuncios = AnuncioModel::getAnunciosByUser($idUsuario);
    }

    $this->render('vendedor.view.php', [
        'header' => $header,
        'user' => $user, 
        'listaAnuncios' => $listaAnuncios, 
        'datosUsuario' => $datosUsuario
    ]);
}

    
public function getAnuncioByUser() {
    $idUsuario = $_GET['id'] ?? null;
    if (!$idUsuario) {
        die("No se proporcionó el ID del comerciante");
    }

    header("Location: index.php?controller=VendedorController&accion=index&id=$idUsuario");
    exit;
}


}