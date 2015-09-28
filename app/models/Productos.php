<?php

class Productos extends Eloquent
{
	protected $table = "productos";

	public function scopeAlimentosUser($alimentos, $hora){
		$alimentos =DB::table('productos as Productos')

		->leftjoin('restaurantes as Restaurantes',	function($join){
				$join->on('Restaurantes.id','=','Productos.id_restaurante');
		})
		->where('Restaurantes.validado','=',' 1')

		->where('Productos.hora_inicio','<', $hora)

		->where('Productos.hora_fin','>', $hora)

		->where('Productos.tipo','=', 'alimento')

		->select('*','Productos.nombre as nombreP','Productos.id as idP')
		
		
		->get();
		return $alimentos;
	}
	public function scopeMisP($alimentos, $id){
		$alimentos =DB::table('productos as Productos')


		->where('Productos.id_restaurante','=', $id)

		->where('Productos.tipo','=', 'alimento');
					
		
		return $alimentos;
	}
	public function scopeMisB($alimentos, $id){
		$alimentos =DB::table('productos as Productos')


		->where('Productos.id_restaurante','=', $id)

		->where('Productos.tipo','=', 'bebida');
					
		
		return $alimentos;
	}
	public function scopePlatilloEsp($alimentos, $hora, $id){
		$alimentos =DB::table('productos as Productos')

		->leftjoin('restaurantes as Restaurantes',	function($join){
				$join->on('Restaurantes.id','=','Productos.id_restaurante');
		})
		->where('Restaurantes.validado','=',' 1')

		->where('Productos.id','=', $id)
		
		->where('Productos.hora_inicio','<', $hora)

		->where('Productos.hora_fin','>', $hora)

		->select('*','Productos.nombre as nombreP','Productos.id as idP')

		->get();
		return $alimentos;
	}
		public function scopeMoreAli($alimentos, $hora, $id){
		$alimentos =DB::table('productos as Productos')

		->leftjoin('restaurantes as Restaurantes',	function($join){
				$join->on('Restaurantes.id','=','Productos.id_restaurante');
		})		

		->where('Productos.id_restaurante','=', $id)
		
		->where('Productos.hora_inicio','<', $hora)

		->where('Productos.hora_fin','>', $hora)
		
		->select('*','Productos.nombre as nombreP','Productos.id as idProducto')								

		->get();
		return $alimentos;
	}


	public function scopeBebidasUser($alimentos, $hora){
		$alimentos =DB::table('productos as Productos')

		->leftjoin('restaurantes as Restaurantes',	function($join){
				$join->on('Restaurantes.id','=','Productos.id_restaurante');
		})
		->where('Restaurantes.validado','=',' 1')

		->where('Productos.hora_inicio','<', $hora)

		->where('Productos.hora_fin','>', $hora)

		->where('Productos.tipo','=', 'bebida')


		
		->get();
		return $alimentos;
	}

	public function scopePorCategoria($productos,$categoria){

		date_default_timezone_set('America/Mexico_City');
		
		$productos = DB::table('productos as Productos')

		->where('Productos.hora_inicio','<', date('H:i:s'))

		->where('Productos.hora_fin','>', date('H:i:s'))

		->where('Productos.id_categoria','=',$categoria)

		->leftjoin('restaurantes as Restaurantes',	function($join){
				$join->on('Restaurantes.id','=','Productos.id_restaurante');
		})

		->where('Restaurantes.validado','=','1');

	
		
		return $productos;
	}
}