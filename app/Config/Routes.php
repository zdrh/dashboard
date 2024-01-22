<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('login', 'Main::login');
$routes->post('login-complete', 'Main::loginComplete');
$routes->get('login2', 'Main::login2');

$routes->get('register', 'Main::register');
$routes->get('register2', 'Main::register2');
$routes->post('register-complete', 'Main::registerComplete');
$routes->post('register-username', 'Main::registerUsername');
$routes->post('register-email', 'Main::registerEmail');
$routes->get('pokus', 'Main::pokus');
$routes->get('forgotten-password', 'Main::forgottenPassword');
$routes->post('forgotten-password-complete', 'Main::forgottenPasswordComplete');
$routes->get('forgotten-password-message', 'Main::forgottenPasswordMessage');



$routes->group('admin', ['filter' => ['auth']], static function($routes){
    $routes->get('routes', 'Admin::routes');
    $routes->get('routes/index', 'Route::index');
    $routes->get('route/edit/(:num)', 'Route::edit/$1');
    $routes->put('route/update/(:num)', 'Route::update/$1');
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('logout', 'Admin::logout');
    $routes->get('profile/edit', 'Profile::edit');
    $routes->get('users', 'User::index');
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->put('user/update/(:num)', 'User::update/$1');
    $routes->get('user/delete/(:num)', 'User::delete/$1');
    $routes->delete('user/remove/(:num)', 'User::remove/$1');
});
