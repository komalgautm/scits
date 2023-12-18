<!-- <script src="http://localhost/scits/public/frontEnd/js/jquery.js"></script> -->

<!-- Earning Scheme -->
<div class="modal fade" id="earningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - {{ $labels['earning_scheme']['label'] }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="{{ url('/system/earning/add') }}">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="title">
                                <p class="help-block">Enter the category, choose a icon and click plus to add. </p>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 r-p-15 p-0">
                                <span class="group-ico icon-box-earning"> <i class="fa fa-info"></i> </span>
                                <input type="hidden" name="earning_icon" value="" class="earn_icon">
                                <!-- <span class="group-ico"> <i class="fa fa-plus"></i> </span> -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  
                                <button class="btn btn-earn group-ico earn-save" type="submit">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                    <form method="post" action="" id="add_incentive" class="submit-btn">
                            <label class="col-md-1 col-sm-1 p-t-7 p-l-0 p-r-0"> Add: </label>
                            <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                <input type="text" class="form-control" name="incentive_name">
                                <p class="help-block">Enter the incentive, and choose its category. </p>
                            </div>
                        </div>

                        <div class="form-group col-md-5 col-sm-5 col-xs-12">
                            <label class="col-md-3 col-sm-3 col-xs-12 p-t-7 p-l-0 p-r-0"> Category: </label>
                            <div class="col-md-7 col-sm-7 col-xs-10 r-p-0">
                                <div class="select-style medium-select">
                                    <select name="earning_category" name="earning_category_id">
                                     </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 p-0 r-p-15">
                                <!-- <span class="group-ico mrgn-rmve"> <i class="fa fa-plus"></i> </span> -->
                                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-earn group-ico save-incentive-btn" type="submit">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                    </div>

                    <!-- Add new Details -->
                    <div class="risk-tabs">

                        <!-- alert mesage-->
                        @include('frontEnd.common.popup_alert_messages')
                        <!--  end of alert -->

        <form method = "post" action="{{ url('/system/earning/edit') }}" id="edit-earning">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Current Incentives </h3>
                        </div>
                        <!-- earn records list  -->
                        <div class="earn-record-list">
                        <!-- earn records will be shown here using ajax  -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                <button class="btn btn-warning submit_edit_earn" type="button"> Confirm </button>
            </div>
        </form>
        </div>
    </div>
</div>

 <script>

    /*------Font awesome icons script ---------*/ 
    $(document).ready(function(){
        $('.fontwesome-panel').hide();
        $('.icon-box-earning').on('click',function(){
            $('body').addClass('modal-open');
            $('.fontwesome-panel').show();
            $('.fontwesome-panel').find(".font-list").attr('id','earning-fonts');
        });

        $('.fontawesome-cross').on('click',function(){
           $('body').removeClass('modal-open');
           $('.fontwesome-panel').hide(); 
           
        });

        $(document).on('click','#earning-fonts .fa-hover a', function () {                 
            var trim_txt = $(this).find('i');
            var new_class = trim_txt.attr('class');
            $('.icon-box-earning i').attr('class',new_class);
            $('body').toggleClass('modal-open');
            $('.fontwesome-panel').hide(); 
            $('.earn_icon').val(new_class);
      
        });
    });

</script>


<script>      
$(document).ready(function(){
    //get  list of earning scheme 
    $(".earning-scheme").click(function(){
        $('.loader').show();
        $('body').addClass('body-overflow'); 
      
        $.ajax({
            type: 'get',
            url : "{{ url('/system/earning/index') }}",
            dataType: 'json',
            success: function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                var earn_cat_list = resp['list'];
                var earn_cat_opions = resp['earning_cat_options'];
                
                $('.earn-record-list').html(earn_cat_list);

                //setting options
                $('select[name=\'earning_category\']').find('option').remove();
                $('select[name=\'earning_category\']').append('<option value="">Select</option>'+earn_cat_opions);


                $('#earningModal').modal('show');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });

    });

});
</script>

