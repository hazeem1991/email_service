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
$router->group(['prefix' => 'messages'], function () use ($router) {
    $router->get('/','MessageController@getIndex');
    $router->get('/add','MessageController@getAddMessageForm');
    $router->post('/add','MessageController@postAddMessageForm');
});
$router->group(['prefix' => 'log'], function () use ($router) {
    $router->get('/','LogController@getIndex');
});
$router->group(['prefix' => 'provider_account'], function () use ($router) {
    $router->get('/','ProviderAccount@getIndex');
    $router->get('/add','ProviderAccount@getAddAccount');
    $router->post('/add','ProviderAccount@postAddAccount');
    $router->get('/edit','ProviderAccount@getEditAccount');
    $router->post('/edit','ProviderAccount@postEditAccount');
});
