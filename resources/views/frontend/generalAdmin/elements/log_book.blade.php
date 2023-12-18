<style type="text/css">
    .datetimepicker-minutes {
        height: 250px;
        overflow: auto;
    }
</style>
<?php $members =  App\ServiceUser::select('id', 'name')
                                        ->where('is_deleted','0')
                                        ->where('home_id', Auth::user()->home_id)
                                        ->get()
                                        ->toArray();
    // echo "<pre>"; print_r($members); die;
 ?>
<!--Log Book Modal -->
<div class="modal fade" id="logBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Log Book </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New Item</button>
                        <button class="btn label-default logged-btn active log-book-logged-btn" type="button"> Logged </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>
                <form method="post" action="" >
                    @include('frontEnd.common.popup_alert_messages')

                    <div class="add-new-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 fnt-20 clr-blue rmp-details"> Add Details </h3>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">                               
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi">
                                    <input type="text" class="form-control" placeholder="" name="log_title" />
                                </div>
                                <p class="help-block"> Enter the Title of Log and add details below.</p>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Select User: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi">
                                    <select class="form-control sel_usr_id" name="select_usr_id">
                                        <option value="">Select User</option>
                                        @foreach($members as $key => $members)
                                            <option value="{{$members['id']}}">{{ isset($members['name'])? $members['name'] : '' }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Add to Daily Log: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi">
                                    <select class="form-control" name="daily_log" disabled=''>
                                        <option value="">Select</option> 
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <!-- <input type="checkbox" class=""> -->
                            <!-- <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Add to Calender: </label> -->
                            <div class="col-md-2 col-sm-1 col-xs-12">
                                <div class="select-bi text-right">
                                    <input type="checkbox" class="" name="add_calender">
                                </div>
                            </div>
                            <label class="col-md-10 col-sm-10 col-xs-10"> Add to Calender </label>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 datepicker-sttng date-sttng">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Date: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                   <input name="log_date" type="text" value="" readonly="" size="16" class="form-control log-book-datetime">
                                    <span class="input-group-btn add-on datetime-picker2">
                                        <input type="text" value="" name="" id="log-book-datetimepicker" class="form-control date-btn2">
                                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Details: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi">
                                    <textarea name="log_detail" class="form-control detail-info-txt" rows="3" ></textarea>
                                </div>
                            </div>
                        </div>
            
                    <div class="form-group modal-footer m-t-0 modal-bttm">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-warning submit-log" type="submit"> Submit </button>
                    </div>
                </form>

                </div>

                <!-- logged plans -->
                <div class="logged-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged </h3>
                        </div>
                    <!-- alert messages -->
                    <!-- @include('frontEnd.common.popup_alert_messages') -->
                    <form id="edit-daily-logged-form" action="">
                        <div class="modal-space modal-pading logged-log-book-list text-center">
                            <!-- logged book list be shown here using ajax -->
                        </div>
                    </form>
                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <!-- <button class="btn btn-warning logged_daily_record_btn" type="button"> Confirm</button> -->
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
                                <select name="log_book_search_type">
                                    <option value='log_title' <?php echo 'selected';?>> Title </option>
                                    <option value='log_date'> Date </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                            <input type="text" name="log_book_title_search" class="form-control"><!-- id="log-book-datepicker" -->
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                            <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                <input name="log_book_date_search" type="text"  value="" size="45" class="form-control" readonly="">
                                <span class="input-group-btn add-on">
                                    <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <form id="srchd-log-books-form" method="post">
                        <div class="modal-space modal-pading log_book_searched_records text-center">
                        <!-- <div class="modal-space log_book_searched_records p-t-0" > -->
                        <!--searched Record List using ajax -->
                        </div>
                    </form>

                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning search_log_record_btn" type="button"> Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $('.log_book').click(function(){
        autosize($("textarea"));
        // Thu Jun 08 2017 15:40:17 GMT+0530 (IST)
        var currentdate = new Date;

        // var utc = currentdate.getTime() - (currentdate.getTimezoneOffset() * 60000);
        // var currentdate = new Date(utc + (3600000*offset));

        var dateTime = currentdate.getDate()+"-" +(currentdate.getMonth() + 1)+"-"+currentdate.getFullYear()+" "+currentdate.getHours()+":"+currentdate.getMinutes();
        $('input[name=\'log_date\' ]').val(dateTime);
        $('#logBookModal').modal('show');
    });
