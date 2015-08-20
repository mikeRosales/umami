<?php

class Pedidos extends Eloquent
{
	protected $table = "pedidos";
	public function scopePedidos($pedidos){
		$pedidos =DB::table('pedidos')
		->select('*');
		return $pedidos;
	}
	public function scopeConsulta($query){

			$query =DB::table('pedidos')
					
				

					->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					})

					->leftjoin('productos',	function($join){
							$join->on('productos.id','=','detalles.id_producto');
					})		

					->orderBy('detalles.id_pedido')	

					->select('detalles.id_pedido','detalles.cantidad', 'productos.nombre', 'productos.precio', 'productos.iva','productos.costo_unitario');

					return $query;
		
	}
}