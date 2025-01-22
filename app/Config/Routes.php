<?php

use CodeIgniter\Router\RouteCollection;
use DeepCopy\Filter\Filter;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter' => 'noauth']);
//$routes->get('/login', 'Home::index',['filter' => 'noauth']);
//$routes->get('/signup','Home::signup',['filter' => 'noauth']);

$routes->match(['get','post'],'/signup','Home::signup',['filter' => 'noauth']);

$routes->match(['get','post'],'/editUser/(:num)', 'Home::editUser/$1',['filter' => 'noauth']);

$routes->get('/deleteUser/(:num)', 'Home::deleteUser/$1');

$routes->match(['get','post'],'/login','Home::index',['filter'=>'noauth']);
$routes->get('/dashboard','Home::dashboard', ['filter' => 'auth']);
$routes->get('/logout','Home::logout',['filter' => 'auth']);
?>
