<?php

use Laravel\Lumen\Routing\Router;

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

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'x-hub-signature'], function () use ($router) {
    $router->post('/payload/{project}', ['as' => 'payload', 'uses' => 'PayloadController@actionPayload']);
});


$router->group(['prefix' => 'project'], function () use ($router) {
    $router->get('/', ['as' => 'project.list', 'uses' => 'ProjectController@actionList']);
    $router->post('/', ['as' => 'project.create', 'uses' => 'ProjectController@actionCreate']);

    $router->group(['prefix' => '{project}'], function () use ($router) {
        $router->get('/', ['as' => 'project.view', 'uses' => 'ProjectController@actionView']);
        $router->put('/', ['as' => 'project.update', 'uses' => 'ProjectController@actionUpdate']);
        $router->delete('/', ['as' => 'project.delete', 'uses' => 'ProjectController@actionDelete']);



    });
});
