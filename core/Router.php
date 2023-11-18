<?php namespace core;

use core\view;
use mvc\Controllers\Homepage;
use core\Error;
require_once '../core/Constants.php';


    class Router {
      private $uri = '';
      static $called = false;
      static $routeCollection ;
      static $getRouteCollection;
      static $postRouteCollection;

      public function __construct () {
        self::$getRouteCollection = count(getAllRoutes("get"));
        self::$postRouteCollection = count(getAllRoutes("post"));
      } 
      
      public function get ($uri, $class, $method) {
        if(getRequestMethod() != 'GET') return;

        if(self::$called) return;
        $requestUri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $requestUri = trim($requestUri, '/');
        $this->uri = explode('/', $requestUri);
        // if route has params in uri
        if(strpos($uri, '(') !== false) {
          self::$getRouteCollection--;
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
           $uri = str_replace($args[$i], $arguments[$names[$i]], $uri);
           // echo $arguments[$names[$i]];

          }
         }

          if($uri != $requestUri) return false;
          if(doesMethodExist($class, $method))  {
            $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
            $arguments = [];
            $class = new $classPath();
            self::$called = true;
            if(is_array($arguments) && count($arguments) > 0) {
              return  $class->$method($arguments);
            } else return $class->$method();  
          } 
        }
        // if route does not have params in uri
        else {
          self::$getRouteCollection--;
          if($uri[0] ==  '/')  {
            $uri = substr($uri, 1);
          } 
          if(strpos($requestUri, '?') !== false) {
            $realUri = explode('?', $requestUri);
            $requestUri = $realUri[0];
            $getParams = $realUri[1];

          }
          if($uri == $requestUri) {
            if(!doesClassExist($class))  {
              return;
           }
           else {
            if(doesMethodExist($class, $method))  {
              $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
              $arguments = [];
              $class = new $classPath();
              self::$called = true;
              if(is_array($arguments) && count($arguments) > 0) {
                return  $class->$method($arguments);
              } else return $class->$method();  
            } 
           }
          }
        }

        if(self::$getRouteCollection <= 0) loadView('RouteNotDefined');
      } 


        public function post ($uri, $class, $method) {
          if(getRequestMethod() != 'POST') return;
         if(self::$called) return;
        $requestUri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $requestUri = trim($requestUri, '/');
        $this->uri = explode('/', $requestUri);

        // if route has params in uri
        if(strpos($uri, '(') !== false) {
          self::$postRouteCollection--;
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
           $uri = str_replace($args[$i], $arguments[$names[$i]], $uri);
           // echo $arguments[$names[$i]];

          }
         }
          if($uri != $requestUri) return false;
          if(doesMethodExist($class, $method))  {
            $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
            $arguments = [];
            $class = new $classPath();
            self::$called = true;
            if(is_array($arguments) && count($arguments) > 0) {
              return  $class->$method($arguments);
            } else return $class->$method();  
          } 
        }
        // if route does not have params in uri
        else {
          self::$postRouteCollection--;
          if($uri[0] ==  '/')  {
            $uri = substr($uri, 1);
          }
          if($uri == $requestUri) {
            if(!class_exists(CONTROLLER_NAMESPACE.'\\'.$class))  {
           }
           else {
            if(doesMethodExist($class, $method))  {
              $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
              $arguments = [];
              $class = new $classPath();
              self::$called = true;
              if(is_array($arguments) && count($arguments) > 0) {
                return  $class->$method($arguments);
              } else return $class->$method();  
            } 
           }
          }
        }
 
        if(self::$postRouteCollection <= 1) loadView('RouteNotDefined');
        } 
        
    }