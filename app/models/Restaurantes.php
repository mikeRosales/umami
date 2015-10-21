<?php

class Restaurantes extends Eloquent
{
	protected $table = "restaurantes";

	public function scopeBuscarR($coincidencias, $texto){
		$coincidencias =DB::table('restaurantes as Restaurantes')

		->where('Restaurantes.nombre','LIKE','%'.$texto.'%')


		->where('Restaurantes.validado','=',' 1')




				

		->select('*');
			
		return $coincidencias;
	}

	public function scopeEstadisticas()
	{
		$restaurantes =DB::table('restaurantes as Restaurantes')
		->leftjoin('detalles_pedidos as detalles',	function($join){
					$join->on('detalles.id_pedido','=','pedidos.id');
		})
		->leftjoin('detalles_pedidos as detalles',	function($join){
					$join->on('detalles.id_pedido','=','pedidos.id');
		})
		;
	}
}