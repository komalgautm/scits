
<!-- Behaviour Management Plans -->
<div class="modal fade my_plan_model" id="PlanRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#dailyrecordModal" class="close p-r-10" > <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title"> Risk / Behaviour Management Plans</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default active risk-add-btn" type="button"> Add New </button>
                        <button class="btn label-default logged-btn logged-plan-btn" type="button"> Logged Plans </button>
                        <button class="btn label-default risk-search-btn" type="button"> Search </button>
                    </div>                      
                    <!-- Add new Details -->
                    <div class="risk-add-box risk-tabs risk-label-left">
                        <form method="post" id="add-new-bmp-rmp-form">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right">User: </label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                    <div class="select-style">
                                        <select name="service_user_id" class="su_n_id" disabled="" >
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
                                        <select name="dynamic_form_builder_id" class="dynamic_form_select b_rmp_form_sel">
                                            <option value="0"> Select Form </option>
                                            <?php
                                            $this_location_id  = App\DynamicFormLocation::getLocationIdByTag('bmp');
                                            $this_location_id1 = App\DynamicFormLocation::getLocationIdByTag('rmp');
                                            foreach($dynamic_forms as $value) {
                                            
                                                $location_ids_arr = explode(',',$value['location_ids']);

                                                if(in_array($this_location_id,$location_ids_arr)) {  ?>

                                                    <option value="{{ $value['id'] }}" location_id="{{ $this_location_id }}"> {{ ucfirst($value['title']) }} </option>
                                                
                                                <?php } elseif(in_array($this_location_id1,$location_ids_arr)) {  ?>

                                                    <option value="{{ $value['id'] }}" location_id="{{ $this_location_id1 }}"> {{ ucfirst($value['title']) }} </option>
                                                <?php } 
                                            } ?>
                                        </select>
                                    </div>
                                    <p class="help-block"> Choose a user and the type of form you want to fill. </p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="below-divider">                                    
                                </div>
                            </div>

                            @include('frontEnd.common.popup_alert_messages')
                            <div class="dynamic-form-fields"> </div>
                                
                            <div class="modal-footer m-t-0 modal-bttm m-b-5">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <input type="hidden" name="su_daily_record_id" value=""> -->
                                <input type="hidden" name="location_id" value="{{ $this_location_id }}" class="b_rmp_location_id">
                                <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                                <!-- <input type="hidden" name="plan_detail" value="">
                                <input type="hidden" name="service_user_id" value=""> -->
                                <button class="btn btn-default" type="button" data-dismiss="modal" data-toggle="modal" data-target="#dailyrecordModal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning sbt-dyn-form-btn" type="submit"> Confirm </button>
                                <!-- submit-add-new-bmp-rmps -->
                            </div>
                        </form>
                    </div>
                </div>
                  
                <!-- Logged Plans edit-plan-form-->
                <div class="risk-logged-box risk-tabs">
                    <div class="row">
                        <form method="post" action="" id="edit-plan-form">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue"> Logged Plans </h3>
                            </div>
                            <!-- alert messages -->
                            @include('frontEnd.common.popup_alert_messages')
                            <div class="loggd-min-ht">
                                <div class="col-md-12 col-sm-12 col-xs-12 logged-bmp_rmp">
                                    <div class="bmp-rmp-btns">
                                        <a href="#" class="btn bmp-btn bmp-plan-record">BMP</a>
                                        <a href="javascript:void(0)" class="btn rmp-btn rmp-plan-record">RMP</a>
                                    </div>
                                </div>
                                <!--Logged BMP/RMP List using ajax -->
                                <div class="bmp-content bmp-content-record">
                                    <!--Logged BMP List using ajax -->
                                </div>

                                <div class="rmp-content rmp-content-record">
                                    <!--Logged RMP List using ajax -->
                                </div>
                            </div>
                            <div class="modal-footer m-t-50 p-t-10 m-b-10 modal-bttm">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" data-toggle="modal" data-target="#dailyrecordModal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning submit-edit-logged-record" type="submit"> Confirm </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="risk-search-box risk-tabs">
                    <div class="row">
                        <form method="post" action="" id="searched-bmp-rmp-records-form">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue"> Search </h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="bmp-rmp-btns">
                                <a href="#" class="btn bmp-btn search-bmp-plan">BMP</a>
                                <a href="javascript:void(0)" class="btn rmp-btn search-rmp-plan">RMP</a>
                              </div>
                            </div>

                            <!-- 1st field -->
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Search: </label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                    <input class="form-control" type="text" name="search_bmp_rmp_record" value="" maxlength="255"/>
                                </div>
                            </div>
                            <div class="srch-min-ht text-center srch-bmp-plan">
                                <!--searched BMP/RMP List using ajax -->
                            </div>
                            <div class="srch-min-ht text-center srch-rmp-plan">
                                <!--searched BMP/RMP List using ajax -->
                            </div>
                            <div class="modal-footer m-t-0 modal-bttm m-b-10">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" data-toggle="modal" data-target="#dailyrecordModal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning search-bmp-rmp-btn" type="button"> Confirm </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<script>
    $(document).ready(function(){
        $(document).on('click','.bmp-rmp_record_btn', function(){
            // var su_daily_record_id = $(this).attr('service_user_daily_record_id');
            // //alert(su_daily_record_id);
            // $('input[name=\'su_daily_record_id\']').val(su_daily_record_id);
            $('#PlanRecordModal').modal('show');
        });
        $('#PlanRecordModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('change','.b_rmp_form_sel', function(){
            var opt_val = $('.b_rmp_form_sel option:selected').attr('location_id');
            $('.b_rmp_location_id').val(opt_val);
        });
    });
