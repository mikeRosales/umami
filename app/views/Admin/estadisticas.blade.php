@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estadisticas</title>
</head>
<body>

	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading admin"><h4>Pedidos</h4></div>   
   
     <br>

     @foreach($restaurantes as $key => $value)
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
          <th></th>
     </thead>
     <tbody>
 
     <tr>
          <td>{{$value->nombre}}</td>
          @foreach($cantidad as $key => $cant)
               @if($cant->id_restaurante == $value->id_restaurante)
               <td>{{$cant->cantidad}}</td>
               @endif
          @endforeach
          <td>{{$value->promedio}}</td>
          <td>{{$value->ordenes}}</td>
     	<td>{{$value->reservaciones}}</td>
          <td>{{$value->consultas}}</td>
          <td>{{$value->comision}}</td>
          <td>{{$value->totalF}}</td>
          <td>{{$value->cuenta}}</td>
          
     </tr>

     </tbody>
     </table>
     @endforeach
     <div class="panel-footer clearfix admin">
	
	</div>     
	</div>
	</div>
</body>
</html>