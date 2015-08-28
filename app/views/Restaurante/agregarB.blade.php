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
     <div class="panel-heading"><h4>Agregar Bebida</h4></div>     
		<div class="container">
		{{Form::open(array('url'=>'/restaurante/addB','files'=>'true'))}}
			<div class="col-md-6" style="height:50%;">
				<br>
			     <img id="blah" style="width:100%;"  src="" />
				<input type="file" name="imgFile" id="imgFile" value="">
					
			</div>
			<br>
			<div class="col-md-3">
			<label>Nombre</label>
			<input type="text" name="nombre" value="">
			<label>Descripción</label>
			<textarea name="descripcion" id=""  rows="10"></textarea>
				  <label>Categoria  </label>
	          <select name="categoria">
	            <option value="fria">Fria</option>
	            <option value="caliente">Caliente</option>	            
         	 </select>
         	 <br>
         	 <label>Sabor  </label>
	          <select name="sabor">
	            <option value="salado">Salado</option>
	            <option value="dulce">Dulce</option>	            
         	 </select>
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
				<input name="comision"  type="text">
				<br>
				<label for="">Precio final</label>
				<br>
				<input name="precio_final"  value="" type="text">
				<br>
				<label for="">Horario</label> <input  value="" name="horario" type="text">
				<br>
				<br>
				<input type="hidden" name="id" value="">
			{{Form::submit('Guardar cambios',array('class'=>'btn btn-primary'))}}
			</div>

		{{Form::close()}}
		</div>
     <div class="panel-footer clearfix">
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