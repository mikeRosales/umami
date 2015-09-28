@include('Admin.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Alimentos</title>
</head>
<body>

	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading admin"><h4>Alimentos</h4></div>     

	<div class="container">
	<ul class="nav nav-tabs">
	
	<li> <a href="{{URL::to('#') }}">Mas vistos</a></li>
	<li><a href="{{URL::to('#') }}">Mas pedidos</a></li>
	<li><a href="{{URL::to('#') }}">Por precio</a></li>
	<li><a href="{{URL::to('#') }}">Por categoria</a></li>
	
	</ul>
	<br>
	
	@if(count($alimentos)>0)
	<div class="row">
	 	@foreach($alimentos as $key => $value)
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
								<input type="checkbox">
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