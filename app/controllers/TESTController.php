<?php
require_once __DIR__ . '/BaseController.php';
//require_once __DIR__ . '/../models/XxxxxModel.php';

class TESTController extends BaseController {
    
    public function index() {
        $this->render('TEST.view.php');
    }
}