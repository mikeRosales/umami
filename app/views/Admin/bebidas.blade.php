@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bebidas</title>
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
				<div class="row">
	 	@foreach($bebidas as $key => $value)
				<div class="col-md-5" style="border:1px solid;  margin:1%;" >
						
							<div class="col-md-7 ">
								<img style="width:100%;margin:5%;" height="200px" src="{{asset($value->imagen)}}">
							</div>
							<div class="col-md-3">
							<br>	
								{{$value->nombre}} 	<br>
								{{$value->descripcion}}
								
							</div>
							<br/>
							<div class="col-md-2">
								{{$value->precio}}$
							
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