<?php
use core\Error;
use core\View;

function doesMethodExist($class, $method) {
    $classPath = CONTROLLER_NAMESPACE. '\\'. $class;
    if(!method_exists(CONTROLLER_NAMESPACE. '\\'. $class, $method))    return Error::MethodDoesNotExist();
    return true;
}

function doesClassExist($class) {
    if(!class_exists(CONTROLLER_NAMESPACE. '\\'. $class))    return Error::ClassDoesNotExist();
    return true;
}

function loadView($name, $args = null) {
    $view = new View();
    return $view->renderView($name, $args);
}

function getRequestMethod() {
    return $_SERVER['REQUEST_METHOD'];
}

function getAllRoutes($method) {
    $routes = file_get_contents(ROOTDIR.'/mvc/config/Routes.php');
    $file_lines = file(ROOTDIR.'/mvc/config/Routes.php', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $validRoutes = [];
    $routes = preg_replace('/\/\/.*?\n/', '', $routes);
    $routes = preg_replace('/\/\*.*?\*\//s', '', $routes);
    $routes = explode(';', $routes);
    foreach($routes as $route) {

        if(strpos($route, '$routes->'.$method) !== false) {
            $validRoutes[] = trim($route);
        }
    }
    return $validRoutes;
 
 
}

	
