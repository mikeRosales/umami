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
     <div class="panel-heading admin"><h4>Pedidos</h4></div>   
   
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
          <th></th>
     </thead>
     <tbody>
 
     <tr>
     	<td>Mi restaurante</td>
     	<td>3</td>
     	<td>$150</td>
     	<td>6</td>
          <td>2</td>
          <td>$20</td>
          <td>$2000</td>
          <td><button class="btn btn-primary">Pagar</button></td>
          
     	
     </tr>

     </tbody>
     </table>
     <div class="panel-footer clearfix admin">
	  @include('Admin.menu')
	</div>     
	</div>
	</div>
</body>
</html>