<!-- notification start -->

<section class="panel m-0">
    <header class="panel-heading"> Notification <span class="tools pull-right"> <a href="javascript:;" class="fa fa-chevron-down"></a> <a href="javascript:;" class="fa fa-cog"></a> <a href="javascript:;" class="fa fa-times"></a> </span> </header>
    <div class="panel-body">

        <?php foreach($notifications as $notification)  {
                $created_at = $notification->created_at;
                $created_at1 = Carbon\Carbon::parse($created_at);
                $diff = $created_at1->diffForHumans();
                // $current = Carbon\Carbon::now();

                if($notification->event_type == "H")   {
                    $event_name = "Health Record";
                    $tile_color = "alert alert-health";     //terques
                    // $tile_color = "alert alert-danger";     //terques
                    $icon = "fa fa-heartbeat";
                }
                elseif($notification->event_type == "D")   {
                    $event_name = "Daily Record";
                    $tile_color = "alert alert-info";       //blue
                    $icon = "fa fa-calendar ";
                }
                elseif($notification->event_type == "E")   {
                    $event_name = "Earning Scheme";
                    $tile_color = "alert alert-earning";   //purple
                    $icon = "fa fa-calendar ";
                }
                elseif($notification->event_type == "P")   {
                    $event_name = "Placement Plan";
                    $tile_color = "alert alert-placement";   //purple
                    $icon = "fa fa-map-marker";
                }
                
        ?>
        <div class="{{ $tile_color }} clearfix">
        
            <span class="alert-icon"><i class="{{ $icon }}"></i></span>
            <div class="notification-info">
                <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><span><a href="#">{{ $notification->su_name }}</a></span></li>
                    <li class="pull-right notification-time">{{ $diff }}</li>
            <!--    <li class="pull-right notification-time">1 min ago</li> !-->
                </ul>
                <p>{{ $notification->message }}</p>
            </div>
        </div>
        <?php   }   ?>

            <!-- <div class="alert alert-danger">
                <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender"><span><a href="#"></a></span></li>
                        <li class="pull-right notification-time">2 Days Ago</li>
                    </ul>
                    <p> Earning Scheme review overdue</p>
                </div>
            </div>
            <div class="alert alert-warning ">
                <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">Jeremy Fischer</li>
                        <li class="pull-right notification-time">3 Days Ago</li>
                    </ul>
                    <p> Health record review date coming up </p>
                </div>
            </div>
            <div class="alert alert-success m-0">
                <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender"><a href="#">Steven Hall</a></li>
                        <li class="pull-right notification-time">4 Days Ago</li>
                    </ul>
                    <p> Daily record all upto date</p>
                </div>
            </div> -->
    </div>
</section>  
    <!--notification end-->


                <!-- <section class="panel">
                    <header class="panel-heading">
                        Notification <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-cog"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="alert alert-info clearfix">
                            <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">Steven Hall</a></span></li>
                                    <li class="pull-right notification-time">1 min ago</li>
                                </ul>
                                <p>
                                    Needs to be contacted by a member of staff
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-danger">
                            <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">Jeremy Fisher</a></span></li>
                                    <li class="pull-right notification-time">7 Hours Ago</li>
                                </ul>
                                <p>
                                    Placement Plan 6 days overdue!
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-success ">
                            <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><a href="#">Lewis Danes</a></li>
                                    <li class="pull-right notification-time">1 Day ago</li>
                                </ul>
                                <p> Placement Plan is complete.</p>
                            </div>
                        </div>
                        <div class="alert alert-warning ">
                            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender">Jeremy Fisher</li>
                                    <li class="pull-right notification-time">1 Day Ago</li>
                                </ul>
                                <p>
                                    Health record review date coming up
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-success ">
                            <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><a href="#">Steven Hall</a></li>
                                    <li class="pull-right notification-time">1 Day ago</li>
                                </ul>
                                <p> Daily record all upto date</p>
                            </div>
                        </div>
                        <div class="alert alert-danger">
                            <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">Steven Hall</a></span></li>
                                    <li class="pull-right notification-time">2 Days Ago</li>
                                </ul>
                                <p>
                                    Earning Scheme review overdue
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-success ">
                            <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><a href="#">Lewis Danes</a></li>
                                    <li class="pull-right notification-time">2 Days Ago</li>
                                </ul>
                                <p> Placement Plan is complete.</p>
                            </div>
                        </div>
                        <div class="alert alert-warning ">
                            <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender">Jeremy Fisher</li>
                                    <li class="pull-right notification-time">3 Days Ago</li>
                                </ul>
                                <p>
                                    Health record review date coming up
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-success ">
                            <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><a href="#">Steven Hall</a></li>
                                    <li class="pull-right notification-time">4 Days Ago</li>
                                </ul>
                                <p> Daily record all upto date</p>
                            </div>
                        </div>
                    </div>
                </section> -->
                                <!--notification end