<!-- <script src="{{ url('public/frontEnd/js/jquery.js') }}"></script> -->

<!-- record model -->
<div class="modal fade" id="livingSkillModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - {{ $labels['living_skill']['label'] }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" id='daily_record_add_form'>  

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-2 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-6 col-xs-12 p-0 r-p-15">
                                <input type="text" class="form-control" name="skill_description">
                                <!-- <p class="field_error field-reqiured">This field is requried. </p> -->
                                <p class="help-block"> Enter the description and click plus to add. </p>
                            </div>

                            <!-- Separately hidden | (score field div) -->
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
                                    <button class="btn group-ico save-skill-btn" type="submit">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            <!-- </div> -->

                        </div>
                    </form>

            <form method="post" action="{{ url('edit-record-list') }}" id="edit_lvng_skill_form">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider"></div>
                        
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> 
                                <label class="pull-left checkbox"> <input class="select_all skill_sel_all_checkbox" type="checkbox" name="" /> Current Values </label> 
                                <span class="m-l-10"> <i class="fa fa-trash skill_del_btn"></i> </span>
                            </h3>
                            <div class="living-skills-list">
                                <!-- records will be shown here using ajax -->    
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <button class="btn btn-default" class="close" data-dismiss="modal" type="button"> Cancel </button>
                <input type="hidden" name="id" value="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning submit-edit-living-skill" type="submit"> Submit </button>
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
    $(document).on('click','.skill_del_btn',function(){
        var skill_id = [];
        $("input[type=checkbox]:checked").each(function() {

            skill_id.push($(this).val());
        });
        // console.log(skill_id);
        if(skill_id != ''){
            $('.loader').show();
            var skill_token = "{{ csrf_token() }}";
            $.ajax({
                type    : 'post',
                url     : "{{ url('/system/del/living-skill/') }}",
                dataType: "json",
                data    : {'skill_id':skill_id,'_token':skill_token},
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

                        $('span.popup_success_txt').text('Skill Deleted Successsfully');
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
        $('.living-skill').click(function(){
            // alert(1); return false;
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/living-skills/') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.living-skills-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');    
                        $('.skill_sel_all_checkbox,.skill_del_btn').hide();
                    } else {
                        $('.living-skills-list').html(resp);
                        $('.skill_sel_all_checkbox,.skill_del_btn').show();
                    }
                    //$('.living-skills-list').html(resp);
                    $('#livingSkillModal').modal('show');
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
    $(document).on('click','.save-skill-btn',function(){

        var skill_description = $('input[name=\'skill_description\']').val();
        skill_description = jQuery.trim(skill_description);

        var skill_token = $('input[name=\'_token\']').val();
        var error = 0;

        if((skill_description == '') || (skill_description == null) ){ 
            //$('.field-reqiured').text('Field is requried');
            $('input[name=\'skill_description\']').addClass('red_border');
            error = 1;
        } else{ 
            $('input[name=\'skill_description\']').removeClass('red_border');
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

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/living-skill/add') }}",
            data : { 'skill_description' : skill_description, '_token' : skill_token},
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
                    $('input[name=\'skill_description\']').val('');
                    // $('select[name=\'record_score\']').val('0');
                    
                    //show record list
                    $('.living-skills-list').html(resp);
                    
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //show success message
                    $('span.popup_success_txt').text('New Skill Added Successsfully');
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
   
    //delete a new skill
    $(document).on('click','.delete_skill_btn',function(){
        
        if(!confirm("Are sure you to delete this ?")){
            return false;
        }

        var living_skill_id = $(this).attr('living_skill_id');
        $(this).addClass('active_record');

        var skill_token = $('input[name=\'_token\']').val();
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/living-skill/delete/') }}"+'/'+living_skill_id,
            data : { 'living_skill_id' : living_skill_id, '_token' : skill_token },

            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == 1) {
                    $('.active_record').closest('.record_row').html('');

                    //show delete message
                    $('span.popup_success_txt').text('Skill Deleted Successsfully');
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
    //skill status change
    $(document).on('click','.skill_status_change',function(){
        // alert(1); return false;
        var living_skill_id = $(this).attr('living_skill_id'); 
        $(this).addClass('active_record');
        var row = $(this);

        var skill_token = $('input[name=\'_token\']').val();

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/living-skill/status/') }}"+'/'+living_skill_id,
            data : { 'living_skill_id' : living_skill_id, '_token' : skill_token },
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
                $('.pop-notifbox').removeClass('active');
            } 
        });
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
   
    //make editable a record
    $(document).on('click','.edit_skill_btn',function(){
        // alert(1); return false;
        var living_skill_id = $(this).attr('living_skill_id');
        var skill_token = $('input[name=\'_token\']').val();
        // edit_record_desc_ -> edit_skill_desc_
        $('.edit_skill_desc_'+living_skill_id).removeAttr('disabled');
        // $('.edit_record_score_'+living_skill_id).removeAttr('disabled');
        $('.edit_skill_id_'+living_skill_id).removeAttr('disabled');
        $('.pop-notifbox').removeClass('active');
        return false;
    });
});
</script>

<script>
    $(document).ready(function(){
        
        //for saving editable records
        $(document).on('click','.submit-edit-living-skill',function() {
            
            var skill_token    = $('input[name=\'_token\']').val();
            var err = 0;
            var enabled = 0;
            $('.edit_skill').each(function(index){

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

            var formdata = $('#edit_lvng_skill_form').serialize();
            // alert(formdata); return false;
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/living-skill/edit') }}",
                data : formdata,
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    $('.living-skills-list').html(resp);

                    //loader
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    $('span.popup_success_txt').text('Skill Updated Successsfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
            });
            return false;  
        });
    });
</script>