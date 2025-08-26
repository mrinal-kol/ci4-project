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
$routes->get('jobPost', 'Hello::jobpost');
//$routes->post('sendjobPost', 'Hello::jobpostemail');
$routes->get('upload-image', 'Hello::pdfConvert');
$routes->post('upload-image', 'Hello::uploadImage');
$routes->match(['get', 'post'], 'sendjobPost', 'Hello::jobpostemail');

//$routes->setAutoRoute(true);
