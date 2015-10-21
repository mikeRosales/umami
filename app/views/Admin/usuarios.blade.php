@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Usuarios</title>
</head>
<body>

	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading admin"><h4>Pedidos</h4></div>   
          <ul class="nav nav-tabs">
     
     <li> <a href="{{URL::to('#') }}">Numero Total</a></li>
     <li><a href="{{URL::to('#') }}">Numero Usuarios</a></li>
     <li><a href="{{URL::to('#') }}">Gasto Promedio</a></li>
     <li><a href="{{URL::to('#') }}">Porcentaje ha ordenado</a></li>
     
     </ul>
     <br>
     <table class="table table-bordered">
     <thead>
     	<th>Edad</th>
     	<th>Nombre</th>
     	<th>Órdenes</th>
     	<th>Dirección</th>
          <th>Codigo Postal</th>
          <th>Reservaciones</th>
          <th>Costo de ordenes</th>          
     </thead>
     <tbody>
     @foreach($usuarios as $key => $value)  
     <tr>
     	<td>{{$value->edad}}</td>
     	<td>{{$value->nombre}}</td>
     	<td>2</td>
     	<td>{{$value->direccion}}</td>
          <td>{{$value->codigo_postal}}</td>
          <td>3</td>
          <td>80</td>
          
     	
     </tr>
     @endforeach
     </tbody>
     </table>
     <div class="panel-footer clearfix admin">
	
	</div>     
	</div>
	</div>
</body>
</html>