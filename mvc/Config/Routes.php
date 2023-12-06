<?php

use core\Router;

// TODO: URI params (they work kinda)

$routes = new Router();
//$routes->get('/comments )', 'Users', 'index');
/*
$routes->get('/', 'Homepage', 'index');
$routes->get('/homepage', 'Homepage', 'test');
$routes->get('/darecar', 'Homepage', 'test');
*/

//$routes->get('/users/(id-integer)/name/(name-string)', 'Users', 'show');
//$routes->get('/users/(id-integer)/name/(name-string)/surname/(surname-string)', 'Users', 'index');
$routes->get('users/(id-integer)/name/(name-string)', 'Users', 'show');

$routes->get('users/(id-integer)', 'Users', 'show');

$routes->get('/', 'Homepage', 'index');
$routes->get('/homepage', 'Homepage', 'test');
$routes->get('/asdasdasd', 'Homepage', 'index');

$routes->get('/category/sport', 'Users', 'sport');

$routes->get('/users', 'Users', 'index');
$routes->get('/Login', 'Login', 'index');
$routes->get('/pdf/convert', 'Pdf', 'convert');

$routes->post('excel/export', 'excel', 'export');
$routes->post('excel/exported', 'homepage', 'index');
$routes->get('excel', 'excel', 'index');
$routes->get('/users/(id-integer/name/(name-string)/prezime/(prezime-string))', 'Users', 'index');

$routes->get('pdf', 'Pdf', 'index');

$routes->get('bookings', 'Bookings', 'index');
$routes->get('auth/login', 'Bookings', 'login');
$routes->get('auth/logout', 'Bookings', 'logout');



$routes->get('/quicksort', 'homepage', 'quicksort');
