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
    $datosUsuario = null;

    // Intentamos obtener ID de usuario desde GET o sesión
    $idUsuario = $_GET['id'] ?? ($user['id'] ?? null);
    $idAnuncio = $_GET['idAnuncio'] ?? null;

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

    // Si tenemos ID, obtenemos sus datos
    if ($idUsuario) {
        $datosUsuario = UsuarioModel::devolverDatosUsuario($idUsuario);
    }

    // Si no hay usuario pero hay idAnuncio, obtenemos datos por anuncio
    if ($idAnuncio !== null) {
        $datosUsuario = UsuarioModel::devolverDatosUsuarioPorAnuncio($idAnuncio);
        if ($datosUsuario) {
            $idUsuario = $datosUsuario->id; // Para guardar el ID
        }
    }

    // Teniendo datos de usuario, obtener sus anuncios
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