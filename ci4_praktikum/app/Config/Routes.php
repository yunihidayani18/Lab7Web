<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/page/tos', 'Page::tos');

$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:segment)', 'Artikel::view/$1');

$routes->get('/admin/artikel', 'Artikel::admin_index');
$routes->get('/admin/artikel/add', 'Artikel::add');
$routes->post('/admin/artikel/add', 'Artikel::add');
$routes->add('/admin/artikel/edit/(:num)', 'Artikel::edit/$1');
$routes->post('/admin/artikel/update', 'Artikel::update');
$routes->get('/admin/artikel/delete/(:num)', 'Artikel::delete/$1');

$routes->get('/test', 'Test::index');
$routes->post('/test/login', 'Test::login');

$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');
$routes->group('admin', ['filter' => 'auth'], function($routes) {
$routes->get('artikel', 'Artikel::admin_index');
});
$routes->get('/ajax', 'AjaxController::index');
$routes->get('/ajax/getData', 'AjaxController::getData');
$routes->delete('/ajax/delete/(:num)', 'AjaxController::delete/$1');

$routes->resource('post');
$routes->post('api/login', 'Api\Auth::login');
$routes->options('api/login', static function () {
    return response()->setStatusCode(200);
});

