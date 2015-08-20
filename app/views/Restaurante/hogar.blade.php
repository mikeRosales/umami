@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading">&nbsp;</div>
     @if(count($pedidos)>0)
    
     		<table>
     		<thead>
     			<th>Orden</th>
     			<th rowspan="2">Cantidad</th>
     			<th>Producto</th>
     			<th>Importe</th>
     			<th>Iva</th>
     			<th>Costo Unitario</th>
     			<th>Total</th>
     		</thead>
     		<tbody>
		 @foreach($pedidos as $key => $value)
		 {{Form::open(array('url' => '/condec'))}}
			<?php $a = 1; ?>
			@foreach($detalles as $key => $info)					
				@if($info->id_pedido == $value->id)	
				<?php $a++; ?>
				@endif     
		     @endforeach
				<tr>
					<td rowspan="{{$a}}">{{$value->id}}</td>
					@foreach($detalles as $key => $info)
					
					@if($info->id_pedido == $value->id)	
					
					
				
					
						<tr>							
			     			<td >{{$info->cantidad}}</td>
			     		
			     			<td >{{$info->nombre}}</td>
			     				
			     			<td >{{$info->precio}}</td>
			     				
			     			<td >{{$info->iva}}</td>
			     				
			     			<td >{{$info->costo_unitario}}</td>		
							<?php $total = $info->cantidad *  $info->costo_unitario; ?>

			     			<td>{{$total}}</td>	     			
			     		</tr>
		     			@endif     
		     		 		
					 @endforeach
				{{ Form::hidden('idpedido',$value->id)}}

				<td>{{ Form::submit('Confirmar', array('name'=> 'Confirmar','class' => 'btn btn-primary')) }}</td>
				<td>{{ Form::submit('Declinar', array('name'=> 'Declinar','class' => 'btn btn-danger')) }}</td>
				 
				</tr>

				 {{Form::close()}}
		 @endforeach
	
		 </tbody>
			</table>
     @endif
     <div class="panel-footer clearfix">
	  &nbsp;
	</div>     
	</div>
	</div>
</body>
</html>
		