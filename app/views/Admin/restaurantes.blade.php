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
     <div class="panel-heading admin">&nbsp;</div>     
	<div class="container col-height">
	<ul class="nav nav-tabs">
	
	<li> <a href="{{URL::to('#') }}">Mas vistos</a></li>
	<li><a href="{{URL::to('#') }}">Mas ordenes</a></li>
	<li><a href="{{URL::to('#') }}">Mas reservaciones</a></li>
	<li><a href="{{URL::to('#') }}">Mas ventas</a></li>
	<li><a href="{{URL::to('#') }}">Mas productos</a></li>
	<li><a href="{{URL::to('#') }}">Orden promedio</a></li>
	
	</ul>
	<br>
	
	
			@if(count($restaurantes)>0)
			<div class="col-md-12">
	 			@foreach($restaurantes as $key => $value)
					<div class="col-md-5" style="border:1px solid; height:20%; margin:1%;" >
						
							<div class="col-md-12">
								<img style="width:100%; height:80%; margin:10%;"src="{{asset($value->imagen)}}">
							</div>
						
								
								
						
					</div>
				@endforeach
				</div>
			@endif
			
	</div>


     <div class="panel-footer clearfix admin">
	  @include('Admin.menu')
	</div>     
	</div>
	</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('.direccionar').click(function(){
		var formulario = $(this).next('input').val();
		$('#'+formulario).submit();
	});
});
</script>