</script>

<script>
    $(document).ready(function() {

        today  = new Date; 
       // alert(today); 
        $('#log-book-datetimepicker').datetimepicker({
            format: 'dd-mm-yyyy',
            minuteStep: 1 //for one minute gap
            // endDate: today,
            // minView : 2

        }).on("change.dp",function (e) {
            var currentdate = $(this).data("datetimepicker").getDate();

            // var utc = currentdate.getTime() - (currentdate.getTimezoneOffset() * 60000);
            // var currentdate = new Date(utc + (3600000*offset));

            var newFormat = currentdate.getDate()+"-" +(currentdate.getMonth() + 1)+"-"+currentdate.getFullYear()+" "+currentdate.getHours()+":"+currentdate.getMinutes();
            $('.log-book-datetime').val(newFormat);
        });

        $('#log-book-datetimepicker').on('click', function(){
            $('#log-book-datetimepicker').datetimepicker('show');
        });

        $( "#logBookModal" ).scroll(function() {
            $('#log-book-datetimepicker').datetimepicker('place')
        });

        $('#log-book-datetimepicker').on('change', function(){
            $('#log-book-datetimepicker').datetimepicker('hide');
        });
    });
</script>

<script>
    //click search btn
    $('input[name=\'log_book_date_search\']').closest('.srch-field').hide();


    $(document).ready(function(){
        
        /*$( "#logBookModal" ).scroll(function() {
            $('#log-book-datepicker').datepicker('place')
        });*/
        
        $('input[name=\'log_book_title_search\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search_log_record_btn').click();
                return false;
            }
        });
        
        $('select[name=\'log_book_search_type\']').change(function(){

            $('.log_book_searched_records').html('');
            var log_book_title_search = $('input[name=\'log_book_title_search\']');
            var log_book_date_search  = $('input[name=\'log_book_date_search\']');

            var type = $(this).val(); 
            if(type == 'log_date'){

                log_book_date_search.closest('.srch-field').show();
                log_book_date_search.removeClass('red_border');
                log_book_title_search.closest('.srch-field').hide();
            }
            else{
                log_book_title_search.closest('.srch-field').show();
                log_book_title_search.removeClass('red_border');
                log_book_date_search.closest('.srch-field').hide();
            }            
        });

        $(document).on('click','.search_log_record_btn', function(){

            var log_book_search_type = $('select[name=\'log_book_search_type\']');
            var log_book_title_search= $('input[name=\'log_book_title_search\']');
            
            var log_book_search_date = $('input[name=\'log_book_date_search\']');
            
            var search               = log_book_title_search.val();
            var log_book_date_search = log_book_search_date.val();
            var log_book_search_type = log_book_search_type.val();
            // alert(log_book_search_type); return false;

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(log_book_search_type == 'log_title'){
                if(search == ''){

                    log_book_title_search.addClass('red_border');
                    return false;
                } else{
                    log_book_title_search.removeClass('red_border');
                }
            }
            else{
                if(log_book_date_search == ''){

                    log_book_search_date.addClass('red_border');
                    return false;
                } else{
                    log_book_search_date.removeClass('red_border');
                }
            }

            //for editing functionality
            //check validations
            // var error = 0;
            //var enabled = 0;
            /*$('.log_book_searched_records .edit_rcrd').each(function(index){
                var is_disable = $(this).attr('disabled');
                if(is_disable == undefined){ //if it is not disabled
                    var title = $(this).val();
                    title = jQuery.trim(title);

                    if(title == '' || title == '0'){
                        $(this).addClass('red_border');
                        error=1;
                    } else{
                        $(this).removeClass('red_border');
                    }
                    //enabled = 1;
                }
            }); 
            if(error == 1){
                return false;
            }*/ 
            /*if(enabled == 0){
                return false;
            }*/

            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'post',
                // url  : "{{ url('/service/daily-records') }}"+'/'+service_user_id+'?search='+search+'&log_book_date_search='+log_book_date_search,
                url  : "{{ url('/general/logsbook') }}"+'?search='+search+'&log_book_date_search='+log_book_date_search+'&log_book_search_type='+log_book_search_type,

                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // alert(resp); return false;
                    if(resp == ''){
                        $('.log_book_searched_records').html('No Records found.');
                    } else{
                        $('.log_book_searched_records').html(resp);
                    }
                    $('input[name=\'log_book_title_search\']').val('');
                    $('input[name=\'log_book_date_search\']').val('');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>
<!-- ww -->
<script >
    $(document).ready(function(){

        $('.log-book-logged-btn').click(function(){
            
            $('.loader').show();
            $('body').addClass('body-overflow');
        
            $.ajax({
                type : 'get', 
                url  : "{{ url('/general/logsbook') }}" + '?logged',     
                //dataType : "json",
                success:function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if (resp == '') {
                        $('.logged-log-book-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    } else {
                        $('.logged-log-book-list').html(resp);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>
 
<script type="text/javascript">
    // $(document).on('change','.sel_usr_id',function(){
    //     var select_usr_id   = $(this).val();
    //     if(select_usr_id != ''){
    //         $('select[name=\'daily_log\']').removeAttr('disabled');
    //         $('select[name=\'add_calender\']').removeAttr('disabled');
    //     }else{
    //         $('select[name=\'daily_log\']').attr('disabled','');
    //         $('select[name=\'add_calender\']').attr('disabled','');
    //     }
    // });
</script>
<script>
    $('.submit-log').click(function(){

        var log_title       = $('input[name=\'log_title\']').val();
        var log_date        = $('input[name=\'log_date\']').val();
        var log_detail      = $('textarea[name=\'log_detail\']').val();
        var select_usr_id   = $('select[name=\'select_usr_id\']').val();
        // var daily_log       = $('select[name=\'daily_log\']').val();
        var add_calender    = $("input[name=add_calender]:checked").val();
       // console.log(add_calender);
        if(add_calender == undefined){
            var add_calender ='false';
        } 
        var token    = $('input[name=\'_token\']').val();

        var error = 0;
        
        if(log_title == ''){ 
            $('input[name=\'log_title\']').parent().addClass('red_border');
            error = 1;
        }else{ 
            $('input[name=\'log_title\']').parent().removeClass('red_border');
        }

        if(log_date == ''){ 
            $('input[name=\'log_date\']').parent().addClass('red_border');
            error = 1;
        }else{ 
            $('input[name=\'log_date\']').parent().removeClass('red_border');
        }

        if(log_detail == ''){ 
            $('textarea[name=\'log_detail\']').parent().addClass('red_border');
            error = 1;
        }else{ 
            $('textarea[name=\'log_detail\']').parent().removeClass('red_border');
        }

        if(error == 1){ 
            return false;
        }

        $('.loader').show();
        $('body').addClass('body-overflow'); 


       $.ajax({
            type : 'post',
            url  : "{{ url('/general/logbook/add') }}",
            data : {'log_title':log_title, 'log_detail':log_detail, 'log_date':log_date, 'select_usr_id':select_usr_id,'add_calender':add_calender,'token':token},

            success:function(resp){
                if (isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                }   else  {
                    // $('.log-book-records').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    
                    $('input[name=\'log_title\']').val('');
                    $('textarea[name=\'log_detail\']').val('');
                    $('select[name=\'select_usr_id\']').val('');
                    $('input[name=add_calender]').prop('checked', false);
                    //show success message
                    $('span.popup_success_txt').text(' Record Added Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
                return false;
            }
       });
       return false;
    });
    
</script>

<!-- Log Record Deatils  -->
<script>
    $(document).ready(function(){

        //detail option
        $(document).on('click','.log-record-detail', function(){
            
            var detail_btn = $(this);
            var log_id = $(this).attr('log_id');  
            
            //if edit button is already cliked then don't click detail button
            var edit_log_record_btn = detail_btn.closest('.pop-notification').find('.edit_log_record_btn');
            
            if(edit_log_record_btn.hasClass('active')){
                
                // $('.edit_record_score_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_detail_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_record_id_'+service_user_daily_record_id).attr('disabled','disabled');
                $(this).closest('.cog-panel').find('.input-plusbox').removeClass('edit');
                $(this).closest('.cog-panel').find('.input-plusbox').addClass('view');
                edit_log_record_btn.removeClass('active');
                $(this).toggleClass('active');
                return false;    
            }

            $(this).closest('.cog-panel').find('.input-plusbox').toggle();
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('view');
            $(this).toggleClass('active');
            $(this).closest('.pop-notifbox').removeClass('active');
            //.edit_log_record_btn
            // setTimeout(function () {
            	autosize($("textarea"));
            // },200);
            return false;
        });
    });
</script>

<!-- Add To YP's Profile -->
<script>

    $(document).on('click', '.add_to_yp_profile', function(){

        var log_id = $(this).attr('log_book_id');

        $('#logBookModal').modal('hide');    
  
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type  : 'get',
            url   : "{{ url('/service-user-list') }}",
            success:function(resp)  {
                
                if (isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {
                    $('.service-user-list').html(resp);
                    $(".js-example-placeholder-single").select2({
                        dropdownParent: $('#ServiceUserlogBookModal'),
                        placeholder: "Select Service User"
                    });
                    $('input[name=\'log_id\']').val(log_id);
                    $('#ServiceUserlogBookModal').modal('show');    
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    });
</script>

<!-- Pagination -->
<script>
    //pagination
    $(document).on('click','.log_records_paginate .pagination li',function(){

        var new_url = $(this).children('a').attr('href');
        if(new_url == undefined){
            return false;
        }
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'get',
            url  : new_url+'&logged',
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {
                    $('.logged-log-book-list').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            }
        });
        return false;
    });
</script>

<!-- <script>
    //3 tabs script
    $('.logged-box').hide();
    $('.search-box').hide();
    $('.logged-btn').removeClass('active');
    $('.search-btn').removeClass('active');

    $('.add-new-btn').on('click',function(){ 
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.add-new-box').show();
        $(this).closest('.modal-body').find('.add-new-box').siblings('.risk-tabs').hide();
    });
    $('.logged-btn').on('click',function(){ //alert(1);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.logged-box').show();
        $(this).closest('.modal-body').find('.logged-box').siblings('.risk-tabs').hide();
    });
    $('.search-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.search-box').show();
        $(this).closest('.modal-body').find('.search-box').siblings('.risk-tabs').hide();
    });
</script> -->
<script>
    $(document).ready(function(){
        $(document).on('click','.daily-rcd-head', function(){
            $(this).next('.daily-rcd-content').slideToggle();
            $(this).find('i').toggleClass('fa-angle-down');
            $('.input-plusbox').hide();
        });
    });
</script>

<!-- YP add to calendar -->
<script>
    $(document).ready(function(){
        $(document).on('click','.add_to_clndr', function(){
            
            var log_book_id = $(this).attr('log_book_id');
            
            $('#logBookModal').modal('hide');    
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type  : 'get',
                url   : "{{ url('/service-user-list') }}",
                success:function(resp)  {
                    
                    if (isAuthenticated(resp) == false){
                        return false;
                    }
                    if (resp == 0){
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                    } else {
                        $('.service-user-list').html(resp);
                        $(".js-example-placeholder-single").select2({
                            dropdownParent: $('#ServiceUserAddToCalendarModal'),
                            placeholder: "Select Service User"
                        });
                        $('input[name=\'log_id\']').val(log_book_id);
                        $('#ServiceUserAddToCalendarModal').modal('show');    
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>

