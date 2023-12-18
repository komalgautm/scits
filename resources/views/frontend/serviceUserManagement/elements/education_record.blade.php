<!-- Education Record Modal -->

<div class="modal fade" id="educationRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['education_record']['label'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active edu-rec-logged-btn" type="button"> Logged Records </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    <div class="add-new-box risk-tabs custm-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <form method="post" action="">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="select-bi" style="width:100%;float:left;">
                                    <?php 
                                        $earning_scheme_label_id = App\EarningSchemeLabel::where('home_id',Auth::user()->home_id)
                                                                                     ->where('label_type','E')
                                                                                     ->where('deleted_at',null)
                                                                                     ->value('id');
                                        // echo "<pre>"; print_r($earning_scheme_label_id); die; 
                                        $education_record_options = App\EarningSchemeLabelRecord::where('home_id',Auth::user()->home_id)
                                                                                            ->where('status','1')
                                                                                            ->where('earning_scheme_label_id',$earning_scheme_label_id)
                                                                                            ->where('deleted_at',null)
                                                                                            ->orderBy('id','desc')
                                                                                            ->get()
                                                                                            ->toArray();
                                        // echo "<pre>"; print_r($education_record_options); die;
                                    ?>
                                    <select class="js-example-placeholder-single-et form-control" id="edu_records_list" style="width:100%;" name="edu_rec_id">
                                        <option value=""></option>
                                        @foreach($education_record_options as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <p class="help-block">Enter the task to be complete, once enter this task can be given a score.</p>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-5 add-rcrd">
                                    <label class="col-md-1 col-sm-2 p-t-7"> Select: </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12 l-p-10">
                                        <div class="select-bi" style="width:100%;float:left;">
                                            <select class="js-example-placeholder-single-et form-control"  style="width:100%;" name="am_pm">
                                                <option value="A">Am</option>
                                                <option value="P">Pm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                        <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn group-ico ser-sec save-edu-rec-btn" type="submit"> <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>

                                <!-- <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn group-ico ser-sec save-edu-rec-btn" type="submit"> <i class="fa fa-plus"></i> </button>
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
                                            foreach($daily_score as $score) {  ?>
                                                <!-- <li> <b class="p-r-10" >{{ $score->score }} - </b>  {{ $score->title }} Amount:{{ $score->title }} </li> -->
                                                <li> <b class="p-r-10" >{{ $score->score }} - </b>  {{ $score->title }}  </li>
                                                <?php } ?>
                                                <!-- <li><span class="clr-grn"></span> 2. {{ $score->title }} </li>
                                                <li><span class="clr-skyblu"></span> 3. {{ $score->title }} </li>
                                                <li><span class="clr-ornge"></span> 4. {{ $score->title }} </li>
                                                <li><span class="clr-red"></span> 5. {{ $score->title }} </li> -->
                                            </ul>
                                        </div>
                                    </span>
                                </h3>       
                            </div>                                 
                        </div>
                    <form method="post" action="" id="edit_edu_record_form">
                        <div class="su-edu-records modal-space ">
                        </div>
            
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <a class="bottm-btns" href="{{ url('/service/calendar/'.$service_user_id) }}" ><div class="pull-left"><i class="fa fa-calendar"></i></div></a>
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning sbmt-edittd-edu-rec" type="submit"> Submit </button>
                        </div>
                    </form>
                </div>

                <!-- logged plans -->
                <div class="logged-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged Records </h3>
                        </div>
                    <!-- alert messages -->
                    @include('frontEnd.common.popup_alert_messages')
                    <form id="edit-edu-logged-form">
                        <div class="modal-space modal-pading logged-plan-shown logged-edu-rec-list">
                            <!-- logged risk list be shown here using ajax -->
                        </div>
                    </form>
                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning edit-edu-logged-form-sub-btn" type="button"> Confirm</button>
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
                                <select name="er_search_type">
                                    <option value='title' <?php echo 'selected';?>> Title </option>
                                    <option value='date'> Date </option>
                                </select>
                            </div>
                            <!-- <input type="text" name="search_edu_record" class="form-control"> -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-b-15 title">
                            <input type="text" name="search_edu_record" class="form-control" maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-b-15">
                            <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                <input name="er_date" type="text"  value="" size="45" class="form-control" readonly="" maxlength="10">
                                <span class="input-group-btn add-on">
                                    <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <form id="searched-edu-records-form" method="post">
                        <div class="modal-space modal-pading searched-edu-records text-center">
                        <!-- <div class="modal-space searched-edu-records p-t-0" > -->
                        <!--searched Record List using ajax -->
                        </div>
                    </form>
                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning search_edu_rec_btn" type="button"> Confirm</button>
                    </div>
                </div>

        </div>
    </div>
</div>
</div>
</div>
                                    <!-- BMP-RMP -->
<!-- <li> 
    <a data-toggle="modal" data-dismiss="modal" href="#riskrecordModal" su_edu_record_id="'.$value->id.'" class="bmp-rmp_record_btn" > <span class="color-yellow"> <i class="fa fa-bolt"></i> </span> BMP/RMP </a> 
</li> -->
<script>
    //value get in option
    $(document).ready(function(){  
        $(document).on('click','.education-record-list',function(){

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
                    $('#edu_records_list').append(resp);  */    
                    var service_user_id = "{{ $service_user_id }}";

                    $.ajax({
                        type: 'get',
                        url : "{{ url('/service/education-records') }}"+'/'+service_user_id,
                        success:function(resp2){
                            
                            if(isAuthenticated(resp2) == false){
                                return false;
                            }
                            $('.su-edu-records').html(resp2);
                            $('#educationRecordModal').modal('show');
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
    //click search btn
    $('input[name=\'er_date\']').closest('.srch-field').hide();

    $(document).ready(function(){

        $('input[name=\'search_edu_record\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search_edu_rec_btn').click();
                return false;
                //$('.search_files_btn').click();        
            }
        });
        
        $('select[name=\'er_search_type\']').change(function(){

            $('.searched-edu-records').html('');
            var er_srch_title = $('input[name=\'search_edu_record\']');
            // alert(er_srch_title); return false;
            var er_src_date  = $('input[name=\'er_date\']');

            var type = $(this).val(); 
            if(type == 'date'){

                er_src_date.closest('.srch-field').show();
                er_src_date.removeClass('red_border');
                er_srch_title.closest('.srch-field').hide();

                /*--- used to initalize calendar specially for EarningScheme webpage ----*/
                $('.dpYears').datepicker({
                }).on('changeDate', function(e){
                    $(this).datepicker('hide');
                });
            }
            else{
                er_srch_title.closest('.srch-field').show();
                er_srch_title.removeClass('red_border');
                er_src_date.closest('.srch-field').hide();
            }            
        });

        $(document).on('click','.search_edu_rec_btn', function(){

            var er_search_type = $('select[name=\'er_search_type\']');
            var search_input   = $('input[name=\'search_edu_record\']');
            var er_search_date = $('input[name=\'er_date\']');
            
            var search = search_input.val();
            var er_date = er_search_date.val();
            var er_search_type = er_search_type.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');
            
            if(er_search_type == 'title'){
                if(search == ''){

                    search_input.addClass('red_border');
                    return false;
                } else{
                    search_input.removeClass('red_border');
                }
            }
            else{
                if(er_date == ''){
                    er_search_date.addClass('red_border');
                    return false;
                } else{
                    er_search_date.removeClass('red_border');
                }

            }
            //for editing functionality
            //check validations
            var error = 0;
            //var enabled = 0;
            $('.searched-edu-records .edit_edu_record').each(function(index){

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
            var formdata = $('#searched-edu-records-form').serialize();
            // alert(formdata); return false;
            var service_user_id = "{{ $service_user_id }}";
         
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'post',
                // url  : "{{ url('/service/daily-records') }}"+'/'+service_user_id+'?search='+search+'&er_date='+er_date,
                url  : "{{ url('/service/education-records') }}"+'/'+service_user_id+'?search='+search+'&er_date='+er_date+'&er_search_type='+er_search_type,
                data : formdata,
                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    resp = $.trim(resp);
                    if(resp == ''){

                        $('.searched-edu-records').html('{{ NO_RECORD }}');
                    } else{
                        $('.searched-edu-records').html(resp);
                    }

                    // whether to empty search input
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

        $('.edu-rec-logged-btn').click(function(){
            $('.loader').show();
            $('body').addClass('body-overflow');

            var service_user_id = "{{ $service_user_id }}";
        
            $.ajax({
                type : 'get', 
                url  : "{{ url('/service/education-records') }}"+'/'+service_user_id+ '?logged',     
                //dataType : "json",
                success:function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    $('.logged-edu-rec-list').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    //alert(resp);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){

    //add new su daily record
        $(document).on('click','.save-edu-rec-btn', function(){
            
            var edu_rec_id = $('select[name=\'edu_rec_id\']').val();
            var am_pm     = $('select[name=\'am_pm\']').val();
            var service_user_id = $('input[name=\'service_user_id\']').val();
            
            var error = 0;
            if(edu_rec_id == ''){ 
            $('select[name=\'edu_rec_id\']').parent().addClass('red_border');
            error = 1;
            }else{ 
                $('select[name=\'edu_rec_id\']').parent().removeClass('red_border');
            }
            
            if(error == 1){ 
                return false;
            }

            $('.loader').show();
            $('body').addClass('body-overflow');
          
            $.ajax({
                type: 'get',
                url : "{{ url('/service/education-record/add') }}",
                data : {'edu_rec_id' : edu_rec_id, 'service_user_id' : service_user_id, 'am_pm' : am_pm },
                success:function(resp){

                    // alert(resp); return false;
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == '0'){
                    //alert('Sorry record could not be added');
                     $('span.popup_error_txt').text('{{ COMMON_ERROR }}');
                     $('.popup_error').show();
                   } else {

                    $('.su-edu-records').html(resp);
                    //$('select[name=\'edu_rec_id\']').val('');
                    
                    //$('#dailyrecordModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //set select box placeholder
                    $('#select2-edu_records_list-container').html('<span class="select2-selection__placeholder">Select Task</span>');

                    //show success message
                    $('span.popup_success_txt').text('{{ ADD_RCD_MSG }}');
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
    $(document).on('click','.delete-edu-rec',function(){
        
        if(!confirm("Are sure you to delete this ?")){
            return false;
        }
        var su_edu_record_id = $(this).attr('su_edu_record_id');
        // alert(su_edu_record_id);  return false;

        $(this).addClass('active_record');
         var edu_rec_token = $('input[name=\'_token\']').val();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/service/education-record/delete') }}"+'/'+su_edu_record_id,
            data : {'su_edu_record_id' : su_edu_record_id, '_token' : edu_rec_token},
            success:function(resp){
                //alert(resp); return false;
                
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == 1) {
                    $('.active_record').closest('.edu_rec_row').html('');

                    //show delete message
                    $('span.popup_success_txt').text('{{ DEL_RECORD }}');

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                } else{

                    //show delete message error
                    $('span.popup_error_txt').text('{{ COMMON_ERROR }}');
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
        $(document).on('click','.edit_edu_rec_btn', function(){

            var edit_btn = $(this);
            var edu_record_detail_btn = edit_btn.closest('.pop-notification').find('.edu-record-detail');
            var su_edu_record_id = $(this).attr('su_edu_record_id');
            
            //if edit button is already cliked then don't click detail button
            if(edu_record_detail_btn.hasClass('active')){
                //return false;      
            } else {
                $(this).closest('.cog-panel').find('.input-plusbox').toggle();  
            }

            $('.edit_edu_rec_score_'+su_edu_record_id).removeAttr('disabled');
            /*if($('.edit_edu_rec_score_'+su_edu_record_id).removeAttr('disabled'))
            {
                alert('done'); return false;
            }
            else{
                alert('no'); return false;
            }*/
            $('.edit_edu_rec_detail_'+su_edu_record_id).removeAttr('disabled');
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('edit');
            $('.edit_edu_rec_id'+su_edu_record_id).removeAttr('disabled');
            $(this).closest('.pop-notifbox').removeClass('active');

            //used for checking if it is shown
            $(this).toggleClass('active');
            autosize($("textarea"));
            return false;
        });

        //detail option
        $(document).on('click','.edu-record-detail', function(){
            
            var detail_btn = $(this);
            var su_edu_record_id = $(this).attr('su_edu_record_id');  
            
            //if edit button is already cliked then don't click detail button
            var edit_edu_rec_btn = detail_btn.closest('.pop-notification').find('.edit_edu_rec_btn');
            
            if(edit_edu_rec_btn.hasClass('active')){
                
                // $('.edit_edu_rec_score_'+su_edu_record_id).attr('disabled','disabled');
                // $('.edit_edu_rec_detail'+su_edu_record_id).attr('disabled','disabled');
                // $('.edit_edu_rec_id'+su_edu_record_id).attr('disabled','disabled');
                $(this).closest('.cog-panel').find('.input-plusbox').removeClass('edit');
                $(this).closest('.cog-panel').find('.input-plusbox').addClass('view');
                edit_edu_rec_btn.removeClass('active');
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
        $(document).on('click','.sbmt-edittd-edu-rec', function(){
            
            //validating the input fields
            var validate_res = validate_edit_edu('.su-edu-records');
            //if any field is empty or if no field is editable then don't call ajax request
            if( (validate_res['err'] == 1) || (validate_res['enabled'] == 0) ) { 
            // alert(validate_res);
                return false;
            }
            // alert('1');

            var err = 0;
            var enabled = 0;
            $('.su-edu-records .edit_edu_record').each(function(index){

                var disabled_attr = $(this).attr('disabled');
                // alert(disabled_attr); return false;
                if(disabled_attr == undefined){

                    var desc = $(this).val();
                    desc = jQuery.trim(desc);
                    // alert(desc); return false;
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
            var formdata = $('#edit_edu_record_form').serialize();
            //alert(formdata); return false;

            $('.loader').show();
            $('body').addClass('body-overflow');
            //alert(formdata); return false;

            $.ajax({
                type : 'post',
                url  : "{{ url('/service/education-record/edit') }}",
                data : formdata,
                success:function(resp){
                    //alert(resp); return false;

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.su-edu-records').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Education/Training Record Updated Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });

        $(document).on('click','.edit-edu-logged-form-sub-btn', function(){
         
            //validating the input fields
            var validate_res = validate_edit_edu('.logged-edu-rec-list');
            
            //if any field is empty or if no field is editable then don't call ajax request
            if( (validate_res['err'] == 1) || (validate_res['enabled'] == 0) ) { 
                return false;
            }

            //loader
            var formdata = $('#edit-edu-logged-form').serialize();
            $('.loader').show();
            $('body').addClass('body-overflow');
            //alert(formdata); return false;

            $.ajax({
                type : 'post',
                url  : "{{ url('/service/education-record/edit?logged') }}",
                data : formdata,
                success:function(resp){
              
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.logged-edu-rec-list').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('{{ EDIT_RCD_MSG }}');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });

        function validate_edit_edu(parent_div_class){
            
            var response         = [];
            response['err']      = 0;
            response['enabled']  = 0;
            //var a = '.su-skill';

            //$('.su-skill .edit_skill').each(function(index){
            $(parent_div_class+' .edit_edu_record').each(function(index){

                var disabled_attr = $(this).attr('disabled');
                // alert(disabled_attr); return false;
                if(disabled_attr == undefined){
                    // alert('enterd'); return false;

                    var desc = $(this).val();
                    desc = jQuery.trim(desc);

                    if(desc == '' || desc == '0'){
                        if($(this).hasClass('sel')) {
                            $(this).parent().addClass('red_border');
                        } else{
                            $(this).addClass('red_border');
                        }
                        response['err'] = 1;
                    } else{
                        // alert('not enterd'); return false;
                        if($(this).hasClass('sel')) {
                            $(this).parent().removeClass('red_border');
                        } else{
                            $(this).removeClass('red_border');
                        }   
                    }
                    response['enabled'] = 1;
                }
            });
            return response;
        }

    });
</script>

<script>
$(document).ready(function(){
    $(".js-example-placeholder-single-et").select2({
          dropdownParent: $('#educationRecordModal'),
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
            $('.logged-daily-list .edit_edu_record').each(function(index){
                var is_disable = $(this).attr('disabled');
                if(is_disable == undefined) { //if it is not disabled
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

                    $('span.popup_success_txt').text('{{ EDIT_RCD_MSG }}');
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

        $(document).on('click','.edu-rcd-head', function(){
            $(this).next('.edu-rcd-content').slideToggle();
            $(this).find('i').toggleClass('fa-angle-down');
            $('.input-plusbox').hide();
        });
    });
</script>


<script>
    //pagination 
    $(document).ready(function(){

        $(document).on('click','#educationRecordModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();
           // alert(page_no);
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
                url  : "{{ url('/service/education-records') }}"+'/'+"{{ $service_user_id }}"+"?page="+page_no+ "&logged",
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.logged-edu-rec-list').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>
