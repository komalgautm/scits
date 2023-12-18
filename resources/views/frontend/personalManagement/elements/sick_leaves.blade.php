<!-- sick leave model-->
<div class="modal fade" id="mySickLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rmp-modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sick Leave</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                      <!--   <button class="btn label-default add-new-btn active" type="button"> Add New </button> -->
                        <button class="btn label-default add-new-btn active logged_my_sick_btn" type="button"> Logged Leaves </button><!-- logged-btn -->
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    <!-- Add new Details -->
                    <!-- <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details"> Leave Details </h3>
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
                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> 
                                       <input name="leave_date" type="text" value="" readonly="" size="16" class="form-control date-pick-staff">
                                        <span class="input-group-btn add-on datetime-picker2">
                                            <input type="text" value="" name="" id="new-date-sick" class="form-control date-btn2">
                                            <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 cog-panel">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> Leave Date: </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                            <input name="v_leave_date" type="text"  value="" size="45" class="form-control" readonly="">
                                            <span class="input-group-btn add-on">
                                                <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
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
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12"> No. of days: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="leave_days" value="" type="text" class="form-control" maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <input type="hidden" name="staff_member_id" value="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning  sbt-sick-leave-form" type="submit"> Confirm </button>
                            </div>
                        </form>
                    </div> -->
                    

                    <!-- logged plans -->
                    <div class="add-new-box risk-tabs custm-tabs"><!-- logged-box -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged Leaves </h3>
                            </div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" id="edit-rmp-form">
                            <div class="modal-space modal-pading log_my_sick_record_list">
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
                            <h3 class="m-t-0 m-b-20 clr-blue">Search</h3>
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
                        <form id="searched-my-sick-leave-record-form" method="post">
                            <div class="modal-space modal-pading text-center search_my_sick_record">
                            <!-- <div class="modal-space searched-records p-t-0" > -->
                            <!--searched Record List using ajax -->
                            </div>
                        </form>
                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning search-my-sick-leave-btn" type="button"> Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- sick leave model End -->

<!-- View sick leave model End -->
<div class="modal fade" id="viewmySickLeaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#mySickLeaveModal" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> Sick Leave</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue rmp-details"> Leave Details </h3>
                        </div>
                        @include('frontEnd.common.popup_alert_messages')
                        <form method="post" action="" id="sick_leave_edit_form">
                            <div class="set-my-sick-record-value">
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
    //logged my sick records
    $(document).ready(function(){
        $(document).on('click','.my_sick_record', function(){
            
            var manager_id = $(this).attr('manager_id');
            // var manager_id = "{{ $manager_id }}";
            //alert(manager_id); //return false;

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/my-profile/sick-leaves/view') }}"+'/'+manager_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $(".log_my_sick_record_list").html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    } else {
                        $('.log_my_sick_record_list').html(resp);
                    }
                    $('#mySickLeaveModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });

    });
</script>

<!-- <script>
    //delete my sick record 
    $(document).ready(function(){
        $(document).on('click','.delete_my_sick_record', function(){
            var sick_leave_id = $(this).attr('sm_sick_leave_id');
            var this_record   = $(this);

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/my-profile/sick-leaves/delete/') }}"+'/'+sick_leave_id,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 1) {
                        this_record.closest('.remove-my-sick-rec-row').remove();

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
</script> -->

<script>
    $(document).ready(function(){
        $(document).on('click','.view-my-sick-leave-content', function(){

            var sick_leave_id = $(this).attr('sm_sick_leave_id');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : " {{ url('/my-profile/sick-leaves/view-record/') }}"+'/'+sick_leave_id,
                //dataType : 'json',
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.set-my-sick-record-value').html(resp);
                    $('#viewmySickLeaveModal').modal('show');
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
    //pagination of my sick leave record
    $(document).ready(function(){
        $(document).on('click','#mySickLeaveModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();
            if(page_no == '') {
                return false;
            }
            if(isNaN(page_no)) {
                var new_url = $(this).children('a').attr('href');
                page_no = new_url[new_url.length -1];
            }
            
            var manager_id = "{{ $manager_id }}";
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/my-profile/sick-leaves/view') }}"+'/'+manager_id+"?page="+page_no,
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    if(resp == '') {
                        $(".log_my_sick_record_list").html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    } else {
                        $('.log_my_sick_record_list').html(resp);
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
    // 3rd tab search
        $('input[name=\'sm_leave_date\']').closest('.srch-field').hide();
        $('input[name=\'sm_sick_title\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                return false;      
            }
        });

        $('#mySickLeaveModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });

        $('select[name=\'sm_sick_search_type\']').change(function(){
            $('.search_my_sick_record').html('');
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

        $(document).on('click', '.search-my-sick-leave-btn', function(){
            update_my_sick_leave_search_list()
            return false;
        });
        
        function update_my_sick_leave_search_list() {

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

            var formdata = $('#searched-my-sick-leave-record-form').serialize();
            var manager_id = "{{ $manager_id }}";
            $.ajax({
                type : 'post',
                url  : "{{ url('/my-profile/sick-leaves/view') }}"+'/'+manager_id+'?search='+search+'&sm_leave_d='+sm_leave_d+'&sm_search_type='+sm_search_type,
                data : formdata,
                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // alert(resp); return false;
                    if(resp == ''){
                        $('.search_my_sick_record').html('No Records found.');
                    } else{
                        $('.search_my_sick_record').html(resp);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        }
</script>