<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function pedidos()
	{

		$pedidos= Pedidos::pedidos();		
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
		$restaurantes= Restaurantes::all();
		return View::make('Admin.restaurantes',compact('restaurantes'));
	}		
	public function informes()
	{
		$VT = Pedidos::VT();
		$IVA = Pedidos::IVA();
		$NuOrdenes = Pedidos::NuOrdenes();
		$OM = Pedidos::OM();
		$MO = Pedidos::MO();
		$OP = Pedidos::OP();
	
		return View::make('Admin.informes',compact('VT','IVA','NuOrdenes','OM','MO','OP'));
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




}
