<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class TESTController extends BaseController {
    
    public function index() {
        session_start(); 

        // Header según tipo de usuario
        $header = 'headerSinSession.php';
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['tipo'] === 'comprador') {
                $header = 'headerSessionComprador.php';
            } elseif ($_SESSION['user']['tipo'] === 'vendedor') {
                $header = 'headerSessionVendedor.php';
            }
        }
        $this->render('TEST.view.php', ['header' => $header]);
    }
}