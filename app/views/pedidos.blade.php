<div class="container marg">
  <div class="panel panel-default">
   <div class="panel-body_header">

    <table class="headervermas">
      <tr style="vertical-align: top;">
        <th colspan="3"><a href="{{ URL::to('anclas') }}"><img src="{{ URL::asset('assets/img/regresar.png') }}"></a></th>
        <th style="width:20px;  text-align: right;"><img class="buttoneditar" data-target="#myModal" src="{{asset('assets/img/anclas/editar.png')}}"></th>
      </tr>

      <tr>
        <th rowspan="4" scope="col" style="padding:20px;width:25px"><img src="{{asset('assets/img/')}}/{{substr($solicitud->producto_id,0,2)}}.png"></th>
        <th colspan="2" scope="col">  {{$solicitud->nombre_producto}}</th>
        <th rowspan="4" scope="col" style="text-align:right;padding:30px"></th>
      </tr>
      <tr>
        <td colspan="2">{{$solicitud->nombre}}</td>
      </tr>
      <tr>
        <td rowspan="2" width="50"></td>
        <td style="text-align: justify">{{$solicitud->descripcion_servicio}}</td>
      </tr>
      <tr>
        <br>
        <td style="text-align:right;  margin-left: 50px;" > {{ ucwords(strftime("Hasta el  %d de %B del %Y",strtotime($solicitud->fecha_limite))) }}</td>
      </tr>
    </table>


    <tr>
      <td colspan="3" >
        <br>
        <tr>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prospectos:</label>
      </tr>
        <table class="solicitudes_vermas">
          <th colspan="5" style="background-color:#E66111;border-radius:15px;-webkit-border-radius: 15px;">
            <img src="{{ asset('assets/img/icono-S.png')}}">
          </th>
          @foreach($vinculacion as $value)
          @if($value->tipo=='solicitud')
          <tr>
          <td colspan="5"><hr class="solicitud"/></td>
        </tr>
          <tr>
            <th rowspan="2" scope="col"><img class="img-vermas-perfilempresa" width="72" height="72" src="{{asset($value->url_img_per)}}">@if($value->mensajes_recibidos>0)<span class="badge_vermas">{{$value->mensajes_recibidos}}</span>@endif</th>
            <th scope="col">{{ $value->nombre}}</th>
            <th scope="col"><img src="{{asset('assets/img/icono_4.png')}}">{{$value->calif_positivas}}</th>
            <th scope="col"><img src="{{asset('assets/img/icono_3.png')}}">{{$value->calif_negativas}}</th>

          </tr>
          <tr>
            <td>{{$solicitud->nombre_producto}}</td>
            <th scope="col"><img src="{{asset('assets/img/icono_1.png')}}">{{$value->calif_neutras}}</th>
            <th scope="col"><img src="{{asset('assets/img/icono_2.png')}}"></th>
            <td><a href="{{ URL::to('anclas/'.$value->id.'/msgSolicitud') }}"><img src="{{asset('assets/img/contacto.png')}}"></a></td>
          </tr>
          <tr>
            <td colspan="5"><hr class="solicitud"/></td>
          </tr>
          @endif
          @endforeach
        </table>
        <br>
        <table class="solicitudes_vermas">
          <th colspan="5" style="background-color:#69C62B;border-radius:15px;-webkit-border-radius: 15px;">
            <img src="{{ asset('assets/img/icono-O.png')}}">
          </th>

      </table>

    </td>
  </tr>
</div>

</div>
</div>


</div>
<script type="text/javascript">
$(function() {
  $('#datepick').datetimepicker({
    language: 'es'
  });
});

$('.buttoneditar').click(function(){
  $('#myModal').modal('show');
});


$(function() {
 $("#tipo_de_servicio").autocomplete({
  source: "{{URL('/anclas/getdata')}}",
  minLength: 3,
  select: function( event, ui ) {
   $('#response').val(ui.item.id);
 }
});
});
</script>