<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" type="image/x-icon" href="{{ env('FILE_URL') }}images/favicon.ico">

    <title>{{ PROJECT_NAME }}: @yield('title','') </title>
    
    <link href="{{ env('FILE_URL') }}frontEnd/css/bs3/bootstrap.min.css" rel="stylesheet">
    <link href="{{ env('FILE_URL') }}frontEnd/css/bootstrap-reset.css" rel="stylesheet">
    <link href="{{ env('FILE_URL') }}frontEnd/css/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ env('FILE_URL') }}frontEnd/css/style.css" rel="stylesheet">
    <link href="{{ env('FILE_URL') }}frontEnd/css/style-responsive.css" rel="stylesheet">
    <link href="{{ env('FILE_URL') }}frontEnd/css/developer.css" rel="stylesheet">

    <script src="{{ env('FILE_URL') }}frontEnd/js/jquery.js"></script>
    <script src="{{ env('FILE_URL') }}frontEnd/js/bs3/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ env('FILE_URL') }}frontEnd/js/validation/formValidation.min.js"></script>
    <script type="text/javascript" src="{{ env('FILE_URL') }}frontEnd/js/validation/bootstrap.js"></script> 
    <script src="{{ env('FILE_URL') }}frontEnd/js/jquery.validate.js"></script>

</head>
  @include('frontEnd.common.alert_messages')
  <body class="login-body">

    <div class="container">
    
    <div align="center" style="padding-top:35px; margin-bottom:-75px;"><img src="{{ env('FILE_URL') }}images/scits1.png" width="150" alt=""/></div>

      @yield('content')

    </div>

    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <!--  <script src="js/jquery.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>  -->
 


    <!-- VALIDATION FILES -->

  </body>
</html>
