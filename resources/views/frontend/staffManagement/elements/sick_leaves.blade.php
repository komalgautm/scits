<!-- sick leave model-->
<div class="modal fade" id="sickLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rmp-modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sick Leave</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active logged_sick_btn" type="button"> Logged Leaves </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details fnt-20"> Add Leave Details </h3>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" action="" id="sick_leave_add_form">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Title: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="sick_title" value="" type="text" class="form-control" maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 datepicker-sttng date-sttng cog-panel">
                                <label class="col-md-1 col-sm-1 col-xs-12">Leave Date:</label>
                                <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                       <input name="leave_date" type="text" value="" readonly="" size="16" class="form-control date-pick-staff">
                                        <span class="input-group-btn add-on datetime-picker2">
                                            <input type="text" value="" name="" id="new-date-sick" class="form-control date-btn2">
                                            <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 cog-panel">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Leave Date: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                            <input name="v_leave_date" type="text"  value="" size="45" class="form-control" readonly="">
                                            <span class="input-group-btn add-on">
                                                <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Reason: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <textarea name="leave_reason" value="" rows="3" type="text" class="form-control" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> No. of days: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="leave_days" value="" type="text" class="form-control" maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Comment: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <textarea name="leave_comment" value="" rows="3" type="text" class="form-control" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer m-t-0 m-b-15 modal-bttm">
                                <a class="bottm-btns" href="{{ url('/system/calendar') }}" ><div class="pull-left"><i class="fa fa-calendar"></i></div></a>
                                <input type="hidden" name="staff_member_id" value="{{ $staff_id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning  sbt-sick-leave-form" type="submit"> Confirm </button>
                            </div>
                        </form>
                    </div>
                    

                    <!-- logged plans -->
                    <div class="logged-box risk-tabs custm-tabs">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged Leaves </h3>
                            </div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" id="edit-rmp-form">
                            <div class="modal-space modal-pading log_sick_record_list">
                                <!-- logged sick leave list be shown here using ajax -->
                            </div>
                        </form>
                        <div class="modal-footer m-t-0 recent-task-sec" style="visibility: hidden;">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning" type="button"> Confirm</button>
                        </div>
                    </div>

                    <div class="search-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20">Search</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 type-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Type: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                <div class="select-style">
                                    <select name="sm_sick_search_type">
                                        <option value='title' <?php echo 'selected';?>> Title </option>
                                        <option value='date'> Date </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                                <input type="text" name="sm_sick_title" class="form-control" maxlength="255">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                    <input name="sm_leave_date" type="text"  value="" size="45" class="form-control" readonly="">
                                    <span class="input-group-btn add-on">
                                        <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form id="searched-sick-leave-record-form" method="post">
                            <div class="modal-space modal-pading text-center search_sick_record">
                            <!-- <div class="modal-space searched-records p-t-0" > -->
                            <!--searched Record List using ajax -->
                            </div>
                        </form>
                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning search-sick-leave-btn" type="button"> Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- sick leave model End -->

<!-- View sick leave model End -->
<div class="modal fade" id="viewsickLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#sickLeaveModal" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> Sick Leave</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details fnt-20"> Leave Details </h3>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" action="" id="sick_leave_edit_form">
                            <div class="set-sick-record-value">
                                <!-- sick leave form data shown here using ajax -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!--View  sick leave model End -->

