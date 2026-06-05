<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::index');
$routes->get('/register', 'Home::register');
$routes->get('/forget_password', 'Home::forget_password');
$routes->get('/dashboard', 'Home::dashboard');