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
		$reservaciones = Reservaciones::All();
		$detallesR = Reservaciones::consulta()->get();
		return View::make('Restaurante.hogar',compact('pedidos','detalles','reservaciones','detallesR'));
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
	public function alimentos()
	{
		$alimentos=Productos::where('tipo','=','alimento')->get();
		return View::make('Restaurante.alimentos',compact('alimentos'));
	}
	public function bebidas()
	{
		$bebidas=Productos::where('tipo','=','bebida')->get();
		return View::make('Restaurante.bebidas',compact('bebidas'));
		
	}
	public function editar(){
		$producto = Productos::find(Input::get('producto_id'));
		return View::make('Restaurante.editarProducto',compact('producto'));
	}
	public function pedidos()
	{
	
		return View::make('Restaurante.pedidos');
	}		
	public function informes()
	{
	
		return View::make('Restaurante.informes');
	}
	public function datos()
	{
	
		return View::make('Restaurante.datos');
	}


}
