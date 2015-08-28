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
	public function scopeVT(){
		$VT =DB::table('pedidos')
		->where('pedidos.estatus','=','confirmada')
		->sum('pedidos.total');

		return $VT;
	}
	public function scopeImporte(){
		
	}
	public function scopeIVA(){
		
	}
	public function scopeNuOrdenes(){
			$NuOrdenes =DB::table('pedidos')
		->where('pedidos.estatus','=','confirmada')
		->count();
		return $NuOrdenes;
	}
	public function scopeOM(){
		$OM =DB::table('pedidos')
		->where('pedidos.estatus','=','confirmada')
		->min('pedidos.total');
		return $OM;
	}
	public function scopeMO(){
			$MO =DB::table('pedidos')
		->where('pedidos.estatus','=','confirmada')
		->max('pedidos.total');
		return $MO;
	}
	public function scopeOP(){
		$OP =DB::table('pedidos')
		->where('pedidos.estatus','=','confirmada')
		->avg('pedidos.total');
		return $OP;
	}
}