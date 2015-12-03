<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function pedidos()
	{

		$pedidos= Pedidos::Admin();		
		return View::make('Admin.pedidos',compact('pedidos'));
	}
public function publicidad()
	{

				
		return View::make('Admin.publicidad');
	}
	public function alimentos()
	{
		
		$alimentos=Productos::where('tipo','=','alimento')->get();
		$mensaje = 0;
		return View::make('Admin.alimentos',compact('alimentos','mensaje'));
		
	}
	public function bebidas()
	{
		$bebidas=Productos::where('tipo','=','bebida')->get();
		$mensaje = 0;
		return View::make('Admin.bebidas',compact('bebidas','mensaje'));
		
	}
	public function restaurantes()
	{
		$restaurantes= Restaurantes::where('validado','=','1')->get();
		return View::make('Admin.restaurantes',compact('restaurantes'));
	}		
	public function informes()
	{
		$id= Auth::user()->id_restaurante;
		$pedidos=Pedidos::pagadasAdmin()->count();
	

		
		if($pedidos==0){
 			return View::make('Admin.informes2');	
 		}

 		else{
		$VT = Pedidos::pagadasAdmin()->sum('total');
				
		
		
		$NuOrdenes = Pedidos::pagadasAdmin()->count();

		$OM = Pedidos::pagadasAdmin()->max('total');
		$MO = Pedidos::pagadasAdmin()->min('total');
		$OP = Pedidos::pagadasAdmin()->avg('total');
	
		return View::make('Admin.informes',compact('VT','IMPORTE','NuOrdenes','OM','MO','OP'));
		}
	}
	public function usuarios()
	{
		$usuarios = Usuarios::where('id_nivel', '!=', 1)->get();
		
		return View::make('Admin.usuarios',compact('usuarios'));
	}
	public function estadisticas()
	{
		$restaurantes = Pedidos::estadisticas()->get(); 
		$nuevafecha = date('Y-m-d', strtotime('+3 day')) ;
		$cantidad = Pedidos::cantidad()->get();
		$credito = Estadisticas::where('tipo', '=','tarjeta')->get();
		$efectivo = Estadisticas::where('tipo', '=','efectivo')->get();		
		
	
		return View::make('Admin.estadisticas',compact('restaurantes','cantidad','nuevafecha','efectivo','credito'));
	}
	public function candidatos(){
		$candidatos = Restaurantes::where('validado','=','0')->get();
		return View::make('Admin.candidatos',compact('candidatos'));
	}

	public function candidato($id)
	{
		$candidato=Restaurantes::where('id','=',$id)->get();
		$candidato = $candidato[0];

		return View::make('Admin.candidato',compact('candidato'));
		
	}
	public function validar()
	{	

		$rules = array(			
			'password'	       => 'required',
			'user'				=> 'required'
	
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput(Input::all());
		} else {

			$candidato=Restaurantes::where('id','=',Input::get('id'))->get();
			$candidato[0]->validado = 1;
			$candidato[0]->save();

			$usuario=new User;
			$usuario->username 	=	Input::get('user');
			$usuario->password 	=	Hash::make(Input::get('password'));
			$usuario->id_nivel = 2;
			$usuario->id_restaurante = Input::get('id') ;
			$usuario->save();

			return Redirect::to('admin/candidatos')->with('message','Restaurante aceptado con éxito');
		}

	}
	public function borrar_candidato()
	{
			$candidato=Restaurantes::where('id','=',Input::get('id'))->get();
			$candidato[0]->delete();
			return Redirect::to('admin/candidatos')->with('message','Restaurante eliminado con éxito');
	}
	public function categorias()
	{
		$categorias = Categorias::All();
		return View::make('Admin.categorias',compact('categorias'));

	}
	public function activar()
	{	dd(Input::All());
		// $valor = Input::get('activar');
		// $activa = Input::get('opt');
		// $categoria = Categorias::find($valor);
		// $categoria->activa = $activa;
		// $categoria->save();
		// 	return Redirect::back()->with('message','Cambios con exito');
	}
	public function publicar()
	{
		$publicidad = new Publicidad;
		$image = Input::file('imagen');
		if($image!=null){
			
				$name_image = $image -> getClientOriginalName();	
				$image_final = 'publicidad/' .$name_image;
				$publicidad->imagen = $image_final;
				$image -> move('publicidad', $name_image );
			}
		$date = DateTime::createFromFormat('d/m/Y', Input::get('date'));
		$date=$date->format('Y-m-d');
		
		$publicidad->descripcion = Input::get('descripcion');
		$publicidad->dia = $date;
		$publicidad->hora_inicio = Input::get('hora_inicio');
		$publicidad->hora_fin = Input::get('hora_fin');
		$publicidad->save();
		return Redirect::back()->with('message','Publicidad subida correctamente');
	}
	public function vistos()
	{
		$alimentos=DetallesPedidos::vistos()->get();

		$mensaje = 1;
		return View::make('Admin.alimentos',compact('alimentos','mensaje'));
	}
	public function maspedidos()
	{
		$alimentos=DetallesPedidos::vistos()->get();

		$mensaje = 2;
		return View::make('Admin.alimentos',compact('alimentos','mensaje'));
	}
	public function precios()
	{
		$alimentos=Productos::where('tipo','=','alimento')->orderBy('costo_unitario','DSC')->get();
		$mensaje = 0;
		return View::make('Admin.alimentos',compact('alimentos','mensaje'));
	}
	public function porcategoria()
	{

		$alimentos=Productos::where('tipo','=','alimento')->get();
		$categorias = Categorias::All();
		return View::make('Admin.alimentos2',compact('alimentos','categorias'));
	}
		public function vistos2()
	{
		$bebidas=DetallesPedidos::vistos2()->get();

		
		$mensaje = 1;
		return View::make('Admin.bebidas',compact('bebidas','mensaje'));
	}
	public function maspedidos2()
	{
		$bebidas=DetallesPedidos::vistos2()->get();

		
		$mensaje = 2;
		return View::make('Admin.bebidas',compact('bebidas','mensaje'));
	}
	public function precios2()
	{
		$bebidas=Productos::where('tipo','=','bebida')->orderBy('costo_unitario','DSC')->get();
		$mensaje = 0;
		return View::make('Admin.bebidas',compact('bebidas','mensaje'));
	}
	public function porcategoria2()
	{

		$bebidas=Productos::where('tipo','=','bebida')->get();
		$categorias = Categorias::All();
		return View::make('Admin.bebidas2',compact('bebidas','categorias'));
	}
		public function vistos3()
	{
		$restaurantes=DetallesPedidos::vistos3()->get();
		
		return View::make('Admin.restaurantes',compact('restaurantes'));
	}
		public function ordenes()
	{
		$variable=Pedidos::pedidas()->get();
		$restaurantes= Restaurantes::where('validado','=','1')->get();	
			
		return View::make('Admin.restaurantes2',compact('restaurantes','variable'));
	}
		public function reservaciones()
	{
		$variable=Reservaciones::reservadas()->get();
		$restaurantes= Restaurantes::where('validado','=','1')->get();			
			
		return View::make('Admin.restaurantes2',compact('restaurantes','variable'));
	}
		public function ventas()
	{
		$variable=Pedidos::total()->get();
		$restaurantes= Restaurantes::where('validado','=','1')->get();			
		
		return View::make('Admin.restaurantes2',compact('restaurantes','variable'));
	}
		public function productos()
	{
		$variable=Productos::rest()->get();
		$restaurantes= Restaurantes::where('validado','=','1')->get();			
		
		return View::make('Admin.restaurantes2',compact('restaurantes','variable'));
	}
		public function op()
	{
		$variable=Pedidos::oP()->get();
		$restaurantes= Restaurantes::where('validado','=','1')->get();			
		
		return View::make('Admin.restaurantes2',compact('restaurantes','variable'));
	}


}
