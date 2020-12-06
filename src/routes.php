<?php

use App\Router;

/**
 * Web routes
 */
Router::get('/', 'Controllers\HomeController@index');
Router::get('/task', 'Controllers\TaskController@index');
Router::get('/task/(:any)', 'Controllers\TaskController@show');
Router::get('/task/create', 'Controllers\TaskController@create');
Router::post('/task/create', 'Controllers\TaskController@store');
Router::get('/task/update/(:any)', 'Controllers\TaskController@edit');
Router::post('/task/update', 'Controllers\TaskController@update');
Router::delete('/task/delete/(:any)', 'Controllers\TaskController@delete');

Router::get('/register', 'Controllers\AuthController@registerForm');
Router::post('/register', 'Controllers\AuthController@register');
Router::get('/login', 'Controllers\AuthController@loginForm');
Router::post('/login', 'Controllers\AuthController@login');
Router::get('/logout', 'Controllers\AuthController@logout');


/**
 * Admin routes
 */
Router::get('/admin', 'Controllers\AdminController@loginForm');
Router::post('/admin', 'Controllers\AdminController@login');
Router::get('/admin/logout', 'Controllers\AdminController@logout');

Router::get('/admin/task', 'Controllers\AdminTaskController@index');
Router::get('/admin/task/(:any)', 'Controllers\AdminTaskController@show');
Router::post('/admin/task/update', 'Controllers\AdminTaskController@update');
Router::get('/admin/task/update/(:any)', 'Controllers\AdminTaskController@edit');


/**
 * There is no route defined for a certain location
 */
Router::error(function () {
    die('404 Page not found');
});

/**
 * Uncomment this function to migrate tables
 * It will commented automatically again
 */
//createTables();
Router::dispatch();
