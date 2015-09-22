@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading rest"><h4>{{ Session::get("nombre") }} Seccion:Editar</h4></div>     
		<div class="container">
		{{Form::open(array('url'=>'/restaurante/saveChanges','files'=>'true'))}}
			<div class="col-md-6">
				<br>
			     <img id="blah" style="width:100%;" src="{{asset($producto->imagen)}}" alt="your image" />
				<input type="file" name="imgFile" id="imgFile" value="">
					
			</div>
			<br>
			<div class="col-md-3">
			<input type="text" name="nombre" value="{{$producto->nombre}}">
			<textarea name="descripcion" id=""  rows="10">{{$producto->descripcion}}</textarea>
			</div>
			<div class="col-md-3">
				<label >Precio</label>
				<br>
				<input name="precio" value="{{$producto->precio}}" type="text">
				<br>
				<label >Costo por transacción</label>
				<br>
				<input name="costo"   type="text">
				<br>
				<label for="">Comisión</label>
				<br>
				<input name="comision"  type="text">
				<br>
				<label for="">Precio final</label>
				<br>
				<input name="precio_final"  value="{{$producto->precio}}" type="text">
				<br>
				<label for="">Horario</label> <input  value="{{$producto->horario }}" name="horario" type="text">
				<br>
				<br>
				<input type="hidden" name="id" value="{{$producto->id}}">
			{{Form::submit('Guardar cambios',array('class'=>'btn btn-primary'))}}
			</div>

		{{Form::close()}}
		</div>
     <div class="panel-footer clearfix rest">
	  @include('Restaurante.menu')
	</div>     
	</div>
	</div>
</body>
</html>
<script>
	$('#imgFile').change(function(){
		$('#blah')[0].src = window.URL.createObjectURL(this.files[0])
	});
</script>