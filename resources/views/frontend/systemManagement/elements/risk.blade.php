<!-- <script src="http://localhost/scits/public/frontEnd/js/jquery.js"></script> -->

<!-- Risk Modal -->
<div class="modal fade" id="riskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - Risks </h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form method="post" action="{{ url('system/risk/add') }}">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-8 col-xs-12">
                                <input type="text" class="form-control" name="risk_description">
                                <p class="help-block">Enter the risk title, choose a icon and click plus to add. </p>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 p-0 r-p-15">
                                <span class="group-ico icon-box-risk"><i class="fa fa-info"></i> </span>
                                <input type="hidden" name="risk_icon" value="" class="risk_icon">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-risk group-ico save-risk-btn" type="submit" name="icon_list">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                            
                           
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider">
                        </div>
                    </div>

                    <form method="post" action="{{ url('edit-risk-list') }}" id="edit-risk-form">         
                        <!-- alert mesage-->
                        @include('frontEnd.common.popup_alert_messages')
                        <!--  end of alert -->
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20 cur_risk_head">
                                <label class="pull-left checkbox"> <input class="select_all sel_all_checkbox" type="checkbox" name="" /> Current Risks </label> 
                                <span class="m-l-10"> <i class="fa fa-trash del_btn"></i> </span>
                            </h3>
                        </div>

                        <!-- risk records list  -->
                        <div class="risk-record-list">
                        <!-- risk records will be shown here using ajax  -->
                        </div>
                </div>
            </div>
            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-warning submit_edit_risk" type="button"> Submit </button>
            </div>
            </form>  

        </div>
    </div>
</div>

<script>
    
    $(document).on('click','.select_all',function(){

        if($(this).is(':checked')){
            $('.risk-row input[type="checkbox"]').prop('checked', true);
        }else{
            $('.risk-row input[type="checkbox"]').prop('checked', false);
        }

    })

