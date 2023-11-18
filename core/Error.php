<?php namespace core;

use core\MainController;
use core\View;
class Error  {


    public function __construct () {
     
    } 

    public static  function MethodDoesNotExist () {
       $view = new View();
        return $view->renderView('MethodDoesNotExist');
    } 
    public static  function ClassDoesNotExist () {
        $view = new View();
         return $view->renderView('classDoesNotExist');
     } 

 
}