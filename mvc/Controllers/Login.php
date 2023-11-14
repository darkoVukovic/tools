<?php namespace mvc\Controllers;

use core\MainController;

class Login extends MainController {


    public function index () {
        $this->view->renderView('login');
    } 
}