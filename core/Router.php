<?php namespace core;

use core\view;
use mvc\Controllers\Homepage;
use mvc\Controllers\Error;
require_once '../core/Constants.php';


    class Router {
      private $uri = '';
      static $called = false;
      static $routeCollection = []; 

        public function get ($uri, $class, $method) {
        if(self::$called) return;
        $arguments = [];
        $this->uri = explode('/', $_SERVER['REQUEST_URI']);
          
        if(strpos($_SERVER['REQUEST_URI'],strtolower($class)) === false) {
            return;
        }

          if(strpos($uri, '(') !== false) {
            $args = explode('/', $uri);
            $names = [];
            $types = [];

            if(count($args) != count($this->uri)) return false;
           for($i=0; $i < count($args); $i++) {
            if(isset($args[$i][0]) && $args[$i][0] == '(') {
              $params = explode('-', $args[$i]);
              $names[$i] = trim($params[0], '(');
              $types[$i] = trim($params[1], ')');
              $arguments[$names[$i]] = $this->uri[$i];
              if(is_numeric($arguments[$names[$i]])) {
                $intVal = intval($arguments[$names[$i]]);
                if($types[$i] != gettype($intVal))  return false;
              }
            }
           }
          }
          else {
            if($uri !== $_SERVER['REQUEST_URI']) return;
          }

            if(!class_exists(CONTROLLER_NAMESPACE.'\\'.$class))  {
               return new \mvc\Controllers\Error();
            }
            $classPath  = 'mvc\\Controllers\\' . $class;
            $class = new $classPath();
            // TODO: return 404 or some error stuff later
     
            if(!method_exists($class, $method)) return false;
            self::$called = true; 
            if(is_array($arguments) && count($arguments) > 0) {
              return  $class->$method($arguments);
            } else return $class->$method();  
        } 
        
    }