<?php

class RestauranteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pedidos = Pedidos::All();
		$detalles = Pedidos::consulta()->get();
	
		return View::make('Restaurante.hogar',compact('pedidos','detalles'));
	}


	public function hogarPedidos(){
		
		$pedido = Pedidos::find(Input::get('idpedido'));
		if(Input::has('Confirmar'))
		{
			$pedido->estatus = 'confirmada';
			$pedido->save();
			return Redirect::to('/');

		}
		elseif (Input::has('Declinar')) 
		{
			$pedido->estatus = 'declinada';
			$pedido->save();
			return Redirect::to('/');
		}
	}


}
