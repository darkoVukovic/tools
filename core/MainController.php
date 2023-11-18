<?php namespace core;

use core\View;
use core\Auth;

class MainController {
    public $view;
    public $auth;

    // preloading stuff here
    public function __construct () {
        $this->view = new view();
        $this->auth = new Auth();
        if(session_status() == PHP_SESSION_NONE) session_start();
    } 


    

}