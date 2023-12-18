@extends('backEnd.layouts.master')

@section('title',$labels['earning_scheme']['label'])

@section('content')

<style type="text/css">
    .ghaint {
      margin: 0 0 20px;
    }
    .head-star {
      font-size: 22px;
      line-height: 73px;
      margin-right: 40px;
    }
    .star-bigg i {
      color: #fed853;
      font-size: 80px;
      position: relative;
    }
    .star-bigg i + .valStar {
      color: #5aaa63;
      font-size: 23px;
      font-weight: bold;
      position: absolute;
      right: 46px;
      text-align: center;
      top: 28%;
    }
    .user-heading.alt {
      display: inline-block;
      text-align: left;
      width: 100%;
    }
    .profile-nav .user-heading {
      border-radius: 4px 4px 0 0;
      color: #fff;
      padding: 30px;
      text-align: center;
    }
    .wdgt-value {
      font-size: 14px;
      padding: 3px 0;
      word-wrap: break-word;
    }
    .bg-1 {
        background: #99CCE3 none repeat scroll 0 0 !important;
    }
    .bg-2 {
        background: #EDA4C1 none repeat scroll 0 0 !important;
    }
    .bg-3 {
        background: #AFE399 none repeat scroll 0 0 !important;
    }
    .bg-4 {
        background: #BDA4EC none repeat scroll 0 0 !important;
    }
    .bg-5 {
        background: #FED65A none repeat scroll 0 0 !important;
    }
    .bg-6 {
        background: #7B8DE3 none repeat scroll 0 0 !important;
    }
    .profile-nav {
      border-radius: 5px;
      box-shadow: 0 0 3px 0 #ccc;
    }
    .card-div {
      margin-top: 30px;
    }
    .cal-day {
      color: unset;
      font-weight: 400;
    }
    .cal-day small {
      font-size: 13px;
      text-transform: none;
      display: block;
    }
    /*---Modal ----*/
    .incen-body
    {
        float: left;
        width: 100%;
        padding: 13px 15px 24px
    }
    .incen-main {
      float: left;
      width: 100%;
      border: 1px solid #ddd;
      padding: 10px;
      margin: 10px 0;
    }

    .incen-head .pull-left
    {
        font-size: 18px;
    }
    .incen-main p
    {
        text-align: justify;
        width: 100%;
        float: left;
    }
    .stars-sec
    {
        float: left;
        width: 100%;
    }
    .stars-sec span
    {
        display: inline-block;
    }
    .stars-sec i {
      color: #eb661a;
      font-size: 14px;
    }
    .star-head {
      font-size: 15px;
      margin-right: 5px;
    }
    .star-head.pull-right
    {
        font-size: 14px;
        color: #1F88B5;
    }
    .incen-link {
      color: #1f88b5;
      float: left;
      width: 35%;
    }
    .incen-link:hover
    {
        color: #1f88b5;
    }
    .incen-foot
    {
        float: left;
        width: 100%
    }
    .incen-main .group-ico.btn {
      margin-top: -6px;
      padding: 5px 0 4px;
    }
    .his-main {
      float: left;
      width: 100%;
      border: 1px solid #ddd;
      padding: 6px;
      margin: 5px 0;
      height: 46px;
    }
    .earn-hist-date{
      width:100%; 
      border:0px red solid; 
      color:#1f88b5; 
      text-align:right; 
      padding:5px 10px; 
      margin:-5px 0px;
    }
    .earn-hist-body {
      float: left;
      padding: 13px 15px 24px;
      width: 100%;
    }
    /*---Modal End ----*/
</style>

<?php                 
    if($record_score['daily_record'] >= $earn_area_percent['daily_record']){
        $daily_icon = 'fa fa-check';
        $daily_clas = 'color-green';
    }else{
        $daily_icon = 'fa fa-close';
        $daily_clas = 'color-red';                                    
    }
    if($record_score['living_skill'] >= $earn_area_percent['living_skill']){
        $liv_icon = 'fa fa-check';
        $liv_clas = 'color-green';
    }else{
        $liv_icon = 'fa fa-close';
        $liv_clas = 'color-red';                                    
    }
    if($record_score['mfc'] >= $earn_area_percent['mfc']){
        $mfc_icon = 'fa fa-check';
        $mfc_clas = 'color-green';
    }else{
        $mfc_icon = 'fa fa-close';
        $mfc_clas = 'color-red';                                    
    }
    if($record_score['education_record'] >= $earn_area_percent['education_record']){
        $edu_icon = 'fa fa-check';
        $edu_clas = 'color-green';
    }else{
        $edu_icon = 'fa fa-close';
        $edu_clas = 'color-red';                                    
    }
