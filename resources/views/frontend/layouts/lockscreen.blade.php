<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">

        <title>{{ PROJECT_NAME }} @yield('title','')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ url('public/frontEnd/css/bs3/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('public/frontEnd/css/bootstrap-reset.css') }}" rel="stylesheet">

        <!--external css-->
        <link href="{{ url('public/frontEnd/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="{{ url('public/frontEnd/css/style.css') }}" rel="stylesheet">
        <link href="{{ url('public/frontEnd/css/style-responsive.css') }}" rel="stylesheet">
        <link href="{{ url('public/frontEnd/css/bootstrap-reset.css') }}" rel="stylesheet">
        <link href="{{ url('public/frontEnd/css/developer.css') }}" rel="stylesheet">
        
        <script src="{{ url('public/frontEnd/js/jquery.js') }}"></script>
        <script src="{{ url('public/frontEnd/js/bs3/bootstrap.min.js') }}"></script>

    </head>
  @yield('content')
</html>