@extends('frontEnd.layouts.lockscreen')
@section('title',' Lockscreen')
@section('content')


@include('frontEnd.common.alert_messages')

<script type = "text/javascript" >
    //prevent back button
    $().ready(function() {
        //if(document.referrer != 'http://localhost:8181/'){
            var lockscreen_url = "{{ url('/lockscreen') }}"; 
            history.pushState(null, null, lockscreen_url);
            window.addEventListener('popstate', function () {
                history.pushState(null, null, lockscreen_url);
            });
        //}
    });
</script>

<body class="lock-screen" onload="startTime()">

    <div class="lock-wrapper">
        <div id="time"></div>

        <div class="lock-box text-center">
            <?php
                $user_image = Auth::user()->image;
                if(empty($user_image)){
                    $user_image = 'default_user.jpg';
                }
            ?>
            <form role="form" action="{{ url('/lockscreen') }}" method="post" >
                <div class="form-group">
                    <!-- <div class="lock-name">{{ ucfirst(Auth::user()->name) }}</div> -->
                    <input name="user_name" type="text" placeholder="User Name" id="exampleInputUserName" class="form-control lock-name" autofocus="TRUE" autocomplete="off" value="{{ ucfirst(Auth::user()->user_name) }}">
                    <img src="{{ env('FILE_URL').userProfileImagePath.'/'.$user_image }}" alt=""/>
                    <div class="lock-pwd">
                        <input name="password" type="password" placeholder="Password" id="exampleInputPassword2" class="form-control lock-input" autofocus="TRUE" autocomplete="off">
                        {{ csrf_field() }}
                        <button class="btn btn-lock" type="submit">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
</body>
@endsection