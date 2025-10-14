<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class InicioController extends BaseController {
    
    public function index() {
        $this->render('inicio.view.php');
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