?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="view-star-history-bck">
                                    <div class="col-sm-8 col-xs-12">
                                        <div class="cal-day">
                                            <span>Today</span>
                                           {{ date('l') }}
                                           <small> Score atleast {{ $earning_target }}% to get a star. </small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 ghaint text-right">
                                        <span class="head-star">Total Stars</span>
                                        <span class="star-bigg pull-right view-star-history">
                                            <i class="fa fa-star-o"></i>
                                            <span class="valStar">{{ $total_stars }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>    
                                    @if(!empty($earning_scheme_label))
                                        @foreach($earning_scheme_label as $key => $label)     
                                        <?php //echo "<pre>"; print_r($label['label_type']); die; ?>                           
                                            <tr>
                                                <td><input type="checkbox" class="labell" name="earning_scheme_label_id" {{@(in_array($label['id'],$service_user_labels)) ? 'checked' : ''}} value="{{$label['id']}}"><br></td>
                                                <td>{{ $label['name'] }}</td>
                                                <td class="action-icn">
                                                    @if($label['label_type'] == 'M')
                                                        <a href="{{ url('admin/service/earning-scheme/mfcs/'.$service_user_id) }}"><i data-toggle="tooltip" title="View!" class="{{ $label['icon'] }}"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('admin/service/earning-scheme/daily-records/'.$service_user_id.'/'.$label['id']) }}"><i data-toggle="tooltip" title="View!" class="{{ $label['icon'] }}"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                            </table>
                        </div>
                                    <!--<tr>
                                        <td>{{ $labels['living_skill']['label'] }}</td>
                                         <td class="action-icn">
                                            <a href="{{ url('admin/service/earning-scheme/living-skills/'.$service_user_id) }}"><i data-toggle="tooltip" title="View!" class="{{ $liv_icon }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $labels['education_record']['label'] }}</td>
                                        <td class="action-icn">
                                            <a href="{{ url('admin/service/earning-scheme/education-records/'.$service_user_id) }}"><i data-toggle="tooltip" title="View!" class="{{ $edu_icon }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $labels['mfc']['label'] }}</td>
                                         <td class="action-icn">
                                            <a href="{{ url('admin/service/earning-scheme/mfcs/'.$service_user_id) }}"><i data-toggle="tooltip" title="View!" class="{{ $mfc_icon }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tr> -->
                        <div class="row card-div">
                            <div class="col-md-12 col-sm-12 col-xs-12 p-0 dashboard-box">
                                <?php 
                                    $i = 1; 
                                    foreach ($earning_scheme as $key => $value) {
                                        
                                        $bg_color[$value['id']] = 'bg-'.$i;
                                        
                                        if($i > 5){
                                            $i = 1;   
                                        } else{
                                            $i++;
                                        }
                                    }
                                foreach ($earning_scheme as $key => $value) { ?>
                                    <div class="col-md-2">
                                        <div class="profile-nav alt incentive_details" earning_category_id="{{ $value['id'] }}">
                                            <section class="panel text-center">
                                                <div class="user-heading alt wdgt-row {{ $bg_color[$value['id']] }}"> <i class="{{ $value['icon'] }}"></i> </div>
                                                <div class="panel-body">
                                                    <div class="wdgt-value">
                                                        <h1 class="count">{{ $value['incentives_count'] }}</h1>
                                                        <p> {{ $value['title'] }} </p>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </section>
</section>


<!-- Incentive Modal  Start -->
<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="incentivesModal" class="modal fade in" aria-hidden="false">
    <div role="document" class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 id="myModalLabel" class="modal-title"> Day trips </h4>
            </div>
            <div class="incen-body">
                <div class="view_incentive_details">
                <!--  Data show using ajax  -->
                </div>               
            </div>

            <!-- <div class="modal-footer incen-foot">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            <div class="row"></div>
        </div>
    </div>
</div>
<!-- Incentive Modal  End -->

<!-- Earning Stars Modal Start -->
<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="EarningHistoryModal" class="modal fade in" aria-hidden="false">
    <div role="document" class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 id="myModalLabel" class="modal-title">Earning History</h4>
            </div>
            <div class="earn-hist-body">
                
                <div class="earnHistScroller">
                    
                    @foreach($earn_history as $value)
                    <div class="his-main">
                    <p class="earn-hist-date"> {{ $value['date'] }}</p>
                        <p>{{ $value['message'] }}</p>
                    </div>
                    @endforeach
                </div>                            
            </div>
            <!-- <div class="modal-footer incen-foot">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            <div class="row"></div>
        </div>
    </div>
</div>
<!-- Earning Stars Modal End  -->

<script>
    //earn history scroller
    $(".earnHistScroller").slimScroll({height:'400px'});
</script>

<script>
    $(document).ready(function(){
        
        $('.view-star-history').on('click',function(){
            $('#EarningHistoryModal').modal('show');
        });

        $('.incentive_details').on('click',function(){
            var earning_category_id = $(this).attr('earning_category_id');
            var earning_category_name = $(this).find('p').text();

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'get',
                url : "{{ url('/admin/service/earning-scheme/view_incentive') }}"+'/'+earning_category_id,
                success: function(resp) {

                    if(resp == '') {
                        alert('No Incentive Found.');
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                        return false;
                    }

                    $('.view_incentive_details').html(resp);
                    $('#incentivesModal .modal-title').text(earning_category_name);
                    $('#incentivesModal').modal('show');

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');   
                }
            });
            return false; 
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".labell").on('click',function(){
            var earning_scheme_label_id = $(this).val();
            var service_user_id = "{{$service_user_id}}";
          
            if($(this).prop("checked") == true){
                // alert("Checkbox is checked.");
                $('.loader').show();
                $.ajax({
                    type:'post',
                    url: "{{ url('/admin/service-user/earning-scheme-label/add') }}"+'/'+service_user_id +'/'+earning_scheme_label_id,
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success: function(resp){
                        if(resp == 'success'){
                            $('.loader').hide();
                            return true;
                        }else{
                            return false;
                        }
                    }
                });
            }
            else if($(this).prop("checked") == false){
                // alert("Checkbox is unchecked.");
                $('.loader').show();
                $.ajax({
                    type:'post',
                    url: "{{ url('/admin/service-user/earning-scheme-label/delete') }}"+'/'+service_user_id +'/'+earning_scheme_label_id,
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success: function(resp){
                        if(resp == 'success'){
                            $('.loader').hide();
                            return true;
                        }else{
                            return false;
                        }
                    }
                });
            }
        });
    });


</script>
@endsection