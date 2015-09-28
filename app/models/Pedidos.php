<?php

class Pedidos extends Eloquent
{
	protected $table = "pedidos";

	public function scopePedidos($pedidos,$id){
		$pedidos =DB::table('pedidos')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 
		->where('pedidos.id_restaurante','=',$id)
		->where('pedidos.estatus','=','pendiente')
		->select('*','restaurantes.nombre')
		->get();
		return $pedidos;
	}
		public function scopeAdmin(){
		$pedidos =DB::table('pedidos')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 		
		->select('*','restaurantes.nombre')
		->get();
		return $pedidos;
	}
	public function scopePagadas($pagadas,$id){
		$pagadas = DB::table('pedidos')
			->where('estatus','=','pagada')							
			->where('id_restaurante','=', $id)
			->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					});
		return $pagadas;
	}
		public function scopePagadasAdmin($pagadas,$id){
		$pagadas = DB::table('pedidos')
			->where('estatus','=','pagada')							
			->where('id_restaurante','=', $id)
			->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					});
		return $pagadas;
	}
	public function scopeVendidos($id)
	{
		$pagadas = DB::table('pedidos')
		->where('pedidos.id_restaurante','=',$id)	
		->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					}) 
		->get();
		return $pagadas;
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