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
$router->get('/admin', 'AdminDashboardController@index')->middleware('auth');
$router->group('/admin', function(Router $router) {
    $router->get('/services', 'AdminServiceController@index')->middleware('auth');
    $router->match(['GET','POST'], '/services/create', 'AdminServiceController@create')->middleware('auth');
    $router->match(['GET','POST'], '/services/{id}/edit', 'AdminServiceController@edit')->middleware('auth');
    $router->post('/services/{id}/delete', 'AdminServiceController@delete')->middleware('auth');

    $router->get('/posts', 'AdminPostController@index')->middleware('auth');
    $router->match(['GET','POST'], '/posts/create', 'AdminPostController@create')->middleware('auth');
    $router->match(['GET','POST'], '/posts/{id}/edit', 'AdminPostController@edit')->middleware('auth');
    $router->post('/posts/{id}/delete', 'AdminPostController@delete')->middleware('auth');

    $router->get('/quotes', 'AdminQuoteController@index')->middleware('auth');
    $router->post('/quotes/{id}/status', 'AdminQuoteController@updateStatus')->middleware('auth');

    $router->get('/faqs', 'AdminFaqController@index')->middleware('auth');
    $router->match(['GET','POST'], '/faqs/create', 'AdminFaqController@create')->middleware('auth');
    $router->match(['GET','POST'], '/faqs/{id}/edit', 'AdminFaqController@edit')->middleware('auth');
    $router->post('/faqs/{id}/delete', 'AdminFaqController@delete')->middleware('auth');

    $router->match(['GET','POST'], '/settings', 'AdminSettingsController@index')->middleware('auth');
    $router->get('/users', 'AdminUserController@index')->middleware('auth');
    $router->match(['GET','POST'], '/users/create', 'AdminUserController@create')->middleware('auth');
    $router->match(['GET','POST'], '/users/{id}/edit', 'AdminUserController@edit')->middleware('auth');
    $router->post('/users/{id}/delete', 'AdminUserController@delete')->middleware('auth');
});
