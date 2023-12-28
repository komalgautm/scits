<!-- Event Change Request Modal-->
<div class="modal fade" id="eventChangeRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
                <a class="close view-risk-back-btn mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="#calndrViewEvent">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Event - Change Request </h4>
                
            </div>
            <form method="post" id="chng-event-req-form">
                <div class="modal-body event-dtl-bg">
                    <!-- include('frontEnd.common.popup_alert_messages') -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                            
                            <div class="form-group col-xs-12 p-0">
                                <label class="col-sm-1 col-xs-12 color-themecolor r-p-0"> Reason: </label>
                                <div class="col-sm-11 r-p-0">
                                    <div class="input-group">
                                        <textarea rows="3" name="reason" required class="form-control txtarea edit_event" value=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 cog-panel datepicker-sttng p-0">
                                <label class="col-sm-1 col-xs-12 r-p-0">Current Date:</label>
                                <div class="col-sm-11 r-p-0">
                                    <input name="current_date" disabled="disabled" class="form-control trans" type="text" value="" autocomplete="off" maxlength="10" />
                                </div>
                            </div>

                            <div class="form-group col-xs-12 cog-panel datepicker-sttng p-0">
                                <label class="col-sm-1 col-xs-12 r-p-0">New Date:</label>
                                <div class="col-sm-11 r-p-0">
                                    <input name="new_date" required class="form-control datetime-picker trans" type="text" value="" autocomplete="off" maxlength="10" readonly="" />
                                </div>
                            </div>

                            <input type="hidden" name="su_daily_record_id" type="text" value=""/>
                            <input type="hidden" name="event_id" type="text" value=""/>
                            <input type="hidden" name="event_type" type="text" value=""/>
                        </div>
                    </div>
                    <!-- Data show with the help of ajax -->
                </div>
            
                <div class="modal-footer event-dtl-rd m-t-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning submit-req" type="submit"> Confirm </button> 
                </div>
            </form>
        </div>
    </div>
</div>

<!-- alert Modal -->
  <div class="modal fade" id="alertModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SCITS</h4>
        </div>
        <div class="modal-body">
          <p class="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- New Date Datetimepicker Script(Old) in Controller -for Current & New Date!-->

<!-- <div class="form-group col-xs-12 cog-panel datepicker-sttng p-0">
    <label class="col-sm-1 col-xs-12 r-p-0">New Date:</label>
    <div class="col-sm-11 r-p-0">
        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date">
           <input name="new_date" type="text" required value="" readonly="" size="16" class="form-control pick-new-date">
            <span class="input-group-btn add-on datetime-picker2">
                <input type="text" value="" name="" id="request-new-date" class="form-control date-btn2" autocomplete="off">
                <button class="btn btn-primary change_event_date" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
            </span>
        </div>
    </div>
</div> -->

<script>
    $(document).ready(function(){
        $(document).on('click', '.submit-req', function(){

            var service_user_id = "{{ $service_user_id }}";
            var calendar_id     = $('input[name=\'calendar_id\']').val();
            var reason          = $('textarea[name=\'reason\']').val().trim();
            var new_date        = $('input[name=\'new_date\']').val();
            var current_date    = $('input[name=\'current_date\']').val();
            var token           = $('input[name=\'_token\']').val();
            
            var error = 0;

            if(reason == ''){
                $('textarea[name=\'reason\']').addClass('red_border');
                error =1;
            } else {
                $('textarea[name=\'reason\']').removeClass('red_border');
            }

            if(new_date == ''){
                $('input[name=\'new_date\']').addClass('red_border');
                error =1;
            } else {
                $('input[name=\'new_date\']').removeClass('red_border');
            } 
            if(error == 1) {
                return false;
            }
            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type: 'post',
                url : "{{ url('api/service/calendar/change-event-req/add') }}"+'/'+service_user_id,
                data: {'service_user_id':service_user_id, 'calendar_id': calendar_id, 'reason':reason, 'new_date':new_date, 'current_date':current_date, 'token': token},
                
                success:function(resp){

                    if(isAuthenticated(resp) == false) {
                        return false;
                    } 
                    
                    if(resp['response'] == true){
                        $('#alertModal .message').text('Your Request has been submitted successfully');
                    } else{
                        $('#alertModal .message').text("{{ COMMON_ERROR }}");
                    }

                    $('#eventChangeRequest').modal('hide');

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    $('#alertModal').modal('show');

                    /*$('span.popup_success_txt').text('success, Request added successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 3000);*/


                }
            });
        return false;
        });
    });    
</script>
