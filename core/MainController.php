<?php namespace core;

use core\View;

class MainController {
    public $view;

    // preloading stuff here
    public function __construct () {
        $this->view = new view();
    } 


    

}