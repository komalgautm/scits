<!-- <script src="{{ url('public/frontEnd/js/jquery.js') }}"></script>
 -->
<!-- record model -->
<div class="modal fade" id="educationRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - {{ $labels['education_record']['label'] }}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form method="post" id='daily_record_add_form'>  

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-2 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="edu_rec_desc">
                                <!-- <p class="field_error field-reqiured">This field is requried. </p> -->
                                <p class="help-block"> Enter the description </p>
                            </div>
                            <!--<div class="col-md-4 col-sm-4 col-xs-12 p-0 r-p-15 "> -->
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
                           <!--  <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn group-ico save-edu-rec-btn" type="submit">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-2 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="edu_rec_amount">
                                <!-- <p class="field_error field-reqiured">This field is requried. </p> -->
                                <p class="help-block"> Enter the amount </p>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn group-ico save-edu-rec-btn" type="submit">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    
            <form method="post" action="{{ url('edit-record-list') }}" id="edit_edu_rec_form">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> 
                                <label class="pull-left checkbox"> <input class="select_all edu_sel_all_checkbox" type="checkbox" name="" /> Current Values </label> 
                                <span class="m-l-10"> <i class="fa fa-trash edu_del_btn"></i> </span>
                            </h3>
                            <div class="edu-record-list">
                                <!-- records will be shown here using ajax -->    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <button class="btn btn-default" class="close" data-dismiss="modal" type="button"> Cancel </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning sbmt-edit-edu-rec" type="submit"> Submit </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- record model end -->


<script>
    
    $(document).on('click','.select_all',function(){

        if($(this).is(':checked')){
            $('.record_row input[type="checkbox"]').prop('checked', true);
        }else{
            $('.record_row input[type="checkbox"]').prop('checked', false);
        }

    })

</script>
<script type="text/javascript">
    $(document).on('click','.edu_del_btn',function(){
        var edu_id = [];
        $("input[type=checkbox]:checked").each(function() {

            edu_id.push($(this).val());
        });
        // console.log(edu_id);
        if(edu_id != ''){
            $('.loader').show();
            var edu_token = "{{ csrf_token() }}";
            $.ajax({
                type    : 'post',
                url     : "{{ url('/system/del/education-record') }}",
                dataType: "json",
                data    : {'edu_id':edu_id,'_token':edu_token},
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
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                        $('span.popup_success_txt').text('Record Deleted Successfully');
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
        
        // get education-training list
        $('.education-record').click(function(){

            $('.loader').show();
            $('body').addClass('body-overflow');
            
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/education-records/') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.edu-record-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                        $('.edu_sel_all_checkbox,.edu_del_btn').hide();
                    } else {
                        $('.edu-record-list').html(resp);
                        $('.edu_sel_all_checkbox,.edu_del_btn').show();
                    }
                    // $('.edu-record-list').html(resp);
                    $('#educationRecordModal').modal('show');
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

    $(document).on('click','.save-edu-rec-btn',function(){

        var edu_rec_desc = $('input[name=\'edu_rec_desc\']').val();
        edu_rec_desc     = jQuery.trim(edu_rec_desc);

        var edu_rec_amount  = $('input[name=\'edu_rec_amount\']').val(); 
        edu_rec_amount      = jQuery.trim(edu_rec_amount);
        var num             = edu_rec_amount.match(/[\d\.]+/g);
        if (num != null){
            var edu_rec_amount = num.toString();
            
        }else{
            var edu_rec_amount = null;
        }
        //alert(edu_rec_amount);
        // var record_score = $('select[name=\'record_score\']').val();
        var edu_rec_token = $('input[name=\'_token\']').val();
        var error = 0;

        if((edu_rec_desc == '') || (edu_rec_desc == null) || (edu_rec_amount == '') || (edu_rec_amount == null)){ 
            //$('.field-reqiured').text('Field is requried');
            $('input[name=\'edu_rec_desc\']').addClass('red_border');
            $('input[name=\'edu_rec_amount\']').addClass('red_border');
            error = 1;
        } else{ 
            $('input[name=\'edu_rec_desc\']').removeClass('red_border');
            $('input[name=\'edu_rec_amount\']').removeClass('red_border');
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
            url  : "{{ url('/system/education-record/add') }}",
            data : { 'edu_rec_desc' : edu_rec_desc, 'edu_rec_amount' : edu_rec_amount, '_token' : edu_rec_token },
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
                    $('input[name=\'edu_rec_desc\']').val('');
                    $('input[name=\'edu_rec_amount\']').val('');
                    
                    //show record list
                    $('.edu-record-list').html(resp);
                    
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //show success message
                    $('span.popup_success_txt').text('Education Record Added Successfully');
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
    $(document).on('click','.delete_edu_rec_btn',function(){
        if(!confirm("Are sure you to delete this ?")){
            return false;
        }

        var edu_rec_id = $(this).attr('edu_rec_id');
        $(this).addClass('active_record');

        var edu_rec_token = $('input[name=\'_token\']').val();
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/education-record/delete/') }}"+'/'+edu_rec_id,
            data : { 'edu_rec_id' : edu_rec_id, '_token' : edu_rec_token },

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
    $(document).on('click','.rec_status_chnge_btn',function(){

        var edu_rec_id = $(this).attr('edu_rec_id'); 
        $(this).addClass('active_record');

        var row = $(this);
        var edu_rec_token = $('input[name=\'_token\']').val();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/education-record/status/') }}"+'/'+edu_rec_id,
            data : { 'edu_rec_id' : edu_rec_id, '_token' : edu_rec_token },
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

                    $('span.popup_success_txt').text('Status changed successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                } else{
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                }
                $('.active_record').removeClass('active_record');
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
   
    //make a record editable
    $(document).on('click','.edit_edu_rec_btn',function(){

        var edu_rec_id    = $(this).attr('edu_rec_id');
        var edu_rec_token = $('input[name=\'_token\']').val();
       
        $('.edit_edu_rec_desc_'+edu_rec_id).removeAttr('disabled');
        $('.edit_edu_rec_id_'+edu_rec_id).removeAttr('disabled');
        $('.pop-notifbox').removeClass('active');
        return false;
    });
});
</script>

<script>
    $(document).ready(function(){
        
        //for saving editted records
        $(document).on('click','.sbmt-edit-edu-rec',function() {

            var edu_rec_token    = $('input[name=\'_token\']').val();
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

            var formdata = $('#edit_edu_rec_form').serialize();
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/education-record/edit') }}",
                data : formdata,
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    $('.edu-record-list').html(resp);
                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Education Record Updated Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });
    });
</script>