</script>


<script>
    //designer scipt
   // $('.bmp-content').hide();
    $('.rmp-content').hide();
    $('.logged-plan-btn').on('click',function(){
        $('.bmp-content').show();
        $('.rmp-content').hide();
        $('.rmp-btn').removeClass('active');
        $(this).addClass('active');
    });
    $('.bmp-btn').on('click',function(){
        //$('.bmp-content').slideToggle();
        $('.rmp-content').hide();
        $('.bmp-content').show();
        $('.rmp-btn').removeClass('active');
        $(this).addClass('active');
        $('.srch-rmp-plan').hide();
        $('.srch-bmp-plan').show();
    });  
    $('.rmp-btn').on('click',function(){
        //$('.rmp-content').slideToggle();
        $('.bmp-content').hide();
        $('.rmp-content').show();
        $('.bmp-btn').removeClass('active');
        $(this).addClass('active');
        $('.srch-bmp-plan').hide();
        $('.srch-rmp-plan').show();
    });    
</script>

<script>
    //using option value dynamic form 
    /*$('.rmp_form').hide();

    $(document).ready(function(){
        $('select[name=\'plan_type\']').change(function(){
            var bmp_risk = $('input[name=\'bmp_plan\']');
            var rmp_risk = $('input[name=\'rmp_plan\']');
            var type = $(this).val();
            if(type == 'rmp_plan') {
                $('.rmp_form').show();
                $('.bmp_form').hide();
            } else {
                $('.bmp_form').show();
                $('.rmp_form').hide();          
            }

        });
    });*/
</script>

<script>
    /*$('.plan_description').hide();
    $('.add_plan_desc').on('click',function(){
        $('.plan_description').toggle();
    });*/
</script>

