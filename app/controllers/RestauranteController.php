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
		$restaurante = Restaurantes::find(Auth::user()->id_restaurante);
		$reservaciones = Reservaciones::res(Auth::user()->id_restaurante);
		
		$detallesR = Reservaciones::consulta()->get();
		return View::make('Restaurante.hogar',compact('pedidos','detalles','reservaciones','detallesR','restaurante'));
	}


	public function hogarPedidos(){
		
		$pedido = Pedidos::find(Input::get('idpedido'));
		$user =    	$usuario = User::where('id','=',$pedido->id_usuario)->first();
	
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
	public function rescon()
	{
		$reservacion = Reservaciones::find(Input::get('idreservacion'));
		$user =    	$usuario = User::where('id','=',$reservacion->id_usuario)->first();
		$restaurantes = Restaurantes::find($reservacion->id_restaurante)->first();
		if(Input::has('Confirmar'))
		{

			$reservacion->estatus = 'confirmada';
			$reservacion->save();
			$restaurantes->confirmadas = $restaurantes->confirmadas + 1;
			$restaurantes->save();
			return Redirect::to('/')->with('success','reservacion Aceptada Con Exito');

		}
		elseif (Input::has('Declinar')) 
		{
			$reservacion->estatus = 'declinada';
			$reservacion->save();
			return Redirect::to('/')->with('success','reservacion Cancelada Con Exito');
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
		$cat =  Categorias::find($producto->id_categoria);

	$categorias = Categorias::where('activa','=','1')->lists('nombre','id');		
		return View::make('Restaurante.editarProducto',compact('producto','cat','categorias'));
	}
	public function saveChanges()
	{	$producto = Productos::find(Input::get('id'));
		$image = Input::file('imgFile');
		$cat = Input::get('categoria');
		if($image!=null){
			$producto->imagen = $image_final;
			$name_image = $image -> getClientOriginalName();	
			$image_final = 'productos/' .$name_image;
			$image -> move('productos', $name_image );
		}
			
	
		$producto->nombre = Input::get('nombre');
		$producto->descripcion = Input::get('descripcion');
		$producto->precio = Input::get('precio');
		$producto->iva = Input::get('comision');
		$producto->costo_unitario = Input::get('costo_unitario');
		$producto->id_restaurante = Auth::user()->id_restaurante;
		$producto->id_sabor = Input::get('sabor');
		if($cat != 0){
			$producto->id_categoria = $cat;
		}
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
		$producto->iva = Input::get('comision');
		$producto->costo_unitario = Input::get('costo_unitario');
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
		$producto->iva = Input::get('comision');
		$producto->costo_unitario = Input::get('costo_unitario');
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
		$pedidos = Pedidos::pedidosDos(Auth::user()->id_restaurante);
			$detalles = Pedidos::consulta()->get();
		return View::make('Restaurante.pedidos',compact('pedidos','detalles'));
	}	
		public function noAtendidas()
	{
		$pedidos = Pedidos::pedidosCuatro(Auth::user()->id_restaurante);
			$detalles = Pedidos::consulta()->get();
		return View::make('Restaurante.noAtendidas',compact('pedidos','detalles'));
	}	
		public function declinadas()
	{
		$pedidos = Pedidos::pedidosTres(Auth::user()->id_restaurante);
			$detalles = Pedidos::consultaDos()->get();
		return View::make('Restaurante.pedidos',compact('pedidos','detalles'));
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
	
		return View::make('Restaurante.informes',compact('VT','IMPORTE','NuOrdenes','OM','MO','OP'));
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
		$estadisticas = Estadisticas::where('id_restaurante', '=', $id)->get();
		$restaurante = Restaurantes::find(Auth::user()->id_restaurante);
		if($pedidos==0){
 			return View::make('Restaurante.estadisticas2');	
 		}
 		else{		
 			
 			$cantidad = Pedidos::cantidad()->get();
 		
		return View::make('Restaurante.estadisticas',compact('estadisticas','cantidad','restaurante'));
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
	public function facturas()
	{	
	
		$Facturas = FacturarR::propias(Auth::user()->id_restaurante)->get();
	
		return View::make('Restaurante.facturas',compact('Facturas'));

	}
	public function factura($id)
	{
		$factura = FacturarR::unica($id)->get();
		return View::make('Restaurante.FacturaA',compact('factura'));
	}
	public function facturaM()
	{
		$factura = FacturarR::find(Input::get('id'));
		$factura->estatus = 'facturada';
		$factura->save();
		return Redirect::to('restaurante/facturas')->with('message','Factura guardada con éxito');
	}
	public function facturacion()
	{

			$factura = New Facturas;
			$factura->nombreUsuario = Input::get('nombre');
			$factura->Domicilio = Input::get('domicilio');
			$factura->rfc = Input::get('RFC');
			$factura->correo = Input::get('Correo');
												
			$factura->save();
			return Redirect::to('restaurante/hogar')->with('message','factura guardada con éxito');
			
				
	}

}
