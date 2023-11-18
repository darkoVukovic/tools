<?php 
// file that is been initialized during every request
require_once '../vendor/autoload.php';
require_once '../core/helpers.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

spl_autoload_register(function ($class) {
    //from rootpath tools/
    $file = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});
require_once '../mvc/Config/Routes.php';
use core\app;

// Autoloader function


$app  = new App();
$app->run();
?>