<!-- Daily Record Modal -->
<div class="modal fade" id="dailyrecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['daily_record']['label'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active daily-record-logged-btn" type="button"> Logged Records </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>
                    <div class="add-new-box risk-tabs custm-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <form method="post" action="" >
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi" style="width:100%;float:left;">
                                    <?php 
                                    // $daily_records_options  = App\DailyRecord::where('home_id',Auth::user()->home_id)
                                        $earning_scheme_label_id = App\EarningSchemeLabel::where('home_id',Auth::user()->home_id)
                                                                                     ->where('label_type','G')
                                                                                     ->where('deleted_at',null)
                                                                                     ->value('id');
                                        // echo "<pre>"; print_r($earning_scheme_label_id); die; 
                                        $daily_records_options = App\EarningSchemeLabelRecord::where('home_id',Auth::user()->home_id)
                                            ->where('status','1')
                                            ->where('earning_scheme_label_id',$earning_scheme_label_id)
                                            ->where('deleted_at',null)
                                            ->orderBy('id','desc')
                                            ->get()
                                            ->toArray();
                                    ?>
                                    <select class="js-example-placeholder-single form-control" id="records_list" style="width:100%;" name="daily_record_id">
                                        <option value=""></option>

                                        @foreach($daily_records_options as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <p class="help-block"> Enter the task to be complete, once enter this task can be given a score.</p>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-5 add-rcrd">
                                    <label class="col-md-1 col-sm-2 p-t-7"> Select: </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12 l-p-10">
                                        <div class="select-bi" style="width:100%;float:left;">
                                            <select class="js-example-placeholder-single form-control"  style="width:100%;" name="am_pm">
                                                <option value="A">Am</option>
                                                <option value="P">Pm</option>
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn group-ico save-daily-record-btn" type="submit"> <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                                <!-- <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Select: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <select class="form-control" name="am_pm">
                                        <option value="A">Am</option>
                                        <option value="P">Pm</option>
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn group-ico save-daily-record-btn" type="submit"> <i class="fa fa-plus"></i> </button>
                                </div> -->
                            </form>
                        </div>
                 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="below-divider"></div>
                        </div>
                    
                    <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <div class="recent-task-sec">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Recent Tasks
                                <span class="pull-right key-main"><i class="fa fa-key"></i>        
                                
                                    <div class="key-sec score-detail">
                                        <h4> Scores Detail </h4>
                                        <ul type="none">

                                        <?php 
                                        foreach ($daily_score as $score) {  ?>
                                            <li> <b class="p-r-10" >{{ $score->score }} - </b>  {{ $score->title }} </li>
                                            <?php } ?>
                                           <!--  <li><span class="clr-grn"></span> 2. {{ $score->title }} </li>
                                            <li><span class="clr-skyblu"></span> 3. {{ $score->title }} </li>
                                            <li><span class="clr-ornge"></span> 4. {{ $score->title }} </li>
                                            <li><span class="clr-red"></span> 5. {{ $score->title }} </li> -->
                                        </ul>
                                    </div>
                                    
                                </span>
                            </h3>       
                            </div> 
                            
                        </div>
                    <form method="post" action="{{ url('/service/daily-record/edit') }}" id="edit_record_form">
                        <div class="service-user-record modal-space text-center">
                            <!-- daily records using ajax will be shown here -->
                        </div>
            
                    <div class="form-group modal-footer m-t-0 modal-bttm">
                        <a class="bottm-btns su-botm-calndr" href="{{ url('/service/calendar/'.$service_user_id) }}" ><div class="pull-left"><i class="fa fa-calendar"></i></div></a>
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-warning submit-edit-daily-record" type="submit"> Submit </button>
                        </form>
                    </div>
                </div>

                <!-- logged plans -->
                <div class="logged-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged Records </h3>
                        </div>
                    <!-- alert messages -->
                    @include('frontEnd.common.popup_alert_messages')
                    <form id="edit-daily-logged-form">
                        <div class="modal-space modal-pading logged-plan-shown logged-daily-list">
                            <!-- logged risk list be shown here using ajax -->
                        </div>
                    </form>
                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning logged_daily_record_btn" type="button"> Confirm</button>
                    </div>
                </div>

                <div class="search-box risk-tabs custm-tabs">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="m-t-0 m-b-20 clr-blue fnt-20">Search</h3>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 type-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Type: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-b-15">
                            <div class="select-style">
                                <select name="dr_search_type">
                                    <option value='title' <?php echo 'selected';?>> Title </option>
                                    <option value='date'> Date </option>
                                </select>
                            </div>
                            <!-- <input type="text" name="search_daily_record" class="form-control"> -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-b-15 title">
                            <input type="text" name="search_daily_record" class="form-control" maxlength="255"> 
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-b-15">
                            <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                <input name="dr_date" type="text"  value="" size="45" class="form-control" readonly="" maxlength="10">
                                <span class="input-group-btn add-on">
                                    <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <form id="searched-daily-records-form" method="post">
                        <div class="modal-space modal-pading searched-records text-center">
                        <!-- <div class="modal-space searched-records p-t-0" > -->
                        <!--searched Record List using ajax -->
                        </div>
                    </form>
                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning search_record_btn" type="button"> Confirm</button>
                    </div>
                </div>

        </div>
    </div>
</div>
</div>
</div>

<script>
    //click search btn
    $('input[name=\'dr_date\']').closest('.srch-field').hide();

    $(document).ready(function(){

        $('input[name=\'search_daily_record\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search_record_btn').click();
                return false;
                //$('.search_files_btn').click();        
            }
        });
        
        $('select[name=\'dr_search_type\']').change(function(){

            $('.searched-records').html('');
            var dr_src_title = $('input[name=\'search_daily_record\']');
            var dr_src_date  = $('input[name=\'dr_date\']');

            var type = $(this).val(); 
            if(type == 'date'){

                dr_src_date.closest('.srch-field').show();
                dr_src_date.removeClass('red_border');
                dr_src_title.closest('.srch-field').hide();

                /*--- used to initalize calendar specially for EarningScheme webpage ----*/
                $('.dpYears').datepicker({
                }).on('changeDate', function(e){
                    $(this).datepicker('hide');
                });

            }
            else{
                dr_src_title.closest('.srch-field').show();
                dr_src_title.removeClass('red_border');
                dr_src_date.closest('.srch-field').hide();
            }            
        });

        $(document).on('click','.search_record_btn', function(){

            var dr_search_type = $('select[name=\'dr_search_type\']');
            var search_input = $('input[name=\'search_daily_record\']');
            var dr_search_date = $('input[name=\'dr_date\']');
            
            var search = search_input.val();
            var dr_date = dr_search_date.val();
            var dr_search_type = dr_search_type.val();
            // alert(dr_search_type); return false;

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(dr_search_type == 'title'){
                if(search == ''){

                    search_input.addClass('red_border');
                    return false;
                } else{
                    search_input.removeClass('red_border');
                }
            }
            else{
                if(dr_date == ''){

                    dr_search_date.addClass('red_border');
                    return false;
                } else{
                    dr_search_date.removeClass('red_border');
                }

            }
            //for editing functionality
            //check validations
            var error = 0;
            //var enabled = 0;
            $('.searched-records .edit_rcrd').each(function(index){
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
            } 
            /*if(enabled == 0){
                return false;
            }*/
            var formdata = $('#searched-daily-records-form').serialize();
    
            var service_user_id = $('.selected_su_id').val();
            if(service_user_id == undefined){
                service_user_id = "{{ $service_user_id }}";
            } 
    
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'post',
                // url  : "{{ url('/service/daily-records') }}"+'/'+service_user_id+'?search='+search+'&dr_date='+dr_date,
                url  : "{{ url('/service/daily-records') }}"+'/'+service_user_id+'?search='+search+'&dr_date='+dr_date+'&dr_search_type='+dr_search_type,
                data : formdata,
                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // alert(resp); return false;
                    if(resp == ''){
                        $('.searched-records').html('No Records found.');
                    } else{
                        $('.searched-records').html(resp);
                    }
                    $('input[name=\'search\']').val('');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>

<script >
    $(document).ready(function(){

        $('.daily-record-logged-btn').click(function(){
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            var service_user_id = $('.selected_su_id').val();
            if(service_user_id == undefined){
                service_user_id = "{{ $service_user_id }}";
            } 

            $.ajax({
                type : 'get', 
                url  : "{{ url('/service/daily-records') }}"+'/'+service_user_id+ '?logged',     
                //dataType : "json",
                success:function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.logged-daily-list').html('<div class="text-center p-b-20" style="width:100%">No Records found.</div>');    
                    } else {
                        $('.logged-daily-list').html(resp);
                    }

                    // $('.logged-daily-list').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    //alert(resp);
                }
            });
        });
    });
</script>
<?php //echo '1'; die; ?>
<script>
    //value get in option
    $(document).ready(function(){  
        $(document).on('click','.daily-record-list',function(){ //alert('hi');
             
            $('.loader').show();
            $('body').addClass('body-overflow');
    
            /*$.ajax({
                type : 'get',
                url  : "{{ url('/service/daily-record/options') }}",  
                //dataType : 'json', 
                success:function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('#records_list').append(resp);  */    
                    var service_user_id = $('.selected_su_id').val();
                    if(service_user_id == undefined){
                        service_user_id = "{{ $service_user_id }}";
                    } 
                    
                    $.ajax({
                        type: 'get',
                        url : "{{ url('/service/daily-records') }}"+'/'+service_user_id,
                        success:function(resp2){
                            
                            if(isAuthenticated(resp2) == false){
                                return false;
                            }
                            if(resp2 == '') {
                                $('.service-user-record').html('<div class="text-center p-b-20" style="width:100%">No Records found.</div>');    
                            } else {
                                $('.service-user-record').html(resp2);
                            }

                            // $('.service-user-record').html(resp2);
                            $('#dailyrecordModal').modal('show');
                            $('.add-new-btn').click();          
                            $('.loader').hide();
                            $('body').removeClass('body-overflow');
                        }
                    });
                /*}
            });*/
        });
    });
</script>
 
<script>
    $(document).ready(function(){

    //add new su daily record
        $(document).on('click','.save-daily-record-btn', function(){
         
            var daily_record_id = $('select[name=\'daily_record_id\']').val();
            var am_pm = $('select[name=\'am_pm\']').val();
            // alert(am_pm);
            // alert(daily_record_id);
            var service_user_id = $('.selected_su_id').val();
            if(service_user_id == undefined){
                service_user_id = "{{ $service_user_id }}";
            } 

            var error = 0;
            if(daily_record_id == ''){ 
            $('select[name=\'daily_record_id\']').parent().addClass('red_border');
            error = 1;
            }else{ 
                $('select[name=\'daily_record_id\']').parent().removeClass('red_border');
            }
            
            if(error == 1){ 
                return false;
            }

            $('.loader').show();
            $('body').addClass('body-overflow');
          
            $.ajax({
                type: 'get',
                url : "{{ url('/service/daily-record/add') }}",
                data : {'daily_record_id' : daily_record_id, 'service_user_id' : service_user_id, 'am_pm' : am_pm },
                success:function(resp){
                    //alert(resp); return false;
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == '0'){
                        $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);

                   } else {

                        $('.service-user-record').html(resp);
                        //$('select[name=\'daily_record_id\']').val('');
                        $('#records_list').val('');
                       
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                        
                        //set select box placeholder
                        $('#select2-records_list-container').html('<span class="select2-selection__placeholder">Select Task</span>');

                        //show success message
                        $('span.popup_success_txt').text("{{ ADD_RCD_MSG }}");
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    }
                }

            })
            return false;
        });
    });
