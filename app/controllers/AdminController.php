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
		return View::make('Admin.alimentos',compact('alimentos'));
		
	}
	public function bebidas()
	{
		$bebidas=Productos::where('tipo','=','bebida')->get();
		return View::make('Admin.bebidas',compact('bebidas'));
		
	}
	public function restaurantes()
	{
		$restaurantes= Restaurantes::where('validado','=','1')->get();
		return View::make('Admin.restaurantes',compact('restaurantes'));
	}		
	public function informes()
	{
		$id= Auth::user()->id_restaurante;
		$pedidos=Pedidos::pagadas($id)->count();
	

		
		if($pedidos==0){
 			return View::make('Admin.informes2');	
 		}

 		else{
		$VT = Pedidos::pagadasAdmin($id)->sum('total');
				
		$IVA = Pedidos::pagadasAdmin($id)->sum('iva');
		$IMPORTE = $VT-$IVA;
		$NuOrdenes = Pedidos::pagadasAdmin($id)->count();

		$OM = Pedidos::pagadasAdmin($id)->max('total');
		$MO = Pedidos::pagadasAdmin($id)->min('total');
		$OP = Pedidos::pagadasAdmin($id)->avg('total');
	
		return View::make('Admin.informes',compact('VT','IVA','IMPORTE','NuOrdenes','OM','MO','OP'));
		}
	}
	public function usuarios()
	{
		$usuarios = Usuarios::where('id_nivel', '=', 1)->get();
		
		return View::make('Admin.usuarios',compact('usuarios'));
	}
	public function estadisticas()
	{
		
		
		return View::make('Admin.estadisticas');
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
	{
		$valor = Input::get('activar');
		$activa = Input::get('opt');
		$categoria = Categorias::find($valor);
		$categoria->activa = $activa;
		$categoria->save();
			return Redirect::back()->with('message','Cambios con exito');
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


}
