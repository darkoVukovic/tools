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
            echo "12312";
        } 

        public function quicksort () {
            $nums = [5,2 ,3, 1, 6]; 
            $l= 0;
            $h = count($nums) -1;
            sortIt($nums, $l, $h);

            print_r($nums);
        } 
    }   