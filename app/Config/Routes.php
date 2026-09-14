<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Landing page — the site's root URL
$routes->get('/', 'Pages::landing');

// About page
$routes->get('about', 'Pages::about');

// Customer Accounts page — lists records from a static array for now
$routes->get('customers', 'Customers::index');

// User Accounts page — lists staff records from a static array for now
$routes->get('users', 'Users::index');