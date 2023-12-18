<!-- su event change requests model -->
<div class="modal fade" id="eventRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Calendar Event Date Change Request </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @include('frontEnd.common.popup_alert_messages')
                    <div class="events-list event-change-req">
                    </div>
                </div>
            </div>

            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
               <!--  <button class="btn btn-warning" type="button"> Confirm </button> -->
            </div>
        </div>
    </div>
</div>

<!-- su event req view model start -->
<div class="modal fade" id="viewRequestChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="#eventRequest">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title">Event Date Change Request Detail </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    @include('frontEnd.common.popup_alert_messages')
                    <form method="POST" id="req_change_form">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" disabled="disabled" placeholder="" id="event-title" name="title"/>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" disabled="disabled" placeholder="" id="date" name="title"/>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> New Date: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" disabled="disabled" placeholder="" id="new_date" name="title"/>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Reason: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <textarea name="" disabled="disabled" class="form-control detail-info-txt" rows="3" id="reason"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Status: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10" id="event_req_status"> 
                                <!-- <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="2">Accept</option>
                                    <option value="1">Reject</option> 
                                </select>   --> 
                            </div>
                        </div>
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <input type="hidden" value="" name="event_req_id" id="event_req_id">
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

<script> 
    //$("#eventRequest").model('show');
    $(document).on('click','.eventreq',function(){
        var service_user_id = "{{ $service_user_id }}";
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url : "{{ url('/service/event-requests') }}"+'/'+service_user_id,
            type:  "GET",
            success: function(resp)
            {  
                if(isAuthenticated(resp) == false){ //alert('2');
                    return false;
                }
               
                if(resp == ''){
                    $(".event-change-req").html('<div class="text-center p-b-20" style="width:100%"> No Requests found.</div>');
                } else{
                    $(".event-change-req").html(resp);
                }
                //alert($(".event-change-req").html());
                $("#eventRequest").modal('show');

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

    });

    $(document).on('click','.view-req-form', function(){
        var event_req_id = $(this).attr('event_change_request');
        // alert(req_id); 
        $('.loader').show();
        $('body').addClass('body-overflow');

        var text=$(this).text();

        $.ajax({
            type : 'get',
            url  : "{{ url('/service/event-request') }}"+'/'+event_req_id,
            success : function(data) {

                if(isAuthenticated(data) == false){
                    return false;
                }

                // $('.req-change-view').html(resp);
                $('#event-title').val(text);
                $('#date').val(data.date);
                $('#new_date').val(data.new_date);
                $('#reason').val(data.reason);
                $('#event_req_id').val(data.id);
                $('#event_req_status').html(data.status);
                $('#eventRequest').modal('hide');
                $('#viewRequestChange').modal('show');

                setTimeout(function () {
                    autosize($("textarea"));
                },200);

                $('.loader').hide();
                $('body').removeClass('body-overflow');
                // alert(resp); return false;
            }
        });
        return false;

    });
</script>


<script>
    $(function(){        
        $("#req_change_form").validate({
            rules: {
                event_status: 'required',
            },
            submitHandler: function(form) {

                var status_disabled = $('#event_req_status').children().attr('disabled');
                if(status_disabled == 'disabled'){
                    return false;
                }
                $('.loader').show();
                $('body').addClass('body-overflow');
                $.ajax({
                    type: 'POST',
                    data: $('#req_change_form').serialize(),
                    url: "{{ url('/service/event-request/update') }}",
                    success: function(resp) {
                        if(isAuthenticated(resp) == false){
                            return false;
                        }
                        if(resp == '1') {
                            $("#viewRequestChange").modal('hide');
                            $("#eventRequest").modal('show');
                            $('span.popup_success_txt').text('{{ EDIT_RCD_MSG }}');
                            $('.popup_success').show();   
                            setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                        } else {
                            $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                            $('.popup_error').show();
                            setTimeout(function(){$(".popup_error").fadeOut()}, 5000);        
                        }
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });
                return false;
            }
        });
    })
</script>

<script type="text/javascript">
    $(document).on('click','#eventRequest .pagination li a',function(e){

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
                $(".event-change-req").html(resp);
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