<?php 
     // $home_id = Auth::user()->home_id;
    // $service_users = App\ServiceUser::where('home_id',$home_id)->get()->toArray();
    $dynamic_forms = App\DynamicFormBuilder::getFormList();
    $service_user_id = (isset($service_user_id)) ? $service_user_id : 0;
?>

<!-- add active target details model start -->
<div class="modal fade" id="viewTargetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title view-target-title"> </h4>
            </div>
            <form method="post" id="add-active-target-details" action="{{ url('/service/placement-plan/edit') }}">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> User: </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <div class="select-style">
                                    <select name="service_user_id" readOnly="" class="su_n_id">
                                        <option value="{{ $service_user->id }}"> {{ $service_user->name }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7 text-right"> Add: </label>
                            <div class="col-md-11 col-sm-12 col-xs-12">
                                <div class="select-style">
                                    <select name="dynamic_form_builder_id" class="dynamic_form_select placement_plan_f_buld_id">
                                        <option value="0"> Select Form </option>
                                        <?php
                                        $this_location_id = App\DynamicFormLocation::getLocationIdByTag('placement_plan');
                                        foreach($dynamic_forms as $value) {
                                        
                                            $location_ids_arr = explode(',',$value['location_ids']);

                                            if(in_array($this_location_id,$location_ids_arr)) { 
                                            ?>
                                                <option value="{{ $value['id'] }}"> {{ ucfirst($value['title']) }} </option>
                                            <?php } 
                                        } ?>
                                    </select>
                                </div>
                                <p class="help-block"> Choose a user and the type of form you want to fill. </p>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="below-divider"></div>
                        </div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-2 col-sm-2 col-xs-12 p-t-7"> Task: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                            <input name="target_task" required value="" class="form-control bmp_risk" type="text" maxlength="255">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-2 col-sm-2 col-xs-12 p-t-7"> Detail: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div class="input-group popovr">
                                           <textarea name="target_description" required class="form-control" rows="2" cols="20" placeholder="Detail" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">      
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-2 col-sm-2 col-xs-12 p-t-7"> Date: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date="" class="input-group date"> <!-- dpYears -->
                                           <input name="target_date" required type="text" value="" readonly="" size="16" class="form-control date-pick" maxlength="10">
                                            <span class="input-group-btn add-on datetime-picker1" >
                                                <input style="left:-1px; top:0px;" type="text" value="" name="" id="target-new-date" class="form-control date-btn">
                                                <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="edit-dynamic-form-fields"> </div>

                        <div class="dynamic-form-fields"> </div>


                        <div class="modal-footer m-t-0 m-b-15 modal-bttm">
                            <input type="hidden" name="location_id" value="{{ $this_location_id }}">
                            <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <input type="hidden" name="placement_plan_id" value="">
                            <button class="btn btn-warning sbt-btn-dyn-plac" type="submit"> Confirm </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add active target details model end -->

<div class="modal fade" id="qqaReviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title qqa-review-title"> QQA-Review </h4>
            </div>
            <form method="post" action="{{ url('/service/placement-plan/add-qqa-review') }}" id="add-qqa-review">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Task: </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <div class="select-style">
                                    <input name="target_task" disabled="disabled" value="" class="form-control " type="text" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7">QQA: </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <textarea name="qqa_review" required rows="5" class="form-control" maxlength="1000"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    <input type="hidden" name="placement_plan_id" value="">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning save-qqa-review" type="submit"> Confirm </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    //alert(1);
    today  = new Date; 
    $('#target-new-date').datetimepicker({
        format: 'dd-mm-yyyy',
        startDate: today,
        minView : 2,
        setDate : new Date(2017,06,01)
    }).on("change.dp",function (e) { 
        var currdate =$(this).data("datetimepicker").getDate();
        var newFormat = currdate.getDate()+"-" +(currdate.getMonth() + 1)+"-"+currdate.getFullYear();
        $('.date-pick').val(newFormat);
    });

    $('#target-new-date').on('click', function(){
        $('#target-new-date').datetimepicker('show');
    });

    $( "#viewTargetModal" ).scroll(function() {
        $('#new-date-su').datetimepicker('place')
    });
    
    $('#target-new-date').on('change', function(){
        $('#target-new-date').datetimepicker('hide');
    });
});
</script>

