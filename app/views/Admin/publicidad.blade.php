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
     <div class="panel-heading admin"><h4>Pedidos</h4></div>   
     		<div class="container">
     			<div class="col-md-3">
				<br>
			
				<input type="file" name="imgFile" id="imgFile" value="">
					
				</div>
					<div class="col-md-3">
				<br>
			
				<input type="file" name="imgFile" id="imgFile" value="">
					
				</div>
					<div class="col-md-3">
				<br>
			
				<input type="file" name="imgFile" id="imgFile" value="">
					
				</div>
					<div class="col-md-3">
				<br>
			
				<input type="file" name="imgFile" id="imgFile" value="">
					
				</div>
     		</div>
          <div class="panel-footer clearfix admin">
	  @include('Admin.menu')
	</div>     
	</div>
	</div>
</body>
</html>