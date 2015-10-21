@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estadisticas</title>
</head>
<body>

	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading rest"><h4>{{ Session::get("nombre") }} Seccion:Pedidos</h4></div>   
   
     <br>
     <table class="table table-bordered">
     <thead>
     	<th>Nombre</th>
     	<th>Platillos Vendidos</th>
     	<th>Costo Promedio</th>
     	<th>No. ordenes</th>
          <th>Reservaciones</th>
          <th>Consultas</th>
          <th>Comisión</th>          
          <th>Total a depositar</th> 
          <th>Numero de cuenta</th>
         
     </thead>
     <tbody>
 
     <tr>
     	<td>Mi restaurante</td>
     	<td>{{$cantidad}}</td>
     	<td>${{$OP}}</td>
     	<td>{{$NuOrdenes}}</td>
          <td>{{$Reservaciones}}</td>         
          <td>{{$consultas}}</td>
          <td>{{$totalComision}}</td>
          <td>{{$totalDepositar}}</td>
          <td>{{$cuenta}}</td>
         
          
     	
     </tr>

     </tbody>
     </table>
     <div class="panel-footer clearfix rest">
	
	</div>     
	</div>
	</div>
</body>
</html>