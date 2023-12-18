<!-- Annual leave model-->
<div class="modal fade" id="annualLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rmp-modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Annual Leave</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active logged_annual_btn" type="button"> Logged Leaves </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details fnt-20"> Add Leave Details </h3>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" action="" id="annual_leave_add_form">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Title: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="annual_title" value="" type="text" class="form-control" maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 datepicker-sttng date-sttng cog-panel">
                                <label class="col-md-1 col-sm-1 col-xs-12">Leave Date:</label>
                                <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                       <input name="annual_leave_date" type="text" value="" readonly="" size="16" class="form-control date-annual">
                                        <span class="input-group-btn add-on datetime-picker2">
                                            <input type="text" value="" name="" id="annual-date" class="form-control date-btn2">
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
                                            <textarea name="annual_leave_reason" value="" rows="3" type="text" class="form-control" maxlength="1000"></textarea>
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
                                            <textarea name="annual_leave_comment" value="" rows="3" type="text" class="form-control" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer m-t-0 m-b-15 modal-bttm">
                                <a class="bottm-btns" href="{{ url('/system/calendar') }}" ><div class="pull-left"><i class="fa fa-calendar"></i></div></a>
                                <input type="hidden" name="staff_member_id" value="{{ $staff_id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning  sbt-annual-leave-form" type="submit"> Confirm </button>
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
                        <form method="post" id="">
                            <div class="modal-space modal-pading log_annual_record_list">
                                <!-- logged annual leave list be shown here using ajax -->
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
                                    <select name="sm_annual_search_type">
                                        <option value='title' <?php echo 'selected';?>> Title </option>
                                        <option value='date'> Date </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                                <input type="text" name="sm_annual_title" class="form-control" maxlength="255">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                    <input name="sm_annual_date" type="text"  value="" size="45" class="form-control" readonly="">
                                    <span class="input-group-btn add-on">
                                        <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form id="searched-annual-leave-record-form" method="post">
                            <div class="modal-space modal-pading text-center search_annual_record">
                            <!-- <div class="modal-space searched-records p-t-0" > -->
                            <!--searched Record List using ajax -->
                            </div>
                        </form>
                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning search-annual-leave-btn" type="button"> Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- Annual leave model End -->

<!-- View annual leave model End -->
<div class="modal fade" id="viewannualLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#annualLeaveModal" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> Annual Leave </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details fnt-20"> Leave Details </h3>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" action="" id="annual_leave_edit_form">
                            <div class="set-annual-record-value">
                                <!-- annual leave form data shown here using ajax -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!--View  annual leave model End -->

