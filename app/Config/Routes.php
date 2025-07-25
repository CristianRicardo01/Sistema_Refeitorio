<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PublicoController::index');

$routes->get('/cardapio', 'Cardapio::cardapio');

$routes->get('/cadastro', 'PublicoController::cadastro');
$routes->post('/cadastrar', 'PublicoController::cadastrar');

$routes->post('/registrar', 'PublicoController::registrar');

$routes->get('/admin/profile/(:num)', 'AdminController::profile/$1');
$routes->post('/admin/profile/update', 'AdminController::updateProfile');

$routes->post('/admin/profile/update/password', 'AdminController::updatePassword');

$routes->get('/admin/users', 'AdminController::users');
$routes->get('/admin/users/create', 'AdminController::create');
$routes->post('/admin/users/store', 'AdminController::store');
$routes->post('/admin/users/status', 'AdminController::toggleStatus');

$routes->get('/admin/relatorio', 'AdminController::relatorio');
$routes->get('/admin/lancamentos', 'AdminController::lancamentos');

$routes->get('/admin/config', 'ConfigController::index');
$routes->post('/admin/config/update', 'ConfigController::update');

$routes->get('/admin/exportar/csv', 'AdminController::exportarCsv');
$routes->get('/admin/exportar/pdf', 'AdminController::exportarPdf');

$routes->get('/admin/cardapio', 'Cardapio::index');
$routes->get('/admin/cardapio/edit_almoco/(:num)', 'Cardapio::editAlmoco/$1');
$routes->post('/admin/cardapio/update_almoco/(:num)', 'Cardapio::updateAlmoco/$1');

$routes->get('admin/cardapio/edit_janta/(:num)', 'Cardapio::editJanta/$1');
$routes->post('admin/cardapio/update_janta/(:num)', 'Cardapio::updateJanta/$1');



$routes->group('admin', ['filter' => 'roleauth'], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    

});

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin'); //Acminha para autenticar.
$routes->get('/logout', 'AuthController::logout');
