<?php

class Pedidos extends Eloquent
{
	protected $table = "pedidos";

	public function scopePedidos($pedidos,$id){
		$pedidos =DB::table('pedidos')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 
		->leftjoin('users as users',	function($join){
							$join->on('users.id','=','pedidos.id_usuario');
					}) 
		->where('pedidos.id_restaurante','=',$id)
		->where('pedidos.estatus','=','pendiente')
		->select('*','pedidos.id as id','restaurantes.id as idR','restaurantes.nombre','users.nombre as nombreUsuario','pedidos.domicilio as domicilioP','pedidos.caracteristica')
		->get();
		return $pedidos;
	}
	public function scopePedidosDos($pedidos,$id){
		$pedidos =DB::table('pedidos')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 
		->leftjoin('users as users',	function($join){
							$join->on('users.id','=','pedidos.id_usuario');
					}) 
		->where('pedidos.id_restaurante','=',$id)
		
		->select('pedidos.total','pedidos.estatus','pedidos.id as id','restaurantes.id as idR','restaurantes.nombre','users.nombre as nombreUsuario','pedidos.domicilio as domicilioP','pedidos.caracteristica')
		->get();
		return $pedidos;
	}
		public function scopePedidosTres($pedidos,$id){
		$pedidos =DB::table('pedidos')

		->where('pedidos.estatus','=','declinada')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 
		->leftjoin('users as users',	function($join){
							$join->on('users.id','=','pedidos.id_usuario');
					}) 
		->where('pedidos.id_restaurante','=',$id)
		
		->select('pedidos.total','pedidos.estatus','pedidos.id as id','restaurantes.id as idR','restaurantes.nombre','users.nombre as nombreUsuario','pedidos.domicilio as domicilioP','pedidos.caracteristica')
		->get();
		return $pedidos;
	}
			public function scopePedidosCuatro($pedidos,$id){
		$pedidos =DB::table('pedidos')

		->where('pedidos.estatus','=','noAtendida')
		->leftjoin('restaurantes as restaurantes',	function($join){
							$join->on('restaurantes.id','=','pedidos.id_restaurante');
					}) 
		->leftjoin('users as users',	function($join){
							$join->on('users.id','=','pedidos.id_usuario');
					}) 
		->where('pedidos.id_restaurante','=',$id)
		
		->select('pedidos.total','pedidos.estatus','pedidos.id as id','restaurantes.id as idR','restaurantes.nombre','users.nombre as nombreUsuario','pedidos.domicilio as domicilioP','pedidos.caracteristica')
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
					
					->where('pedidos.estatus','!=','declinada')

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
		public function scopeConsultaDos($query2){

			$query2 =DB::table('pedidos')
					
					

					->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					})

					->leftjoin('productos',	function($join){
							$join->on('productos.id','=','detalles.id_producto');
					})		

					->orderBy('detalles.id_pedido')	

					->select('detalles.id_pedido','detalles.cantidad', 'productos.nombre', 'productos.precio', 'productos.iva','productos.costo_unitario');

					return $query2;
		
	}
	public function scopeUserPagado($pagado,$id){
		$pagado = DB::table('pedidos')
			->where('estatus','=','pagada')							
			->where('id_usuario','=', $id)
			->orderBy('created_at', 'desc');
		return $pagado;
	}
	public function scopeUltPedido($ultimo,$id,$pedido){
		$ultimo =DB::table('pedidos')
		->where('pedidos.id_usuario','=',$id)

		->where('pedidos.estatus','=','pagada')

		->where('pedidos.id','=', $pedido)

		->leftjoin('detalles_pedidos as detalles',	function($join){
							$join->on('detalles.id_pedido','=','pedidos.id');
					})
		->leftjoin('productos',	function($join){
							$join->on('detalles.id_producto','=','productos.id');
					})

	
		->select('pedidos.id','detalles.id as id_detalle','detalles.id_producto','productos.nombre');

		

		return $ultimo;
	}
		public function scopePedidas(){
		$productos =DB::table('pedidos')
		
		->select(DB::raw('id_restaurante, Count(id_restaurante) as cantidad '))
		
		->groupBy('id_restaurante')
		->orderBy('cantidad','DSC');
	
		return $productos;
	}
		public function scopeTotal(){
		$productos =DB::table('pedidos')
		
		->select(DB::raw('id_restaurante, SUM(total) as cantidad '))
		
		->groupBy('id_restaurante')
		->orderBy('cantidad','DSC');
	
		return $productos;
	}
	public function scopeOP(){
		$productos =DB::table('pedidos')
		
		->select(DB::raw('id_restaurante, AVG(total) as cantidad '))
		
		->groupBy('id_restaurante')
		->orderBy('cantidad','DSC');
	
		return $productos;
	}


}