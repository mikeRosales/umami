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
Route::get('/restaurante/agregarA','RestauranteController@agregarA');
Route::get('/restaurante/agregarB','RestauranteController@agregarb');
Route::post('/restaurante/addA','RestauranteController@addA');
Route::post('/restaurante/addB','RestauranteController@addB');
Route::post('/restaurante/editar','RestauranteController@editar');
Route::post('/restaurante/saveChanges','RestauranteController@saveChanges');

Route::post('condec','RestauranteController@hogarPedidos');