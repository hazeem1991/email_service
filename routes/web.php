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
    return redirect('front/dist');
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
    $router->get('/','ProviderAccountController@getIndex');
    $router->get('/add','ProviderAccountController@getAddAccount');
    $router->post('/add','ProviderAccountController@postAddAccount');
    $router->get('/edit/{provider_id}','ProviderAccountController@getEditAccount');
    $router->put('/edit/{provider_id}','ProviderAccountController@postEditAccount');
    $router->delete('/delete/{provider_id}','ProviderAccountController@deleteDeleteAccount');
});