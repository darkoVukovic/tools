<?php namespace mvc\Controllers;

use core\MainController;

    class Users extends MainController {


        public function index ($args = null) {
            $data = [
                'name' => 'darko'
            ];
            $this->view->renderView('users', $data);
        } 

    
    }   