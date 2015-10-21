<?php

class DetallesPedidos extends Eloquent
{
	protected $table = "detalles_pedidos";


	public function scopeVistos(){
		$productos =DB::table('detalles_pedidos')
		->leftjoin('productos as productos',	function($join){
							$join->on('detalles_pedidos.id_producto','=','productos.id');
					}) 
		->select(DB::raw('*','id_producto, SUM(cantidad) as cantidad '))
		->where('productos.tipo','=','alimento')
		->groupBy('id_producto')
		->orderBy('cantidad','ASC');
	
		return $productos;
	}
		public function scopeVistos2(){
		$productos =DB::table('detalles_pedidos')
		->leftjoin('productos as productos',	function($join){
							$join->on('detalles_pedidos.id_producto','=','productos.id');
					}) 
		->select(DB::raw('*','id_producto, SUM(cantidad) as cantidad '))
		->where('productos.tipo','=','bebida')
		->groupBy('id_producto')
		->orderBy('cantidad','ASC');
	
		return $productos;
	}

}