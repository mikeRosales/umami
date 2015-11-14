
<?php

class RepartidorController extends \BaseController {
	public function getEnvios(){
		$envios = Envios::where('estatus','=','pendiente')->get();
		return json_encode($envios);
	}	
	public function enviarA(){
		$envio = Envios::find(Input::get('idEnvio'))->first();
		$coordenadas = Input::get('coordenadas');
		$envio->coordenadasA = $coordenadas;
		$envio->save();
		return Response::json('modificacion registrada con exito');
	}
	public function marcarE()
	{
			$envio = Envios::find(Input::get('idEnvio'))->first();
			$envio->estatus = 'entregado';
			$envio->save();
			return Response::json('success');
	}
}