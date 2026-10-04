<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Landing page — the site's root URL
$routes->get('/', 'Pages::landing');

// About page
$routes->get('about', 'Pages::about');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->get('logout', 'Auth::logout');

// Customer Accounts page — lists records from a static array for now
$routes->get('customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('customers/new', 'Customers::new', ['filter' => 'auth']);
$routes->post('customers', 'Customers::create', ['filter' => 'auth']);
$routes->get('customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('customers/update/(:num)', 'Customers::update/$1', ['filter' => 'auth']);

// User Accounts page — lists staff records from a static array for now
$routes->get('users', 'Users::index', ['filter' => 'auth']);
$routes->get('users/new', 'Users::new', ['filter' => 'auth']);
$routes->post('users', 'Users::create', ['filter' => 'auth']);
$routes->get('users/edit/(:num)', 'Users::edit/$1', ['filter' => 'auth']);
$routes->post('users/update/(:num)', 'Users::update/$1', ['filter' => 'auth']);
