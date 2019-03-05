<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/posts', 'PostController@index');
    $router->get('/post/{id}', 'PostController@show');
    $router->delete('/post/{id}', 'PostController@show');
    $router->put('/post/{id}', 'PostController@update');
    $router->post('/post', 'PostController@create');
});
    $router->post('/login', 'AuthController@postLogin');


$router->get('/{route:.*}/', function () {
    return view('app');
});