<script>
    $(document).ready(function() {
        today  = new Date; 
        $('#new-date-sick').datetimepicker({
            format: 'dd-mm-yyyy',
            startDate: today,
            minView : 2
        }).on("change.dp",function (e) {
            var currdate =$(this).data("datetimepicker").getDate();
            var newFormat = currdate.getDate()+"-" +(currdate.getMonth() + 1)+"-"+currdate.getFullYear();
            $('.date-pick-staff').val(newFormat);
        });

        $('#new-date-sick').on('click', function(){
            $('#new-date-sick').datetimepicker('show');
        });

        $( "#sickLeaveModal" ).scroll(function() {
            $('#new-date-sick').datetimepicker('place')
        });

        $('#new-date-sick').on('change', function(){
            $('#new-date-sick').datetimepicker('hide');
        });
        $('#sickLeaveModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });
    });
</script>

<script>
    //add sick leave record 
    $(document).ready(function(){
        $(document).on('click','.sbt-sick-leave-form', function(){
            
            //checking if it is listing page or profile page & staff id variable exists or not
            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 
            $('input[name=\'staff_member_id\']').val(staff_id);
            
            var sick_title  = $('input[name=\'sick_title\']').val();
            var sick_date   = $('input[name=\'leave_date\']').val();
            var sick_reason = $('textarea[name=\'leave_reason\']').val();
            //var sick_days   = $('input[name=\'leave_days\']').val();
            error = 0;
            sick_title  = jQuery.trim(sick_title);
            sick_reason = jQuery.trim(sick_reason);
            //sick_days   = jQuery.trim(sick_days);
            if(sick_title == '' || sick_title == null) {
                $('input[name=\'sick_title\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'sick_title\']').removeClass('red_border');
            }
            if(sick_date == '' || sick_date == null) {
                $('input[name=\'leave_date\']').parent().addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'leave_date\']').parent().removeClass('red_border');
            }
            if(sick_reason == '' || sick_reason == null) {
                $('textarea[name=\'leave_reason\']').addClass('red_border');
                error = 1;
            } else {
                $('textarea[name=\'leave_reason\']').removeClass('red_border');
            }
            /*if(sick_days == '' || sick_days == null) {
                $('input[name=\'leave_days\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'leave_days\']').removeClass('red_border');
            }*/

            if(error == 1) {
                return false;
            }
            var formdata = $('#sick_leave_add_form').serialize();
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/staff/member/sick-leave/add') }}",
                data : formdata,
                dataType : 'json',
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    if(response == '1') {  //add-new-box
                        $('input[name=\'sick_title\']').val('');
                        $('input[name=\'leave_date\']').val('');
                        $('textarea[name=\'leave_reason\']').val('');
                        //$('input[name=\'leave_days\']').val('');
                        $('textarea[name=\'leave_comment\']').val('');

                        //show success message
                        $('span.popup_success_txt').text('Sick Leave Added Successfully.');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else {
                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        }); 
    });
</script>

<script>
    //logged sick records
    $(document).ready(function(){
        $(document).on('click','.logged_sick_btn', function(){

            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/member/sick-leave/view/') }}"+'/'+staff_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.log_sick_record_list').html('<div class="text-center p-b-20"style="width:100%"> No Records found. </div>');
                    } else {
                        $('.log_sick_record_list').html(resp);  
                    }


                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>

<script>
    //delete sick record 
    $(document).ready(function(){
        $(document).on('click','.delete_sick_record', function(){
            if(!confirm('{{ DEL_CONFIRM }}')){
                return false;
            }
            var sick_leave_id = $(this).attr('sm_sick_leave_id');
            var this_record   = $(this);

            $('.loader').show();
            $('body').addClass('body-overflow');


            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/member/sick-leave/delete/') }}"+'/'+sick_leave_id,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 1) {
                        this_record.closest('.remove-sick-rec-row').remove();

                        //show success delete message
                        $('span.popup_success_txt').text('Sick Leave Deleted Successfully');                   
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else {
                        //show delete message error
                        $('span.popup_error_txt').text('Error Occured.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.view-sick-leave-content', function(){

            var sick_leave_id = $(this).attr('sm_sick_leave_id');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : " {{ url('/staff/member/sick-leave/view-record/') }}"+'/'+sick_leave_id,
                //dataType : 'json',
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.set-sick-record-value').html(resp);
                    $('#viewsickLeaveModal').modal('show');
                    setTimeout(function () {
                        autosize($("textarea"));
                    },200);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    $('.pop-notifbox').removeClass('active'); 
                }
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.edit_sick_leave_content', function(){
            var view_btn = $(this);
            var sick_leave_id = view_btn.attr('sm_sick_leave_id');
   
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : " {{ url('/staff/member/sick-leave/view-record/') }}"+'/'+sick_leave_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.set-sick-record-value').html(resp);
                    $('#viewsickLeaveModal').modal('show');

                    //making editable field in viewsickLeaveModal modal
                    $('.edit_sick').removeAttr('disabled');
                    //$('#block-sbt-btn').removeAttr('style');


                    //calendar while editing the sick record
                    today  = new Date; 
                    $('#edit-sick-date').datetimepicker({
                        format: 'dd-mm-yyyy',
                        // startDate: today,
                        minView : 2
                    }).on("change.dp",function (e) {
                        var currdate =$(this).data("datetimepicker").getDate();
                        var newFormat = currdate.getDate()+"-" +(currdate.getMonth() + 1)+"-"+currdate.getFullYear();
                        $('.date-pick-staff').val(newFormat);
                    });

                    $('#edit-sick-date').on('click', function(){
                        $('#edit-sick-date').datetimepicker('show');
                    });

                    $( "#viewsickLeaveModal" ).scroll(function() {
                        $('#edit-sick-date').datetimepicker('place')
                    });
                    $('#edit-sick-date').on('change', function(){
                        $('#edit-sick-date').datetimepicker('hide');
                    });

                    setTimeout(function () {
                        autosize($("textarea"));
                    },200);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    $('.pop-notifbox').removeClass('active'); 
                }
            });
            return false;

        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.sbt-edit-sick-leave-form', function(){

            var edit_sick_title  = $('input[name=\'v_sick_title\']').val();
            var edit_sick_date   = $('input[name=\'v_leave_date\']').val();
            var edit_sick_reason = $('textarea[name=\'v_leave_reason\']').val();
            //var edit_sick_days   = $('input[name=\'v_leave_days\']').val();
            error = 0;
            edit_sick_titles  = jQuery.trim(edit_sick_title);
            edit_sick_reasons = jQuery.trim(edit_sick_reason);
            //edit_sick_day   = jQuery.trim(edit_sick_days);
            if(edit_sick_titles == '' || edit_sick_titles == null) {
                $('input[name=\'v_sick_title\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'v_sick_title\']').removeClass('red_border');
            }
            if(edit_sick_date == '' || edit_sick_date == null) {
                $('input[name=\'v_leave_date\']').parent().addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'v_leave_date\']').parent().removeClass('red_border');
            }
            if(edit_sick_reasons == '' || edit_sick_reasons == null) {
                $('textarea[name=\'v_leave_reason\']').addClass('red_border');
                error = 1;
            } else {
                $('textarea[name=\'v_leave_reason\']').removeClass('red_border');
            }
            /*if(edit_sick_day == '' || edit_sick_day == null) {
                $('input[name=\'v_leave_days\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'v_leave_days\']').removeClass('red_border');
            }*/

            if(error == 1) {
                return false;
            }

            var formdata = $('#sick_leave_edit_form').serialize();

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/staff/member/sick-leave/edit') }}",
                data : formdata,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 'true') {
                        $('#viewsickLeaveModal').modal('hide');
                        $('#sickLeaveModal').modal('show');
                        //know which tab is currently active logged or search  sick_leave tab
                        if($('.logged_sick_btn').hasClass('active')) {
                            $('.logged_sick_btn').click();
                        } else {
                            update_sick_leave_search_list()
                        }
                        //show success message
                        $('span.popup_success_txt').text('Sick Leave Editted Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else {
                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');;

                }
            });
            return false;
        });

        // 3rd tab search
        $('input[name=\'sm_leave_date\']').closest('.srch-field').hide();
        $('input[name=\'sm_sick_title\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search-sick-leave-btn').click();
                return false;      
            }
        });

        $('select[name=\'sm_sick_search_type\']').change(function(){
            $('.search_sick_record').html('');
            var sm_sick_title = $('input[name=\'sm_sick_title\']');
            var sm_leave_date = $('input[name=\'sm_leave_date\']');
            var type = $(this).val();

            if(type == 'date') {
                sm_leave_date.closest('.srch-field').show();
                sm_leave_date.removeClass('red_border');
                sm_sick_title.closest('.srch-field').hide();
                $('input[name=\'sm_sick_title\']').val('');
            } else {
                sm_sick_title.closest('.srch-field').show();
                sm_sick_title.removeClass('red_border');
                sm_leave_date.closest('.srch-field').hide();
                $('input[name=\'sm_leave_date\']').val('');
            }
        });

        $(document).on('click', '.search-sick-leave-btn', function(){
            update_sick_leave_search_list()
            return false;
        });
        
        function update_sick_leave_search_list() {

            var sm_sick_search_type = $('select[name=\'sm_sick_search_type\']');
            var sm_sick_title       = $('input[name=\'sm_sick_title\']');
            var sm_leave_date       = $('input[name=\'sm_leave_date\']');

            var search = sm_sick_title.val();
            var sm_leave_d = sm_leave_date.val();
            var sm_search_type = sm_sick_search_type.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(sm_search_type == 'title'){
                if(search == ''){
                    sm_sick_title.addClass('red_border');
                    return false;
                } else{
                    sm_sick_title.removeClass('red_border');
                }
            }
            else{
                if(sm_leave_d == ''){
                    sm_leave_date.addClass('red_border');
                    return false;
                } else{
                    sm_leave_date.removeClass('red_border');
                }

            }
            var error = 0;
            if(error == 1){
                return false;
            } 
            $('.loader').show();
            $('body').addClass('body-overflow');

            var formdata = $('#searched-sick-leave-record-form').serialize();
            var staff_member_id = "{{ $staff_id }}";
            $.ajax({
                type : 'post',
                url  : "{{ url('/staff/member/sick-leave/view/') }}"+'/'+staff_member_id+'?search='+search+'&sm_leave_d='+sm_leave_d+'&sm_search_type='+sm_search_type,
                data : formdata,
                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // alert(resp); return false;
                    if(resp == ''){
                        $('.search_sick_record').html('No Records found.');
                    } else{
                        $('.search_sick_record').html(resp);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        }

    });
</script>

<script>
    //pagination of sick leave record
    $(document).ready(function(){
        $(document).on('click','#sickLeaveModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();
            if(page_no == '') {
                return false;
            }
            if(isNaN(page_no)) {
                var new_url = $(this).children('a').attr('href');
                page_no = new_url[new_url.length -1];
            }
            
            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/member/sick-leave/view/') }}"+'/'+staff_id+"?page="+page_no,
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.log_sick_record_list').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>