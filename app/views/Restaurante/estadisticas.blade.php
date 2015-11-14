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
   @foreach($estadisticas as $key => $value)
        
                <br>
          <table class="table table-bordered">
          <thead>
               <th>Nombre</th>
               <th>Platillos Vendidos</th>
               <th>Costo Promedio</th>
               <th>No. ordenes</th>               
               <th>Consultas</th>
               <th>Comisión</th>          
               <th>Total a depositar</th> 
               <th>Numero de cuenta</th>
               <th>Fecha a pagar</th>
               <th></th>
          </thead>
          <tbody>
      
          <tr>
               <td>{{$restaurante->nombre}}</td>
               @foreach($cantidad as $key => $cant)
                    @if($cant->id_restaurante == $value->id_restaurante)
                    <td>{{$cant->cantidad}}</td>
                    @endif
               @endforeach
               <td>{{$value->costo_promedio}}</td>
               <td>{{$value->no_ordenes}}</td>
               
               <td>{{$value->consultas}}</td>
               <td>{{$value->comision}}</td>
               <td>{{$value->total}}</td>
               <td>{{$restaurante->cuenta}}</td>
               <td>{{$value->fecha}}</td>
          </tr>

          </tbody>
          </table>
          
     @endforeach
     <div class="panel-footer clearfix rest">
	
	</div>     
	</div>
	</div>
</body>
</html>