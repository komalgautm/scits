
<!-- Add Incident Report Modal -->
<div class="modal fade" id="riskIncdntRprtModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close inc-modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['incident_report']['label'] }} - Add</h4>
            </div>
            <form method="post" action="" id="risk_inc_rep_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right">User: </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <div class="select-style">
                                    <select name="service_user_id" class="su_n_id" disabled="">
                                        <option value="0"> Select Service User </option>
                                        @foreach($service_users as $value)
                                            <option value="{{ $value['id'] }}" {{ ($service_user_id == $value['id']) ? 'selected' : '' }}>{{ ucfirst($value['name']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right"> Add: </label>
                            <div class="col-md-11 col-sm-12 col-xs-12">
                                <div class="select-style">
                                    <select name="dynamic_form_builder_id" class="dynamic_form_select">
                                        <option value="0"> Select Form </option>
                                        
                                        <?php
                                        $this_location_id = App\DynamicFormLocation::getLocationIdByTag('incident_report');
                                        foreach($dynamic_forms as $value) {
                                        
                                            $location_ids_arr = explode(',',$value['location_ids']);

                                            if(in_array($this_location_id,$location_ids_arr)) { 
                                            ?>
                                                <option value="{{ $value['id'] }}"> {{ ucfirst($value['title']) }} </option>
                                            <?php } 
                                        } ?>
                                    </select>
                                </div>
                                <p class="help-block"> Choose a user and the type of form you want to fill. </p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="below-divider"></div>
                        </div>
                        
                        @include('frontEnd.common.popup_alert_messages')    
                        <div class="dynamic-form-fields"> </div>
                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    <input type="hidden" name="location_id" value="{{ $this_location_id }}">
                    <input type="hidden" name="su_risk_id" value="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-default inc-modal-close" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning smt_incdnt_btn"> Continue </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Incident Report Modal end -->

<script>
    $(document).ready(function(){

        $('.smt_incdnt_btn').click(function(){
            
            var model_id        = $(this).closest('.modal').attr('id');
            var form_id         = $(this).closest('form').attr('id');
            var service_user    = $('#'+model_id+' .su_n_id');
            var form_builder    = $('#'+model_id+' .dynamic_form_select');
            var static_title    = $('#'+model_id+' .static_title');
            
            var static_title_vl = static_title.val();
            if(static_title_vl == undefined){
                return false;
            } 

            var service_user_id = service_user.val().trim();
            var form_builder_id = form_builder.val().trim();
            var static_title_vl = static_title_vl.trim();
            var err = 0;

            if(service_user_id == 0) { 
                service_user.parent().addClass('red_border');
                err = 1;
            }else{
                service_user.parent().removeClass('red_border');
            }

            if(form_builder_id == 0) { 
                form_builder.parent().addClass('red_border');
                err = 1;
            } else{
                form_builder.parent().removeClass('red_border');
            }

            if(static_title_vl == '') { 
                static_title.addClass('red_border');
                err = 1;
            } else{
                static_title.removeClass('red_border');
            }

            if(err == 1){
                return false;
            }

            var formdata = $('#'+form_id).serialize();
       
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/service/risk/inc-rep/add') }}",                
                data : formdata,
                dataType: 'json',
                success:function(resp){

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    var response = resp['response'];
               
                    if(response == true){
                        $('#'+form_id+' span.popup_success_txt').text('Incident report has been Added Successfully');
                        $('#'+form_id+' .popup_success').show();
                        setTimeout(function(){$('#'+form_id+' .popup_success').fadeOut()}, 5000);
                        
                        $('#'+model_id+' .dynamic_form_select').val('0');
                        $('#'+model_id+' .dynamic-form-fields').html('');

                        $('#'+model_id).modal('hide');

                    } else{
                        //show error message
                        $('#'+form_id+'  span.popup_error_txt').text("{{ COMMON_ERROR }}");
                        $('#'+form_id+' .popup_error').show();
                        setTimeout(function(){$('#'+form_id+' .popup_error').fadeOut()}, 5000);
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });  
            return false;  
        });
    });
</script>

<!-- view Incident Report Modal start -->
<div class="modal fade" id="veIncdntRprtModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close inc-modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close view-risk-back-btn mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target=""> <i class="fa fa-arrow-left" title=""></i> </a>
                <h4 class="modal-title"> {{ $labels['incident_report']['label'] }} - View </h4>
            </div>
            <form method="post" action="" id="edit_inc_rep_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right">User: </label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                    <div class="select-style">
                                        <select name="service_user_id" class="su_n_id" disabled="">
                                            <option value="0"> Select Service User </option>
                                            @foreach($service_users as $value)
                                                <option value="{{ $value['id'] }}" {{ ($service_user_id == $value['id']) ? 'selected' : '' }}>{{ ucfirst($value['name']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right"> Add: </label>
                                <div class="col-md-11 col-sm-12 col-xs-12">
                                    <div class="select-style">
                                        <select name="dynamic_form_builder_id" class="dynamic_form_select" disabled>
                                            <option value="0"> Select Form </option>
                                            
                                            <?php
                                            $this_location_id = App\DynamicFormLocation::getLocationIdByTag('incident_report');
                                            foreach($dynamic_forms as $value) {
                                            
                                                $location_ids_arr = explode(',',$value['location_ids']);

                                                if(in_array($this_location_id,$location_ids_arr)) { 
                                                ?>
                                                    <option value="{{ $value['id'] }}"> {{ ucfirst($value['title']) }} </option>
                                                <?php } 
                                            } ?>
                                        </select>
                                    </div>
                                    <p class="help-block"> Choose a user and the type of form you want to fill. </p>
                                </div>
                            </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="below-divider"></div>
                        </div>

                        @include('frontEnd.common.popup_alert_messages')
                        <div class="dynamic-form-fields"> </div>

                        <!-- <div class="risk-tabs">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue inc-details fnt-20">Details </h3>
                            </div>
                        <form method="post" action="" id="edit_inc_rep_form">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Title: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0 p-l-30">
                                        <div class="input-group popovr">
                                            <input name="edit_inc_rec_title" value="" class="form-control" type="text" maxlength="255">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">      
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0 p-l-30">
                                      <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date="" class="input-group date dpYears">
                                        <input name="edit_inc_rec_date" value="" size="16" readonly="" class="form-control" type="text" maxlength="10">
                                        <span class="input-group-btn add-on">
                                          <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edit-dynamic-inc-rec-fields">
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <input type="hidden" name="location_id" value="{{ $this_location_id }}">
                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    <input type="hidden" name="su_risk_id" value="">
                    <!-- <input type="hidden" name="su_ir_id" value=""> -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-default inc-modal-close" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning edit_smt_inc_rec_btn"> Continue </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- view Incident Report Modal end -->

<script>
    $('.view-risk-back-btn').click(function(){
        $('#riskViewModal').modal('show');
    });

    /*$('.smt_incdnt_btn1').on('click', function() {
        
        var inc_rep_title = $('input[name=\'inc_rep_title\']').val();
        var inc_rep_date = $('input[name=\'i_report_date\']').val();
        error = 0;
        inc_rep_title = jQuery.trim(inc_rep_title);

        // border_error shown here
        if(inc_rep_title == '' || inc_rep_title == null) {
            $('input[name=\'inc_rep_title\']').addClass('red_border');
            error = 1;
        } else {
             $('input[name=\'inc_rep_title\']').removeClass('red_border');
        }
        if(inc_rep_date == '' || inc_rep_date == null) {
            $('input[name=\'i_report_date\']').addClass('red_border');
            error = 1;
        } else {
             $('input[name=\'i_report_date\']').removeClass('red_border');
        }
        if(error == 1) {
            return false;
        }

        var formdata = $('#risk_inc_rep_form').serialize();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type:  'post',
            url :  "{{ url('/service/risk/inc-rep/add') }}",
            data:   formdata,
            dataType: 'json',
            success:function(resp) {
                if(isAuthenticated(resp) == false){
                    return false;
                }
                var response = resp['response'];
                if(response == '1') {

                    // empty modal fields
                    $('.dynamic-incdnt-rprt-fields').find('input').val('');
                    $('.dynamic-incdnt-rprt-fields').find('textarea').val('');
                    $('input[name=\'inc_rep_title\']').val('');
                    
                    //success msg outside modal
                    $('.ajax-alert-suc').find('.msg').text('Incident Report Added Successfully.');
                    $('.ajax-alert-suc').show();
                    setTimeout(function(){$(".ajax-alert-suc").fadeOut()}, 5000);

                    // hide modal
                    $('#incdntRprtModal').modal('hide');
                }    
                else{
                    $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    return false;
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });*/
    $('#incdntRprtModal').on('scroll',function(){
        $('.dpYears').datepicker('place')
    });
</script>

<script>
    $('.inc-modal-close').click(function(){

        /*var risk_inc_notif_ttl = $('.inc-details').text();

        var unique_id = $.gritter.add({
                title: risk_inc_notif_ttl,
                text: 'Please fill the necessary form and submit it.',
                sticky: true,
                // (int | optional) the time you want it to be alive for before fading out
                //time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
        });*/

        var risk_name = $('input[name=\'risk_name\']').val();
        var unique_id = $.gritter.add({
                title: 'Risk Details',
                text: 'Please fill the required RMP/Incident Report details of '+risk_name+' risk',
                //text: 'Please fill the required RMP/Incident Report Form of  .',
                sticky: true,
                class_name: 'my-sticky-class'
        });
        //return false;
    });
</script>