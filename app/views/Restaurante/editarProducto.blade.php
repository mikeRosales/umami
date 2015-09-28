@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar</title>
</head>
<body>
	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading rest"><h4>{{ Session::get("nombre") }} Seccion:Editar</h4></div>     
		<div class="panel-body">
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
			  <label>Categoria  </label>
	          {{ Form::select('categoria', (['0' => 'Elija una categoria'] + $categorias), null,['class' => 'form-control']) }}
         	 <br>         	
	      
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
				<input name="comision" value="2.5" type="text">
				<br>
				<label for="">Precio final</label>
				<br>
				<input name="precio_final"  value="" type="text">
				<br>				
		         {{ Form::label('hora_inicio', 'hora a la que se comienza a preparar') }}
		         <br>
		         {{ Form::text('hora_inicio', Input::old('hora_inicio'), array('placeholder'=>'09:00')) }}
		    	<br/>
		    
		         {{ Form::label('hora_fin', 'hora a la que se deja de preparar') }}
		         <br>
		         {{ Form::text('hora_fin', Input::old('hora_fin'), array('placeholder'=>'17:00')) }}
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