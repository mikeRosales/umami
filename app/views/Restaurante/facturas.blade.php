@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Facturas</title>
</head>
<body>

	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading rest"><h4>Facturas</h4></div>     

	<div class="container">
		<table class="solicitudes_vermas">
					<tr>
						<h2>Factura</h2>
						<td colspan="5"><hr class="solicitud"/></td>
					</tr>	        
					@foreach($Facturas as $value)
					<tr>
						
						<td>
							Persona: {{ $value->nombreUsuario}}<br><br>
							
						</td>
						<td class="calificaciones">
							Estatus: {{$value->estatus}} <br><br>
							
						</td>
						<td class="contactar_vermas_d"><a href="{{ URL::to('restaurante/'.$value->idf.'/factura') }}"><img src="{{asset('assets/img/vermas.png')}}"></a></td>
					</tr>

					<tr>
						<td colspan="5"><hr class="solicitud"/></td>
					</tr>
					@endforeach
				</table>
	</div>
	<br>
	  <div class="panel-footer clearfix rest">

	</div>     
	</div>
	</div>
</body>
</html>