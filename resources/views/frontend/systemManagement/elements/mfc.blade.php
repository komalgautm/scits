<!-- record model -->
<div class="modal fade" id="mfcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - {{ $labels['mfc']['label'] }} </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" id='daily_record_add_form'>  

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-2 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="mfc_description">
                                <!-- <p class="field_error field-reqiured">This field is requried. </p> -->
                                <p class="help-block"> Enter the description and click plus to add. </p>
                            </div>

                            <!-- <div class="col-md-4 col-sm-4 col-xs-12 p-0 r-p-15 "> -->
                                <!-- <label class="col-md-4 col-sm-4 col-xs-12 p-t-7 r-p-0"> Score: </label>
                                <div class="col-md-4 col-sm-4 col-xs-9 p-0">
                                    <div class="select-style small-select">
                                    <select name="record_score" class="">
                                    
                                    <?php  for($i=0;$i<=5;$i++){
                                        $sel = '';
                                        if($i == 0){
                                            $sel = 'selected';
                                        }
                                       ?>
                                        <option value="{{ $i }}" {{ $sel }}>{{ $i }}</option>
                                    <?php  }  ?>
                                     
                                    </select>
                                    </div>
                                </div> -->
                                
                                <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn group-ico save-mfc-btn" type="submit">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            <!-- </div> -->

                        </div>
                    </form>

            <form method="post" action="{{ url('edit-record-list') }}" id="edit_mfc_form">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                        
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue"> Current Values </h3>
                            <div class="mfc-list">
                                <!-- records will be shown here using ajax -->    
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <button class="btn btn-default" class="close" data-dismiss="modal" type="button"> Cancel </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning sbmt-editd-mfc" type="submit"> Submit </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- record model end -->

<script>
    $(document).ready(function(){
        
        // get mfc list
        $(".mfc").click(function(){
            // alert('mfc'); return false;
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/mfc/') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.mfc-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');    
                    } else {
                        $('.mfc-list').html(resp);
                    }

                    // $('.mfc-list').html(resp);
                    $('#mfcModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            
        });
    });
</script>

<script>
$(document).ready(function(){

    //save a new mfc
    $(document).on('click','.save-mfc-btn',function(){

        var mfc_description = $('input[name=\'mfc_description\']').val();
        mfc_description = jQuery.trim(mfc_description);

        // var record_score = $('select[name=\'record_score\']').val();
        var mfc_token = $('input[name=\'_token\']').val();
        var error = 0;

        if((mfc_description == '') || (mfc_description == null) ){ 
            //$('.field-reqiured').text('Field is requried');
            $('input[name=\'mfc_description\']').addClass('red_border');
            error = 1;
        } else{ 
            $('input[name=\'mfc_description\']').removeClass('red_border');
        }

        /*if(record_score == 0){ 
            $('select[name=\'record_score\']').parent().addClass('red_border');
            error = 1;
        } else{ 
            $('select[name=\'record_score\']').parent().removeClass('red_border');
        }*/
        
        if(error == 1){ 
            return false;
        }

        $('.loader').show();
        $('body').addClass('body-overflow');
        
        // 'record_score' : record_score, -->line 145
        $.ajax({
            type : 'post',
            url  : "{{ url('/system/mfc/add') }}",
            data : { 'mfc_description' : mfc_description, '_token' : mfc_token},
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
                    $('input[name=\'mfc_description\']').val('');
                    // $('select[name=\'record_score\']').val('0');
                    
                    //show record list
                    $('.mfc-list').html(resp);
                    
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //show success message
                    $('span.popup_success_txt').text('MFC Added Successfully');
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
    $(document).on('click','.delete_mfc_btn',function(){

        var mfc_id = $(this).attr('mfc_id');

        $(this).addClass('active_record');

        var mfc_token = $('input[name=\'_token\']').val();
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/mfc/delete/') }}"+'/'+mfc_id,
            data : { 'mfc_id' : mfc_id, '_token' : mfc_token },

            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }

                if(resp == 1) {
                    $('.active_record').closest('.mfc_row').html('');

                    //show delete message
                    $('span.popup_success_txt').text('MFC Deleted Successfully');

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

    //status change mfc row
    $(document).on('click','.status_mfc_chnge_btn',function(){

        var mfc_id = $(this).attr('mfc_id'); 
        $(this).addClass('active_record');
        var row = $(this);

        var mfc_token = $('input[name=\'_token\']').val();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/mfc/status/') }}"+'/'+mfc_id,
            data : { 'mfc_id' : mfc_id, '_token' : mfc_token },
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
                } else{
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                }
                $('.active_record').removeClass('active_record');
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
   
    //make mfc editable
    $(document).on('click','.edit_mfc_btn',function(){
      
        var mfc_id = $(this).attr('mfc_id');
        var mfc_token = $('input[name=\'_token\']').val();
       
        $('.edit_mfc_desc'+mfc_id).removeAttr('disabled');
        // $('.edit_record_score_'+mfc_id).removeAttr('disabled');
        $('.edit_mfc_id_'+mfc_id).removeAttr('disabled');
        return false;
    });
});
</script>

<script>
    $(document).ready(function(){
        
        //for saving editable mfc
        $(document).on('click','.sbmt-editd-mfc',function() {

            var mfc_token    = $('input[name=\'_token\']').val();
            var err = 0;
            var enabled = 0;
            $('.edit_mfc').each(function(index){

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

            var formdata = $('#edit_mfc_form').serialize();
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/mfc/edit') }}",
                data : formdata,
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('.mfc-list').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('MFC Updated Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });
    });
</script>