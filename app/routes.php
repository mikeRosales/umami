<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/','RestauranteController@index');
Route::get('/restaurante/alimentos','RestauranteController@alimentos');
Route::get('/restaurante/bebidas','RestauranteController@bebidas');
Route::get('/restaurante/pedidos','RestauranteController@pedidos');
Route::get('/restaurante/informes','RestauranteController@informes');
Route::get('/restaurante/datos','RestauranteController@datos');
Route::post('/restaurante/editar','RestauranteController@editar');
Route::post('condec','RestauranteController@hogarPedidos');