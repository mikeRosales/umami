@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
         
     </thead>
     <tbody>
 
     <tr>
     	<td>Mi restaurante</td>
     	<td>3</td>
     	<td>$150</td>
     	<td>2</td>
          <td>2</td>
          <td>1</td>
          <td>$20</td>
          <td>$2000</td>
         
          
     	
     </tr>

     </tbody>
     </table>
     <div class="panel-footer clearfix rest">
	  @include('Admin.menu')
	</div>     
	</div>
	</div>
</body>
</html>