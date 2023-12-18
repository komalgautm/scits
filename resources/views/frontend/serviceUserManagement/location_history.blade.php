@extends('frontEnd.layouts.master')
@section('title','Service User Location History')
@section('content')

<style type="text/css">
    .modal-btn {
        background-color: #3398CC!important;
        border: none!important;
        padding: 10px 12px!important;
        font-size: 14px!important;
        color: #fff!important;
        border-radius: 5px;
    }
    .error1 {
        color: red;
    }
    .error2 {
        color: red;
    }
    .location-list li {
        padding-right: 10px;
    }
    .loc-del-btn {
        position: absolute;
        right: 17px;
    }
    .fa.fa-edit.location-page-edit-icn {
        color: #f00;
        font-size: 13px;
        margin-left: 10px;
        margin-top: 4px;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <section class="panel cus-calendar" >
            <header class="panel-heading">
                {{ $service_user_name }}'s Location History  
            </header>
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                    <aside class="col-lg-9">
                        <form action="{{ url('service/location-history/'.$service_user_id) }}" method="get" class="form-inline drg-event-title">
                            
                            <div class="form-group m-r-10">
                                <label for="email">History Duration:</label>
                                Last {{ $location_history_duration }} Days
                            </div>

                            <div class="form-group">
                                <label for="email">Show Locations For:</label>

                                <input name="date" required class="form-control datetime-picker trans" type="text" value="{{ $search_date }}" autocomplete="off" maxlength="10" readonly="" />

                            </div>
                            <button class="btn group-ico" type="submit" style="width:40px;">Go</button>
                             
                            @if(isset($noti_data['back_path']))
                               <div class="cus-back-btn pull-right">
                                   <a href="{{ $noti_data['back_path'] }}" class="btn cus-btn btn-warning">Continue</a>
                               </div>
                            @endif
                        </form> 
                        <!-- <iframe frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDHAmHRTOCxpfWKLZWlDuw6T_UasvI3XUc &q=Space+Needle,Seattle+WA" allowfullscreen width="100%;" height="500"></iframe> -->
                        <div id="location-map"></div>


                    </aside>
                    <aside class="col-lg-3">
                        <div class="col-md-12">
                            <h4 class="drg-event-title"> Allowed Locations<!-- Locations <a class="pull-right loc-seting-btn" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-cog"></i></a> --></h4>
                            <ul class="location-list">
                                @foreach($specified_locations as $value)
                                    @if($value['location_type'] == 'A')
                                    <li>{{ ucfirst($value['location']) }} 
                                        <a class="loc-del-btn pull-right edit_allowed_location" location-id="{{ $value['id'] }}"  location-name="{{ $value['location'] }}" location-radius="{{ $value['radius'] }}" href="javascript:;" style="margin-right: 12px;"> <i class="fa fa-edit location-page-edit-icn"></i></a>
                                        <a class="loc-del-btn conf-del pull-right" href="{{ url('service/location-history/location/delete/'.$value['id']) }}"> <i class="fa fa-times"></i> </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>

                            <div class="form-group col-md-8">
                                <div class="input-group popovr allowed_location_area">
                                    <div class="add-event label label-event"> Add Location </div>
                                    <span class="input-group-addon cus-inpt-grp-addon color-green">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-lg-3">
                        <div class="col-md-12">
                            <h4 class="drg-event-title"> Restricted Locations</h4>
                            <ul class="location-list">
                                @foreach($specified_locations as $value)
                                    @if($value['location_type'] == 'R')
                                    <li>{{ ucfirst($value['location']) }} 
                                        <a class="loc-del-btn pull-right edit_restricted_location" location-id="{{ $value['id'] }}" location-name="{{ $value['location'] }}" location-radius="{{ $value['radius'] }}"  href="javascript:;" style="margin-right: 12px;"> <i class="fa fa-edit location-page-edit-icn"></i></a>
                                        <a class="loc-del-btn conf-del pull-right" href="{{ url('service/location-history/location/delete/'.$value['id']) }}"> <i class="fa fa-times"></i> </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>

                            <div class="form-group col-md-8">
                                <div class="input-group popovr restricted_location_area">
                                    <div class="add-event label label-event"> Add Location </div>
                                    <span class="input-group-addon cus-inpt-grp-addon color-green">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- page end-->
            </div>
        </section>
    </section>
</section>

<!-- Location Add Modal -->
<div class="modal fade" id="area2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title location_modal_header">Location</h4>
            </div>
            <form method="post" action="{{ url('/service/location-history/location/add') }}" id="location_modal">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                            <label class="col-md-3 col-sm-2 col-xs-12 p-t-7 text-right"> Location Name: </label>
                            <div class="col-md-9 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" id="address" name="location" >
                                <span class="error1"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                          <label class="col-md-3 col-sm-2 col-xs-12 p-t-7  r-p-0 text-right"> Location Type: </label>
                          <div class="col-md-9 col-sm-10 col-xs-12 ">
                            <div class="select-style">
                              <select name="location_type" class="sel_location_type" readonly="readonly">
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                            <label class="col-md-3 col-sm-2 col-xs-12 p-t-7 text-right"> Miles: </label>
                            <div class="col-md-9 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="miles" id="mile" placeholder="Enter Miles">
                                 <span class="error2"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer m-t-0">
                    {{ csrf_field() }}
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="available_radius" id="radius" value="">
                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <input class="btn btn-warning" type="submit" value="Confirm">
                    <!-- <button class="btn btn-warning" type="submit"> Confirm </button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Location Add Modal end-->

<!-- Location Edit Modal -->
<div class="modal fade" id="edit_area2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title edit_location_modal_header">Location</h4>
            </div>
            <form method="post" action="#" id="edit_location_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                            <label class="col-md-3 col-sm-2 col-xs-12 p-t-7 text-right"> Location Name: </label>
                            <div class="col-md-9 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="location" id="input_location_name" value="" disabled="true">
                                <!-- <span class="error1"></span> -->
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                            <label class="col-md-3 col-sm-2 col-xs-12 p-t-7  r-p-0 text-right"> Location Type: </label>
                            <div class="col-md-9 col-sm-10 col-xs-12 ">
                                <div class="select-style">
                                    <select name="location_type" class="sel_edit_location_type" readonly="readonly"></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 add-rcrd p-l-20 p-r-20">
                            <label class="col-md-3 col-sm-2 col-xs-12 p-t-7 text-right"> Miles: </label>
                            <div class="col-md-9 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="miles" value="" id="input_location_radius" placeholder="Enter Miles">
                                <!-- <span class="error2"></span> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer m-t-0">
                    {{ csrf_field() }}
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <!-- <input class="btn btn-warning" type="submit" value="Confirm"> -->
                    <button class="btn btn-warning" type="submit" id="submit_btn"> Confirm </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Location Edit Modal end-->

<script>
    $(document).ready(function(){
        $(document).on('click','.allowed_location_area', function(){
            $('.location_modal_header').text('Add Allowed Location');
            $('.sel_location_type').html('<option value="A">Allowed</option>');
            $('#area2').modal('show');
        });

        $(document).on('click','.restricted_location_area', function(){
            $('.location_modal_header').text('Add Restricted Location');
            $('.sel_location_type').html('<option value="R">Restricted</option>');
            $('#area2').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.edit_allowed_location', function(){
            var location_id = $(this).attr('location-id');
            var location_name = $(this).attr('location-name');
            var location_radius = $(this).attr('location-radius');
            var action = "{{ url('service/location-history/location/edit') }}" + '/' + location_id;

            $('.edit_location_modal_header').text('Edit Allowed Location');
            $('.sel_edit_location_type').html('<option value="A">Allowed</option>');
            $('#edit_location_form').attr('action', action);
            $('#input_location_name').val(location_name);
            $('#input_location_radius').val(location_radius);
            $('#edit_area2').modal('show');
        });

        $(document).on('click','.edit_restricted_location', function(){
            var location_id = $(this).attr('location-id');
            var location_name = $(this).attr('location-name');
            var location_radius = $(this).attr('location-radius');
            // alert(location_radius);
            var location_radius1 = parseFloat(location_radius) / 1609.34;
            // alert(location_radius1);
            var action = "{{ url('service/location-history/location/edit') }}" + '/' + location_id;
            
            $('.edit_location_modal_header').text('Edit Restricted Location');
            $('.sel_edit_location_type').html('<option value="R">Restricted</option>');
            $('#edit_location_form').attr('action', action);
            $('#input_location_name').val(location_name);
            $('#input_location_radius').val(location_radius1);
            $('#edit_area2').modal('show');
        });

        $(document).on('click','#submit_btn', function(){
            $('#edit_location_form').submit();
        });
    });
</script>

<script>
    $(document).ready(function() {
        today  = new Date; 
        $('.datetime-picker').datetimepicker({
            format: 'dd-mm-yyyy',
            //startDate: today,
            minView : 2
        });
    });
</script>
<!-- scripts for autocomplete address -->
<!-- Google map script -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQhN-xkQiUIQ9toO-KRdb9wqtc_cGbAqo&libraries=places"></script> 

<!-- <script src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry" type="text/javascript"></script> -->
<script type="text/javascript">
    var address = document.getElementById('address');
    var autocomplete_address = new google.maps.places.Autocomplete(address);
    google.maps.event.addListener(autocomplete_address, 'place_changed', function () {
        var address = autocomplete_address.getPlace();
        var latitude  = document.getElementById('latitude').value = address.geometry.location.lat();
        var longitude = document.getElementById('longitude').value = address.geometry.location.lng();
        // alert(latitude);
        var p1 = new google.maps.LatLng(latitude, longitude);
        $(".error1").html('');
        $("input[type=submit]").prop("disabled", false);
        // alert(p1);
        <?php 
            $value_rad ='';  
            foreach($specified_locations as $key => $value) {  //$radius = '1400'; ?>
                var p2 = new google.maps.LatLng({{ $value['latitude'] }}, {{ $value['longitude'] }});
                var rad = function(x) {
                    return x * Math.PI / 180;
                };
                var R     = 6378137; // Earth’s mean radius in meter
                var dLat  = rad(p2.lat() - p1.lat());
                var dLong = rad(p2.lng() - p1.lng());
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var distance_in_meter = R * c;
                var radius_in_meter = "{{$value['radius']}}";

                var distance_in_meter = parseInt(Math.trunc(distance_in_meter));
                var radius_in_meter   = parseInt(Math.trunc(radius_in_meter));
                // alert(distance_in_meter);
                // alert(radius_in_meter);
                /* if input radius is less then distance then (Radius < distance_r==)  */
                // $radius = $miles * 1609.34; // radius in meter
                var value_rad = '';
                if(distance_in_meter < radius_in_meter){
                    $(".error1").html(' Select other location');
                    $("input[type=submit]").prop("disabled", true);
                }else if(distance_in_meter > radius_in_meter){ //alert('distance more')
                    var available_radius = distance_in_meter - radius_in_meter;
                    $('#radius').val(available_radius);
                    //alert(available_radius);
                }
        <?php 
        } ?>        
    });
</script>
<script type="text/javascript">
    $('#mile').on('change', function(){ //alert('miles');
        /*$(".error2").html('');
            $("input[type=submit]").prop("disabled", false); */
        var miles_val =  $(this).val();
        // alert(miles_val);
        var value_in_meters = miles_val * 1609.34; //coverting miles into meter
        var value_in_meter = parseInt(Math.trunc(value_in_meters));
        var radius = $('#radius').val();
        var radius = parseInt(Math.trunc(radius));
        // alert(value_in_meter);
        // alert('entered radius');
        // alert(radius);
        if(radius > 0){ 
            // var available_radius_meters = value_in_meter - radius;
            // alert(available_radius_meters);
            $(".error2").html('');
            var error1 = $(".error1").html();
            // alert(error1);
            if(error1 == ''){ //alert('hiii')
                $("input[type=submit]").prop("disabled", false);
            }else{
                $("input[type=submit]").prop("disabled", true);
            }
            // $("input[type=submit]").prop("disabled", false); 
            if(value_in_meter >= radius){ //alert('done');
                $(".error2").html(' Please check input');
                $("input[type=submit]").prop("disabled", true);
            }
        }    
    });
</script>
<!-- scripts for autocomplete address end -->
<!-- Google map script start -->
<?php $api_key = env('GOOGLE_MAP_API_KEY');  ?>
<script>
    $(document).ready(function(){
        //google map

        // initialize(null,null);
        
        // function initialize() {
        //     var FocusLatlng = new google.maps.LatLng({{ $focus_loc['latitude'] }}, {{ $focus_loc['longitude'] }});

        //     <?php if(!empty($latest_loc)) {  ?>
        //         // console.log('1');
        //         // alert('first_map');
        //         var mapOptions = {
        //             zoom: 10,
        //             scrollwheel: false,
        //             center: FocusLatlng,
        //             mapTypeId: google.maps.MapTypeId.ROADMAP
        //         }
        //     <?php } else { ?>
        //         // console.log('2');
        //        // alert('second_map');
        //         var mapOptions = {
        //             zoom: 2,
        //             scrollwheel: false,
        //             center: FocusLatlng,
        //             mapTypeId: google.maps.MapTypeId.ROADMAP
        //         }
        //     <?php } ?>
        //     var map = new google.maps.Map(document.getElementById('location-map'), mapOptions);

        //     /*var marker = new google.maps.Marker({
        //         position: FocusLatlng,
        //         map: map,
        //         optimized: false,
        //     });*/


        //     <?php if(!empty($latest_loc)){
        //             $latest_timestamp = $latest_loc['timestamp'];
        //     ?>
        //         var LastLatlng = new google.maps.LatLng({{ $latest_loc['latitude'] }}, {{ $latest_loc['longitude'] }});
        //         var marker = new google.maps.Marker({
        //             position: LastLatlng,
        //             map: map,
        //             title: '{{ date("d-m-Y g:i a", strtotime(@$latest_timestamp)) }}',
        //             icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
        //         });
        //     <?php  } ?>    

        //     <?php if(!empty($specified_locations)){ ?>
        //         //from source to destination
        //         //destination at the top of source
        //         var i = 0;
        //         <?php  foreach ($specified_locations as $key => $value) {  //$radius = '1400'; ?>
                        
        //                 var myLatlng1 = new google.maps.LatLng({{ $value['latitude'] }}, {{ $value['longitude'] }});
                       
        //                 <?php if($value['location_type'] == 'A'){ ?>

        //                     var radius = "{{$value['radius']}}";
        //                     // alert(radius);
        //                     var circle = new google.maps.Circle({
        //                         center: myLatlng1,
        //                         map: map,
        //                         radius: parseFloat(radius),    // 10 miles in metres
        //                         strokeColor: 'green'
        //                     });

        //                <?php }else{ ?>

        //                     var radius = "{{$value['radius']}}";
        //                     // alert(radius);
        //                     var circle = new google.maps.Circle({
        //                         center: myLatlng1,
        //                         map: map,
        //                         radius: parseFloat(radius),    // 10 miles in metres
        //                         strokeColor: '#FF0000'
        //                     });
        //                <?php } ?>
        //             i++;
        //         <?php } ?>
        //     <?php }   ?>
        // }
        // google.maps.event.addDomListener(window, 'load', initialize);
    });
</script>
<!-- Google map script end -->
@include('frontEnd.serviceUserManagement.elements.socket_tracking')
@include('frontEnd.serviceUserManagement.elements.track')

<script>
    $(function() {
        $("#location_modal").validate({
            rules: {
                miles: {
                    required: true,
                    regex: /^[0-9+\s]+$/
                },
                location: {
                    required: true,
                },
            },
            messages: {
                //job_title: "This field is required.",
                miles:{
                    required: "This field is required.",
                    regex: 'This field contain only digits'
                }, 
                location: "This field is required.",
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

<script>
    $(function() {
        $("#edit_location_form").validate({
            rules: {
                miles: {
                    required: true,
                    regex: /^[0-9.+\s]+$/
                }
            },
            messages: {
                miles:{
                    required: "This field is required.",
                    regex: 'This field contain only digits'
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

@endsection