</script>

<script>
    //delete a row
    $(document).on('click','.delete-record',function(){

        if(!confirm('{{ DEL_CONFIRM }}')){
            return false;
        }

        var service_user_daily_record_id = $(this).attr('service_user_daily_record_id');
        //alert(service_user_daily_record_id);  return false;

        $(this).addClass('active_record');
         var record_token = $('input[name=\'_token\']').val();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/service/daily-record/delete') }}"+'/'+service_user_daily_record_id,
            data : {'service_user_daily_record_id' : service_user_daily_record_id, '_token' : record_token},
            success:function(resp){
                //alert(resp); return false;
                
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == 1) {
                    $('.active_record').closest('.record_row').html('');

                    //show delete message
                    $('span.popup_success_txt').text('Record Deleted Successsfully');

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                } else{

                    //show delete message error
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            }   
        });
    });
</script>

<script>
    $(document).ready(function(){

        //edit option => making editable 
        $(document).on('click','.edit_record_btn', function(){

            var edit_btn = $(this);
            var record_detail_btn = edit_btn.closest('.pop-notification').find('.record-detail');
            var service_user_daily_record_id = $(this).attr('service_user_daily_record_id');
            
            //if edit button is already cliked then don't click detail button
            if(record_detail_btn.hasClass('active')){
                //return false;      
            } else {
                $(this).closest('.cog-panel').find('.input-plusbox').toggle();  
            }

            $('.edit_record_score_'+service_user_daily_record_id).removeAttr('disabled');
            $('.edit_detail_'+service_user_daily_record_id).removeAttr('disabled');
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('edit');
            $('.edit_record_id_'+service_user_daily_record_id).removeAttr('disabled');
            $(this).closest('.pop-notifbox').removeClass('active');

            //used for checking if it is shown
            $(this).toggleClass('active');
            autosize($("textarea"));
            return false;
        });

        //detail option
        $(document).on('click','.record-detail', function(){
            
            var detail_btn = $(this);
            var service_user_daily_record_id = $(this).attr('service_user_daily_record_id');  
            
            //if edit button is already cliked then don't click detail button
            var edit_record_btn = detail_btn.closest('.pop-notification').find('.edit_record_btn');
            
            if(edit_record_btn.hasClass('active')){
                
                // $('.edit_record_score_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_detail_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_record_id_'+service_user_daily_record_id).attr('disabled','disabled');
                $(this).closest('.cog-panel').find('.input-plusbox').removeClass('edit');
                $(this).closest('.cog-panel').find('.input-plusbox').addClass('view');
                edit_record_btn.removeClass('active');
                $(this).toggleClass('active');
                autosize($("textarea"));
                return false;    
            }

            $(this).closest('.cog-panel').find('.input-plusbox').toggle();
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('view');
            $(this).toggleClass('active');
            $(this).closest('.pop-notifbox').removeClass('active');
            //.edit_record_btn
            autosize($("textarea"));

           return false;
        });
    });
