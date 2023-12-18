<style type="text/css">
    #weeklyModal input[type="checkbox"] {
        float: left;
        margin: 3px 0 0;
    }
</style>
<!-- Log Book Modal -->
<div class="modal fade" id="logBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Daily Log</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right hide-field">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active su-log-book-logged-btn" type="button"> Logged </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    @include('frontEnd.common.popup_alert_messages')


                <form method="post" action="" id="su-log-book-form">
                    <div class="add-new-box risk-tabs custm-tabs">
                                
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0"><!-- add-rcrd -->
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> User: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <div class="select-style">
                                    <select name="service_user_id" disabled="disabled" class='su_name'/>
                                        <option value="{{$patient->id}}">{{ $patient->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-center"> Category: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <div class="select-style">
                                    <select name="category_id">

                                        <option value="">Select Category</option>
                                        <?php /*foreach($su_log_book_category  as $category) 
                                        { ?>
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        <?php } */?>
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <!-- <div class="select-bi" style="width:100%;float:left;"> -->
                                    <input type="text" class="form-control" placeholder="" name="log_title" />
                                <!-- </div> -->
                                <!-- <p class="help-block"> Enter the Title of Log and add details below.</p> -->
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 datepicker-sttng date-sttng">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                   <input name="log_date" value="{{ date('d-m-Y H:i') }}" type="text" value="" readonly="" size="16" class="form-control log-book-datetime">
                                    <span class="input-group-btn add-on datetime-picker2">
                                        <input type="text" value="" name="" id="log-book-datetimepicker" autocomplete="off" class="form-control date-btn2">
                                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Details: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <div class="select-bi">
                                    <textarea name="log_detail" class="form-control detail-info-txt log-detail" rows="3" ></textarea>
                                </div>
                            </div>
                        </div>
            
                    <div class="form-group modal-footer m-t-0 modal-bttm">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-warning submit-log hide-field" type="submit"> Submit </button>
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
                    <form id="edit-daily-logged-form">
                        <div class="modal-space modal-pading logged-su-log-book-list text-center">
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
                                <input name="log_book_date_search" type="text"  value="{{ date('d-m-Y') }}" size="39" class="form-control" readonly="">
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
                        <button class="btn btn-warning search_su_log_record_btn" type="button"> Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- View Log Book Modal -->
<div class="modal fade" id="viewlogBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="#logBookModal">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Log Book </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                @include('frontEnd.common.popup_alert_messages')

                <form method="post" action="" id="su-log-book-form">
                    <div class="add-new-box risk-tabs custm-tabs">
                                
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0"><!-- add-rcrd -->
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Service User: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <div class="select-style">
                                    <select name="service_user_id" disabled="disabled" class='su_name'/>
                                        <option value="{{$patient->id}}">{{ $patient->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Staff: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <!-- <div class="select-bi" style="width:100%;float:left;"> -->
                                    <input type="text" class="form-control" disabled="disabled" placeholder="" name="view_staff_name" />
                                <!-- </div> -->
                                <!-- <p class="help-block"> Enter the Title of Log and add details below.</p> -->
                            </div>
                        </div>
                        

                        <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-center"> Category: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <div class="select-style">
                                    <select name="category_id" disabled="disabled">

                                        <option value="">Select Category</option>
                                        <?php /*foreach($su_log_book_category  as $category) 
                                        { ?>
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        <?php } */ ?>
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <!-- <div class="select-bi" style="width:100%;float:left;"> -->
                                    <input type="text" class="form-control" disabled="disabled" placeholder="" name="view_log_title" />
                                <!-- </div> -->
                                <!-- <p class="help-block"> Enter the Title of Log and add details below.</p> -->
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 datepicker-sttng date-sttng">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                   <input name="view_log_date" disabled="disabled" type="text" value="" readonly="" size="16" class="form-control log-book-datetime">
                                    <span class="input-group-btn add-on datetime-picker2">
                                        <input type="text" value="" name="" id="log-book-datetimepicker" autocomplete="off" class="form-control date-btn2">
                                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Details: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10 p-l-30">
                                <div class="select-bi">
                                    <textarea name="view_log_detail" disabled="disabled" class="form-control detail-info-txt" rows="3" id="log_book_info"></textarea>
                                </div>
                            </div>
                        </div>
            
                    <div class="form-group modal-footer m-t-0 modal-bttm">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        <!-- <button class="btn btn-warning close" type="submit"> Continue </button> -->
                    </div>
                </form>

                </div>

               
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="WeeklyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close view-all-logs mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Add to Weekly Log</h4>
            </div>
            @include('frontEnd.common.popup_alert_messages')
            <div class="modal-body" >
                <div class="row">
                    <form id="wekly_report" method="post"> 
                        <div class="add-new-box risk-tabs custm-tabs wekly_rpt">
                            

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    $('.log_book').click(function(){

        // Thu Jun 08 2017 15:40:17 GMT+0530 (IST)
        var currentdate = new Date;
        var dateTime = currentdate.getDate()+"-" +(currentdate.getMonth() + 1)+"-"+currentdate.getFullYear()+" "+currentdate.getHours()+":"+currentdate.getMinutes();
        $('input[name=\'log_date\' ]').val(dateTime);
        $('#logBookModal').modal('show');
    });
</script> -->

<script>
    $(document).ready(function() {

        var today  = new Date; 
        $('#log-book-datetimepicker').datetimepicker({
            format: 'dd-mm-yyyy',
            // endDate: today,
            // minView : 2

        }).on("change.dp",function(e) {
            var currentdate = $(this).data("datetimepicker").getDate();
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
                $('.search_su_log_record_btn').click();
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

        $(document).on('click','.search_su_log_record_btn', function(){

            var log_book_search_type = $('select[name=\'log_book_search_type\']');
            var log_book_title_search= $('input[name=\'log_book_title_search\']');
            
            var log_book_search_date = $('input[name=\'log_book_date_search\']');
            
            var search               = log_book_title_search.val();
            var log_book_date_search = log_book_search_date.val();
            var log_book_search_type = log_book_search_type.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(log_book_search_type == 'log_title') {
                if(search == '') {

                    log_book_title_search.addClass('red_border');
                    return false;
                } else{
                    log_book_title_search.removeClass('red_border');
                }
            }
            else {
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
            var service_user_id = "{{ $service_user_id }}";
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'post',
                url  : "{{ url('/service/logsbook') }}"+'/'+service_user_id+'?search='+search+'&log_book_date_search='+log_book_date_search+'&log_book_search_type='+log_book_search_type,

                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == ''){
                        $('.log_book_searched_records').html('No Logs found.');
                    } else{
                        $('.log_book_searched_records').html(resp);
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
        $('#logBookModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });
    });
</script>

<!-- ServiceUser Logged Button -->
<script>
    $(document).ready(function(){

        $(document).on('click', '.su-log-book-logged-btn', function(){
            
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            var service_user_id = "{{ $service_user_id }}";

            $.ajax({
                type : 'get', 
                url  : "{{ url('/service/logsbook') }}"+'/'+service_user_id+'?logged',     
                
                success:function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 0 || resp == '') {
                        $('.logged-su-log-book-list').html('No Logs Found');
                    } else {

                        $('.logged-su-log-book-list').html(resp);
                    }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
                }
            });
        });


        // View Log Record from Service User Logged Records
        $(document).on('click', '.view-su-log-book', function(){

            var log_book_id     = $(this).attr('log_book_id');
            var service_user_id = "{{ $service_user_id }}";

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({

                type: 'get',
                url : "{{ url('/service/logbook/view') }}"+'/'+log_book_id,
                success:function(resp) {

                    if(isAuthenticated(resp) == false) {
                        return false;
                    }

                    var response = resp['response'];
                    if(response == false) {
                        $('span.popup_error_txt').text('Error Occured', 'Try after sometime');
                        $('.popup_error').show();
                        setTimeout(function(){$('.popup_error').fadeOut()}, 5000);
                    } else {
                        
                        var su_log_rec_title   = resp['title'];                        
                        var su_log_rec_details = resp['details'];                        
                        //var su_log_rec_ctgry   = resp['category_id'];                        
                        var su_log_rec_date    = resp['date'];    
                        var staff_name         = resp['staff_name'];                   
                        
                        //$('select[name=\'category_id\']').val(su_log_rec_ctgry);
                        $('input[name=\'view_log_title\']').val(su_log_rec_title);
                        $('input[name=\'view_staff_name\']').val(staff_name);
                        $('input[name=\'view_log_date\']').val(su_log_rec_date);
                        $('textarea[name=\'view_log_detail\']').val(su_log_rec_details);

                        $('#logBookModal').modal('hide');
                        $('#viewlogBookModal').modal('show');

                        setTimeout(function () {
                            var elmnt = document.getElementById("log_book_info");
                            var scroll_height = elmnt.scrollHeight;
                            console.log(scroll_height);
                            $('#log_book_info').height(scroll_height);
                        },200);

                    }   
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>
 
<!-- Add Log to ServiceUser LogBook -->
<script>
    $('.submit-log').click(function(){

        var category_id  = $('select[name=\'category_id\']').val();
        var log_title  = $('input[name=\'log_title\']').val();
        var log_date   = $('input[name=\'log_date\']').val();
        var log_detail = $('.log-detail').val();
        var token      = $('input[name=\'_token\']').val();

        var formdata = $('#su-log-book-form').serialize();
        
        var error = 0;

        if(category_id == ''){ 
            $('select[name=\'category_id\']').addClass('red_border');
            error = 1;
        }else{ 
            $('select[name=\'category_id\']').removeClass('red_border');
        }

        if(log_title == ''){ 

            $('input[name=\'log_title\']').addClass('red_border');
            error = 1;
        }else{

            $('input[name=\'log_title\']').removeClass('red_border');
        }

        if(log_detail == ''){ 
            $('textarea[name=\'log_detail\']').addClass('red_border');
            error = 1;
        }else{ 
            $('textarea[name=\'log_detail\']').removeClass('red_border');
        }

        if(error == 1){ 
            return false;
        }

        $('.loader').show();
        $('body').addClass('body-overflow'); 


        $.ajax({
            type : 'post',
            url  : "{{ url('/service/logbook/add') }}",
            data : formdata,
            dataType : 'json',

            success:function(resp){
                if (isAuthenticated(resp) == false){
                    return false;
                }

                if (resp == false){
                    
                    $('span.popup_error_txt').text('Error Occured', 'Try after sometime');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                }   else  {

                    $('select[name=\'category_id\']').val('');
                    $('input[name=\'log_title\']').val('');
                    $('textarea[name=\'log_detail\']').val('');
                    
                    //show success message
                    $('span.popup_success_txt').text('Daily log Added Successsfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
                return false;
            }
       });
       return false;
    });
</script>

<script>
    // Log Record Details
    $(document).ready(function(){

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
                autosize($("textarea"));
                return false;    
            }

            $(this).closest('.cog-panel').find('.input-plusbox').toggle();
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('view');
            $(this).toggleClass('active');
            $(this).closest('.pop-notifbox').removeClass('active');
            //.edit_log_record_btn
            autosize($("textarea"));
           return false;
        });
    });
</script>

<script>
    // Pagination   
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
                if (resp == 0 || resp == ''){
                    $('.logged-su-log-book-list').html('No Logs Found');

                } else {
                    $('.logged-su-log-book-list').html(resp);
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });
</script>

<script>
    //3 tabs script only for general admin
    $('.logged-box').hide();
    $('.search-box').hide();
    $('.logged-btn').removeClass('active');
    $('.search-btn').removeClass('active');

    $('.add-new-btn').on('click',function(){ 
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.add-new-box').show();

    });
    $('.logged-btn').on('click',function(){ //alert(1);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.logged-box').show();

    });
    $('.search-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.search-box').show();

    });
</script>

<script>

    $(document).on('click', '.add_to_hndovr', function(){

        var log_id = $(this).attr('log_book_id');
        var servc_use_id = "{{ $service_user_id }}";
        
        $('#logBookModal').modal('hide');    
  
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type  : 'get',
            url   : "{{ url('/staff-user-list') }}",
            success:function(resp)  {
                
                if (isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {

                    $('.staff-user-list').html(resp);
                    $(".js-example-placeholder-single").select2({
                        dropdownParent: $('#StaffUserlogBookModal'),
                        placeholder: "Select Staff User"
                    });
                    $('input[name=\'log_id\']').val(log_id);
                    $('input[name=\'servc_use_id\']').val(servc_use_id);
                    $('#StaffUserlogBookModal').modal('show');    
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    });
</script>

<script>

    $(document).on('click', '.add_to_weekly', function(){
        // alert('1');
        var log_id = $(this).attr('log_book_id');
        // console.log(log_id); return false;
        var servc_use_id = "{{ $service_user_id }}";
        
        $('#logBookModal').modal('hide');    
  
        $('.loader').show();
        $('body').addClass('body-overflow');
        var _token = "{{ csrf_token()}}";

        $.ajax({
            type  : 'post',
            url   : "{{ url('/weekly/report') }}"+'/'+log_id,
            data : { 'servc_use_id': servc_use_id,'_token':_token},
            success:function(resp)  {
                // console.log(resp);
                if (isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {

                    $('.wekly_rpt').html(resp);
                    // $(".js-example-placeholder-single").select2({
                    //     dropdownParent: $('#StaffUserlogBookModal'),
                    //     placeholder: "Select Staff User"
                    // });
                    // $('input[name=\'log_id\']').val(log_id);
                    // $('input[name=\'servc_use_id\']').val(servc_use_id);
                    $('#WeeklyModal').modal('show');    
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click','.submt_wekly_report',function(){
        var title = $('input[name=title1]').val();
        var srvc_use_id = "{{ $service_user_id }}";
        var detail = $('textarea[name=detail]').val();
        

        error = 0;
        if(title =='') {

            $('input[name=title1]').parent().addClass('red_border');
            error = 1;
        } else {
            $('input[name=title1]').parent().removeClass('red_border');
        }

        if(detail =='') {
            $('textarea[name=detail]').parent().addClass('red_border');
            error = 1;
        }   else {
            $('textarea[name=detail]').parent().removeClass('red_border');
        }
        if(error == 1) {
            return false;
        }

        $('input[name=sent_mail]:checked').val('Y');
        var wklyformdata = $('#wekly_report').serialize();
        // console.log(wklyformdata);
        $('.loader').show();
        $.ajax({
            type : 'post',
            data : wklyformdata,
            url  : "{{ url('/weekly/rprt/edit/') }}"+'/'+srvc_use_id,
            success : function(resp){
                console.log(resp);
                if (isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == '1'){
                    $('input[name=title1]').val('');
                    $('textarea[name=detail]').val('');
                    $('input[name=sent_mail]').attr('checked',false);
                    $('span.popup_success_txt').text('Report Added Successsfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }else if(resp == '0'){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                }else{
                    $('input[name=title1]').val('');
                    $('textarea[name=detail]').val('');
                    $('input[name=sent_mail]').attr('checked',false);
                    $('span.popup_error_txt').text('Report is already added');
                    $('.popup_error').show();
                    setTimeout(function(){$('.popup_error').fadeOut()},5000);
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
            
        });
        return false;

    });
</script>


@include('frontEnd.serviceUserManagement.elements.handover_to_staff')