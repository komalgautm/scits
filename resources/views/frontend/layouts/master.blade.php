<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/images/favicon.ico') }}">
  <link href="{{ url('public/frontEnd/css/formIo/formio.form.min.css') }}" rel="stylesheet">

  <title>{{ PROJECT_NAME }} @yield('title','') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Core CSS -->
  <link href="{{ url('public/frontEnd/css/bs3/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/bootstrap-reset.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/css3clock/css/style.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/jquery.fileupload.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/vallenato.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

  @if(Auth::user()->design_layout == 0)
  <link href="{{ url('public/frontEnd/css/style.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/style-responsive.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/developer.css') }}" rel="stylesheet">
  @else
  <link href="{{ url('public/frontEnd/css/dyslexia/dyslexia_style.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/dyslexia/dyslexia_style-responsive.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/dyslexia/dyslexia_developer.css') }}" rel="stylesheet">
  @endif

  <link href="{{ url('public/frontEnd/css/margins-min.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/bootstrap-select.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/selectize/selectize.default.css') }}" rel="stylesheet">
  <link href="{{ url('public/backEnd/css/amarjeet.css')}}" rel="stylesheet" type="text/css">

  <!-- Core JS -->
  <script src="{{ url('public/frontEnd/js/jquery.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/select2.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/selectize/selectize.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/slimscroll.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/frontEnd/js/fullcalendar/fullcalendar.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/frontEnd/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/vallenato.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/moment.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-datetimepicker.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-select.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/clamp/clamp.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/angularjs/angular1.4.8.min.js') }}"></script>

  <!-- Gritter Notifications -->
  <link href="{{ url('public/frontEnd/js/gritter/jquery.gritter.css') }}" rel="stylesheet">
  <script src="{{ url('public/frontEnd/js/gritter/jquery.gritter.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/autosize.js') }}"></script>

  <!-- Date Range Picker -->
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body class="full-width ">
  <!-- Loader -->
  <div class="loader-box loader">
    <div class="loader-inner"></div>
  </div>

  <section id="container" class="hr-menu">
    <!-- Header -->
    @include('frontEnd.common.header')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('frontEnd.common.footer')

    <!-- Chat Modal Trigger -->
    <a class="chat_opt" data-toggle="modal" data-target="#call_modal">
      <i class="fa fa-phone"></i>
    </a>
  </section>

  <!-- Scripts at the end of the document for faster page loading -->
  <script src="{{ url('public/frontEnd/js/bs3/bootstrap.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/hover-dropdown.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="{{ url('public/frontEnd/css/css3clock/js/css3clock.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/scripts.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/developer.js') }}"></script>
  <script src="{{ url('public/front