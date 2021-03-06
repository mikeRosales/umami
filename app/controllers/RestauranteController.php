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
			return Redirect::to('/')->with('success','Orden Aceptada Con Exito');

		}
		elseif (Input::has('Declinar')) 
		{
			$pedido->estatus = 'declinada';
			$pedido->save();
			return Redirect::to('/')->with('success','Orden Cancelada Con Exito');
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
	public function saveChanges()
	{	$producto = Productos::find(Input::get('id'));
		$image = Input::file('imgFile');
	
		if($image!=null){
			$producto->imagen = $image_final;
			$name_image = $image -> getClientOriginalName();	
			$image_final = 'productos/' .$name_image;

		$image -> move('productos', $name_image );
		}
			
	
		$producto->nombre = Input::get('nombre');
		$producto->descripcion = Input::get('descripcion');
		$producto->precio = Input::get('precio');
		$producto->costo_unitario = Input::get('costo_unitario');
		
		$producto->save();

		return Redirect::to('restaurante/alimentos')->with('message','Cambios con exito');
	}
	public function agregarA()
	{
		return View::make('Restaurante.agregarA');
	}

	public function agregarB()
	{
		return View::make('Restaurante.agregarB');
	}
	public function addA()
	{
		$image = Input::file('imgFile');
		$producto = new Productos;
		if($image!=null){
			
			$name_image = $image -> getClientOriginalName();	
			$image_final = 'productos/' .$name_image;
			$producto->imagen = $image_final;
			$image -> move('productos', $name_image );
		}
			
	
		$producto->nombre = Input::get('nombre');
		$producto->descripcion = Input::get('descripcion');
		$producto->precio = Input::get('precio');
		$producto->costo_unitario = Input::get('precio_final');
		$producto->tipo = "alimento";
		$producto->id_sabor = Input::get('sabor');
		$producto->id_categoria = Input::get('categoria');
		$producto->save();

		return Redirect::to('restaurante/alimentos')->with('message','Cambios con exito');

	}
	public function addB()
	{
		$image = Input::file('imgFile');
		$producto = new Productos;
		if($image!=null){
	
			$name_image = $image -> getClientOriginalName();	
			$image_final = 'productos/' .$name_image;
		$producto->imagen = $image_final;
		$image -> move('productos', $name_image );
		}
			
	
		$producto->nombre = Input::get('nombre');
		$producto->descripcion = Input::get('descripcion');
		$producto->precio = Input::get('precio');
		$producto->tipo = "bebida";
		$producto->costo_unitario = Input::get('precio_final');
		$producto->id_sabor = Input::get('sabor');
		$producto->id_categoria = Input::get('categoria');
		
		$producto->save();

		return Redirect::to('restaurante/alimentos')->with('message','Cambios con exito');

	}
	public function pedidos()
	{
		$pedidos= Pedidos::all();
		return View::make('Restaurante.pedidos',compact('pedidos'));
	}		
	public function informes()
	{
		$VT = Pedidos::VT();
		$IVA = Pedidos::IVA();
		$NuOrdenes = Pedidos::NuOrdenes();
		$OM = Pedidos::OM();
		$MO = Pedidos::MO();
		$OP = Pedidos::OP();
	
		return View::make('Restaurante.informes',compact('VT','IVA','NuOrdenes','OM','MO','OP'));
	}
	public function datos()
	{
	
		return View::make('Restaurante.datos');
	}


}
