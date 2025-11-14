<?php
use App\Core\Router;

/** @var Router $router */

// Frontend
$router->get('/', 'HomeController@index');
$router->get('/services', 'ServiceController@index');
$router->get('/services/{slug}', 'ServiceController@show');
$router->get('/pricing', 'PricingController@index');
$router->get('/projects', 'HomeController@projects');
$router->get('/blog', 'BlogController@index');
$router->get('/blog/{slug}', 'BlogController@show');
$router->match(['GET','POST'], '/contact', 'ContactController@index');
$router->match(['GET','POST'], '/quote', 'QuoteController@index');
$router->match(['GET','POST'], '/support', 'SupportController@index');
$router->match(['GET','POST'], '/password/forgot', 'AuthController@forgot');
$router->match(['GET','POST'], '/password/reset', 'AuthController@reset');

// Admin
$router->match(['GET','POST'], '/admin/login', 'AuthController@login');
$router->get('/admin/logout', 'AuthController@logout');
$router->get('/admin', 'AdminController@dashboard')->middleware('auth');
$router->group('/admin', function(Router $router) {
    $router->get('/services', 'AdminController@services')->middleware('auth');
    $router->match(['GET','POST'], '/services/create', 'AdminController@createService')->middleware('auth');
    $router->match(['GET','POST'], '/services/{id}/edit', 'AdminController@editService')->middleware('auth');
    $router->post('/services/{id}/delete', 'AdminController@deleteService')->middleware('auth');

    $router->get('/posts', 'AdminController@posts')->middleware('auth');
    $router->match(['GET','POST'], '/posts/create', 'AdminController@createPost')->middleware('auth');
    $router->match(['GET','POST'], '/posts/{id}/edit', 'AdminController@editPost')->middleware('auth');
    $router->post('/posts/{id}/delete', 'AdminController@deletePost')->middleware('auth');

    $router->get('/quotes', 'AdminController@quotes')->middleware('auth');
    $router->post('/quotes/{id}/status', 'AdminController@updateQuoteStatus')->middleware('auth');

    $router->get('/faqs', 'AdminController@faqs')->middleware('auth');
    $router->match(['GET','POST'], '/faqs/create', 'AdminController@createFaq')->middleware('auth');
    $router->match(['GET','POST'], '/faqs/{id}/edit', 'AdminController@editFaq')->middleware('auth');
    $router->post('/faqs/{id}/delete', 'AdminController@deleteFaq')->middleware('auth');

    $router->match(['GET','POST'], '/settings', 'AdminController@settings')->middleware('auth');
    $router->get('/users', 'AdminController@users')->middleware('auth');
    $router->match(['GET','POST'], '/users/create', 'AdminController@createUser')->middleware('auth');
    $router->match(['GET','POST'], '/users/{id}/edit', 'AdminController@editUser')->middleware('auth');
    $router->post('/users/{id}/delete', 'AdminController@deleteUser')->middleware('auth');
})->middleware('auth');
