<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/poems', [
    'uses' => 'PoemsController@index',
    'as' => 'poems.index',
]);

$router->get('poems/{id}', [
    'uses' => 'PoemsController@show',
    'as' => 'poems.show',
]);

$router->post('user-registrations', [
    'uses' => 'UserRegistrationsController@store',
    'as' => 'user-registrations.store',
]);

$router->post('auth/login', [
    'uses' => 'AuthController@login',
    'as' => 'auth.login',
]);

