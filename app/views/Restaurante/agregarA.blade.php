@include('Restaurante.recursos')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar</title>
</head>
<body>
	  <div class="container marg">
    <div class="panel panel-default">
     <div class="panel-heading rest"><h4>{{ Session::get("nombre") }} Seccion:Agregar Alimento</h4></div>     
		<div class="container">
		{{Form::open(array('url'=>'/restaurante/addA','files'=>'true'))}}
			<div class="col-md-6" style="height:50%;">
				<br>
			     <img id="blah" style="width:100%;" src="" />
				<input type="file" name="imgFile" id="imgFile" value="">
					
			</div>
			<br>
			<div class="col-md-3">
			<label>Nombre</label>
			<input type="text" name="nombre" value="">
			<label>Descripcion</label>
			<textarea name="descripcion" id=""  rows="10"></textarea>
			  <label>Categoria  </label>
	           {{ Form::select('categoria', (['0' => 'Elija una categoria'] + $categorias), null,['class' => 'form-control']) }}
         	 <br>         	
	      
			</div>
			<div class="col-md-3">
				<label >Precio</label>
				<br>
				<input name="precio" value="" type="text">
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