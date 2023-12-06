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

	
function sortIt(&$nums, $l, $h) {

    if($l < $h) {
        $j = partitioning($nums, $l, $h);
        sortIt($nums, $l, $j);
        sortIt($nums, $j+ 1, $h);
    }
}


function partitioning(&$nums, $l, $h) {
    $count = $l+$h;

$pivot = $nums[0];
$i = $l; // i je poceetni index = 0
$j = $h; // j je poslednji index count(arr) - 1

while ($i < $j) {   
    do {
        $i++;
    }while ($nums[$i] <= $pivot);

    do {
        $j--;
     }while ($nums[$j] > $pivot);

    if ($i <= $j) {
        $tmp = $nums[$i];
        $nums[$i] = $nums[$j];
        $nums[$j] = $tmp;
    }
 } 
    $tmp = $nums[$l];
    $nums[$l] = $nums[$j];
    $nums[$j] = $tmp;
    return $j;
}


