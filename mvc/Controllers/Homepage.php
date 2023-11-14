<?php namespace mvc\Controllers;

use core\MainController;

    class Homepage extends MainController {


        public function index () {
           $this->view->renderView('homepage');
        } 

        public function default () {
            $this->view->renderView(ROOTDIR.'mvc/views/default.php');

        } 

        public function test () {
          echo "test";

        } 
    }   