<?php

class UserController extends \BaseController {
	
			
	public function alimentos()
	{
			
			date_default_timezone_set('America/Mexico_City');
			$hora = date('H:i:s');
			$alimentos=Productos::alimentosUser($hora);			
				
			return json_encode($alimentos);
	

		
	}
	public function bebidas()
	{
		
			date_default_timezone_set('America/Mexico_City');
			$hora = date('H:i:s');
			$bebidas=Productos::bebidasUser($hora);			
			return json_encode($bebidas);
		

		
	}
	public function restaurantes()
	{
	
		
		$restaurantes=Restaurantes::all();
		return json_encode($restaurantes);
		
		
	}
	public function pedidos(){
		
		$usuario = User::where('username','=',Input::get('username'))->get();

		$producto = Input::get('nombre');
		$cantidad = Input::get('cantidad');
		$restaurante = Input::get('restaurante');
		$productos = json_decode($producto);
		$cantidades = json_decode($cantidad);
		$usuario{0}->direccion = Input::get('direccion');
		$usuario{0}->save();
		
			
		$pedido = new Pedidos;
		$pedido->domicilio = Input::get('direccion');
		$pedido->total = Input::get('costo');
		$pedido->id_restaurante = $restaurante;
		$pedido->id_usuario = $usuario{0}->id;
		$pedido->estatus = "pendiente";
		$pedido->save();
		
		for ($x = 0; $x < count($productos); $x++) {
			$detalles = new DetallesPedidos;
			$detalles->id_pedido = $pedido->id;
			$detalles->id_producto = $productos[$x];
			$detalles->cantidad = $cantidades[$x];
			$detalles->subtotal = Input::get('costo');
			$detalles->save();
		}
		return Response::json($pedido->id);
			

	}
	public function factura(){
	
		$factura = new Facturas;
		$factura->nombreF = Input::get('nombredelafactura');
		$factura->nombreUsuario =  Input::get('nombre_factura');
		$factura->Domicilio =  Input::get('domiciliofiscal');
		$factura->rfc = Input::get('rfc');
		$factura->correo = Input::get('correo_factura');
		$factura->costo = Input::get('costo');
		$factura->save();
		return Response::json('success');
	}

	public function platilloEsp(){
			date_default_timezone_set('America/Mexico_City');
			$hora = date('H:i:s');
			$id = Input::get('id');
			$alimentos=Productos::platilloEsp($hora,$id);			
				
			return json_encode($alimentos);
	}
	public function addPlatillo(){
			date_default_timezone_set('America/Mexico_City');
			$hora = date('H:i:s');
			$producto=Productos::find(Input::get('id'));
			$alimentos=Productos::moreAli($hora,$producto->id_restaurante);			
				
			return json_encode($alimentos);
	}

	public function payment() {
        Conekta::setApiKey("key_yVL2GZrKn87qN2rE");
      	Conekta::setLocale('es');
        try {
            $charge = Conekta_Charge::create(array(
            "amount" => 5000,
            "currency" => "MXN",
            "description" => "CPMX5 Payment",
            "reference_id"=> "orden_de_id_interno",
            "card" => Input::get('conektaTokenId') //"tok_a4Ff0dD2xYZZq82d9"
            ));
        } catch (Conekta_Error $e) {

           return Response::json($e->getMessage());

        }
        
        	return Response::json($charge->status);
        
    }
}