<script>
    $(document).ready(function() {
        today  = new Date; 
        $('#annual-date').datetimepicker({
            format: 'dd-mm-yyyy',
            startDate: today,
            minView : 2
        }).on("change.dp",function (e) {
            var currdate =$(this).data("datetimepicker").getDate();
            var newFormat = currdate.getDate()+"-" +(currdate.getMonth() + 1)+"-"+currdate.getFullYear();
            $('.date-annual').val(newFormat);
        });

        $('#annual-date').on('click', function(){
            $('#annual-date').datetimepicker('show');
        });

        $( "#annualLeaveModal" ).scroll(function() {
            $('#annual-date').datetimepicker('place')
        });

        $('#annual-date').on('change', function(){
            $('#annual-date').datetimepicker('hide');
        });
        $('#annualLeaveModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });
    });
</script>

<script>
    //add annual leave record 
    $(document).ready(function(){
        $(document).on('click','.sbt-annual-leave-form', function(){
            
            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 

            $('input[name=\'staff_member_id\']').val(staff_id);

            var annual_title  = $('input[name=\'annual_title\']').val();
            var annual_leave_date   = $('input[name=\'annual_leave_date\']').val();
            var annual_leave_reason = $('textarea[name=\'annual_leave_reason\']').val();
            //var sick_days   = $('input[name=\'leave_days\']').val();
            error = 0;
            annual_title  = jQuery.trim(annual_title);
            annual_leave_reason = jQuery.trim(annual_leave_reason);
            //sick_days   = jQuery.trim(sick_days);
            if(annual_title == '' || annual_title == null) {
                $('input[name=\'annual_title\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'annual_title\']').removeClass('red_border');
            }
            if(annual_leave_date == '' || annual_leave_date == null) {
                $('input[name=\'annual_leave_date\']').parent().addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'annual_leave_date\']').parent().removeClass('red_border');
            }
            if(annual_leave_reason == '' || annual_leave_reason == null) {
                $('textarea[name=\'annual_leave_reason\']').addClass('red_border');
                error = 1;
            } else {
                $('textarea[name=\'annual_leave_reason\']').removeClass('red_border');
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
            var formdata = $('#annual_leave_add_form').serialize();
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/staff/annual-leave/add') }}",
                data : formdata,
                dataType : 'json',
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    //alert(resp); return false;
                    var response = resp['response'];
                    if(response == '1') {  //add-new-box
                        $('input[name=\'annual_title\']').val('');
                        $('input[name=\'annual_leave_date\']').val('');
                        $('textarea[name=\'annual_leave_reason\']').val('');
                        //$('input[name=\'leave_days\']').val('');
                        $('textarea[name=\'annual_leave_comment\']').val('');

                        //show success message
                        $('span.popup_success_txt').text('Annual Leave Added Successfully.');
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
    //logged annual records
    $(document).ready(function(){
        $(document).on('click','.logged_annual_btn', function(){

            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/annual-leaves/') }}"+'/'+staff_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.log_annual_record_list').html('<div class="text-center p-b-20"style="width:100%"> No Records found. </div>');
                    } else {
                        $('.log_annual_record_list').html(resp);
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
    //delete annual record 
    $(document).ready(function(){
        $(document).on('click','.delete_annual_record', function(){

            if(!confirm('{{ DEL_CONFIRM }}')){
                return false;
            }

            var annual_leave_id = $(this).attr('sm_annual_leave_id');
            var this_record   = $(this);

            $('.loader').show();
            $('body').addClass('body-overflow');


            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/annual-leave/delete/') }}"+'/'+annual_leave_id,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 1) {
                        this_record.closest('.remove-annual-rec-row').remove();

                        //show success delete message
                        $('span.popup_success_txt').text('Annual Leave Deleted Successfully.');                   
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
    //view annual record data
    $(document).ready(function(){
        $(document).on('click','.view-annual-leave-content', function(){

            var annual_leave_id = $(this).attr('sm_annual_leave_id');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : " {{ url('/staff/annual-leave/view-annual/') }}"+'/'+annual_leave_id,
                //dataType : 'json',
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.set-annual-record-value').html(resp);
                    $('#viewannualLeaveModal').modal('show');
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
    //Edit click annual record show
    $(document).ready(function(){
        $(document).on('click','.edit_annual_leave_content', function(){
            var view_btn = $(this);
            var annual_leave_id = view_btn.attr('sm_annual_leave_id');
   
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : " {{ url('/staff/annual-leave/view-annual/') }}"+'/'+annual_leave_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.set-annual-record-value').html(resp);
                    $('#viewannualLeaveModal').modal('show');

                    //making editable field in viewannualLeaveModal modal
                    $('.edit_annual').removeAttr('disabled');
                    //$('#block-sbt-btn').removeAttr('style');


                    //calendar while editing the annual record
                    today  = new Date; 
                    $('#edit-annual-date').datetimepicker({
                        format: 'dd-mm-yyyy',
                        // startDate: today,
                        minView : 2
                    }).on("change.dp",function (e) {
                        var currdate =$(this).data("datetimepicker").getDate();
                        var newFormat = currdate.getDate()+"-" +(currdate.getMonth() + 1)+"-"+currdate.getFullYear();
                        $('.edit-date-annual').val(newFormat);
                    });

                    $('#edit-annual-date').on('click', function(){
                        $('#edit-annual-date').datetimepicker('show');
                    });

                    $( "#viewannualLeaveModal" ).scroll(function() {
                        $('#edit-annual-date').datetimepicker('place')
                    });
                    $('#edit-annual-date').on('change', function(){
                        $('#edit-annual-date').datetimepicker('hide');
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
        //submit edit annual leave reacord
        $(document).on('click','.sbt-edit-annual-leave-form', function(){

            var edit_annual_title  = $('input[name=\'v_annual_title\']').val();
            var edit_annual_date   = $('input[name=\'v_annual_date\']').val();
            var edit_annual_reason = $('textarea[name=\'v_annual_reason\']').val();
            //var edit_sick_days   = $('input[name=\'v_leave_days\']').val();
            error = 0;
            edit_annual_title  = jQuery.trim(edit_annual_title);
            edit_annual_reasons = jQuery.trim(edit_annual_reason);
            //edit_sick_day   = jQuery.trim(edit_sick_days);
            if(edit_annual_title == '' || edit_annual_title == null) {
                $('input[name=\'v_annual_title\']').addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'v_annual_title\']').removeClass('red_border');
            }
            if(edit_annual_date== '' || edit_annual_date== null) {
                $('input[name=\'v_annual_date\']').parent().addClass('red_border');
                error = 1;
            } else {
                $('input[name=\'v_annual_date\']').parent().removeClass('red_border');
            }
            if(edit_annual_reasons == '' || edit_annual_reasons == null) {
                $('textarea[name=\'v_annual_reason\']').addClass('red_border');
                error = 1;
            } else {
                $('textarea[name=\'v_annual_reason\']').removeClass('red_border');
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

            var formdata = $('#annual_leave_edit_form').serialize();

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/staff/annual-leave/edit') }}",
                data : formdata,
                success: function(resp) {

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 'true') {
                        $('#viewannualLeaveModal').modal('hide');
                        $('#annualLeaveModal').modal('show');

                        //know which tab is currently active logged or search  annual_leave tab
                        if($('.logged_annual_btn').hasClass('active')) {
                            $('.logged_annual_btn').click();
                        } else {
                            update_annual_leave_search_list()
                        }
                        //show success message
                        $('span.popup_success_txt').text('Annual Leave Editted Successfully');
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
        $('input[name=\'sm_annual_date\']').closest('.srch-field').hide();
        $('input[name=\'sm_annual_title\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search-annual-leave-btn').click();
                return false;      
            }
        });

        $('select[name=\'sm_annual_search_type\']').change(function(){
            $('.search_annual_record').html('');
            var sm_annual_title = $('input[name=\'sm_annual_title\']');
            var sm_annual_date = $('input[name=\'sm_annual_date\']');
            var type = $(this).val();

            if(type == 'date') {
                sm_annual_date.closest('.srch-field').show();
                sm_annual_date.removeClass('red_border');
                sm_annual_title.closest('.srch-field').hide();
                $('input[name=\'sm_annual_title\']').val('');
            } else {
                sm_annual_title.closest('.srch-field').show();
                sm_annual_title.removeClass('red_border');
                sm_annual_date.closest('.srch-field').hide();
                $('input[name=\'sm_annual_date\']').val('');
            }
        });

        $(document).on('click', '.search-annual-leave-btn', function(){
            update_annual_leave_search_list()
            return false;
        });
        
        function update_annual_leave_search_list() {

            var sm_annual_search_type = $('select[name=\'sm_annual_search_type\']');
            var sm_annual_title       = $('input[name=\'sm_annual_title\']');
            var sm_annual_date       = $('input[name=\'sm_annual_date\']');

            var search = sm_annual_title.val();
            var sm_annual_leave_date = sm_annual_date.val();
            var sm_search_type = sm_annual_search_type.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(sm_search_type == 'title'){
                if(search == ''){
                    sm_annual_title.addClass('red_border');
                    return false;
                } else{
                    sm_annual_title.removeClass('red_border');
                }
            }
            else{
                if(sm_annual_leave_date == ''){
                    sm_annual_date.addClass('red_border');
                    return false;
                } else{
                    sm_annual_date.removeClass('red_border');
                }

            }
            var error = 0;
            if(error == 1){
                return false;
            }

            $('.loader').show();
            $('body').addClass('body-overflow');

            var formdata = $('#searched-annual-leave-record-form').serialize();
            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/annual-leaves/') }}"+'/'+staff_id+'?search='+search+'&sm_annual_leave_date='+sm_annual_leave_date+'&sm_search_type='+sm_search_type,
                data : formdata,
                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == ''){
                        $('.search_annual_record').html('No Records found.');
                    } else{
                        $('.search_annual_record').html(resp);
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
    //pagination of annual leave record
    $(document).ready(function(){
        $(document).on('click','#annualLeaveModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();
            if(page_no == '') {
                return false;
            }
            if(isNaN(page_no)) {
                var new_url = $(this).children('a').attr('href');
                page_no = new_url[new_url.length -1];
            }
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            var staff_id = $('.selected_staff_id').val();
            if(staff_id == undefined){
                staff_id = "{{ $staff_id }}";
            } 

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/annual-leaves/') }}"+'/'+staff_id+"?page="+page_no,
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.log_annual_record_list').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>