<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Landing page — the site's root URL
$routes->get('/', 'Pages::landing');

// About page
$routes->get('about', 'Pages::about');

// Customer Accounts page — lists records from a static array for now
$routes->get('customers', 'Customers::index');
$routes->get('customers/new', 'Customers::new');
$routes->post('customers', 'Customers::create');
$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');

// User Accounts page — lists staff records from a static array for now
$routes->get('users', 'Users::index');
$routes->get('users/new', 'Users::new');
$routes->post('users', 'Users::create');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');
