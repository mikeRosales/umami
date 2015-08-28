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
     <div class="panel-heading"><h4>Pedidos</h4></div>   
     <table class="table table-bordered">
     <thead>
     	<th>Orden</th>
     	<th>Importe</th>
     	<th>Confirmación</th>
     	<th>Enviar a</th>
     </thead>
     <tbody>
     @foreach($pedidos as $key => $value)  
     <tr>
     	<td>{{$value->id}}</td>
     	<td>{{$value->total}}</td>
     	<td>{{$value->estatus}}</td>
     	<td>{{$value->domicilio}}</td>
     	
     </tr>
     @endforeach
     </tbody>
     </table>
     <div class="panel-footer clearfix">
	  @include('Restaurante.menu')
	</div>     
	</div>
	</div>
</body>
</html>