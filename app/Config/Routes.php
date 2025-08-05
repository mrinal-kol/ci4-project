<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('hello', 'Hello::index');
$routes->get('about', 'about::index');
$routes->post('Hello/add', 'Hello::add');
$routes->get('hello/edit/(:num)', 'Hello::edit/$1');
$routes->post('hello/update', 'Hello::update');
//$routes->setAutoRoute(true);
