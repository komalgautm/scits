@extends('frontEnd.layouts.master')
@section('title','Service User Profile')
@section('content')
    <style>
        .view_log {
            float: right;
            display: inline-block;
            padding: 10px 20px;
            background-color: #1f88b5;
            color: #fff;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .view_log:hover {
            color: #fff;
            background-color: #19779f;
        }

        .profile-nav {
            margin-bottom: 10px;
            box-shadow: none;
        }

        .tm-avatar img {    
            height: 35px;
        }
        .profile-bigico {
            color: #1f88b5;
            font-size: 53px;
            margin: 0px;
            position: relative;
            top: 90px;
        }
        .contact h2{
            font-size: 14px;
            font-weight: 700;
            color: #575757;
            display: contents;
        }  
        .contact h2 span i{
            color: #19779f;
        }  
        .location-info.contact p a i {
            font-size: 22px;
            margin-right: 5px;
            color: #1f88b5;
        }
        .location-info.contact p a:hover i{
            color: #575757;
        }
        .profile-information .profile-desk h1 {
            color: #575757;
        }
        .contact h3 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 5px;
            margin-top: 17px;
        }
        .contact h3 a i.fa.fa-pencil.profile{
            margin-left: 0;
            font-size: 13px;
        }
        .contact h3 .currentAdd{
            color: #767676;
            background: #f1f2f7;
            font-family: 'Open Sans',sans-serif;
            font-size: 13px;
            font-weight: 500;
            margin-left: 10px;
        }
        .location-info {
            font-size: 13px;
            font-weight: 700;
            color: #767676;
        }
        .location-info  .previousAdd{
            color: #767676;
            background: #f1f2f7;
            font-family: 'Open Sans',sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding-left: 10px;
        }
        .top-def {
            margin-top: 6px;
        }
        .location-info.contact {
            padding-top: 20px;
        }
        input.form-control.plusInside.cus-control.edit_record_desc_38.edit_edu_record {
            border-left: unset;
        }
        .edu-rec.input-plus.color-green {
            /* padding-left: 15px; */
            position: absolute;
            right: 67px;
        }
        .backIcon i {
            color: #1f88b5;
            font-size: 20px;
        }
        .backIcon {
            text-align: right;
            margin-bottom: 25px;
        }
    </style>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->


        <div class="row">
        <div class="col-md-12">
            <div class="backIcon"> <a href="{{ url('/service-user-management') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i></a> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                            <?php
                                $user_image = $patient->image;
                                if($afc_status == 1) {
                                    $profile_color = 'profile_active';
                                } else {
                                    $profile_color = 'profile_inactive';
                                }

                                if(empty($user_image)){
                                    $user_image = 'default_user.jpg';
                                } 
                            ?> 

                           <div class="profile-pic text-center">
                               <img src="{{ env('APP_URL') }}/{{ serviceUserProfileImagePath.'/'.$user_image }}" alt="" class="profile_click {{ $profile_color }}"/>
                            </div>
                            <div class="contact">
                                <h3><span><i class="fa fa-map-marker"></i></span> Current location <a href="javascript:void(0)" class="location-edit-btn" clmn-name="current_location"><i class="fa fa-pencil profile"></i> </a> <span class="currentAdd">{!! $patient->current_location !!} </span></h3>
                               
                            </div> 
                            <div class="location-info">    
                                <strong>Previous Location</strong> <span class="previousAdd">{!! $patient->previous_location !!}</span>
                            </div>
                       </div>

                       <div class="col-md-7 col-sm-9 col-xs-12">
                           <div class="profile-desk wrap-div">
                            <!-- <a  href="javascript:;" class="reprt_modl reprt-icon" title="Report" srvcUserId="{{ $service_user_id }}">Report &nbsp;<i class="fa fa-file-o"></i></a> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>{{ ucfirst($patient->name) }}</h1>
                                    <span class="text-muted">{{ date('d/m/Y',strtotime($patient->date_of_birth)) }}</span>
                              
                                    <div class="location-info contact">
                                        <h2 id="modal_data"> <span><i class="fa fa-phone"></i></span> Contacts <a href="javascript:void(0)" class="contact-edit-btn" phone_no="{{ $patient->phone_no }}" mobile="{{ $patient->mobile }}" email="{{ $patient->email }}"><i class="fa fa-pencil profile"></i></a> </h2>
                                        <span ><strong style="color:#3399CC; display:inline-block; margin-bottom: 10px;">Phone</strong> : <span id="phone_number">{!! $patient->phone_no !!}</span> 
                                            <strong style="color:#3399CC; display:inline-block; margin-bottom: 10px;">Mobile</strong> : <span id="mobile_number">{!! $patient->mobile !!}</span>
                                            <strong style="color:#3399CC; display:inline-block; margin-bottom: 10px;">Email</strong> : <span id="email_id">{!! $patient->email !!}</span></span>
                                        <p id="all_social_app">
                                            
                                            <?php foreach($social_app as $key => $value) {
                                                $app_name      = $value['name'];
                                                $social_app_id = $value['id'];
                                                $icon = $value['icon'];
                                                $field_value = (isset($social_app_val[$social_app_id]['value'])) ? $social_app_val[$social_app_id]['value'] : '';
                                            ?>      
                                            <strong style="color:#3399CC; display:inline-block; margin-bottom: 10px;">
                                            <a href="{{ $field_value }}"><i class="{{ $icon }}"></i></a></strong>
                                            <?php } ?>                                             
                                        </p>
                                        <p class="top-def">{{ $patient->short_description }}</p>
                                        <p class="info">
                                            <strong style="color:#3399CC;">Years Old</strong> :   
                                            <?php
                                                $dob = Carbon\Carbon::parse($patient->date_of_birth);
                                                echo $age = $dob->diffInYears();
                                            ?>
                                            <strong style="color:#3399CC; "> &nbsp  &nbsp Admission Number</strong> : {{ $patient->admission_number }}
                                            <strong style="color:#3399CC;"> &nbsp  &nbsp Section</strong> : {{ $patient->section }}
                                            <?php $risk_status = App\Models\Risk::overallRiskStatus($service_user_id);
                                                if($risk_status == 1){
                                                    $color = 'orange-clr';
                                                    $risk_status = 'Historic';
                                                } else if($risk_status == 2){
                                                    $color = 'red-clr';
                                                    $risk_status = 'High';
                                                } else{
                                                    $color = 'darkgreen-clr';
                                                    $risk_status = 'No';
                                                }
                                            ?> 
                                            <strong style="color:#3399CC;"> &nbsp  &nbsp Risk</strong> :  {{ $risk_status }} 
                                        </p>
                                        <p class="info">
                                            <strong style="color:#3399CC;">Height</strong> : {{ $patient->height }}
                                            <strong style="color:#3399CC; "> &nbsp  &nbsp Weight</strong> : {{ $patient->weight }}
                                            <strong style="color:#3399CC;"> &nbsp  &nbsp Hair & Eyes</strong> : {{ $patient->hair_and_eyes }}
                                            <strong style="color:#3399CC;"> &nbsp  &nbsp Markings</strong> : {{ $patient->markings }}
                                        </p>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="contact">
                                        <h2> <span><i class="fa fa-map-marker"></i></span> Current location <a href="javascript:void(0)" class="location-edit-btn" clmn-name="current_location"><i class="fa fa-pencil profile"></i> </a> </h2>
                                        <div class="location-info current_location"><p>{!! $patient->current_location !!}</p></div>

                                    </div> 
                                    <div class="location-info ">    
                                        <strong style="color:#3399CC;">Previous Location</strong><br>
                                        <div class="previous_location"><p>{!! $patient->previous_location !!}</p></div>
                                    </div>
                                </div> -->
                            </div>
                             
                            
                               <!-- <div class="profile-statistics back-res">
                               <?php
                                    $dob = Carbon\Carbon::parse($patient->date_of_birth);
                                    $age = $dob->diffInYears();
                                ?>
                               <h1>{{ $age }}</h1>
                               <p>Years Old</p>
                               <h1>{{ $patient->admission_number }}</h1>
                               <p>Admission Number</p>  
                               <h1>{{ $patient->section }}</h1>
                               <p>Section</p>
                                <?php $risk_status = App\Models\Risk::overallRiskStatus($service_user_id);
                                    if($risk_status == 1){
                                        $color = 'orange-clr';
                                        $risk_status = 'Historic';
                                    } else if($risk_status == 2){
                                        $color = 'red-clr';
                                        $risk_status = 'High';
                                    } else{
                                        $color = 'darkgreen-clr';
                                        $risk_status = 'No';
                                    }
                                ?>
                               <h1 id="su_risk_status" class="{{ $color }}">{{ $risk_status }}</h1>
                               <p>Risk</p> 
                                <?php 
                                if(isset($noti_data['back_path'])){ ?>
                                   <div class="cus-back-btn">
                                       <a href="{{ $noti_data['back_path'] }}" class="btn cus-btn btn-warning">Continue</a>
                                   </div>
                                <?php } ?>                            
                           </div> --> 
                               <!--<a href="#" class="btn btn-primary">Read Full Profile</a>-->
                           </div>
                       </div>
                       <div class="col-md-2 p-0">
                        
                        <p class="center-icons">
                            <span class="profile-bigico"> 
                                <a href="{{ url('/service/calendar/'.$service_user_id) }}" title="Calendar"><i class="fa fa-calendar"></i></a>
                                <!-- <a href="" title="{{ $labels['mfc']['label'] }}" class="mfc"><i class="fa fa-user-times"></i></a> 
                                <a href="" title="{{ $labels['living_skill']['label'] }}" class="living-skill-list"><i class="fa fa-child"></i></a>  -->
                                <a data-toggle="modal" href="#filemngrModal" title="File Manager"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                                <!-- <a data-toggle="modal" href="#filemngrModal" title="YP Log Book"><i class="fa fa-address-book-o"></i></a> -->
                                <!-- <a href="javascript:void(0)" class="moneylist" rel="{{$service_user_id}}" title="Money Requests"><i class="fa fa-credit-card"></i></a> -->
                                <!-- <a data-toggle="modal" href="#careCenterModel" title="Care Center"><i class="fa fa-building-o "></i></a> -->
                                <!-- <a href="javascript:void(0)" class="eventreq" title="Event Date Change Request"><i class="fa fa-calendar-times-o"></i></a> -->
                                <!-- <a href="{{ url('/service/location-history/'.$service_user_id) }}" title="Location History"><i class="fa fa-map-marker"></i></a> -->
                                <a  href="{{url('/select/report?key='.base64_encode($service_user_id))}}" class="" title="Report" srvcUserId="{{ $service_user_id }}"><i class="fa fa-file-o"></i></a>
                            </span>
                        </p>
                       </div>
                    </div>
                </section>
            </div> 
           
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading tab-bg-dark-navy-blue cus-panel-heading">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a data-toggle="tab" href="#overview">Overview</a>
                            </li>
                            <li><a data-toggle="tab" href="#job-history">Care History</a></li>
                            <!-- <li><a data-toggle="tab" href="#contacts" class="contact-map">Contacts</a></li> -->
                            <li><a data-toggle="tab" href="#profile_detail">Full Profile</a></li>
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <!-- new 8  -->
                                            <div class="foor-box-wrap">
                                                <div class="col-lg-12 p-r-0 resp-padd-right">
                                                        <!-- <div class="col-md-3 col-sm-4 col-xs-12 ">
                                                            <div class="profile-nav alt">
                                                                <a href="{{ url('/service/earning-scheme/'.$service_user_id) }}">
                                                                    <section class="panel text-center profile-square" style="">
                                                                        <div class="user-heading alt wdgt-row purple-bg">
                                                                            <i class="{{ $labels['earning_scheme']['icon'] }}"></i> <!-- fa fa-star-half-o --
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="wdgt-value">
                                                                                {{  $labels['earning_scheme']['label'] }}
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                </a>
                                                            </div>
                                                        </div> -->

                                                         <div class="col-md-2 col-sm-4 col-xs-12 ">
                                                            <div class="profile-nav alt" >
                                                                <!-- <a data-toggle="modal" href="#logBookModal"> -->
                                                                <a href="{{ url('/service/daily-logs?key='.$service_user_id) }}">
                                                                    <section class="panel text-center profile-square">
                                                                        <div class="user-heading alt wdgt-row bg-blue">
                                                                            <i class="fa fa-address-book-o"></i>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="wdgt-value">Daily Log</div>
                                                                        </div>
                                                                    </section>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-sm-4 col-xs-12">
                                                            <div class="profile-nav alt" >
                                                                <a href="{{ url('/service/health-records/'.$service_user_id) }}">
                                                                <section class="panel text-center profile-square">
                                                                    <div class="user-heading alt wdgt-row terques-bg">
                                                                        <i class="{{ $labels['health_record']['icon'] }}"></i>
                                                                        <!-- <i class="fa fa-heartbeat"></i> -->
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="wdgt-value">{{ $labels['health_record']['label'] }}</div>
                                                                    </div>
                                                                </section>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-sm-4 col-xs-12">
                                                            <div class="profile-nav alt">
                                                                <a data-toggle="modal" href="#planModal">
                                                                    <section class="panel text-center profile-square">
                                                                        <div class="user-heading alt wdgt-row red-bg">
                                                                            <i class="fa fa-handshake-o"></i>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="wdgt-value">Plans</div>
                                                                        </div>
                                                                        
                                                                      </section>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <!-- </div> -->

                                                    <div class="col-md-2 col-sm-4 col-xs-12 mfc">
                                                        <div class="profile-nav alt">
                                                            <section class="panel text-center profile-square">
                                                                <div class="user-heading alt wdgt-row label-inverse">
                                                                    <i class="{{ $labels['mfc']['icon'] }}"></i>
                                                                        <!-- <i class="fa fa-user-times"></i> -->
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="wdgt-value">
                                                                        {{ $labels['mfc']['label'] }}
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-sm-4 col-xs-12 living-skill-list">
                                                        <div class="profile-nav alt" >
                                                            <section class="panel text-center profile-square">
                                                                <div class="user-heading alt wdgt-row label-success">
                                                                    <i class="{{ $labels['mfc']['icon'] }}"></i>
                                                                        <!-- <i class="fa fa-child"></i> -->
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="wdgt-value">{{ $labels['living_skill']['label'] }}</div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-sm-4 col-xs-12 incident_plan_modal">
                                                        <div class="profile-nav alt" >
                                                            <section class="panel text-center profile-square">
                                                                <div class="user-heading alt wdgt-row label-warning">
                                                                    <i class="{{ $labels['incident_report']['icon'] }}"></i>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="wdgt-value">
                                                                        {{ $labels['incident_report']['label'] }}
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="foor-box-wrap">
                                                <div class="col-lg-6 p-l-0 resp-padd-left">

                                                        <!-- <div class="col-md-3 col-sm-4 col-xs-12 mood-chart">
                                                            <div class="profile-nav alt">
                                                                <section class="panel text-center profile-square">
                                                                    <div class="user-heading alt wdgt-row label-danger">
                                                                        <i class="fa fa-thermometer-3"></i>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="wdgt-value">
                                                                            <!-- Emotional Health and Well Being / Mood Chart --
                                                                            Emotional Thermometer
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div> -->

                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="below-divider"></div>
                                            </div>

                                            <!-- sagar button -->
                                            <div class="col-md-12">
                                            <a href="{{ url('/service/risks/'.$service_user_id) }}" class="view_log">Risk Log</a>
                                                <!-- <a href="https://itdevelopmentservices.com/socialcareitsolutions/service/risks/19" class="view_log">Risk Log</a> -->
                                            </div>
                                            <!-- button end -->
                                            @include('frontEnd.serviceUserManagement.elements.risk_change.risk') 
                                        </div> 
                                    </div>

                                    <div class="col-md-4">  
                                        <div class="feed-box text-center"></div>
                                        <div class="profile-nav alt"></div>

                                        <!-- notification start -->
                                        <section class="panel m-0">
                                            <header class="panel-heading"> Notification
                                            <!-- <span class="tools pull-right"> 
                                                <a href="javascript:;" class="fa fa-chevron-down"></a> 
                                                <a href="javascript:;" class="fa fa-cog"></a> <a href="javascript:;" class="fa fa-times"></a> 
                                            </span> --> 

                                            </header>
                                            <div class="panel-body  min-ht-0 srvc_usr_ntf">
                                                @include('frontEnd.serviceUserManagement.elements.su_profile_notification')
                                            </div>
                                        </section>

                                        @include('frontEnd.serviceUserManagement.elements.profile.care_team')
                                    </div>
                                </div>
                            </div>
                            @include('frontEnd.serviceUserManagement.elements.profile.care_history')                            
                            @include('frontEnd.serviceUserManagement.elements.profile.contacts')
                            @include('frontEnd.serviceUserManagement.elements.profile.profile_detail_info')
                        </div>
                    </div>    
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

    @include('frontEnd.serviceUserManagement.elements.daily_record')  
    @include('frontEnd.serviceUserManagement.elements.health_record')
    @include('frontEnd.serviceUserManagement.elements.plans')
    @include('frontEnd.serviceUserManagement.elements.file_manager')
    @include('frontEnd.serviceUserManagement.elements.bmp-rmp')
    @include('frontEnd.serviceUserManagement.elements.rmp')
    @include('frontEnd.serviceUserManagement.elements.bmp')
    @include('frontEnd.serviceUserManagement.elements.mood')
    @include('frontEnd.serviceUserManagement.elements.incident_report')
    @include('frontEnd.serviceUserManagement.elements.living_skill')  
    @include('frontEnd.serviceUserManagement.elements.education_record')  
    @include('frontEnd.serviceUserManagement.elements.mfc')  
    @include('frontEnd.serviceUserManagement.elements.wear_record')  
    @include('frontEnd.serviceUserManagement.elements.log_book')
    @include('frontEnd.serviceUserManagement.elements.my_money')
    @include('frontEnd.serviceUserManagement.elements.event_request')
    @include('frontEnd.serviceUserManagement.elements.careCenter.index')
    @include('frontEnd.serviceUserManagement.elements.careCenter.message_office')
    @include('frontEnd.serviceUserManagement.elements.careCenter.need_assistance')
    @include('frontEnd.serviceUserManagement.elements.risk_change.body_map_popup')
    @include('frontEnd.serviceUserManagement.elements.report')

