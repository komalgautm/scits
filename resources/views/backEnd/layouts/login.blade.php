<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="utf-8"/>
	<title> @yield('title','') </title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="{{ url('public/backEnd/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/bootstrap/style.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/style.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/bootstrap/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="{{ url('public/backEnd/css/bootstrap/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="{{ url('public/backEnd/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE STYLES -->

	<!-- BEGIN THEME STYLES -->
	<link href="{{ url('public/backEnd/css/components.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/layout.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{ url('public/backEnd/css/custom.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/backEnd/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('public/frontEnd/css/developer.css') }}" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->


	<link rel="shortcut icon" href="favicon.ico"/>
	<script src="{{ url('public/backEnd/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/select2.min.js') }}" type="text/javascript"></script>

	<script src="{{ url('public/backEnd/js/common.js') }}" type="text/javascript"></script>

</head>

<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="../../assets/admin/layout/img/logo-big.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->	
			@yield('content')

	<!-- </div> -->
		<!-- END QUICK SIDEBAR -->
	<!-- </div> -->
	<!-- END CONTAINER -->
			
			

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->

	<script src="{{ url('public/backEnd/js/jquery-migrate.min.js') }}" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

    <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/formValidation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/frontEnd/js/validation/validations_rule.js') }}"></script>
	
	<script src="{{ url('public/backEnd/js/bootstrap/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.blockui.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.cokie.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.uniform.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/bootstrap/bootstrap-switch.min.js') }}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{ url('public/backEnd/js/jquery.vmap.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/maps/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.flot.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.pulsate.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/bootstrap/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/bootstrap/daterangepicker.js') }}" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<script src="{{ url('public/backEnd/js/fullcalendar.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{ url('public/backEnd/js/metronic.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/layout.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/quick-sidebar.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/demo.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/index.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/backEnd/js/tasks.js') }}" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->


	
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>
	<!-- END JAVASCRIPTS -->



</body>
</html>