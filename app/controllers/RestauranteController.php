<?php

class RestauranteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$pedidos = Pedidos::pedidos(Auth::user()->id_restaurante);
		$detalles = Pedidos::consulta()->get();
		$reservaciones = Reservaciones::where('id_restaurante','=',Auth::user()->id_restaurante)->get();
		$detallesR = Reservaciones::consulta()->get();
		return View::make('Restaurante.hogar',compact('pedidos','detalles','reservaciones','detallesR'));
	}


	public function hogarPedidos(){
		
		$pedido = Pedidos::find(Input::get('idpedido'));
		if(Input::has('Confirmar'))
		{
			$pedido->estatus = 'sinPagar';
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
		
		$alimentos=Productos::misP(Auth::user()->id_restaurante)->get();
		return View::make('Restaurante.alimentos',compact('alimentos'));
		
	}
	public function bebidas()
	{
		$bebidas=Productos::misB(Auth::user()->id_restaurante)->get();
		return View::make('Restaurante.bebidas',compact('bebidas'));
		
	}
	public function editar(){
		$producto = Productos::find(Input::get('producto_id'));
		$categorias = Categorias::where('activa','=','1')->lists('nombre','id');		
		return View::make('Restaurante.editarProducto',compact('producto','categorias'));
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
		$producto->id_restaurante = Auth::user()->id_restaurante;
		$producto->id_sabor = Input::get('sabor');
		$producto->id_categoria = Input::get('categoria');
		$producto->hora_inicio = Input::get('hora_inicio'); 
		$producto->hora_fin = Input::get('hora_fin');
		
		$producto->save();

		return Redirect::to('restaurante/alimentos')->with('message','Cambios con exito');
	}
	public function agregarA()
	{
		$categorias = Categorias::where('activa','=','1')->lists('nombre','id');
		return View::make('Restaurante.agregarA')->with('categorias', $categorias);
	}

	public function agregarB()
	{
		$categorias = Categorias::where('activa','=','1')->lists('nombre','id');
		return View::make('Restaurante.agregarB')->with('categorias', $categorias);
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
		$producto->id_restaurante = Auth::user()->id_restaurante;		
		$producto->id_categoria = Input::get('categoria');
		$producto->hora_inicio = Input::get('hora_inicio'); 
		$producto->hora_fin = Input::get('hora_fin');
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
		$producto->id_restaurante = Auth::user()->id_restaurante;
		$producto->id_sabor = Input::get('sabor');
		$producto->id_categoria = Input::get('categoria');
		$producto->hora_inicio = Input::get('hora_inicio'); 
		$producto->hora_fin = Input::get('hora_fin');
		$producto->save();

		return Redirect::to('restaurante/alimentos')->with('message','Cambios con exito');

	}
	public function pedidos()
	{
		$pedidos= Pedidos::where('id_restaurante','=',Auth::user()->id_restaurante)->get();
		return View::make('Restaurante.pedidos',compact('pedidos'));
	}		
	public function informes()
	{
		$id= Auth::user()->id_restaurante;
		$pedidos=Pedidos::pagadas($id)->count();
	

		
		if($pedidos==0){
 			return View::make('Restaurante.informes2');	
 		}

 		else{
		$VT = Pedidos::pagadas($id)->sum('total');
				
		$IVA = Pedidos::pagadas($id)->sum('iva');
		$IMPORTE = $VT-$IVA;
		$NuOrdenes = Pedidos::pagadas($id)->count();

		$OM = Pedidos::pagadas($id)->max('total');
		$MO = Pedidos::pagadas($id)->min('total');
		$OP = Pedidos::pagadas($id)->avg('total');
	
		return View::make('Restaurante.informes',compact('VT','IVA','IMPORTE','NuOrdenes','OM','MO','OP'));
		}
	}
	public function datos()
	{
		$restaurante=Restaurantes::find( Auth::user()->id_restaurante);
		return View::make('Restaurante.datos',compact('restaurante'));
	}

		public function estadisticas()
	{
		
			$id= Auth::user()->id_restaurante;
		$pedidos=Pedidos::pagadas($id)->count();
	

		
		if($pedidos==0){
 			return View::make('Restaurante.estadisticas2');	
 		}

 		else{		
 		$cantidad = Pedidos::pagadas($id)->sum('cantidad');		
		$NuOrdenes = Pedidos::pagadas($id)->count();
		$Reservaciones = Reservaciones::confirmadas($id)->count();
		$OP = Pedidos::pagadas($id)->avg('total');
	
		return View::make('Restaurante.estadisticas',compact('cantidad','NuOrdenes','Reservaciones','OP'));
		}
	}
	public function guardarTarjeta()
	{
			$rules = array(			
			'cuenta'	       => 'required'			
	
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput(Input::all());
		} else {
			$restaurante=Restaurantes::find( Auth::user()->id_restaurante);
			$restaurante->cuenta = Input::get('cuenta');
			$restaurante->save();
			return Redirect::back()->with('message','cuenta guardada con éxito');
		}
	}
	public function imgPerfil()
	{

			$rules = array(			
			
		'imgFile' => 'mimes:jpeg,bmp,png'		
	
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput(Input::all());
		} else {
				$restaurante=Restaurantes::find(Auth::user()->id_restaurante);
				$image = Input::file('imgFile');
				if($image!=null){				
					$name_image = $image -> getClientOriginalName();	
					$image_final = 'restaurantes/' .$name_image;
					$restaurante->imagenR = $image_final;
					$image -> move('restaurantes', $name_image );											
					$restaurante->save();
					return Redirect::back()->with('message','cuenta guardada con éxito');
			}
		}
	}
	



}
