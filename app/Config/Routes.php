<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/buku', 'Buku::index');
$routes->get('/buku/create', 'Buku::create');
$routes->post('/buku/create', 'Buku::create');
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('/buku/edit/(:num)', 'Buku::edit/$1');
$routes->get('/buku/delete/(:num)', 'Buku::delete/$1');