<script>
    $(document).on('click','.view_qqa_review_btn',function(){

        var target_task = $(this).parent().attr('target_task');
        var qqa = $(this).attr('qqa');
        var placement_plan_id = $(this).parent().attr('target_id');

        $('input[name=\'target_task\']').val(target_task);
        $('textarea[name=\'qqa_review\']').val(qqa);
        $('input[name=\'placement_plan_id\']').val(placement_plan_id);
        // $('input[name=\'placement_plan_id\']') = $(this).parent().attr('target_id');
        $('#qqaReviewModal').modal('show');

    });
</script>
<!-- <script>
    $(document).ready(function(){
        $('.save-qqa-review').click(function(){
        
            var qqa_review = $('textarea[name=\'qqa_review\']').val();
            var err = 0;

            if(qqa_review == '') { 
                $('textarea[name=\'qqa_review\']').addClass('red_border');
                err = 1;
            } else{
                $('textarea[name=\'qqa_review\']').removeClass('red_border');
            }

            if(err == 1){
                return false;
            } else{ 
                return true;
            }
        });
    });
</script> -->

<script>
    
        $(document).on('click', '.view_active_target_btn', function(){
          
            if ($(this).hasClass('active-targets')){
                $('.view-target-title').text('Active Targets');
            }
            else{
                $('.view-target-title').text('Make Target Active');   
            }

            var target_id = $(this).parent().attr('target_id');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/service/placement-plan/target/view') }}"+'/'+target_id,
                dataType : 'json',
                success:function(resp){

                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    var response = resp['response'];
                    
                    if(response == true)    {
                    
                        var task            = resp['task'];
                        var description     = resp['description'];
                        var date            = resp['date'];
                        //var pp_form         = resp['pp_form'];
                        var dyn_forms        = resp['dyn_form'];
                        var form_builder_id  = resp['form_builder_id'];

                        if(form_builder_id > 0) {
                            $('.placement_plan_f_buld_id').val(form_builder_id).attr('disabled','true');
                        } else {
                            $('.placement_plan_f_buld_id').val(form_builder_id).removeAttr('disabled','true');
                        }

                        // alert(dyn_forms);
                        $('input[name=\'target_task\']').val(task);
                        $('textarea[name=\'target_description\']').val(description);

                        $('input[name=\'target_date\']').val(date);
                        $('input[name=\'target_date\']').parent().attr('data-date',date);

                        $('input[name=\'placement_plan_id\']').val(target_id);
                        $('.edit-dynamic-form-fields').html(dyn_forms);
                        $('#viewTargetModal').modal('show');
                        
                        $('.dpYears').datepicker({
                            //format: 'dd/mm/yyyy',
                        }).on('changeDate', function(e){
                            $(this).datepicker('hide');
                        });  

                    } else{
                        var error = resp['error'];
                        if(error == 'AUTH'){
                            alert('{{ UNAUTHORIZE_ERR }}');
                        } else{
                            alert('{{ COMMON_ERROR }}');
                        }
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
   
</script>

<script>
    
    $(document).ready(function(){
        $(document).on('click','.sbt-btn-dyn-plac', function(){
            var model_id        = $(this).closest('.modal').attr('id');
            // alert(model_id);
            var f_buld_id = $('.placement_plan_f_buld_id').val();
            var st_title = $('#'+model_id+' .static_title');
            var st_title = st_title.val();

            // alert(st_title);
            // return false;
            var error = 0; 

            if(f_buld_id == 0) {
                $('.placement_plan_f_buld_id').addClass('red_border');
                error = 1;
                // return false;
            }
            if(st_title == undefined){
                return false;
            } 
            var st_title = st_title.trim();
            if(st_title == '') {
                $('#'+model_id+' .static_title').addClass('red_border');
                error = 1;
            }

            if(error == 1){
                return false;
            }

            // return false;

        });
    });

</script>