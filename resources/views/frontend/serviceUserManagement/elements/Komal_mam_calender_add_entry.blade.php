<?php 
    if(isset($system_calendar)) {
        $add_entry_url = url('/system/calendar/entry/add'); 
        $display_form  = url('/system/calendar/entry/display-form');
    } else {
        $add_entry_url = url('/service/calendar/entry/add');
        $display_form  = url('/service/calendar/entry/display-form');
    }

?>

<!-- Calendar Add Entry -->
<div class="modal fade" id="calndraddEntryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Calendar - Add Entry </h4>
            </div>

            <form method="post" id="add-cal-entry-form" action="{{ $add_entry_url }}" >
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                        <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> User: </label>
                        <div class="col-md-11 col-sm-11 col-xs-12">
                            <div class="select-style">
                                <select name="service_user_ids" >
                                    <option value="0"> Select Service User </option>
                                    <?php foreach ($service_users as $key=>$value) { ?>
                                    <option value="{{ $value->id }}" 
                                        <?php if(!isset($system_calendar)){
                                            if($service_user_id == $value->id){
                                                echo 'selected';
                                            }
                                        } ?>
                                         >{{ $value->name }}</option>
                                    <?php   } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                        <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                        <div class="col-md-11 col-sm-11 col-xs-10">
                            <div class="select-style">

                                <select name="plan_builder_id">
                                    <option value="0" > Select Event Type </option>
                                    <?php foreach ($appointment_plans as $key=>$value) { ?>
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                    <?php   } ?>
                                </select>
                            
                            </div>
                            <p class="help-block"> Choose a user and the type of entry you want to add to the calendar. </p>
                        </div>
                        <!-- <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                            <button class="btn group-ico" type="submit" > <i class="fa fa-plus"></i> </button>
                        </div> -->
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                    </div>
                    <!-- alert messages -->
                    @include('frontEnd.common.popup_alert_messages')

                    <!-- Add new Details -->
                    <div class="risk-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue"> Details </h3>
                        </div>

                        <div class="entry-default-fields">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 ">
                                    <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="entry_title" type="text" class="form-control"  maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 ">
                                    <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Staff: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div class="select-style">
                                            <select name="staff_user_id">
                                                <option value="0">Select Staff Members</option>
                                            @foreach($staff_members as $staff_member)
                                                <option value="{{ $staff_member->id }}">{{ ucfirst($staff_member->name) }}</option>
                                            @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">      
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                            <input name="date" type="text" readonly value="" size="16" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                        </div>

                        <div class="entry-data-fields">
                        <!-- dynamic data fields should be shown here -->
                        </div>
                  
                    </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                <button class="btn btn-warning save-event-btn" type="submit"> Confirm </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.entry-default-fields').hide();
    $(document).ready(function(){
        $('select[name=\'plan_builder_id\']').on('change', function() {   
            var plan_id = $(this).val();

            if(plan_id > 0){
                
                $('.loader').show();
                $('body').addClass('body-overflow');
              
                $.ajax({
                    type:'get',
                    url : "{{ $display_form }}"+'/'+plan_id,
                    dataType: "json",
                    success:function(resp){
                        
                        if(isAuthenticated(resp) == false){
                            return false;
                        }

                        var response = resp['response'];
                        if(response == true){
                            
                            var formdata = resp['formdata'];
                            $('.entry-default-fields').find('input').val(''); 
                            $('.entry-default-fields').show();       
                            $('.entry-data-fields').html(formdata);
                            //$('.dpYears').datepicker();

                            $('.dpYears').datepicker({
                                //format: 'dd/mm/yyyy',
                                orientation: "top"
                            }).on('changeDate', function(e){
                                $(this).datepicker('hide');
                            });
                            autosize($("textarea"));                
                        } else{
                            $('.entry-default-fields').hide();                
                        }

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });

            } else{
                $('.entry-default-fields').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.save-event-btn').click(function(){
            var service_user = $('select[name=\'service_user_ids\']');
            var plan_builder = $('select[name=\'plan_builder_id\']');
            var title        = $('input[name=\'entry_title\']');
            var staff        = $('select[name=\'staff_user_id\']');

            var service_user_id = service_user.val().trim();  
            var staff_id        = staff.val().trim();    
            var plan_builder_id = plan_builder.val().trim();
            var event_title     = title.val().trim();
            var err = 0;
            //alert(service_user_id)
            if(service_user_id == 0) { 
                service_user.parent().addClass('red_border');
                err = 1;
            }else{
                service_user.parent().removeClass('red_border');
            }

            if(staff_id == 0) { 
                staff.parent().addClass('red_border');
                err = 1;
            }else{
                staff.parent().removeClass('red_border');
            }

            if(plan_builder_id == 0) { 
                plan_builder.parent().addClass('red_border');
                err = 1;
            } else{
                plan_builder.parent().removeClass('red_border');
            }

            if(event_title == '') {
                title.addClass('red_border');
                err = 1;
            } else {
                title.removeClass('red_border');
            }

            if(err == 1){
                return false;
            }else{ 
                return true;
            }

        });
    });
</script>