<script>
    //save the earning scheme
    $(document).ready(function(){
        $(document).on('click','.earn-save', function(){
          
            var title = $('input[name=\'title\']').val();
                title = jQuery.trim(title);
         
            var earning_icon = $('input[name=\'earning_icon\']').val();
            var error = 0;
            var earn_token = $('input[name=\'_token\']').val();

            if((title == '' || title == null)){
                 $('input[name=\'title\']').addClass('red_border');
                 error =1;
            }
            else{
                 $('input[name=\'title\']').removeClass('red_border');   
            }
            if(earning_icon == ''){
                  $('input[name=\'earning_icon\']').siblings('span').addClass('red_border');
                  error =1;
            }
            else{
                  $('input[name=\'earning_icon\']').siblings('span').removeClass('red_border'); 
            }

            if(error == 1){
            return false;
            }
            $('.loader').show();
            $('body').addClass('body-overflow'); 
         
            $.ajax({
                type : 'post',
                url  : "{{ url('/system/earning/add') }}",
                dataType: 'json',
                data : {'title' : title, '_token' : earn_token, 'earning_icon' : earning_icon},
                success: function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    var earn_cat_list = resp['list'];
                    var earn_cat_opions = resp['earning_cat_options'];

                    //empty input field
                    $('input[name=\'title\']').val('');
                    $('input[name=\'earning_icon\']').val('');
                    $('.icon-box-earning i').attr('class','fa fa-info');

                    //show risk list
                    $('.earn-record-list').html(earn_cat_list);
                    $('#earningModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //setting options
                    $('select[name=\'earning_category\']').find('option').remove();
                    $('select[name=\'earning_category\']').append('<option value="">Select</option>'+earn_cat_opions);

                    //show success message
                    $('span.popup_success_txt').text('Earning Scheme Added Successfully');
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
    //delete the earning row
        $(document).on('click','.delete_earn_btn',function(){

            if(!confirm("Are sure you to delete this ?")){
                return false;
            }

            var earn_id = $(this).attr('earn_id');
            $(this).addClass('active_earn');
          

            var earn_token = $('input[name=\'_token\']').val();
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type   : 'post',
                url    : "{{ url('/system/earning/delete/') }}"+'/'+earn_id,
                data   : {'earn_id' : earn_id, '_token' : earn_token},

                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    
                    if(response == '1'){
                        $('.active_earn').closest('.earn-incentive-scheme').html('');

                        var earn_cat_opions = resp['earning_cat_options'];
                    
                        //setting options
                        $('select[name=\'earning_category\']').find('option').remove();
                        $('select[name=\'earning_category\']').append('<option value="">Select</option>'+earn_cat_opions);

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                        $('span.popup_success_txt').text('Earning Scheme Deleted Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    }
                    else{
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                    }

                }

            });
            return false;

        });
    });
</script>

<script>
    //update status
    $(document).ready(function(){
        $(document).on('click','.earn_status_change_btn', function(){
          
        var earn_id = $(this).attr('earn_id');
        $(this).addClass('active_earn');
           
        var earn_token = $('input[name=\'_token\']').val();
       
                $('.loader').show();
                $('body').addClass('body-overflow');
        $.ajax({
            type : 'post',
            url  : "{{ url('/system/earning/status/') }}"+'/'+earn_id,
            data : { 'earn_id' : earn_id, '_token' : earn_token},
            success: function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == '1'){
                    
                    if($('.active_earn').closest('span.settings').siblings('.earn-color').hasClass('clr-blue')){ 
                        $('.active_earn').closest('span.settings').siblings('.earn-color').removeClass('clr-blue');
                        $('.active_earn').closest('span.settings').siblings('.earn-color').addClass('clr-grey');
                    }else{ 
                        $('.active_earn').closest('span.settings').siblings('.earn-color').removeClass('clr-grey');
                        $('.active_earn').closest('span.settings').siblings('.earn-color').addClass('clr-blue');
                    }
                        $('span.popup_success_txt').text('Status changed successfully.');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }else{  
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                }

                $('.active_earn').removeClass('active_earn');
                $('.earn_status_change_btn').closest('.pop-notifbox').removeClass('active');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;

        });
    });
</script>

<script>
    //making editable earning category
    $(document).ready(function(){
        $(document).on('click','.edit_earn_btn', function(){
    
            var earn_id = $(this).attr('earn_id');

            $('.edit_earn_title_'+earn_id).removeAttr('disabled');
            $('.edit_earn_id_'+earn_id).removeAttr('disabled');
            $('.edit_earn_icon_'+earn_id).removeAttr('disabled');
            $(this).closest('.pop-notifbox').removeClass('active');
            return false;
        });
    });
</script>

<script>
    //saving editable record
    $(document).ready(function(){
        $(document).on('click','.submit_edit_earn', function(){
            
            var err = 0;
            var enabled = 0;
            //to check validation
            $('.edit_earn').each(function(index){

                var disabled_attr = $(this).attr('disabled');
                if(disabled_attr == undefined){
                
                    var desc = $(this).val();
                    desc = jQuery.trim(desc);
        
                    if(desc == '' || desc == '0'){
                        $(this).addClass('red_border');
                        err = 1;
                    } else{
                        $(this).removeClass('red_border');
                    }
                    enabled = 1;

                }
            });
            $('.edit_incentive').each(function(index){

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
                        enabled = 1;
                    }
                }
                
            });

            if(err == 1){ 
                return false;
            }
            if(enabled == 0){
                return false;
            }

            $('.loader').show();
            $('body').addClass('body-overflow');
            
            var formdata = $('#edit-earning').serialize();
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/earning/edit') }}",
                dataType: 'json',
                data : formdata,
                success : function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var earn_cat_list = resp['list'];
                    var earn_cat_opions = resp['earning_cat_options'];
    
                    $('.earn-record-list').html(earn_cat_list);
                    //var earn_cat_opions = resp['earning_cat_options'];

                    //setting options
                    $('select[name=\'earning_category\']').find('option').remove();
                    $('select[name=\'earning_category\']').append('<option value="">Select</option>'+earn_cat_opions);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Earning Scheme Updated Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;
        });
    });
</script>

<script>
    //save incentive while adding
    $(document).ready(function(){
        $(document).on('click','.save-incentive-btn', function(){
    
            var formdata = $('#add_incentive').serialize();
            var incentive_name = $('input[name=\'incentive_name\']').val();
            var earning_category = $('select[name=\'earning_category\']').val();
            incentive_name = jQuery.trim(incentive_name);
            var error = 0;

            if((incentive_name == '' || incentive_name == null)){
                 $('input[name=\'incentive_name\']').addClass('red_border');
                 error =1;
            }
             else{
                 $('input[name=\'incentive_name\']').removeClass('red_border');   
            }
            if((earning_category == '' || earning_category == null)){
                 $('select[name=\'earning_category\']').parent().addClass('red_border');
                 error =1;
            }
             else{
                 $('select[name=\'earning_category\']').parent().removeClass('red_border');   
            }

            if(error == 1){
                return false;
            }

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/system/earning/add_incentive') }}",
                dataType: 'json',
                data : formdata,
                success: function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var earn_cat_list = resp['list'];
                    var earn_cat_opions = resp['earning_cat_options'];
                    
                    $('.earn-record-list').html(earn_cat_list);

                    //setting options
                    $('select[name=\'earning_category\']').find('option').remove();
                    $('select[name=\'earning_category\']').append('<option value="">Select</option>'+earn_cat_opions);

                    $('#earningModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('input[name=\'incentive_name\']').val('');

                    $('span.popup_success_txt').text('incentive Added Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                }
            });
             return false;
        });
    });
</script>

<script>
    //delete incentive row 
    $(document).ready(function(){
        $(document).on('click','.delete_incentive_btn', function(){

            if(!confirm("Are sure you to delete this ?")){
                return false;
            }

            var incentive_id = $(this).attr('incentive_id');
            $(this).addClass('active_earn');

            var incentive_token = $('input[name=\'_token\']').val();
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type   : 'post',
                url    : "{{ url('/system/earning/delete_incentive/') }}"+'/'+incentive_id,
                data   : {'incentive_id' : incentive_id, '_token' : incentive_token},

                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 1){
                        $('.active_earn').closest('.incentive-row').remove();

                        $('span.popup_success_txt').text('Incentive Deleted Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    } else if(resp == 'AUTH_ERR'){
                        $('span.popup_error_txt').text('{{ UNAUTHORIZE_ERR }}');
                        $('.popup_error').show()                    
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);

                    } else{
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show()                    
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
    //update status of incentive
    $(document).ready(function(){
        $(document).on('click','.status_incentive_btn', function(){
            var incentive_id = $(this).attr('incentive_id');
            $(this).addClass('active_earn');

            var incentive_token = $('input[name=\'_token\']').val();
           
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url : "{{ url('/system/earning/update_incentive_status/') }}"+'/'+incentive_id,
                data : { 'incentive_id' : incentive_id, '_token' : incentive_token },
                success : function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == true){
                        if($('.active_earn').closest('span.settings').hasClass('clr-blue')){
                            $('.active_earn').closest('span.settings').removeClass('clr-blue');
                            $('.active_earn').closest('span.settings').addClass('clr-grey');
                        }
                        else{
                            $('.active_earn').closest('span.settings').removeClass('clr-grey');
                            $('.active_earn').closest('span.settings').addClass('clr-blue');
                        }
                        $('span.popup_success_txt').text('Status changed successfully.');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    } else if(resp == 'AUTH_ERR'){
                        $('span.popup_error_txt').text('{{ UNAUTHORIZE_ERR }}');
                        $('.popup_error').show()                    
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);

                    } else{
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                    }
                    $('.active_record').removeClass('active_record');
                    $('.status_incentive_btn').closest('.pop-notifbox').removeClass('active');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>

<script>
    //making editable incentive
    $(document).ready(function(){
        $(document).on('click','.edit-incentive-btn', function(){
        
            var incentive_id = $(this).attr('incentive_id');
            $('.edit_incentive_name_'+incentive_id).removeAttr('disabled');
            $('.edit_incentive_id_'+incentive_id).removeAttr('disabled');
            $(this).closest('.pop-notifbox').removeClass('active');
            return false;

        });
    });
</script>
                
<script>
    /*------Font awesome edit icons script ---------*/ 
    $(document).ready(function(){
        $('.fontwesome-panel').hide();
        $(document).on('click','.icon-box-edit-earn', function(){
    
            var earn_id = $(this).attr('earn_id');
            var icon_disabled = $('.edit_earn_icon_'+earn_id).attr('disabled');
        
            if(icon_disabled == undefined){
                $('body').addClass('modal-open');
                $('.fontwesome-panel').show();
                $('.fontwesome-panel').find('.font-list').attr('id','edit-earn-font');

                //adding class for saving icon
                $('.edit_earn_icon_'+earn_id).addClass('edit_active_earn_icon');
                //adding class for showing icon
                $(this).addClass('edit_active_earn_icon_box');
            }
            else{
                return false;
            }
            return false;

        });

        $('.fontawesome-cross').on('click',function(){
            $('body').removeClass('modal-open');
            $('fontwesome-panel').hide();
            $('.edit_active_earn_icon').val(new_class);
            $('.edit_active_earn_icon').removeClass('edit_active_earn_icon');
            $('.edit_active_earn_icon_box').removeClass('edit_active_earn_icon_box');
        });

        $(document).on('click', '#edit-earn-font .fa-hover a', function(){
            var trim_txt = $(this).find('i');
            var new_class = trim_txt.attr('class');
            $('.edit_active_earn_icon_box i').attr('class',new_class);
            $('body').toggleClass('modal-open');
            $('.fontwesome-panel').hide(); 
            $('.edit_active_earn_icon').val(new_class);
            $('.edit_active_earn_icon').removeClass('edit_active_earn_icon');
            $('.edit_active_earn_icon_box').removeClass('edit_active_earn_icon_box');
        });
    });
</script>