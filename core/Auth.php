<?php namespace core;


class Auth {
    
    public function checkAuth () {
      if(isset($_COOKIE['username'])) {
        return  (isset($_SESSION['username'])) ? true : false;
      }
  
    } 


    public function logOut () {
        if($this->checkAuth()) {
          $name = str_replace(' ', '-', $_SESSION['username']);
          if(setcookie('username', $name,  time() -3600, '/', 'localhost', false)) {
           unset($_SESSION['username']);
           return true;
        }
    } 
    return false;
    }
}