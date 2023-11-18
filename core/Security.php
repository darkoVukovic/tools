<?php namespace core;

use core\MainController;


class Security extends MainController {
    
  

  public function filterVar (string &$string) :string { 
      $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
      return $string;
  } 
}