<script>
    //add new bmp rmp record according to plan type 
    $(document).on('click','.submit-add-new-bmp-rmp', function(){

        var service_user_id = $('select[name=\'su_name_id\']').val();
        $('input[name=\'service_user_id\']').val(service_user_id);

        var plan_detail = $('textarea[name=\'details\']').val();
        $('input[name=\'plan_detail\']').val(plan_detail);

        var p_type = $('select[name=\'plan_type\']').val();
        if(p_type == 'bmp_plan') {
 
           

            var bmp_title = $('.bmp_form').find('.plan_bmp').val();
            error = 0;
            bmp_title = jQuery.trim(bmp_title);
            if(bmp_title == '' || bmp_title == null) {
                $('.bmp_form').find('.plan_bmp').addClass('red_border');
                error = 1;
            } else {
                 $('.bmp_form').find('.plan_bmp').removeClass('red_border');
            }
            if(error == 1) {
                return false;
            }
            var formdata = $('#add-new-bmp-rmp-form').serialize();

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'post',
                url : "{{ url('/service/bmp/add') }}",
                data: formdata,
                dataType: 'json',
                success: function(resp) {

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    if(response == '1') {
                        $('.bmp_form').find('input').val('');
                        $('.bmp_form').find('textarea').val('');
                        $('input[name=\'bmp_title_name\']').val('');
                        $('textarea[name=\'details\']').val('');
                         $('.plan_description').hide();

                        //show success message
                        $('span.popup_success_txt').text('BMP Details Added Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    }   else {
                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
           return false;
        } else {

            var rmp_title = $('.rmp_form').find('.plan_rmp').val();
            error = 0;
            rmp_title = jQuery.trim(rmp_title);
            if(rmp_title == '' || rmp_title == null) {
                $('.rmp_form').find('.plan_bmp').addClass('red_border');
                error = 1;
            } else {
                $('.rmp_form').find('.plan_bmp').removeClass('red_border');
            }
            if(error == 1) {
                return false;
            }
            var formdata = $('#add-new-bmp-rmp-form').serialize();
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'post',
                url : "{{ url('/service/rmp/add') }}",
                data: formdata,
                dataType: 'json',
                success: function(resp) {
                    //alert(resp); return false;
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    if(response == '1') {
                        $('.rmp_form').find('input').val('');
                        $('.rmp_form').find('textarea').val('');
                        $('input[name=\'rmp_title_name\']').val('');
                        $('textarea[name=\'details\']').val('');
                        $('.plan_description').hide();

                        //show success message
                        $('span.popup_success_txt').text('RMP Details Added Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    }   else {
                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
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
    $(document).ready(function(){
        // view bmp record
        $(document).on('click','.logged-plan-btn', function(){
            var service_user_id = "{{ $service_user_id }}";

            $('.bmp-btn').addClass('active');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/service/bmp/view/') }}"+'/'+service_user_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.bmp-content-record').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false; 
        });
        
        // view rmp record
        $(document).on('click','.rmp-plan-record', function(){
            var service_user_id = "{{ $service_user_id }}";
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/service/rmp/view/') }}"+'/'+service_user_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.rmp-content-record').html(resp);

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
        // pagination for rmp record
        $(document).on('click','.rmp-content-record .pagination li', function(){
            
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
                url  : "{{ url('service/rmp/view/') }}"+'/'+"{{ $service_user_id }}"+"?page="+page_no,
                success: function(resp) {
                    if(isAuthenticated == false) {
                        return false;
                    }
                    $('.rmp-content-record').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });

        //pagination for bmp record
        $(document).on('click','.bmp-content-record .pagination li', function(){
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
                url  : "{{ url('/service/bmp/view/') }}"+'/'+"{{ $service_user_id }}"+"?page="+page_no,
                success : function(resp) {
                    if(isAuthenticated == false) {
                        return false;
                    }
                    $('.bmp-content-record').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        })
    });
</script>

<script>
    $(document).ready(function(){
        //bmp edit record save
        $(document).on('click','.submit-edit-logged-record', function(){

            if($('.bmp-plan-record').hasClass('active')) {
                //alert(1); return false; 
            var enabled = 0;
            $('.bmp-content-record .edit_rcrd').each(function(index) {
                var is_disable = $(this).attr('disabled');
                if(is_disable == undefined) {
                    enabled = 1;
                }
            });
            if(enabled == 0) {
                return false;
            }
            var formdata =  $('#edit-plan-form').serialize();

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/service/bmp/edit')  }}",
                data : formdata,
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.bmp-content-record').html(resp);
                    $('span.popup_success_txt').text('{{ EDIT_RCD_MSG }}');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000); 

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

            } else if($('.rmp-plan-record').hasClass('active')) {    //rmp edit record save
           
                var enabled = 0;
                $('.rmp-content-record .edit_rcrd').each(function(index) {
                    var is_disable = $(this).attr('disabled');
                    if(is_disable == undefined) {
                        enabled = 1;
                    }
                });
                if(enabled == 0) {
                    return false;
                }
                var formdata =  $('#edit-plan-form').serialize();

                $('.loader').show();
                $('body').addClass('body-overflow');

                $.ajax({
                    type : 'post',
                    url  : "{{ url('/service/rmp/edit')  }}",
                    data : formdata,
                    success : function(resp) {
                        if(isAuthenticated(resp) == false){
                            return false;
                        }
                        $('.rmp-content-record').html(resp);
                        $('span.popup_success_txt').text('Updated Successsfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000); 

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });
                return false;
            } else {
                //alert(3); return false;
            }
            
        });
    });
</script>

<script>
    $(document).ready(function(){
        //search in bmp record

        //when enter press on search box
        $('input[name=\'search_bmp_rmp_record\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                return false;
            }
        });

        //when bmp search confirm button is clicked
        /*$(document).on('click','.search-bmp-rmp-btn', function() {

            var search_input = $('input[name=\'search_bmp_rmp_record\']');
            var search = search_input.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');

            if(search == '') {
                search_input.addClass('red_border');
                return false;
            } else {
                search_input.removeClass('red_border');
            }

            var formdata = $('#searched-bmp-rmp-records-form').serialize();
            //alert(formdata); return false;
            var service_user_id = "{{ $service_user_id }}";

            $('.loader').show();
            $('body').addClass('body-overflow');


            $.ajax({
                type : 'post',
                url  : "{{ url('/service/bmp/view/') }}"+'/'+service_user_id+'?search='+search,
                data : formdata,
                success :function(resp) {
                     if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == ''){
                        $('.srch-bmp-plan').html('No Records found.');
                    } else{
                        $('.srch-bmp-plan').html(resp);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });*/
        //}   

        $(document).on('click','.search-bmp-rmp-btn', function(){
            
            var search_input = $('input[name=\'search_bmp_rmp_record\']');
            var search = search_input.val();

            search = jQuery.trim(search);
            search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');

            if(search == '') {
                search_input.addClass('red_border');
                return false;
            } else {
                search_input.removeClass('red_border');
            }
            var formdata = $('#searched-bmp-rmp-records-form').serialize();

            var service_user_id = "{{ $service_user_id }}";

            if($('.search-bmp-plan').hasClass('active')) {

                var search_type = 'bmp';
                var search_url = "{{ url('/service/bmp/view/') }}"+'/'+service_user_id+'?search='+search;
            } else{
                var search_type = 'rmp';
                var search_url = "{{ url('/service/rmp/view/') }}"+'/'+service_user_id+'?search='+search;
            }
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : search_url,
                data : formdata,
                success :function(resp) {
                    //alert(resp); return false;
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    if(resp == ''){
                        
                        if(search_type == 'bmp'){
                            $('.srch-bmp-plan').html('No Records found.');
                        } else{
                            $('.srch-rmp-plan').html('No Records found.');
                        }
                    } else{

                        if(search_type == 'bmp'){
                            $('.srch-bmp-plan').html(resp);
                        } else{
                            $('.srch-rmp-plan').html(resp);
                        }                        
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
            //}
        });

    });
</script>

<script>
    /*---------Three tabs click option----------*/
    $('.risk-logged-box').hide();
    $('.risk-search-box').hide();

    $('.risk-add-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-add-box').show();
        $(this).closest('.modal-body').find('.risk-logged-box').hide();
        $(this).closest('.modal-body').find('.risk-search-box').hide();
        // $(this).closest('.modal-body').find('.risk-add-box').siblings('.risk-tabs').hide();
    });
    $('.logged-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-logged-box').show();
        $(this).closest('.modal-body').find('.risk-add-box').hide();
        $(this).closest('.modal-body').find('.risk-search-box').hide();
        // $(this).closest('.modal-body').find('.risk-logged-box').siblings('.risk-tabs').hide();
    });
    $('.risk-search-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-search-box').show();
        $(this).closest('.modal-body').find('.risk-add-box').hide();
        $(this).closest('.modal-body').find('.risk-logged-box').hide();
        // $(this).closest('.modal-body').find('.risk-search-box').siblings('.risk-tabs').hide();
        $('.search-bmp-plan').addClass('active');

    });
</script>