</script>
<script type="text/javascript">
    $(document).on('click','.del_btn',function(){
        var risk_id = [];
        $("input[type=checkbox]:checked").each(function() {

            risk_id.push($(this).val());
        });
        // console.log(risk_id);
        if(risk_id != ''){
            $('.loader').show();
            var risk_token = "{{ csrf_token() }}";
            $.ajax({
                type    : 'post',
                url     : "{{ url('/system/del-risk') }}",
                dataType: "json",
                data    : {'risk_id':risk_id,'_token':risk_token},
                cache   : false,

                success:function(resp){
                    // console.log(resp);
                    if(isAuthenticated(resp) == false){
                        return false;
                    }                    
                    if(resp == 1){
                        // $('.active_risk').closest('.risk-row').html('');
                        $("input[type=checkbox]:checked").each(function() {

                            $(this).closest('.risk-row').html('');
                        });
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                        $('span.popup_success_txt').text('Risk Deleted Successfully');
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
    /*------Font awesome icons script ---------*/ 
    $(document).ready(function(){ 
        $('.fontwesome-panel').hide();
        $('.icon-box-risk').on('click',function(){ 
            $('body').addClass('modal-open');
            $('.fontwesome-panel').show();
            $('.fontwesome-panel').find('.font-list').attr('id','risk-fonts');
        });

        $('.fontawesome-cross').on('click',function(){
           $('body').removeClass('modal-open');
           $('.fontwesome-panel').hide(); 
           
        });

        $(document).on('click','#risk-fonts .fa-hover a', function () {             
            var trim_txt = $(this).find('i');
            var new_class = trim_txt.attr('class');
            $('.icon-box-risk i').attr('class',new_class);
            $('body').toggleClass('modal-open');
            $('.fontwesome-panel').hide(); 
            $('.risk_icon').val(new_class);
        });
    });
</script>

<script>      
    $(document).ready(function(){
        //get a new risk 
        $(".risk-record").click(function(){
            $('.loader').show();
            $('body').addClass('body-overflow'); 
            $.ajax({
                type: 'get',
                url : "{{ url('/system/risk/index') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.risk-record-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                        $('.sel_all_checkbox,.del_btn').hide();
                    } else {
                        $('.risk-record-list').html(resp);
                        $('.sel_all_checkbox,.del_btn').show();
                    }
                    $('#riskModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });

        });

    });
</script>

<script>
    //save a new risk
    $(document).ready(function(){
        $(document).on('click','.save-risk-btn',function(){


            var risk_description = $('input[name=\'risk_description\']').val();
                risk_description = jQuery.trim(risk_description);

            var icon_list = $('input[name=\'risk_icon\']').val();
           
            var error = 0;
            var risk_token = $('input[name=\'_token\']').val();

            if((risk_description == '' || risk_description == null)){
                 $('input[name=\'risk_description\']').addClass('red_border');
                 error =1;
            }
            else{
                 $('input[name=\'risk_description\']').removeClass('red_border');   
            }
            if(icon_list == ''){
                  $('input[name=\'risk_icon\']').siblings('span').addClass('red_border');
                  error =1;
            }
            else{
                  $('input[name=\'risk_icon\']').siblings('span').removeClass('red_border'); 

            }

            if(error == 1){
            return false;
            }
            $('.loader').show();
            $('body').addClass('body-overflow'); 

            $.ajax({
                type : 'post',
                url  : "{{ url('/system/risk/add') }}",
                data : {'risk_description' : risk_description, '_token' : risk_token, 'icon_list' : icon_list},
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == '0'){
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                    }
                    
                    //empty input field
                    $('input[name=\'risk_description\']').val('');
                    $('input[name=\'risk_icon\']').val('');
                    $('.icon-box-risk i').attr('class','fa fa-info');

                    //show risk list
                    $('.risk-record-list').html(resp);
                    $('#riskModal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //show success message
                    $('span.popup_success_txt').text('Risk Added Successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                }
            });
            return false;
        });
    });
</script>


<script>
      //delete the risk row
    $(document).ready(function(){
  
        $(document).on('click','.delete_risk_btn',function(){

            if(!confirm("Are sure you to delete this ?")){
                return false;
            } /*else{
                return false;
            }*/

            var risk_id = $(this).attr('risk_id');
            $(this).addClass('active_risk');
            
            var risk_token = $('input[name=\'_token\']').val();
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type   : 'post',
                url    : "{{ url('/system/risk/delete/') }}"+'/'+risk_id,
                data   : {'risk_id' : risk_id, '_token' : risk_token},

                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }                    
                    if(resp == 1){
                        $('.active_risk').closest('.risk-row').html('');

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                        $('span.popup_success_txt').text('Risk Deleted Successfully');
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
    $(document).ready(function(){
        //update status
        $(document).on('click','.risk_status_change_btn',function(){
          
            var risk_id = $(this).attr('risk_id');
            $(this).addClass('active_risk');


            var risk_token = $('input[name=\'_token\']').val();

            $('.loader').show();
            $('body').addClass('body-overflow');

            var risk_status_change_btn = $(this);

            $.ajax({

                type : 'post',
                url  : "{{ url('/system/risk/status/') }}"+'/'+risk_id,
                data : {'risk_id' : risk_id, '_token' : risk_token},
                success:function(resp){ 
                    if(isAuthenticated(resp) == false){
                        return false;
                    } 

                    if(resp == '1'){         

                          if($('.active_risk').closest('span.settings').siblings('.risk-color').hasClass('clr-blue')){
                            $('.active_risk').closest('span.settings').siblings('.risk-color').removeClass('clr-blue');
                            $('.active_risk').closest('span.settings').siblings('.risk-color').addClass('clr-grey');
                          }
                          else{
                            $('.active_risk').closest('span.settings').siblings('.risk-color').removeClass('clr-grey');
                            $('.active_risk').closest('span.settings').siblings('.risk-color').addClass('clr-blue');
                          }
                        $('span.popup_success_txt').text('Status Changed');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    }else{ 
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                    }

                    $('.active_risk').removeClass('active_risk');
                    $('.risk_status_change_btn').closest('.pop-notifbox').removeClass('active');
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
        //make editable row
        $(document).on('click','.edit_risk_btn',function(){
            var risk_id = $(this).attr('risk_id');
            $('.edit_risk_desc_'+risk_id).removeAttr('disabled');
            $('.edit_risk_id_'+risk_id).removeAttr('disabled');
            $('.edit_risk_icon_'+risk_id).removeAttr('disabled');
            $(this).closest('.pop-notifbox').removeClass('active');
            return false;
        });
    });
</script>

<script>
    
        $(document).on('click','.submit_edit_risk', function(){
            //saving editable risk 
            var err = 0;
            $('.edit_risk').each(function(index){

                var disabled_att = $(this).attr('disabled');

                if(disabled_att == undefined){

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
                    if(err == 1){ 
                        return false;
                    }

                    //loader
                    $('.loader').show();
                    $('body').addClass('body-overflow');


                var formdata = $('#edit-risk-form').serialize();

                $.ajax({
                    type : 'post',
                    url  : "{{ url('/system/risk/edit') }}",
                    data : formdata,
                    success : function(resp){
                        if(isAuthenticated(resp) == false){
                            return false;
                        }
                        
                        $('.risk-record-list').html(resp);

                        //loader
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                        $('span.popup_success_txt').text('Risk Updated Successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    }
                });
                return false;
                }
            });
        });
    
</script>


<!-- <script>
$(document).ready(function(){
    $('.settings').on('click',function(){
        $(this).find('.pop-notifbox').toggleClass('active');
        $(this).closest('.cog-panel').siblings('.cog-panel').find('.pop-notifbox').removeClass('active');
    });
    $(window).on('click',function(e){
        e.stopPropagation();
        var $trigger = $(".settings");
        if($trigger !== e.target && !$trigger.has(e.target).length){
            $('.pop-notifbox').removeClass('active');
        }
    });
});
</script> -->

<script>
    /*------Font awesome edit icons script ---------*/ 
    $(document).ready(function(){ 
        $('.fontwesome-panel').hide();
        $(document).on('click','.icon-box-edit-risk',function(){ 

            var risk_id = $(this).attr('risk_id');
            var icon_disabled = $('.edit_risk_icon_'+risk_id).attr('disabled');

            if(icon_disabled == undefined){
                $('body').addClass('modal-open');
                $('.fontwesome-panel').show();
                $('.fontwesome-panel').find('.font-list').attr('id','edit-risk-fonts'); 
                
                //adding class for saving icon
                $('.edit_risk_icon_'+risk_id).addClass('edit_active_risk_icon');
                //adding class for showing icon
                $(this).addClass('edit_active_risk_icon_box');
            }
            else{
                return false;
            }
            
            return false;
        });

        $('.fontawesome-cross').on('click',function(){
           $('body').removeClass('modal-open');
           $('.fontwesome-panel').hide(); 
           $('.edit_active_risk_icon').removeClass('edit_active_risk_icon');
           $('.edit_active_risk_icon_box').removeClass('edit_active_risk_icon_box');    
        });

        $(document).on('click','#edit-risk-fonts .fa-hover a', function () {             
            var trim_txt = $(this).find('i');
            var new_class = trim_txt.attr('class');
            $('.edit_active_risk_icon_box i').attr('class',new_class);
            $('body').toggleClass('modal-open');
            $('.fontwesome-panel').hide(); 
            $('.edit_active_risk_icon').val(new_class);
            $('.edit_active_risk_icon').removeClass('edit_active_risk_icon');
            $('.edit_active_risk_icon_box').removeClass('edit_active_risk_icon_box');
        });
    });
</script>
