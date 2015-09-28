<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery-ui.min.css') }}">
  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
  <script src="{{ asset('assets/js/classie.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="{{ URL::asset('assets/js/modernizr.custom.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/pnotify.css') }}">
  <script src="{{ asset('assets/pnotify.js') }}"></script>
</head>

@if (Session::has('message'))
<script>
$(function(){
  new PNotify({
    title: '{{ Session::get("message") }}',
    type: 'success'
  });
});
</script>
@endif
<?php  $var = $errors->all()?> 
@if(!empty($var))
@foreach ($errors->all() as $error)
<script>
$(function(){
  new PNotify({
    text: '{{$error}}',
    type: 'error'
  });
});

</script>
@endforeach
@endif
<body>
  
</body>
</html>
