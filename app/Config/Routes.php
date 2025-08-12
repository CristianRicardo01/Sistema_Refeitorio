<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PublicoController::index');

// $routes->get('/cadastro', 'PublicoController::cadastro');

$routes->get('/cadastro', 'PublicoController::cadastro');

$routes->get('/cadastro/android', 'PublicoController::cadastroAndroid');
$routes->get('/cadastro/ios', 'PublicoController::cadastroIos');
$routes->get('/cadastro/desktop', 'PublicoController::cadastroDesktop');


$routes->post('/cadastrar', 'PublicoController::cadastrar');
$routes->post('/registrar', 'PublicoController::registrar');

$routes->get('/cardapio', 'Cardapio::cardapio');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');

// Nova rota em Routes.php
$routes->get('/marmita', 'PublicoController::marmita');
$routes->post('/registrar-marmita', 'PublicoController::registrarMarmita');

$routes->group('admin', ['filter' => 'roleauth'], function ($routes) {

    $routes->get('dashboard', 'AdminController::index');

    $routes->get('profile/(:num)', 'AdminController::profile/$1');
    $routes->post('profile/update', 'AdminController::updateProfile');
    $routes->post('profile/update/password', 'AdminController::updatePassword');

    $routes->get('colaborador', 'AdminController::colaborador');
    $routes->post('colaborador/update', 'AdminController::updateColaborador');
    $routes->post('registrar-refeicao', 'AdminController::registrarRefeicao');
    $routes->post('registrar-marmita', 'AdminController::registrarRefeicaoMarmita');

    $routes->get('users', 'AdminController::users');
    $routes->get('users/create', 'AdminController::create');
    $routes->post('users/store', 'AdminController::store');
    $routes->post('users/status', 'AdminController::toggleStatus');

    $routes->get('solicitacao', 'AdminController::solicitacao');

    $routes->get('relatorio', 'AdminController::relatorio');

    $routes->get('config', 'ConfigController::index');
    $routes->post('config/update', 'ConfigController::update');
    $routes->post('config/addSetor', 'ConfigController::addSetor');
    $routes->get('config/toggleSetor/(:num)', 'ConfigController::toggleSetor/$1');

    $routes->get('exportar/csv', 'AdminController::exportarCsv');
    $routes->get('exportar/pdf', 'AdminController::exportarPdf');

    $routes->get('cardapio', 'Cardapio::index');
    $routes->get('cardapio/edit_almoco/(:num)', 'Cardapio::editAlmoco/$1');
    $routes->post('cardapio/update_almoco/(:num)', 'Cardapio::updateAlmoco/$1');

    $routes->get('cardapio/edit_janta/(:num)', 'Cardapio::editJanta/$1');
    $routes->post('cardapio/update_janta/(:num)', 'Cardapio::updateJanta/$1');
});

$routes->group('csv', ['filter' => 'roleauth'], function ($routes) {
    $routes->get('importar-funcionarios', 'FuncionarioImportController::index');
    $routes->post('importar-funcionarios/upload', 'FuncionarioImportController::upload');
});
