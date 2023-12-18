<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
<!--   <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}"> -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">

  <title>{{ PROJECT_NAME }} @yield('title','') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!--Core CSS -->
  <link href="{{ url('public/frontEnd/css/bs3/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ url('public/frontEnd/css/bootstrap-reset.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

  <!--clock css-->
  <link href="{{ url('public/frontEnd/css/css3clock/css/style.css') }}" rel="stylesheet">

  <link href="{{ url('public/frontEnd/js/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ url('public/frontEnd/js/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/select2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  
  <link href="{{ url('public/frontEnd/css/jquery.fileupload.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet">

  <link href="{{ url('public/frontEnd/css/vallenato.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">  
  
  <link href="{{ url('public/frontEnd/css/style.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/margins-min.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/style-responsive.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/developer.css') }}" rel="stylesheet">
  

   <!--Core js-->
  <script src="{{ url('public/frontEnd/js/jquery.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/select2.min.js') }}"></script>

  <script src="{{ url('public/frontEnd/js/slimscroll.js') }}"></script>
  
  <script type="text/javascript" src="{{ url('public/frontEnd/js/fullcalendar/fullcalendar.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/frontEnd/js/jquery-ui-1.9.2.custom.min.js') }}"></script>    

  <script src="{{ url('public/frontEnd/js/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/vallenato.js') }}"></script>
  
  <script src="{{ url('public/frontEnd/js/moment.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-datetimepicker.js') }}"></script>

  <script src="{{ url('public/frontEnd/js/clamp/clamp.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/angularjs/angular1.4.8.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/autosize.js') }}"></script>
</head>
  @include('frontEnd.common.alert_messages')
  <body class="full-width ">
  <!-- body-overflow -->
  <div class="loader-box loader">
      <div class="loader-inner"></div>
  </div>

  <section id="container" class="hr-menu">
      
      
      
      @yield('content')

      
  </section>

  <!-- Placed js at the end of the document so the pages load faster -->

  <!--Core js-->
  <script src="{{ url('public/frontEnd/js/bs3/bootstrap.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/hover-dropdown.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>



 <!--  <script type="text/javascript" src="{{ url('public/frontEnd/js/external-dragging-calendar.js') }}"></script> -->
  <!--clock init-->
  <script src="{{ url('public/frontEnd/css/css3clock/js/css3clock.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
  
  <!--common script init for all pages-->
  <script src="{{ url('public/frontEnd/js/scripts.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/developer.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/advanced-form.js') }}"></script>
 

  <!-- VALIDATION FILES -->
  <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/formValidation.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/bootstrap.js') }}"></script> 
  <!-- <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/validations_rule.js') }}"></script>   -->
  <script src="{{ url('public/frontEnd/js/jquery.validate.js') }}"></script>

  
  </body>
</html>