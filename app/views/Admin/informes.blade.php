@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Informes</title>
</head>
<body>
	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading admin"><h4>Pedidos</h4></div>
     <table class="table">
     	<tr><td colspan="2">Diario</td></tr>
     	<tr><td>Ventas totales</td><td>${{$VT}}</td></tr>
     	<tr><td>Importe</td><td>${{$VT}}</td></tr>
     	<tr><td>IVA por pagar</td><td>$15</td></tr>
     	<tr><td>No. de ordenes</td><td>{{$NuOrdenes}}</td>	</tr>
     	<tr><td>Costo Maximo de ordenes</td><td>{{$OM}}</td>	</tr>
     	<tr><td>Costo Minino de ordenes</td><td>{{$MO}}</td>	</tr>
     	<tr><td>Costo Promedio de ordenes</td><td>{{$OP}}</td>	</tr>
		
		<tr><td colspan="2">Semanal</td>	</tr>
     	    <tr><td>Ventas totales</td><td>${{$VT}}</td></tr>
          <tr><td>Importe</td><td>${{$VT}}</td></tr>
          <tr><td>IVA por pagar</td><td>$15</td></tr>
          <tr><td>No. de ordenes</td><td>{{$NuOrdenes}}</td>     </tr>
          <tr><td>Costo Maximo de ordenes</td><td>{{$OM}}</td>   </tr>
          <tr><td>Costo Minino de ordenes</td><td>{{$MO}}</td>   </tr>
          <tr><td>Costo Promedio de ordenes</td><td>{{$OP}}</td> </tr>

     	<tr><td colspan="2">Mensual</td>	</tr>
     	    <tr><td>Ventas totales</td><td>${{$VT}}</td></tr>
          <tr><td>Importe</td><td>${{$VT}}</td></tr>
          <tr><td>IVA por pagar</td><td>$15</td></tr>
          <tr><td>No. de ordenes</td><td>{{$NuOrdenes}}</td>     </tr>
          <tr><td>Costo Maximo de ordenes</td><td>{{$OM}}</td>   </tr>
          <tr><td>Costo Minino de ordenes</td><td>{{$MO}}</td>   </tr>
          <tr><td>Costo Promedio de ordenes</td><td>{{$OP}}</td> </tr>
     </table>     
     <div class="panel-footer clearfix admin">
	
	</div>     
	</div>
	</div>
</body>
</html>