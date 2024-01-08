@extends('frontEnd.layouts.master')
@section('title','Service User Management')
@section('content')


<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <input type="hidden" name="service_user_id" class="selected_su_id" value="">
                    <?php 
                        foreach($patients as $patient) {
                            $user_image = $patient->image;
                            $afc_status = App\Models\ServiceUser::get_afc_status($patient->id);
                            if($afc_status == 1) {  
                                $profile_colors = 'profile_active';
                            } else {
                                $profile_colors = 'profile_inactive';
                            }
                            if(empty($user_image)){
                                $user_image = 'default_user.jpg';
                            } 
                        $notifi_count_personal = App\Models\ServiceUserManagement::personalDetailNotifyCount($patient->id);
                        
                        if($notifi_count_personal == 0) {
                            $notifi_count_personal_clr = 'label-success';
                        } else if($notifi_count_personal <= 10) {
                            $notifi_count_personal_clr = 'label-warning';
                        } else {
                            $notifi_count_personal_clr = 'label-danger';
                        }

                        $notifi_pp = App\Models\ServiceUserManagement::placementNotifyCount($patient->id);
                        // echo "<pre>"; print_r($notifi_pp); die;
                        $ern_schme_count  = App\Models\ServiceUserManagement::EarningNotifyCount($patient->id);
                        $afc_status_count = App\Models\ServiceUserManagement::AFCNotifyCount($patient->id);

                        $health_record_count = App\Models\ServiceUserManagement::healthRecordCount($patient->id);
                        $risk_notif = App\Models\ServiceUserRisk::riskNotifCount($patient->id);

                        $risk_status = App\Models\Risk::overallRiskStatus($patient->id);
                        if($risk_status == 1){
                            $notif_color = 'label-warning';
                        } else if($risk_status == 2){
                            $notif_color = 'label-danger';
                        } else{
                            $notif_color = 'label-success';
                        }
  
                    ?>
                    <div class="col-md-6" >
                        <!--widget start-->
                        <aside class="profile-nav alt">
                            <section class="panel">
                                <div class="user-heading cususr-head alt gray-bg">
                                    <a href="{{ url('/service/user-profile/'.$patient->id) }}" su_id="{{ $patient->id }}" class="profile_click {{ $profile_colors }} su-set-btn"><!-- sum_profile_click -->
                                    <img alt="user image" src="{{ serviceUserProfileImagePath.'/'.$user_image }}" class="">
                                    </a>
                                    <h1><a href="{{ url('/service/user-profile/'.$patient->id) }}" class="name-clr">{{ $patient->name }}</a></h1>
                                    <p>Section {{ $patient->section }}</p>
                                </div>
                                <?php //echo '<pre>'; print_r($labels); die; ?>
                                <ul class="nav nav-pills nav-stacked">
                                    <li ><a href="{{ url('/service/user-profile/'.$patient->id) }}"> <i class="fa fa-pencil"></i> Personal Details <span class="badge label-success pull-right {{ $notifi_count_personal_clr }}">{{ (strlen($notifi_count_personal) < 2) ? '0':'' }}{{ $notifi_count_personal }}</span></a></li>

                                    <li><a href="{{ url('/service/earning-scheme/'.$patient->id) }}"> <i class="{{ $labels['earning_scheme']['icon'] }}"></i> {{$labels['earning_scheme']['label']}} <span class="badge pull-right r-activity {{ $ern_schme_count['color'] }}">{{ (strlen($ern_schme_count['count']) < 2) ? '0':'' }}{{ $ern_schme_count['count'] }}</span></a></li>
                                    <!-- daily-record-list -->
                                    <li><a href="{{ url('/service/user-profile/'.$patient->id) }}" su_id="{{ $patient->id }}" class=" su-set-btn"> <i class="{{ $labels['mfc']['icon'] }}"></i>{{ $labels['mfc']['label'] }} <span class="badge pull-right r-activity {{ $afc_status_count['color'] }}">{{ (strlen($afc_status_count['count']) < 2) ? '0':'' }}{{ $afc_status_count['count'] }}</span></a></li>

                                    <li><a href="{{ url('/service/health-records/'.$patient->id) }}"> <i class="{{ $labels['health_record']['icon'] }}"></i>{{$labels['health_record']['label']}} <span class="badge pull-right r-activity {{ $health_record_count['color'] }}">{{ (strlen($health_record_count['count']) < 2) ? '0':'' }}{{ $health_record_count['count'] }}</span></a></li>

                                    <li><a href="{{ url('/service/placement-plans/'.$patient->id) }}"> <i class="{{$labels['placement_plan']['icon']}}"></i> {{ $labels['placement_plan']['label'] }} <span class="badge pull-right r-activity {{ $notifi_pp['color'] }}">{{ (strlen($notifi_pp['count']) < 2) ? '0':'' }}{{ $notifi_pp['count'] }}</span></a></li>

                                    <li><a href="{{ url('/service/user-profile/'.$patient->id) }}"> <i class="fa fa-scissors"></i> Risks <span class="badge {{ $notif_color }} pull-right r-activity">{{ (strlen($risk_notif) < 2) ? '0' : '' }}{{ $risk_notif }}</span></a></li>
                                </ul>
                            </section>
                        </aside>
                        <!--widget end-->
                    </div>
                    <?php } ?>
                </div>
                <div class="row"></div>
                <div class="row"></div>
                <div class="row"></div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                </div>
                <div class="profile-nav alt">
                </div>
                <section class="panel">
                    @include('frontEnd.common.notification_bar')
                </section>
            </div>
        </div>
        <!--mini statistics start--><!--mini statistics end-->
        <div class="row"></div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
</section>
<?php $service_user_id = isset($service_user_id) ? $service_user_id : ''; ?>

    <!-- include('frontEnd.common.incident_report') -->

    @include('frontEnd.serviceUserManagement.elements.daily_record')  
    @include('frontEnd.serviceUserManagement.elements.health_record')
    @include('frontEnd.serviceUserManagement.elements.wear_record')


<script >
    //show popups of links
    $('.su-set-btn').click(function(){
        //saving the current selected service user id in a temporary location
        var su_id = $(this).attr('su_id');
        //alert(su_id);
        $('.selected_su_id').val(su_id);
       
        //updating calendar url acc. to su id
        var calndr_url = "{{ url('/service/calendar') }}"+'/'+su_id;
        $('.su-botm-calndr').attr('href',calndr_url);
        $('.add-new-btn').click();

    });

    // photo right click functionality  
        $('.profile_click').bind('contextmenu', function (e) {
            var su_id = $(this).attr('su_id');
            $('.selected_su_id').val(su_id);
            e.preventDefault();
        });
</script>

@endsection