<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::loginProcess');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::registerProcess');
$routes->get('/forget_password', 'Home::forget_password');
$routes->get('/dashboard', 'Home::dashboard');