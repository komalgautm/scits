<!-- su my money requests model -->
<div class="modal fade" id="moneylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Money Requests</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @include('frontEnd.common.popup_alert_messages')
                    <?php //$su_money='0'; ?>
                    <div class="events-list m-t-0"><b>Available Money:</b> £{{ $my_money['balance'] }}</div>
                    
                    <div class="events-list m-t-0"> <b>{{ $my_money['accepted']['request'] }} Accepted requests :</b> £{{ $my_money['accepted']['amount'] }}</div>
                    <div class="events-list m-t-0"> <b>{{ $my_money['pending']['request'] }} Pending requests :</b> £{{ $my_money['pending']['amount'] }}</div>
                    <div class="events-list m-t-0"> <b>{{ $my_money['reject']['request'] }} Rejected requests :</b> £{{ $my_money['reject']['amount'] }}</div>
                    
                    <!-- <div class="events-list m-t-0">{{ $my_money['accepted']['request'] }} accept request : €{{ $my_money['accepted']['amount'] }}</div>
                     -->
                    <!-- <div class="events-list m-t-0">{{ $my_money['pending']['request'] }} pending request : €{{ $my_money['pending']['amount'] }}</div>
                    <div class="events-list m-t-0">{{ $my_money['reject']['amount'] }} reject request : €{{ $my_money['reject']['amount'] }}</div> -->
                    <div class="events-list money-record-list">
                    </div>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"></div> -->
                </div>
            </div>

            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
               <!--  <button class="btn btn-warning" type="button"> Confirm </button> -->
            </div>
        </div>
    </div>
</div>

<!-- money detail model start -->
<div class="modal fade" id="viewRequestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="#moneylist">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Money Request Detail </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    @include('frontEnd.common.popup_alert_messages')
                    <form id="update_req_status" method="POST">
                        <div class="add-new-box risk-tabs custm-tabs">
                                    
                            <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Name: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="select-style">
                                        <input type="text" class="form-control" disabled="disabled" placeholder="" id="name" value=""/>
                                    </div>
                                </div>
                            </div> -->
                            <input type="hidden" value="" rel="" name="req_id" id="req_id">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Amount: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <!-- <div class="select-bi" style="width:100%;float:left;"> -->
                                        <input type="text" class="form-control" disabled="disabled" placeholder="" id="amount" />
                                    <!-- </div> -->
                                    <!-- <p class="help-block"> Enter the Title of Log and add details below.</p> -->
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 datepicker-sttng date-sttng">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Message: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <textarea name="view_log_detail" disabled="disabled" class="form-control detail-info-txt" rows="3" id="desc"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 datepicker-sttng date-sttng">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Status: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10" id="req_status">
                                    
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Provider Staff Comment: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="select-bi" id="p_cmnt">
                                        <textarea name="description" class="form-control detail-info-txt" rows="3" ></textarea>
                                    </div>
                                </div>
                            </div>
                
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning" type="submit"> Submit </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- <button class="btn btn-warning close" type="submit"> Continue </button> -->
                        </div>
                    </form>
                </div>     
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(".moneylist").on('click',function(){
        
        var service_user_id = "{{ $service_user_id }}";

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url : "{{ url('service/money-requests') }}"+'/'+service_user_id,
            type:"GET",
            success: function(resp)
            {
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == ''){
                    $(".money-record-list").html('<div class="text-center p-b-20" style="width:100%"> No requests found.</div>');
                } else{
                    $(".money-record-list").html(resp);
                }

                $("#moneylist").modal('show');

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            },
            error: function()
            {
                alert("{{ COMMON_ERROR }}");
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    })
</script>

<script type="text/javascript">
    //view money request detail
    /*$(document).on('click','.money_listing-li',function(e){
        e.preventDefault();
   
        var list_id = $(this).attr('rel');
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url: "{{ url('service/money-request') }}" +'/'+ list_id,
            type: "GET",
            success: function(data)
            {
                if(isAuthenticated(data) == false){
                    return false;
                }

                $("#moneylist").modal('hide');
                $('#name').val(data.name);
                $('#amount').val(data.amount);
                $('#desc').val(data.desc);
                $('#p_cmnt').html(data.provider_comment);
                $('#req_status').html(data.status);
                $('#req_id').val(data.id);

                $('.popup_error').hide();
                $('.popup_success').hide();
                $("#viewRequestModal").modal('show');
                
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            },
            error: function()
            {
                $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                $('.popup_error').show();
                setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
            }
        })
    })*/

    $(document).on('click','.money_listing-li',function(e){
        e.preventDefault();
   
        var list_id = $(this).attr('rel');
        view_risk(list_id);
    })

    <?php if(!empty($noti_data)){
        if($noti_data['event_type'] == 'MONEY_REQ') { ?>
            var list_id = "{{ $noti_data['event_id'] }}";
            view_risk(list_id);
    <?php }
    } ?>

    function view_risk(list_id){
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url: "{{ url('service/money-request') }}" +'/'+ list_id,
            type: "GET",
            success: function(data)
            {
                if(isAuthenticated(data) == false){
                    return false;
                }

                $("#moneylist").modal('hide');
                $('#name').val(data.name);
                $('#amount').val(data.amount);
                $('#desc').val(data.desc);
                $('#p_cmnt').html(data.provider_comment);
                $('#req_status').html(data.status);
                $('#req_id').val(data.id);

                $('.popup_error').hide();
                $('.popup_success').hide();
                $("#viewRequestModal").modal('show');
                
                setTimeout(function () {
                    autosize($("textarea"));
                },200);
                
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            },
            error: function()
            {
                $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                $('.popup_error').show();
                setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
            }
        })
    }
</script> 

<script>
    $(function(){        
        $("#update_req_status").validate({
            rules:{
                "description":{
                    required:true
                },
                "status":{
                    required:true
                }
            },
            messages:{
              "description":{
                    required:"Please fill this field."
                },
                "status":{
                    required:"Please choose a status."
                }  
            },
            errorPlacement: function(){
                return false;  // suppresses error message text
            },
            submitHandler: function(form){

                var status_disabled = $('#req_status').children().attr('disabled');
                if(status_disabled == 'disabled'){
                    return false;
                }

                $('.loader').show();
                $('body').addClass('body-overflow');

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: $('#update_req_status').serialize(),
                    url: "{{ url('service/money-request/update') }}",
                    success: function(resp) {
                        //alert(resp.status);
                        if(isAuthenticated(resp) == false){
                            return false;
                        }
                        if(resp.status == 'ok'){
                            $("#viewRequestModal").modal('hide');
                            $("#moneylist").modal('show');
                            $('span.popup_success_txt').text('Money request has been updated successfully.');
                            $('.popup_success').show();   
                            setTimeout(function(){$(".popup_success").fadeOut()}, 5000);   

                        } else{
                            if(resp.status == 'insufficient_balance') {
                                $('span.popup_error_txt').text("Service user does not have enough balance");
                            } else{
                                $('span.popup_error_txt').text("{{ COMMON_ERROR }}");                      
                            }
                            $('.popup_error').show();
                            setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                        }
                        $(".moneylist").click();
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });
            }
        });
    })
</script>

<script type="text/javascript">
    $(document).on('click','#moneylist .pagination li a',function(e){

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
                $(".money-record-list").html(resp);
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

