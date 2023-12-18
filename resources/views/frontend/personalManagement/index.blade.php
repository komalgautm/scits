@extends('frontEnd.layouts.master')
@section('title','Staff Management')
@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <?php 
                        foreach($staff as $staff) {
                            $user_image = $staff->image;
    
                            if(empty($user_image)){
                                $user_image = 'default_user.jpg';
                            } 
                    ?>
                    <div class="col-md-6" >
                        <!--widget start-->
                        <aside class="profile-nav alt">
                            <section class="panel">
                                <div class="user-heading cususr-head alt gray-bg">
                                    <a href="{{ url('/staff/profile/'.$staff->id) }}" class="" id="{{ $staff->id }}">
                                    <img alt="user image" src="{{ userProfileImagePath.'/'.$user_image }}" class="">
                                    </a>
                                    <h1><a href="{{ url('/staff/profile/'.$staff->id) }}" class="name-clr">{{ $staff->name }}</a></h1>
                                    <p> {{ $staff->job_title }} </p>
                                </div>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="javascript:;"> <i class="fa fa-pencil"></i> Personal Details <span class="badge label-warning pull-right r-activity">04</span></a></li>
                                  <!--   <li><a href="javascript:;"> <i class="fa fa-star-half-o"></i> Contact Details <span class="badge label-warning pull-right r-activity">02</span></a></li> -->
                                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Annual Leave <span class="badge label-success pull-right r-activity">00</span></a></li>
                                    <li><a href="javascript:;"> <i class="fa fa-heart"></i> Sick Records <span class="badge label-warning pull-right r-activity">02</span></a></li>
                                    <li><a href="javascript:;"> <i class="fa fa-map-marker"></i> Rates of Pay <span class="badge label-success pull-right r-activity">00</span></a></li>
                                    <li><a href="javascript:;"> <i class="fa fa-scissors"></i> Manage Rota <span class="badge label-warning pull-right r-activity">02</span></a></li>
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

@endsection