</script>

<script>
    //saving editable record
    $(document).ready(function(){
        $(document).on('click','.submit-edit-daily-record', function(){
           // alert(1); //return false;
            var record_token    = $('input[name=\'_token\']').val();
            var service_user_id = $('.selected_su_id').val();
            if(service_user_id  == undefined){
                service_user_id = "{{ $service_user_id }}";
            } 

            var err = 0;
            var enabled = 0;
            $('.service-user-record .edit_rcrd').each(function(index){

                var disabled_attr = $(this).attr('disabled');

                if(disabled_attr == undefined){

                    var desc = $(this).val();
                    desc = jQuery.trim(desc);

                    if(desc == '' || desc == '0'){
                        if($(this).hasClass('sel')) {
                            $(this).parent().addClass('red_border');
                        } else{
                            $(this).addClass('red_border');
                        }
                        err = 1;
                    } else{
                        if($(this).hasClass('sel')) {
                            $(this).parent().removeClass('red_border');
                        } else{
                            $(this).removeClass('red_border');
                        }   
                    }
                    enabled = 1;
                }
            });

            if(err == 1){ 
                return false;
            }
            if(enabled == 0){
                return false;
            }

            //loader
            var formdata = $('#edit_record_form').serialize();
            $('.loader').show();
            $('body').addClass('body-overflow');
            //alert(formdata); return false;

            $.ajax({
                type : 'post',
                url  : "{{ url('/service/daily-record/edit') }}",
                data : formdata,
                success:function(resp){
                    //alert(resp); return false;

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.service-user-record').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Daily Records Updated Successsfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });

    });
</script>

<script >
//select options for education  record 
$(document).ready(function(){
    $(".js-example-placeholder-single").select2({
          dropdownParent: $('#dailyrecordModal'),
          placeholder: "Select Task"
    });
 });
</script>


<script>
    //saving editable record in bmp-rmp logged
    $(document).ready(function(){

        $(document).on('click','.logged_daily_record_btn', function(){
         
            //check validations
            var error = 0;
            var enabled = 0;
            $('.logged-daily-list .edit_rcrd').each(function(index){
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
                    enabled = 1;
                }
            }); 
            if(error == 1){
                return false;
            } 
            if(enabled == 0){
                return false;
            }
            
            var formdata = $('#edit-daily-logged-form').serialize();
            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type : 'post',
                url  : "{{ url('/service/daily-record/edit?logged') }}",
                data : formdata,
                success : function(resp){
                
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    $('.logged-daily-list').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Updated Successsfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000); 
                }
            });
            return false;
        });
    });
</script>
<script>
    $(document).ready(function(){

        $(document).on('click','.daily-rcd-head', function(){
            $(this).next('.daily-rcd-content').slideToggle();
            $(this).find('i').toggleClass('fa-angle-down');
            $('.input-plusbox').hide();
        });
    });
</script>


<script>
    //pagination 
    $(document).ready(function(){

        $(document).on('click','#dailyrecordModal .pagination li', function(){
    
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

            $.ajax({
                type : 'get',
                url  : "{{ url('/service/daily-records') }}"+'/'+"{{ $service_user_id }}"+"?page="+page_no+ "&logged",
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.logged-daily-list').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>

<!-- <script>
    //pagination of daily record
    $(document).on('click','.daily_rec_paginate .pagination li',function(){
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

                $('.logged-daily-list').html(resp);
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });
</script>
 -->