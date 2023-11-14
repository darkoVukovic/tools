<?php namespace core;
require_once('../core/Constants.php');

use core\Router;


    class App {

        public function run () {
            $paths = [
                'path' => $_SERVER['REQUEST_URI'],
                'method' => $_SERVER['REQUEST_METHOD']
            ];

        }   
    }