<?php

use core\Router;

// TODO: URI params 

$routes = new Router();

$routes->get('/users/(id-integer)/name/(name-string)', 'Users', 'index');
$routes->get('/users/(id-integer)/name/(name-string)/surname/(surname-string)', 'Users', 'index');

$routes->get('/users/(id-integer)', 'Users', 'index');

$routes->get('/', 'Homepage', 'index');
$routes->get('/homepage', 'Homepage', 'test');
$routes->get('/category/sport', 'Users', 'sport');

$routes->get('/users', 'Users', 'index');
$routes->get('/Login', 'Login', 'index');
$routes->get('/pdf/convert', 'Pdf', 'convert');

$routes->get('/pdf', 'Pdf', 'index');
$routes->get('/excel', 'excel', 'index');
$routes->get('/excel/export', 'excel', 'export');

$routes->get('/pdf/', 'Pdf', 'index');

$routes->get('/users/(id-integer/name/(name-string)/prezime/(prezime-string))', 'Users', 'index');

