<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');

$routes->get('/komik/create', 'Komik::create');

$routes->get('/komik/save', 'Komik::save');

$routes->get('/komik/(:segment)', 'Komik::detail/$1');

$routes->setAutoRoute(true);