<!-- <script src="{{ url('public/frontEnd/js/jquery.js') }}"></script> -->

<!-- record model -->
<div class="modal fade" id="dailyrecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="modal-name">
                    <h4> System Management-</h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" id='daily_record_add_form'>  
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="record_description">
                                <p class="help-block"> Enter the record description and click plus to add. </p>
                            </div>

                            <div class="add_rec_amount">
                                <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-2 p-t-7"> Add: </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15">
                                        <input type="text" class="form-control" name="edu_rec_amount">
                                        <p class="help-block"> Enter the amount </p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn group-ico save-edu-rec-btn" type="submit">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </form>
            <form method="post" action="{{ url('edit-record-list') }}" id="edit_record_form">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> 
                                <label class="pull-left checkbox"> <input class="select_all record_sel_all_checkbox" type="checkbox" name="" /> Current Score / Values </label> 
                                <span class="m-l-10"> <i class="fa fa-trash record_del_btn"></i> </span>
                            </h3>
                            <div class="daily-record-list">
                                <!-- records will be shown here using ajax -->    
                            </div>
                            <!-- <div class="daily-task-list">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <button class="btn btn-default" class="close" data-dismiss="modal" type="button"> Cancel </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning submit-edit-daily-record" type="submit"> Submit </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- record model end -->
<script>
    $(document).on('click','.select_all',function(){
        // console.log('1');
        if($(this).is(':checked')){
            $('.record_row input[type="checkbox"]').prop('checked', true);
        }else{
            $('.record_row input[type="checkbox"]').prop('checked', false);
        }
    })
