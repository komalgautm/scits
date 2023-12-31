<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <!-- <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}"> -->
  
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

  <link href="https://cdn.form.io/formiojs/formio.form.min.css">
  <title>{{ PROJECT_NAME }} @yield('title','') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!--Core CSS -->
  <link href="{{ url('public/frontEnd/css/bs3/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ url('public/frontEnd/css/bootstrap-reset.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

  <!--clock css-->
  <link href="{{ url('public/frontEnd/css/css3clock/css/style.css') }}" rel="stylesheet">

  <!--<link href="{{ url('public/frontEnd/js/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />-->
  
  <link href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/css/select2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  
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
  <!-- For stylish select box -->
  <link href="{{ url('public/frontEnd/css/bootstrap-select.css') }}" rel="stylesheet">
  <link href="{{ url('public/frontEnd/js/selectize/selectize.default.css') }}" rel="stylesheet">
  
  <!-- For body Map-->
  <link href="{{ url('public/backEnd/css/amarjeet.css')}}" rel="stylesheet" type="text/css" > 

   <!--Core js-->
  
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

  <!-- For setting length of text descriptions i.e. clamp -->
  <script src="{{ url('public/frontEnd/js/clamp/clamp.js') }}"></script>

  <script src="{{ url('public/frontEnd/js/angularjs/angular1.4.8.min.js') }}"></script>
  
  <!-- file for sticky(gritter) notifications -->
  <link href="{{ url('public/frontEnd/js/gritter/jquery.gritter.css') }}" rel="stylesheet"> 
  <script src="{{ url('public/frontEnd/js/gritter/gritter.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/gritter/jquery.gritter.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/autosize.js') }}"></script>
  <!-- Date Range Picker -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  
</head>
  @include('frontEnd.common.alert_messages')
  <body class="full-width ">
  <!-- body-overflow -->
  <div class="loader-box loader">
      <div class="loader-inner"></div>
  </div>

  <section id="container" class="hr-menu">
      
        @include('frontEnd.common.header')
      
        @yield('content')
      
        @include('frontEnd.common.footer')
        <a class="chat_opt" data-toggle="modal" data-target="#call_modal">
            <i class="fa fa-phone"></i>
        </a>
      
  </section>

  <!-- Placed js at the end of the document so the pages load faster -->

  <!--Core js-->
  <script src="{{ url('public/frontEnd/js/bs3/bootstrap.min.js') }}"></script>
  <script src="{{ url('public/frontEnd/js/hover-dropdown.js') }}"></script>
  <!--<script src="{{ url('public/frontEnd/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js" type="text/javascript"></script>



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
  
  <!-- Js for Clock in the sidebar -->
  <script src="{{ url('public/frontEnd/js/moment-timezone-data.js') }}"></script>
   <script src='https://cdn.form.io/formiojs/formio.full.min.js'></script>
   <script>
function PrintDivwithvalue(th) {
  var divContents = document.getElementById("formioView").innerHTML;  
  var imagelocalpath="<?php echo adminImgPath ?>";
    var finalpath = imagelocalpath + '/'+$(th).data('id');

       var printWindow = window.open('', '', 'height=600,width=600');  
       printWindow.document.write('<html><head><title>Print DIV Content</title>');
       printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">'); 
       printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');   
       printWindow.document.write('<link rel="stylesheet" href="https://cdn.form.io/formiojs/formio.full.min.css">'); 
       printWindow.document.write('<link href="{{ url('public/backEnd/css/amarjeet.css')}}" rel="stylesheet" type="text/css" >'); 
       printWindow.document.write('<link href="{{ url('public/backEnd/css/pdfstyle.css')}}" rel="stylesheet" type="text/css" >'); 
       printWindow.document.write('</head><body > <div class="masterprintmainarea">'); 
       printWindow.document.write('<div class="header">');  
       printWindow.document.write('<img src="'+ finalpath +'" style="height:80px;">');     
       printWindow.document.write('<img src="{{url('/public/images/scits.png')}}" style="float:right;height:80px;">');
       printWindow.document.write('</div>');   
       printWindow.document.write(divContents); 
       printWindow.document.write('</div>');
       printWindow.document.write('<div class="footer">'); 
       printWindow.document.write('<div class="footer-section-area">'); 
       printWindow.document.write('© {{ date('Y') }} Omega Care Group (SCITS). All Rights Reserved | www.socialcareitsolutions.co.uk ');
       printWindow.document.write('</div>');
       printWindow.document.write('</div>');
       printWindow.document.write('</div> </body></html>');  
       setTimeout(() => {
        printWindow.document.close();
        // printWindow.document.focus();
        printWindow.print(); 
       }, 300);    
}
function PrintDiv(th) 
   {  

    var imagelocalpath="<?php echo adminImgPath ?>";
    
    // console.log(imagelocalpath);
    var finalpath = imagelocalpath + '/'+$(th).data('id');
    //console.log(finalpath);
    // let imagepathdata="public/images/admin/"+"$(th).data('id')";
       var divContents = document.getElementById("formiotest").innerHTML;  
       var printWindow = window.open('', '', 'height=600,width=600');  
       printWindow.document.write('<html><head><title>Print DIV Content</title>'); 
      printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">'); 
       printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');   
       printWindow.document.write('<link rel="stylesheet" href="https://cdn.form.io/formiojs/formio.full.min.css">'); 
       printWindow.document.write('<link href="{{ url('public/backEnd/css/amarjeet.css')}}" rel="stylesheet" type="text/css" >'); 
       printWindow.document.write('<link href="{{ url('public/backEnd/css/pdfstyle.css')}}" rel="stylesheet" type="text/css" >'); 
       printWindow.document.write('</head><body ><div class="masterprintmainarea">');
       printWindow.document.write('<div class="header">');  
       printWindow.document.write('<img src="'+ finalpath +'" style="height:80px;">');     
       printWindow.document.write('<img src="{{url('/public/images/scits.png')}}" style="float:right;height:80px;">');
       printWindow.document.write('</div>');    
       printWindow.document.write(divContents);  
       printWindow.document.write('</div>');
       printWindow.document.write('<div class="footer">'); 
       printWindow.document.write('<div class="footer-section-area">'); 
       printWindow.document.write('© {{ date('Y') }} Omega Care Group (SCITS). All Rights Reserved | www.socialcareitsolutions.co.uk ');
       printWindow.document.write('</div>');
       printWindow.document.write('</div>');
       printWindow.document.write('</div></body></html>');  
       
       setTimeout(() => {
          printWindow.document.close(); 
          // printWindow.document.focus();
          printWindow.print(); 
       }, 300); 
    }  
     </script>
  </body>
  @include('frontEnd.common.take_call')
</html>