<script>
    var ellipse = $('.wdgt-value')[0];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[1];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[2];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[3];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[4];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[5];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[6];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
    var ellipse = $('.wdgt-value')[7];
    $clamp(ellipse, {clamp: 4, useNativeClamp: false});
</script>

<!-- <script>
    $('.input-plusbox').hide();
    $('.input-plus').on('click',function(){
        $(this).closest('.cog-panel').find('.input-plusbox').toggle();
    });
</script> -->

<script>
    $(document).ready(function(){   
        $("#img_upload1").change(function()
        {   
            var img_name = $(this).val();
            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
                if(ext =="jpg" || ext =="jpeg" || ext =="gif" || ext =="png")
                {
                    input=document.getElementById('img_upload1');
                    if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#img_upload1").removeAttr("src");
                      alert("image size should be at least 10KB and upto 2MB");
                      return false;
                    }
                 }
               else
                {
                    $(this).val('');
                    alert('Please select an image .jpg, .png, .gif file format type.');
                }
            }
        return true;
        }); 
    });
</script>

<script>
    $(function() {
        $("#add_care_team").validate({
            rules: {
                // job_title: {
                //     required: true,  
                //     regex: /^[a-zA-Z'.\s]{1,40}$/          
                // },
                name: {
                    required: true,
                    regex: /^[a-zA-Z'.\s]{1,40}$/
                },
                email: {
                    required: true,
                    email: true
                },

                address:{ 
                    required: true,
                    regex: /^[a-zA-Z0-9'#-,.\s]{1,100}$/
                },

                image:{
                    required: true
                },

                phone_no:{
                    required: true,
                    regex: /^[0-9+\s]{10,13}$/
                }
            },

            messages: {
                //job_title: "This field is required.",
                name: "This field is required.",
                email: "This field is required.",
                address: "This field is required.",
                address: "This field is required.",
                image: "This field is required.",
                phone_no: "This field is required.",
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

<script>
    $(document).ready(function(){  
        $(document).on('click','.cancel-btn',function(){
            $('#add_care_team').find('input').val('');
            $('#add_care_team').find('textarea').val('');
            $('#add_care_team').find('img').attr('src','');
            $('label.error').hide();
            var token = "{{ csrf_token() }}";
            $('input[name=\'_token\']').val(token);
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#overview .profile-nav').on('click',function(){
            $(this).find('.overviw-dropdown').toggle();
            $(this).parent('div').siblings('div').find('.overviw-dropdown').hide();
        });

        $(window).on('click',function(e){
            e.stopPropagation();
            var $trigger = $("#overview .profile-nav");
            if($trigger !== e.target && !$trigger.has(e.target).length){
                $('.overviw-dropdown').hide();
            }
        });
    });
</script>

<!--  AIzaSyBxsKWUJ690EsTa1o0Q2VF6BWXgIiFPKZo -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&AMP;sensor=false"></script> 
<?php $api_key = env('GOOGLE_MAP_API_KEY'); ?>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap">
</script> 

<script>
$(document).ready(function(){
    autosize($("textarea"));
    //google map
    function initialize() {
        var myLatlng = new google.maps.LatLng({{ $latitude }}, {{ $longitude }});
        var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: '{{ $patient->name }}'
        });

        //2nd
        var myLatlng2 = new google.maps.LatLng('30.9115517','75.8770886');
        var marker = new google.maps.Marker({
            position: myLatlng2,
            map: map,
            title: 'mk'
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    /*$('.contact-map').click(function(){
        //google map in tab click initialize
        function initialize() {
            var myLatlng = new google.maps.LatLng({{ $latitude }}, {{ $longitude }});
            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: '{{ $patient->name }}'
            });
        }

        google.maps.event.addDomListener(window, 'click', initialize);
    });*/
});
</script>

<script type="text/javascript">
    $(document).on('click','.reprt_modl',function(){
        var srvc_user_id = $(this).attr('srvcuserid');
        // console.log(srvc_user_id);
        $('input[name=srvcc_usrr_id]').val(srvc_user_id);
        $('#ChooseReportModal').modal('show');
    });
</script>
<script type="text/javascript">
    $('.mfc').click(function(){
            //alert(1); return false;
            var service_user_id = "{{ $service_user_id }}";

            $('.loader').show();
            $('body').addClass('body-overflow');

            $('.dynamic-mfc-fields').find('input').val('');
            $('#mfcModal').modal('show');

            $('.loader').hide();
            $('body').removeClass('body-overflow');
            return false;
        });

    $(document).on('click', '.living-skill-list', function() {
            $('.loader').show();
            $('body').addClass('body-overflow');
            var service_user_id = "{{ $service_user_id }}";
            $.ajax({
                type: 'get',
                url: "{{ url('/service/living-skills') }}" + '/' + service_user_id,
                success: function(resp2) {
                    if (isAuthenticated(resp2) == false) {
                        return false;
                    }
                    if (resp2 == '') {
                        $('.su-skill').html('<div class="text-center p-b-20" style="width:100%">No Records found.</div>');
                    } else {
                        $('.su-skill').html(resp2);
                    }
                    // $('.su-skill').html(resp2);
                    $('#livingSkillModal').modal('show');
                    $('.add-new-btn').click();
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    $(document).on('click','.incident_plan_modal', function(){
        $('input[name=\'search_incident_record\']').val('');
        $('#IncidentAddModal').modal('show');
        });
        $('#IncidentAddModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });
    
</script>


@endsection