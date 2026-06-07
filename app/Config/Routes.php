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
$routes->get('/logout', 'Auth\AuthController::logout');

// Admin Sistem
$routes->group('admin', ['filter' => 'role:admin_sistem'], function($routes) {
    $routes->get('dashboard', 'Controlpanel\AdminController::dashboard');
    $routes->get('kelolaUser', 'Controlpanel\AdminController::kelolaUser');
});

// Operator Dinas
$routes->group('operator-dinas', ['filter' => 'role:operator_dinas'], function($routes) {
    $routes->get('dashboard', 'Controlpanel\OperatorDinasController::dashboard');
    
});

// Operator Maps
$routes->group('operator-maps', ['filter' => 'role:operator_maps'], function($routes) {
    $routes->get('dashboard', 'Controlpanel\OperatorMapsController::dashboard');
    $routes->get('input-data-sekolah', 'Controlpanel\OperatorMapsController::inputDataSekolah');
    $routes->get('sekolah/tambah', 'Controlpanel\SekolahController::tambah');
    $routes->post('sekolah/simpan', 'Controlpanel\SekolahController::simpan');
    $routes->get('sekolah/peta', 'Controlpanel\SekolahController::peta');
    $routes->get('profile', 'Controlpanel\OperatorMapsController::profile');
});