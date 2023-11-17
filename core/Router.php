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
      } 
      
      public function get ($uri, $class, $method) {
        if(self::$called) return;
        $requestUri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $requestUri = trim($requestUri, '/');
        $this->uri = explode('/', $requestUri);

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
        else {
          self::$getRouteCollection--;
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
 
        if(self::$getRouteCollection <= 1) loadView('RouteNotDefined');
      } 

      /*
        public function get ($uri, $class, $method) {
          if(self::$called) return;
          if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return;
          }
          $requestUri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
          $requestUri = trim($requestUri, '/');
          $routes = getAllRoutes();
          self::$routeCollection = count($routes);
          foreach($routes as $route) {
            if(strpos($route, $uri)) {
              $args = substr($route, 14, -1);
              $matchingRoute = explode(',', $args);
              $matchingRoute = str_replace("'", '', $matchingRoute);
              if(trim($matchingRoute[0]) == '/'.$requestUri) {
                $class = trim($matchingRoute[1]);
               // $method = trim($matchingRoute[2]);
                if(!class_exists(CONTROLLER_NAMESPACE.'\\'.$class))  {
                  echo "error";
                  self::$routeCollection--;
               }
               else {
                if(doesMethodExist($class, $method))  {
                  $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
                  $arguments = [];
                  $class = new $classPath();
                  if(is_array($arguments) && count($arguments) > 0) {
                    return  $class->$method($arguments);
                  } else {
                    self::$routeCollection++;
                    return $class->$method();
                  }
                }
                else {
                 self::$routeCollection--;
                }
                
               }

              }
            }  else self::$routeCollection--;

          }
          self::$called = true;
         // if(self::$routeCollection == 0) loadView('RouteNotDefiend');
        }
        
        */
        public function post ($uri, $class, $method) {
        	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
          }
          $requestUri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
          $requestUri = trim($requestUri, '/');
          foreach(getAllRoutes('post') as $route) {
            if(strpos($route, $uri)) {
              $args = substr($route, 14, -1);
              $matchingRoute = explode(',', $args);
              $matchingRoute = str_replace("'", '', $matchingRoute);
              
              if(trim($matchingRoute[0]) == $requestUri) {
                $class = trim($matchingRoute[1]);
               // $method = trim($matchingRoute[2]);
                if(!class_exists(CONTROLLER_NAMESPACE.'\\'.$class))  {
                  echo "error";
               }
               else {
                if(doesMethodExist($class, $method))  {
                  $classPath  = CONTROLLER_NAMESPACE .'\\'. $class;
                  $arguments = [];
                  $class = new $classPath();
                  if(is_array($arguments) && count($arguments) > 0) {
                    return  $class->$method($arguments);
                  } else return $class->$method();  
                }
                
               }

              }

            }
          }
        } 
        
    }