<style>
    .req_call_listing-li {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      display: block;
      margin-bottom: 15px;
      padding: 7px;
      width: 100%;
    }
</style>

<!-- CareCenter Modal -->
<div class="modal fade" id="careCenterModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Care Center </h4>
            </div>
            <div class="modal-body" >
                <div class="row">  
                    <div class="foor-box-wrap foor-plan">
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" class="message_office" service_user_id="{{ $service_user_id }}" title="Office Message">
                                    <section class="panel text-center profile-square" style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row bg-blue">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                Office Messages
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>    
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" class="need_assistance" rel="{{ $service_user_id }}" title="Need Assistance">
                                    <section class="panel text-center profile-square" style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row orange-bg">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                Need Assistance
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" rel="{{ $service_user_id }}" title="In Danger" class="in-danger-modal">
                                    <section class="panel text-center profile-square " style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row bg-red">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                {{ $su_in_danger }} In Danger
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" rel="{{ $service_user_id }}" title="Request Call back" class="req-callbk-modal">
                                    <section class="panel text-center profile-square" style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row bg-darkgreen">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                {{ $su_req_cb }} Request Call back
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>
                        <!-- <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 bmp_plan_modal" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-danger">
                                        <i class="fa fa-frown-o"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            Message Plan 3
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>   
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 education-record-list" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-inverse">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            Message Plan 4
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //office message view
    $(".message_office").on('click',function(){
        var service_user_id = $(this).attr('service_user_id');
        if(service_user_id != ""){
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                url: "{{ url('/service/care-center/message-office/') }}" + "/" + service_user_id,
                method: "GET",
                success: function(data){
                    if(isAuthenticated(data) == false){
                        return false;
                    }
                    // alert(data); return false;
                    $(".chat-view-click").html(data);
                    $("#careCenterModel").modal("hide");
                    $("#messageModal").modal("show");

                     //for scrolling chat to the end
                    var chat_height = $('.conversation-list').height();
                    // var chat_height = $('.office_message_hgt').height();
                   // alert(chat_height);
                    $('.chat-view').scrollTop(chat_height);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                },
                error: function(){
                    alert("{{ COMMON_ERROR }}");
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        }
    });
</script>


<script>
    //need assistance message
    $(".need_assistance").on('click',function(){
        var service_user_id = $(this).attr('rel');

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url: "{{ url('/service/care-center/message/need_assistance') }}" + "/" + service_user_id,
            method: "GET",
            success: function(data){
                if(isAuthenticated(data) == false){
                    return false;
                }
                $(".ass-chat-view-click").html(data);
                $("#careCenterModel").modal("hide");
                $("#needModal").modal("show");

                $('.loader').hide();
                $('body').removeClass('body-overflow');

            },
            error: function(){
                alert("{{ COMMON_ERROR }}");
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        })
    });
</script>

<!-- <script>
    $(document).ready(function(){
        $(document).on('click','.in_danger', function(){
            $('#careCenterModel').modal('hide');
            $('#InDanger').modal('show');
        });
    });
</script>   -->         

<!-- Request CallBack Modal -->
<div class="modal fade" id="reqCallBack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#careCenterModel" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> Request CallBack </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="events-list req-callbk-list">
                    </div>
                </div>
            </div>

            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
            </div>
        </div>
    </div>
</div>
<!-- Request CallBack End -->


<!-- In Danger Modal -->
<div class="modal fade" id="inDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#careCenterModel" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> In Danger </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="events-list in-danger-list">
                    </div>
                </div>
            </div>

            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
            </div>
        </div>
    </div>
</div>
<!-- In Danger End -->

<script>
    $(document).ready(function(){
        $(document).on('click','.req-callbk-modal', function(){
            var service_user_id = $(this).attr('rel');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : "get",
                url  : "{{ url('/service/care-center/req-callback/') }}"+"/"+service_user_id,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == ''){
                        $(".req-callbk-list").html('<div class="text-center p-b-20" style="width:100%"> No requests found.</div>');
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    } else{
                        $(".req-callbk-list").html(resp);
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                    $('#careCenterModel').modal('hide');
                    $('#reqCallBack').modal('show');
                    
                }
            });
            return false;

        });
    });
</script>

<script>
    //Request Callback Modal Pagination
    $(document).on('click','#reqCallBack .pagination li a',function(e){

        var url=$(this).attr('href');
        $(this).attr('href','#')
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type: 'GET',
            dataTYpe: 'json',
            url: url,
            success: function(resp) {

                if(isAuthenticated(resp) == false){
                    return false;
                }
                $(".req-callbk-list").html(resp);
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            },
            error: function() {
                alert("{{ COMMON_ERROR }}");
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }

        });
        e.stopImmediatePropagation();
        return false;
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.in-danger-modal', function(){
            var service_user_id = $(this).attr('rel');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : "get",
                url  : "{{ url('/service/care-center/in-danger/') }}"+"/"+service_user_id,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == ''){
                        $(".in-danger-list").html('<div class="text-center p-b-20" style="width:100%"> No requests found.</div>');
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    } else{
                        $(".in-danger-list").html(resp);
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                    $('#careCenterModel').modal('hide');
                    $('#inDanger').modal('show');
                    
                }
            });
            return false;
        });
    });
</script>

<script>
    //In Danger Modal Pagination
    $(document).on('click','#inDanger .pagination li a',function(e){

        var url = $(this).attr('href');
        $(this).attr('href','#')
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type: 'GET',
            dataTYpe: 'json',
            url: url,
            success: function(resp) {

                if(isAuthenticated(resp) == false){
                    return false;
                }
                $(".in-danger-list").html(resp);
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            },
            error: function() {
                alert("{{ COMMON_ERROR }}");
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }

        });
        e.stopImmediatePropagation();
        return false;
    });
</script>

    @if(!empty($noti_data)){
        @if($noti_data['event_type'] == 'NEED_ASSIT')
            <script >
                $(document).ready(function(){
                    $('.need_assistance').click();
                });
            </script>
        @elseif($noti_data['event_type'] == 'REQ_CALLBACK')
            <script >
                $(document).ready(function(){
                    $('.req-callbk-modal').click();
                });
            </script>
        @elseif($noti_data['event_type'] == 'IN_DANGER')
            <script >
                $(document).ready(function(){
                    $('.in-danger-modal').click();
                });
            </script>
        @endif
    @endif


