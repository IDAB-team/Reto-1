<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class InicioController extends BaseController {
    
    public function index() {
        $titulo = 'Comercia Gasteiz';
        $mensaje = 'Bienvenido a la Asociación de Comerciantes de Vitoria-Gasteiz';

        $this->render('inicio.view.php', compact('titulo', 'mensaje'));
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