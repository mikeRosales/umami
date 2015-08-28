<?php

class Reservaciones extends Eloquent
{
	protected $table = "reservaciones";

		public function scopeConsulta($query){

			$query =DB::table('reservaciones')
					
				

					->leftjoin('detalles_reservacion as detalles',	function($join){
							$join->on('detalles.id_reservacion','=','reservaciones.id');
					})

					->leftjoin('productos',	function($join){
							$join->on('productos.id','=','detalles.id_producto');
					})		

					->orderBy('detalles.id_reservacion')	

					->select('reservaciones.id','detalles.id_reservacion','detalles.mesa','detalles.cantidad', 'productos.nombre');

					return $query;
		
	}
}
