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

Route::get('/','SessionController@index');
Route::get('/login','SessionController@index');
Route::post('/login','SessionController@getSession');
Route::get('/logout','SessionController@logout');
Route::post('/registro','RegistroController@registrar');
Route::get('/prospectos','RegistroController@index');
Route::post('/prospectos','RegistroController@create');

Route::post('users/login', function()
{
	$remember = Input::get('remember');
	$credentials = array(
		'username' => Input::get('username'), 
		'password' => Input::get('password')
		
	);

	if (Auth::attempt( $credentials ))
	{
		return Response::json('Logged in');
	 	
	}else{
		return Response::json('Error logging in');
		
    }
});


Route::post('/users/pedidos', 'UserController@pedidos');
Route::post('/users/reservaciones', 'UserController@reservaciones');
Route::post('/users/tarjeta', 'UserController@tarjeta');
Route::get('/users/alimentos','UserController@alimentos');
Route::get('/users/bebidas','UserController@bebidas');
Route::post('/users/platilloEsp','UserController@platilloEsp');
Route::post('/users/addAlim','UserController@addPlatillo');
Route::get('/users/restaurantes','UserController@restaurantes');
Route::post('/users/factura','UserController@factura');
Route::post('/users/categorias','UserController@categorias');
Route::post('/users/tarjetas','UserController@tarjetas');
Route::post('/users/modTarjetas','UserController@modTarjetas');
Route::post('/users/modFacturas','UserController@modFacturas');
Route::post('/users/valoracion','UserController@valoracion');
Route::post('/users/tarjetasP','UserController@tarjetasP');
Route::post('/users/facturasP','UserController@facturasP');
Route::resource('/users/payment', 'UserController@payment');
Route::resource('/users/publicidad', 'UserController@getPubli');




Route::group(array('before' => array('auth', 'restaurante')), function()
{
Route::get('/restaurante/hogar','RestauranteController@index');
Route::get('/restaurante/alimentos','RestauranteController@alimentos');
Route::get('/restaurante/bebidas','RestauranteController@bebidas');
Route::get('/restaurante/pedidos','RestauranteController@pedidos');
Route::get('/restaurante/informes','RestauranteController@informes');
Route::get('/restaurante/datos','RestauranteController@datos');
Route::post('/restaurante/datos','RestauranteController@guardarTarjeta');
Route::post('/restaurante/imgPerfil','RestauranteController@imgPerfil');
Route::get('/restaurante/agregarA','RestauranteController@agregarA');
Route::get('/restaurante/agregarB','RestauranteController@agregarb');
Route::post('/restaurante/addA','RestauranteController@addA');
Route::post('/restaurante/addB','RestauranteController@addB');
Route::post('/restaurante/editar','RestauranteController@editar');
Route::post('/restaurante/saveChanges','RestauranteController@saveChanges');
Route::post('condec','RestauranteController@hogarPedidos');
Route::get('/restaurante/estadisticas','RestauranteController@estadisticas');
});

Route::group(array('before' => array('auth', 'admin')), function()
{
Route::get('/admin/pedidos','AdminController@pedidos');
Route::get('/admin/alimentos','AdminController@alimentos');
Route::get('admin/bebidas','AdminController@bebidas');
Route::get('/admin/restaurantes','AdminController@restaurantes');
Route::get('/admin/usuarios','AdminController@usuarios');
Route::get('/admin/informes','AdminController@informes');
Route::get('/admin/datos','AdminController@estadisticas');
Route::get('/admin/estadisticas','AdminController@estadisticas');
Route::get('/admin/publicidad','AdminController@publicidad');
Route::get('/admin/candidatos','AdminController@candidatos');
Route::get('/admin/{id}/candidato','AdminController@candidato');
Route::post('/admin/validar','AdminController@validar');
Route::post('/admin/borrar_candidato','AdminController@borrar_candidato');
Route::get('/admin/categorias','AdminController@categorias');
Route::post('/admin/activar','AdminController@activar');
Route::post('/admin/publicidad','AdminController@publicar');
});