</script>
<script type="text/javascript">
    $(document).on('click','.record_del_btn',function(){
        var record_id = [];
        $("input[type=checkbox]:checked").each(function() {
            record_id.push($(this).val());
        });
        var label_id = $('.daily-record-list').find('#new_label_id').val();
        // console.log(risk_id);
        if(record_id != ''){
            $('.loader').show();
            var record_token = "{{ csrf_token() }}";
            $.ajax({
                type    : 'post',
                url     : "{{ url('/system/earning-scheme/del-daily-records') }}",
                dataType: "json",
                data    : {'label_id':label_id,'record_id':record_id,'_token':record_token},
                cache   : false,

                success:function(resp){
                    // console.log(resp);
                    if(isAuthenticated(resp) == false){
                        return false;
                    }                    
                    if(resp == 1){
                        // $('.active_risk').closest('.risk-row').html('');
                        $("input[type=checkbox]:checked").each(function() {

                            $(this).closest('.record_row').html('');
                        });
                        
                        $('span.popup_success_txt').text('Record Deleted Successfully');
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
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
        }
    });
</script>

<script>
    $(document).ready(function(){
        // get record list
        $(".label-record").click(function(){ 
            var label_id   = $(this).find('.label_id').val();
            var label_type = $(this).find('.label_type').val();
            // alert(label_type);
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            $.ajax({
                type : 'get',
                url : "{{ url('/system/earning-scheme/tasks') }}"+'/'+label_id,
                // url  : "{{ url('/system/daily-records/') }}", 
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // if(resp == '' ) {
                        // $('.daily-record-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found.</div>');
                        // $('.daily-task-list').html(resp);
                        // $('.record_sel_all_checkbox,.record_del_btn').hide();
                    // }else{
                        $('.daily-record-list').html(resp);
                        var record_list = $('.daily-record-list').text();
                        var string = record_list.match('No Records found.');
                        if(string == null){ 
                            $('.record_sel_all_checkbox,.record_del_btn').show();
                        }else{
                            $('.record_sel_all_checkbox,.record_del_btn').hide();
                        }
                    //}
                    // $('.modal-name').html('<h4> System Management - '+resp+'</h4>');
                    $('#dailyrecordModal').modal('show');

                    if(label_type == 'E'){
                        $('.add_rec_amount').html('<div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd"><label class="col-md-1 col-sm-2 p-t-7"> Add: </label><div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15"><input type="text" class="form-control" name="edu_rec_amount"><p class="help-block"> Enter the amount </p></div><div class="col-md-1 col-sm-1 col-xs-1 p-0"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn group-ico save-record-btn" type="submit"><i class="fa fa-plus"></i></button></div></div>');
                    }else{
                        $('.add_rec_amount').html('<div class="col-md-1 col-sm-1 col-xs-12 p-0 r-p-15"><div class="col-md-1 col-sm-1 col-xs-1 p-0"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn group-ico save-record-btn" type="submit"><i class="fa fa-plus"></i></button></div></div>');
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>

<script>
$(document).ready(function(){
    //save a new record
    $(document).on('click','.save-record-btn',function(){ //alert('hi');
        var new_label_id = $('.daily-record-list').find('#new_label_id').val();
        // var new_label_name = $('.daily-record-list').find('new_label_name').val();
        // alert(new_label_id);
        // alert(new_label_name);
        var record_description = $('input[name=\'record_description\']').val();
        record_description = jQuery.trim(record_description);
        var record_score = $('select[name=\'record_score\']').val();
        var record_token = $('input[name=\'_token\']').val();
        var edu_rec_amount = $('input[name=\'edu_rec_amount\']').val();
        // alert(record_score)
        // alert(record_token)
        var error = 0;

        if(edu_rec_amount == ''){ 
            var data = {'record_description' : record_description,'_token' : record_token};
        }else{ 
            var data = {'record_description' : record_description, 'edu_rec_amount' : edu_rec_amount, '_token' : record_token};
        }

        if((record_description == '') || (record_description == null) ){ 
            //$('.field-reqiured').text('Field is requried');
            $('input[name=\'record_description\']').addClass('red_border');
            error = 1;
        } else{ 
            $('input[name=\'record_description\']').removeClass('red_border');
        }

        if(record_score == 0){ 
            $('select[name=\'record_score\']').parent().addClass('red_border');
            error = 1;
        } else{ 
            $('select[name=\'record_score\']').parent().removeClass('red_border');
        }
        
        if(error == 1){ 
            return false;
        }
        // alert(label_id); 
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/earning-scheme/task/add') }}"+'/'+new_label_id,
            data : data,
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == '0'){
                    //alert('Sorry record could not be added');
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                }else{
                    //empty the input fields
                    $('input[name=\'record_description\']').val('');
                    $('select[name=\'record_score\']').val('0');
                    $('input[name=\'edu_rec_amount\']').val('');
                    //show record list
                    $('.daily-record-list').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                    //show success message
                    $('span.popup_success_txt').text('Daily Record Added Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            }   
        });     
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
    //delete a new record
    $(document).on('click','.delete_record_btn',function(){
        
        if(!confirm("Are sure you to delete this ?")){
            return false;
        }

        var label_id = $('.daily-record-list').find('#new_label_id').val();
        // alert(new_label_id);

        var daily_record_id = $(this).attr('daily_record_id');
        // alert(daily_record_id);
        $(this).addClass('active_record');

        var record_token = $('input[name=\'_token\']').val();
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/earning-scheme/task/delete/') }}"+'/'+daily_record_id,
            data : { 'label_id' : label_id, 'daily_record_id' : daily_record_id, '_token' : record_token },

            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == 1) {
                    $('.active_record').closest('.record_row').html('');

                    //show delete message
                    $('span.popup_success_txt').text('Record Deleted Successfully');

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
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
    //status change record row
    $(document).on('click','.status_record_change_btn',function(){
        var daily_record_id = $(this).attr('daily_record_id'); 
        $(this).addClass('active_record');
        var row = $(this);

        var record_token = $('input[name=\'_token\']').val();
        var new_label_id = $('.daily-record-list').find('#new_label_id').val();
        // alert(new_label_id)
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/earning-scheme/task/status/') }}"+'/'+daily_record_id,
            data : { 'new_label_id' : new_label_id, 'daily_record_id' : daily_record_id, '_token' : record_token },
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == true){
                 
                    if($('.active_record').closest('span.settings').hasClass('clr-blue')){
                        $('.active_record').closest('span.settings').removeClass('clr-blue');
                        $('.active_record').closest('span.settings').addClass('clr-grey');
                    } else{
                        $('.active_record').closest('span.settings').removeClass('clr-grey');
                        $('.active_record').closest('span.settings').addClass('clr-blue');
                    }
                    $('span.popup_success_txt').text('Status Changed');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }else{
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                }
                $('.active_record').removeClass('active_record');
                $('.pop-notifbox').removeClass('active');

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
    //make editable a record
    $(document).on('click','.edit_record_btn',function(){
      
        var daily_record_id = $(this).attr('daily_record_id');
        var record_token = $('input[name=\'_token\']').val();
       
        $('.edit_record_desc_'+daily_record_id).removeAttr('disabled');
        //$('.edit_record_score_'+daily_record_id).removeAttr('disabled');
        $('.edit_record_id_'+daily_record_id).removeAttr('disabled');
        $('.pop-notifbox').removeClass('active');
        return false;
    });
});
</script>

<script>
    $(document).ready(function(){
        //for saving editable records
        $(document).on('click','.submit-edit-daily-record',function() {
            var record_token = $('input[name=\'_token\']').val();
            var new_label_id = $('.daily-record-list').find('#new_label_id').val();
            // alert(new_label_id);
            var err = 0;
            var enabled = 0;
            $('.edit_rcrd').each(function(index){

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
            //loader
            $('.loader').show();
            $('body').addClass('body-overflow');

            var formdata = $('#edit_record_form').serialize();
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/earning-scheme/task/edit') }}"+'/'+new_label_id,
                data : formdata,
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    $('.daily-record-list').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Daily Record Updated Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });
    });
</script>

<script>
    $('#icons').hide();
    $('.icon-box').on('click',function(){
        $('#icons').toggle();
    });
</script>

<!-- <script>
    $(document).ready(function(){
        $(document).on('click','.settings',function(){
            $(this).find('.pop-notifbox').toggleClass('active');
            $(this).closest('.cog-panel').siblings('.cog-panel').find('.pop-notifbox').removeClass('active');
        });
        $(window).on('click',function(e){
            e.stopPropagation();
            var $trigger = $(".settings");
            // console.log($trigger.has(e.target));
            if($trigger !== e.target && !$trigger.has(e.target).length){
                $('.pop-notifbox').removeClass('active');
            }
        });
    });
</script> -->
