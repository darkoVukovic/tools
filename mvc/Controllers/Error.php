<?php namespace mvc\Controllers;

use core\MainController;

class Error extends MainController {

    public function __construct () {
        parent::__construct();
        $this->view->renderView('error');

    } 

 
}