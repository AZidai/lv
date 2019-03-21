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

$router->group(['prefix' => 'api', 'middleware' => 'auth:api'], function () use ($router) {
    $router->delete('/post/{id}', 'PostController@delete');
    $router->delete('/comment/{id}','CommentController@delete');
    $router->put('/post/{id}', 'PostController@update');
    $router->post('/post', 'PostController@create');
    $router->post('/comment','CommentController@create');
    $router->put('/comment/{id}','CommentController@update');
    $router->get('/logout','AuthController@logout');
});
    $router->get('/api/post/{id}', 'PostController@show');
    $router->get('/api/posts', 'PostController@index');
    $router->post('/login', 'AuthController@postLogin');
    $router->post('/register', 'AuthController@postRegister');
    $router->get('/api/post/{id}/comments','CommentController@getCommentsbyPostId');
    

$router->get('/{route:.*}/', function () {
    return view('app');
});
