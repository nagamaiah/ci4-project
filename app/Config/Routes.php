<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/cart', 'ProductController::cart');
$routes->get('/products/add', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/products/show/(:num)', 'ProductController::show/$1');
