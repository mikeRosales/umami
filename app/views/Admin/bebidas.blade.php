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
     <div class="panel-heading admin">Bebidas</div>     
	<div class="container col-height ">
	<ul class="nav nav-tabs">
	
	<li> <a href="{{URL::to('#') }}">Mas vistos</a></li>
	<li><a href="{{URL::to('#') }}">Mas pedidos</a></li>
	<li><a href="{{URL::to('#') }}">Por precio</a></li>
	<li><a href="{{URL::to('#') }}">Por categoria</a></li>
	
	</ul>
	<br>
	
	
			@if(count($bebidas)>0)
			<div class="col-md-12">
	 			@foreach($bebidas as $key => $value)
					<div class="col-md-5" style="border:1px solid; height:20%; margin:1%;" >
						
							<div class="col-md-5">
								<img style="width:100%; height:80%; margin:10%;"src="{{asset($value->imagen)}}">
							</div>
							<div class="col-md-5">
							<br>	
								{{$value->nombre}} 	<br>
								{{$value->descripcion}}
								
							</div>
							<br>
							<br>
							<div class="col-md-2">
								{{$value->precio}}$
								<br> 
							
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