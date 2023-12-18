<!-- appointment plan modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="appointmentplanmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">System management-Appointment/Plan Builder</h4>
            </div>
            <div class="modal-body p-b-0">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default risk-add-btn active" type="button"> Add New </button>
                        <button class="btn label-default risk-logged-btn active logged-plans" type="button"> Logged Plans </button>
                        <button class="btn label-default risk-search-btn active" type="button"> Search </button>
                    </div>

                    <div class="risk-add-box risk-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-9 col-xs-8 p-l-0 resp-padd-left">
                                <input type="text" name="plan_title_add" class="form-control">
                                Enter a title,choose an icon and click plus to description
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                                <!-- <button class="btn group-ico" type="submit"> <i class="fa fa-info"></i> </button> -->
                                <span class="group-ico icon-box-risk"><i class="fa fa-info"></i> </span>
                                <input type="hidden" name="plan_icon_add" class="form-control plan_icon">

                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                                <button class="btn group-ico add_plan_desc" type="submit"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel description_plan">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-md-11 col-sm-11 col-xs-12 r-p-0 m-l-20">
                                    <div class="input-group popovr">
                                        <textarea type="text" rows="3" class="form-control" placeholder="Enter plan details" name="plan_detail_add"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 p-l-0 resp-padd-left">
                                <input type="text" name="field_name" class="form-control">
                                Enter the field name and choose its type
                            </div>
                        
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Type: </label>
                            <div class="col-md-3 col-sm-3 col-xs-10">
                                <div class="select-style">
                                    <select name="field_type">
                                    <option value=""> Select </option>
                                    <option value="Textbox"> Textbox </option>
                                    <option value="Selectbox"> Selectbox </option>
                                    <option value="Textarea"> Textarea </option>
                                    <option value="Date"> Date </option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <button class="btn group-ico add-field-btn" type="submit"> <i class="fa fa-plus"></i> </button>
                            </div>
                            <form id="custom-created-fields-form">
                                <!-- select option should be shown here -->
                                <div class="cus-select-options">
                                    <div class="form-group col-md-offset-1 col-md-10 col-sm-10 col-xs-12 p-0  m-t-10 m-l-50 add-select-options-div " style="display: none;">
                                       
                                        <p>Select options</p>
                                        <!-- <div class="option-div">
                                            <div class="col-md-4 col-sm-4 col-xs-12 p-l-0">
                                                <input name="cus_option1" placeholder="option" class="form-control" type="text" value="">
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 p-l-0">
                                                <input name="cus_value1" placeholder="value" class="form-control" type="text" value="">
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                                <button class="btn group-ico remove-option1-btn" type="button"> <i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-1 col-sm-1 col-xs-1 p-0 plus-btn">
                                            <button class="btn group-ico add-more-option-btn" type="button"> <i class="fa fa-plus"></i> </button>
                                        </div> -->
                                    </div>
                                    <div class="add-more-select-options-div">
                                        <!-- more select options using jquery will be placed here -->
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 p-0 appoint-plus-btn">
                                        <button class="btn group-ico add-more-option-btn" type="button"> <i class="fa fa-plus"></i></button>
                                    </div>
                                    <!-- add-select-options-div closed -->
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-20">
                                    <div class="below-divider"></div>
                                </div>
                                <!-- alert messages -->
                                @include('frontEnd.common.popup_alert_messages')
                                
                                <div class="static-form-fields">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field ">
                                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="Textbox"> Title: </label> 
                                        <div class="col-md-8 col-sm-8 col-xs-12 p-l-0 resp-padd-left"> 
                                            <input readonly="" name="title" class="form-control trans" type="text"> 
                                        </div>
                                    </div>
                                    <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field ">
                                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="Date"> date </label>  
                                        <div class="col-md-8 col-sm-8 col-xs-12 p-l-0">
                                            <div data-date-format="dd-mm-yyyy" class="input-group date dpYears">  
                                                <input name="date" readonly="" value="" size="16" class="form-control trans" style="background:transparent; " type="text">
                                                <span class="input-group-btn "> <button class="btn btn-primary calndr-btn" type="button"><i class="fa fa-calendar"></i></button> </span>  
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <p>Above are default fields of your form, New custom fields will be shown below. </p>
                                    </div>
                                </div>


                                <div class="modal-space created-fields ui-sortable" id="sortable">
                                    <!-- created form fields from jquery will be placed here -->
                                </div>

                                <div class="modal-footer m-t-0 recent-task-sec p-b-0">
                                    <input type="hidden" name="plan_title" value="" />
                                    <input type="hidden" name="plan_icon" value="" />
                                    <textarea name="plan_detail" style="display:none" value=""> </textarea>
                                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                    <button class="btn btn-warning save-appointmnt-form" type="button"> Confirm </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- logged plans -->
                    <div class="risk-logged-box risk-tabs">
                        @include('frontEnd.common.popup_alert_messages')
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> 
                                <label class="pull-left checkbox"> <input class="select_all plan_sel_all_checkbox" type="checkbox" name="" /> Logged Plans </label> 
                                <span class="m-l-10"> <i class="fa fa-trash plan_del_btn"></i> </span>
                            </h3>
                        </div>
                        <div class="logged-plan-shown">
                            <!-- logged plan list be shoen here using ajax -->
                        </div>
                        <!-- <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning" type="button"> Confirm </button>
                        </div> -->
                    </div>

                    <div class="risk-search-box risk-tabs">
                        <form method="post" id="plan_search_form">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue"> Search </h3>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                                <div class="col-md-11 col-sm-11 col-xs-12 p-l-0 m-b-15">
                                    <input type="text" name="search" class="form-control">
                                </div>
                                <div class="searched-plan text-center p-t-10">
                                <!--searched BMP/RMP List using ajax -->
                                </div>
                            </div>
                            <div class="modal-space"></div>
                            <div class="modal-footer m-t-0 recent-task-sec">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning search_plan_builder" type="button"> Confirm</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="popup_notification-box">
                            <div class="alert alert-success alert-dismissible m-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Success!</strong> New Row is added.
                            </div>
                        </div>
                    </div>
                     -->
                </div>                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end appointment modal -->

<!-- view appointment modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewappointmentmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#appointmentplanmodal" class="close bck_btn" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                <h4 class="modal-title">System management-Appointment/Plan Builder</h4>
            </div>
            <div class="modal-body p-b-0">
                <div class="row">
                    <div class="risk-add-box risk-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-l-0">
                                <input type="text" name="e_plan_title_add" class="form-control">
                                <!-- <input type="hidden" name="e_plan_id" value=""> -->
                                Enter a title,choose an icon and click plus to add description
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <span class="group-ico icon-box-risk sel_icon"><i class=""></i> </span>
                                <input type="hidden" name="e_plan_icon_add" class="form-control edit_plan_icon plan_icon" value="">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <button class="btn group-ico e_description_plan" type="submit"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel edit_description_plan">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-md-11 col-sm-11 col-xs-12 r-p-0 m-l-20">
                                    <div class="input-group popovr">
                                        <textarea type="text" rows="3" class="form-control" placeholder="" name="e_plan_detail_add" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Add: </label>
                            <div class="col-md-6 col-sm-6 col-xs-10 p-l-0">
                                <input type="text" name="e_field_name" class="form-control">
                                Enter the field name and choose its type
                            </div>
                        
                            <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Type: </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="select-style">
                                    <select name="e_field_type">
                                    <option value=""> Select </option>
                                    <option value="Textbox"> Textbox </option>
                                    <option value="Selectbox"> Selectbox </option>
                                    <option value="Textarea"> Textarea </option>
                                    <option value="Date"> Date </option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                <button class="btn group-ico e-add-field-btn" type="submit"> <i class="fa fa-plus"></i> </button>
                            </div>
                            <form id="e-custom-created-fields-form">
                            <!-- select option should be shown here -->
                                <div class="cus-select-options">
                                    <div class="form-group col-md-offset-1 col-md-10 col-sm-10 col-xs-12 p-0  m-t-10 m-l-50 e-add-select-options-div " style="display: none;">
                                       
                                        <p>Select options</p>
                                        <!-- <div class="option-div">
                                            <div class="col-md-4 col-sm-4 col-xs-12 p-l-0">
                                                <input name="e_cus_option1" placeholder="option" class="form-control" type="text" value="">
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 p-l-0">
                                                <input name="e_cus_value1" placeholder="value" class="form-control" type="text" value="">
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1 p-0">
                                                <button class="btn group-ico remove-option1-btn" type="button"> <i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-1 col-sm-1 col-xs-1 p-0 plus-btn">
                                            <button class="btn group-ico e-add-more-option-btn" type="button"> <i class="fa fa-plus"></i> </button>
                                        </div> -->
                                    </div>
                                    <div class="e-add-more-select-options-div">
                                        <!-- more select options using jquery will be placed here -->
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 p-0 appoint-plus-btn">
                                        <button class="btn group-ico e-add-more-option-btn" type="button"> <i class="fa fa-plus"></i></button>
                                    </div>
                                    <!-- add-select-options-div closed -->
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-20">
                                    <div class="below-divider"></div>
                                </div>
                                <!-- alert messages -->
                                @include('frontEnd.common.popup_alert_messages')
                                
                                <div class="static-form-fields">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field ">
                                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="Textbox"> Title: </label> 
                                        <div class="col-md-8 col-sm-8 col-xs-12 p-l-0"> 
                                            <input readonly="" name="title" class="form-control trans" type="text"> 
                                        </div>
                                    </div>
                                    <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field ">
                                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="Date"> date </label>  
                                        <div class="col-md-8 col-sm-8 col-xs-12 p-l-0">
                                            <div data-date-format="dd-mm-yyyy" class="input-group date dpYears">  
                                                <input name="date" readonly="" value="" size="16" class="form-control trans" style="background:transparent; " type="text">
                                                <span class="input-group-btn "> <button class="btn btn-primary calndr-btn" type="button"><i class="fa fa-calendar"></i></button> </span>  
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <p>Above are default fields of your form, New custom fields will be shown below. </p>
                                    </div>
                                </div>
                            
                                <div class="modal-space e-created-fields ui-sortable" id="e-sortable">
                                </div>

                                <div class="modal-footer m-t-0 recent-task-sec p-b-0">
                                    <input type="hidden" name="plan_title" value="" />
                                    <input type="hidden" name="plan_icon" value="" />
                                    <input type="hidden" name="plan_id" value="" />
                                    <textarea style="display:none" name="plan_detail" value=""></textarea>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                    <button class="btn btn-warning e-save-appointmnt-form " type="button"> Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                        
                </div>                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    
    $(document).on('click','.select_all',function(){

        if($(this).is(':checked')){
            $('.plan-row input[type="checkbox"]').prop('checked', true);
        }else{
            $('.plan-row input[type="checkbox"]').prop('checked', false);
        }

    })

</script>
<script type="text/javascript">
    $(document).on('click','.plan_del_btn',function(){
        var plan_id = [];
        $("input[type=checkbox]:checked").each(function() {

            plan_id.push($(this).val());
        });
        // console.log(plan_id);
        if(plan_id != ''){
            $('.loader').show();
            var plan_token = "{{ csrf_token() }}";
            $.ajax({
                type    : 'post',
                url     : "{{ url('/system/del/plans') }}",
                dataType: "json",
                data    : {'plan_id':plan_id,'_token':plan_token},
                cache   : false,

                success:function(resp){
                    // console.log(resp);
                    if(isAuthenticated(resp) == false){
                        return false;
                    }                    
                    if(resp == 1){
                        // $('.active_risk').closest('.risk-row').html('');
                        $("input[type=checkbox]:checked").each(function() {

                            $(this).closest('.plan-row').html('');
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
<!-- end view appointment modal -->
<script>

    $(".appointments").click(function(){
        $('#appointmentplanmodal').modal('show');

        /*$('.loader').show();
        $('body').addClass('body-overflow');
        $.ajax({
            type : 'get',
            url  : "{{ url('/system/plans') }}",
            success:function(resp){
                $('.appointments-list').html(resp);
                reset_appointment_modal();
                $('#appointmentplanmodal').modal('show');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });*/
    });
    
$(document).ready(function(){
    //form builder scripts

    $('.add-more-option-btn').hide();

    var option_count = 1;
    var field_count  = 1;

    $('.add-field-btn').on('click',function(){
        
        var field = add_field_in_form(option_count,field_count,'ADD');
        if(field == false){
            return false;
        } 

        // showing new created fields
        $('.created-fields').append(field);
        field_count++;

        // select box options set to default
        $('.add-more-option-btn').hide();
        option_count = 1; 

        reset_appointment_modal();
    });

   $(document).on('click','.field-remove-btn', function(){
        $(this).closest('.cus-field').remove();
   });

    /*select box jquery*/
    $("select[name=\'field_type\'").change(function(){
    
        var value = $(this).val();
        if(value == 'Selectbox'){ 
            $('.add-select-options-div').show();
            $('.add-more-option-btn').show();
            $('.add-more-select-options-div').show();
            $('.add-more-select-options-div').html('');

            option_count = 1;
            $('.add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-8 col-sm-8 col-xs-12 p-l-0"> <input name="cus_option'+option_count+'" placeholder="option" class="form-control " type="text" value=""> </div>  <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');

            /* both option and value
            $('.add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="cus_option'+option_count+'" placeholder="option" class="form-control " type="text" value=""> </div> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="cus_value'+option_count+'" placeholder="value" class=" form-control" type="text" value=""> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');*/

        } else{
            $('.add-select-options-div').hide();
            $('.add-more-option-btn').hide();   
            $('.add-more-select-options-div').hide();
        }
    });

   $(document).on('click','.add-more-option-btn', function(){

        option_count++;
        $('.add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-8 col-sm-8 col-xs-12 p-l-0"> <input name="cus_option'+option_count+'" placeholder="option" class="form-control " type="text" value=""> </div>  <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');

        /* both option text and value  
        $('.add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="cus_option'+option_count+'" placeholder="option" class="form-control " type="text" value=""> </div> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="cus_value'+option_count+'" placeholder="value" class=" form-control" type="text" value=""> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');*/
   });

    $(document).on('click','.remove-option-btn', function(){
        $(this).closest('.option-div').remove();
    });

    $(document).on('click','.remove-option1-btn', function(){
        //$(this).closest('.option-div').find('input').val('');
        $(this).closest('.option-div').remove();
        
        //$(this).closest('.add-select-options-div').removeClass('m-t-10');
        //$(this).closest('.option-div').toggle();
    });
    /*select box jquery end*/

    $(document).on('click','.save-appointmnt-form', function() { 
        $('input[name=\'plan_title\']').val($('input[name=\'plan_title_add\']').val());
        $('input[name=\'plan_icon\']').val($('input[name=\'plan_icon_add\']').val());
        $('textarea[name=\'plan_detail\']').val($('textarea[name=\'plan_detail_add\']').val());
        
        var error = 0;
        if( $('input[name=\'plan_title_add\']').val() == '' ) {
            $('input[name=\'plan_title_add\']').addClass('red_border');
            //$('input[name=\'plan_icon_add\']').siblings('span').addClass('red_border');
                error = 1;
        } else {
           $('input[name=\'plan_title_add\']').removeClass('red_border');
           //$('input[name=\'plan_icon_add\']').siblings('span').removeClass('red_border');
        } 
        if( $('input[name=\'plan_icon_add\']').val() == '') {
            $('input[name=\'plan_icon_add\']').siblings('span').addClass('red_border');
                error = 1;
        } else {
            $('input[name=\'plan_icon_add\']').siblings('span').removeClass('red_border');
        }

        if(error == 1){
            return false;   
        }                                           

        var formData = $('#custom-created-fields-form').serialize();

        //alert(formData);
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url : "{{ url('/system/plans/add') }}",
            type : "post",
            data : formData,
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == 'true'){

                    field_count == 1;
                    // remove new created fields from div
                    $('.created-fields').html('');
                    
                    // select box options set to default
                    $('.add-more-option-btn').hide();
                    option_count = 1; 

                    reset_appointment_modal();
                    $('input[name=\'plan_title_add\']').val('');
                    $('textarea[name=\'plan_detail_add\']').val('');
                    $('input[name=\'plan_icon_add\']').val('');
                    $('.icon-box-risk i').attr('class','fa fa-info');
                    $('textarea[name=\'plan_detail_add\']').closest('.description_plan').hide();

                    //show success message
                    $('span.popup_success_txt').text('Plan Added successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                } else if(resp == 'false'){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);

                } else{
                    $('span.popup_error_txt').text(' No input field added in the form');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        
        return false;
    });

    $(".logged-plans").click(function(){
        
        $('.loader').show();
        $('body').addClass('body-overflow');
       
        $.ajax({
            type : 'get',
            url  : "{{ url('/system/plans') }}",
            // dataType : 'json',
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == '') {
                    $('.logged-plan-shown').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    $('.plan_sel_all_checkbox,.plan_del_btn').hide();
                } else {
                    $('.logged-plan-shown').html(resp);
                    $('.plan_sel_all_checkbox,.plan_del_btn').show();
                }
                reset_appointment_modal();
                $('#appointmentplanmodal').modal('show');

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        
    });

    function add_field_in_form(option_count,field_count,operation){

        if(operation == 'ADD'){ 
            var field_namei = 'field_name';
            var field_typei = 'field_type';            
        } else{ 
            var field_namei = 'e_field_name';
            var field_typei = 'e_field_type';
        }

        //if(operation == 'ADD'){ 
            var field_name = $("input[name=\'"+field_namei+"\']").val().trim();
            var field_type = $("select[name=\'"+field_typei+"\']").val().trim();            
        /*} else{ 
            var field_name = $("input[name=\'e_field_name\']").val().trim();
            var field_type = $("select[name=\'e_field_type\']").val().trim();
        }*/
        
        var column_name = field_name.replace(' ','_');
        column_name = column_name.toLowerCase();
        
        var error_add_field = 0;
        if(field_name == ''){
            $("input[name=\'"+field_namei+"\']").addClass('red_border');
            error_add_field = 1;
        } else{
            $("input[name=\'"+field_namei+"\']").removeClass('red_border');                
        }

        if(field_type == ''){
            $("select[name=\'"+field_typei+"\']").parent().addClass('red_border');
            error_add_field = 1;
        } else{
            $("select[name=\'"+field_typei+"\']").parent().removeClass('red_border');                
        }

        if(error_add_field == 1){
            return false;
        }
       
        if(field_type == 'Textbox'){

            var new_field = '<div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field"> <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="'+field_type+'"> '+field_name+': </label> <div class="col-md-8 col-sm-8 col-xs-12 p-l-0"> <input type="text" readonly name="'+column_name+'" class="form-control trans">  <input type="hidden" name="formdata['+field_count+'][label]" value="'+field_name+'"> <input type="hidden" name="formdata['+field_count+'][column_name]" value="'+column_name+'"> <input type="hidden" name="formdata['+field_count+'][column_type]" value="'+field_type+'"> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico field-remove-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> <div class="col-md-1 col-sm-1 col-xs-1 m-t-5 p-l-10"><span class="sort-sp"><i class="fa fa-sort"></i></span></div> </div>';
            
        } else if(field_type == 'Selectbox'){
            var options = '';
            var option_name = '';
            var option_value = '';
            var opt = '';
            var j = 0;
            ///alert(option_count);
            for(var i=1; i <= option_count; i++){

                if(operation == 'ADD'){ 
                    option_name = $("input[name=\'cus_option"+i+"\']").val();
                    //option_value= $("input[name=\'cus_value"+i+"\']").val();
                } else{
                    option_name = $("input[name=\'e_cus_option"+i+"\']").val();
                    //option_value= $("input[name=\'e_cus_value"+i+"\']").val();                    
                }

                if(option_name !== undefined){
                    option_name = option_name.trim();
                    //option_value = option_value.trim();
                    
                    //if( (option_name !== '') && (option_value !== '') ) {            
                        options += '<option value="'+option_name+'">'+option_name+'</option>';

                        opt += '<input type="hidden" name="formdata['+field_count+'][select_options]['+j+'][option_name]" value="'+option_name+'">';
                        j++;
                    //}
                }

                /*if(option_value !== undefined){
                    option_name = option_name.trim();
                    option_value = option_value.trim();
                    
                    if( (option_name !== '') && (option_value !== '') ) {            
                        options += '<option value="'+option_value+'">'+option_name+'</option>';

                        opt += '<input type="hidden" name="formdata['+field_count+'][select_options]['+j+'][option_name]" value="'+option_name+'"> <input type="hidden" name="formdata['+field_count+'][select_options]['+j+'][option_value]" value="'+option_value+'">';
                        j++;
                    }
                }*/
            }
            /*if(opt == ''){
                alert('Please')
            }*/
          
            var new_field = '<div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field "> <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="'+field_type+'"> '+field_name+' </label> <div class="col-md-8 col-sm-8 col-xs-12 p-l-0"> <div class="select-style"> <select name="'+column_name+'" readonly class="trans"> '+options+' </select>  <input type="hidden" name="formdata['+field_count+'][label]" value="'+field_name+'"> <input type="hidden" name="formdata['+field_count+'][column_name]" value="'+column_name+'"> <input type="hidden" name="formdata['+field_count+'][column_type]" value="'+field_type+'"> '+opt+' </div> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico field-remove-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> <div class="col-md-1 col-sm-1 col-xs-1 m-t-5 p-l-10"><span class="sort-sp"><i class="fa fa-sort"></i></span></div> </div>';    

        } else if(field_type == 'Textarea'){
            var new_field = '<div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field "> <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="'+field_type+'"> '+field_name+' </label> <div class="col-md-8 col-sm-8 col-xs-12 p-l-0">  <textarea name="'+column_name+'" class="form-control trans" readonly></textarea> </div> <input type="hidden" name="formdata['+field_count+'][label]" value="'+field_name+'"> <input type="hidden" name="formdata['+field_count+'][column_name]" value="'+column_name+'">  <input type="hidden" name="formdata['+field_count+'][column_type]" value="'+field_type+'">  <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico field-remove-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> <div class="col-md-1 col-sm-1 col-xs-1 m-t-5 p-l-10"><span class="sort-sp"><i class="fa fa-sort"></i></span></div> </div>'; 

        } else if(field_type == 'Date'){
            var new_field = '<div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 cus-field "> <label class="col-md-2 col-sm-2 col-xs-12 p-t-7" type="'+field_type+'"> '+field_name+' </label>  <div class="col-md-8 col-sm-8 col-xs-12 p-l-0">  <div data-date-format="dd-mm-yyyy" data-date="12-02-2012" class="input-group date dpYears">  <input name="date" readonly="" value="" size="16" class="form-control trans" type="text" style="background:transparent; "> <input type="hidden" name="formdata['+field_count+'][label]" value="'+field_name+'"> <input type="hidden" name="formdata['+field_count+'][column_name]" value="'+column_name+'"> <input type="hidden" name="formdata['+field_count+'][column_type]" value="'+field_type+'"> <span class="input-group-btn "> <button class="btn btn-primary calndr-btn" type="button"><i class="fa fa-calendar"></i></button> </span>  </div> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico field-remove-btn" type="button"> <i class="fa fa-minus"></i> </button>  </div> <div class="col-md-1 col-sm-1 col-xs-1 m-t-5 p-l-10"><span class="sort-sp"><i class="fa fa-sort"></i></span></div> </div>';

        } else{
            var new_field = '';
        }

        
        return new_field;
    }

    function reset_appointment_modal(){
        
        //reset plan info
        // $('input[name=\'plan_title_add\']').val()
        // $('input[name=\'plan_icon_add\']').val()

        //reset add select options
        $("input[name=\'field_name\']").val('');
        $("select[name=\'field_type\']").val('');
        
        //reset select box
        $('.add-select-options-div').hide(); 
        // $("input[name=\'cus_option1\']").val('');
        // $("input[name=\'cus_value1\']").val('');

        //$('#custom-created-fields-form').find('input').val('');
        $('.add-more-select-options-div').html('');
    }
    
    function e_reset_appointment_modal(){
        
        //reset add select options
        $("input[name=\'e_field_name\']").val('');
        $("select[name=\'e_field_type\']").val('');
        
        //reset select box
        $('.e-add-select-options-div').hide(); 
        // $("input[name=\'cus_option1\']").val('');
        // $("input[name=\'cus_value1\']").val('');

        //$('#e-custom-created-fields-form').find('input').val('');
        $('.e-add-more-select-options-div').html('');
    }    

    /*Editing plan */

    $('.e-add-more-option-btn').hide();
    var e_option_count = 1;
    var e_field_count  = 1;

    $(document).on('click','.view-plan',function(){

        e_reset_appointment_modal();
        var plan_id = $(this).closest('ul').attr('logged_plan_id');
        
        $('.loader').show();
        $('body').addClass('body-overflow');
       
        $.ajax({
            type : 'get',
            url  : "{{ url('/system/plans/view') }}"+'/'+plan_id,
            dataType : 'json',
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                var response = resp['response'];
                if(response == true){
                    var plan_id = resp['plan_id']; 
                    //var alrdy_savd_flds = resp['total_fields'];
                    var title   = resp['title'];
                    var icon    = resp['icon'];
                    var detail  = resp['detail'];
                    var formdata = resp['formdata'];
                    // alert(icon);return
                    e_field_count = resp['total_fields'];
                    e_field_count++;
                    //alert(e_field_count);
                    // return false;
                    // set plan info in form for showing
                    $('input[name=\'e_plan_title_add\']').val(title);
                    // $('input[name=\'e_plan_icon_add\']').val(icon);
                    $('.sel_icon i').addClass(icon);
                    $('textarea[name=\'e_plan_detail_add\']').val(detail);

                    $('#e-custom-created-fields-form').find('input[name=\'plan_id\']').val(plan_id);
                    //$('#e-custom-created-fields-form').find('input[name=\'alrdy_savd_flds\']').val(alrdy_savd_flds);

                    $('.e-created-fields').html(formdata);
                    //$('#appointmentplanmodal').modal('show');
                    $('#appointmentplanmodal').modal('hide'); 
                    $('#viewappointmentmodal').modal('show'); 
                    e_reset_appointment_modal();
                } else{
                    alert("{{ COMMON_ERROR }}");
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });

    $('.e-add-field-btn').on('click',function(){
        //alert(e_field_count); return false;
        
        var field = add_field_in_form(e_option_count,e_field_count,'EDIT');
        if(field == false){
            return false;
        } 
        e_field_count++;

        // showing new created fields
        $('.e-created-fields').append(field);
        //e_field_count++;
        // select box options set to default
        $('.e-add-more-option-btn').hide();
        e_option_count = 1; 

        e_reset_appointment_modal();
    });

    $(document).on('click','.e-save-appointmnt-form', function() {
        $('#e-custom-created-fields-form').find('input[name=\'plan_title\']').val($('input[name=\'e_plan_title_add\']').val());
        // $('#e-custom-created-fields-form').find('input[name=\'plan_icon\']').val($('input[name=\'plan_icon_add\']').val($('input[name=\'e_plan_icon_add\']').val()));
        $('#e-custom-created-fields-form').find('input[name=\'plan_id\']').val();

        $('input[name=\'plan_icon\']').val($('input[name=\'e_plan_icon_add\']').val());
        $('#e-custom-created-fields-form').find('textarea[name=\'plan_detail\']').val($('textarea[name=\'e_plan_detail_add\']').val());
        var error = 0;
        if($('input[name=\'e_plan_title_add\']').val() == '') {
            $('input[name=\'e_plan_title_add\']').addClass('red_border');
            //$('input[name=\'e_plan_icon_add\']').siblings('span').addClass('red_border');
            error = 1;
        } else {
            $('input[name=\'e_plan_title_add\']').removeClass('red_border');
            //$('input[name=\'e_plan_icon_add\']').siblings('span').removeClass('red_border');
        }
        if(error == 1) {
            return false;
        }

        var formData = $('#e-custom-created-fields-form').serialize();
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url : "{{ url('/system/plans/edit') }}",
            type : "post",
            data : formData,
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == 'empty'){
                    $('span.popup_error_txt').text(' No input field added in the form');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                } else if(resp == 'false'){
                    $('span.popup_error_txt').text('Some Error Occured.');
                    $('.popup_error').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                } else {
                    
                    $('#viewappointmentmodal').modal('hide'); 
                    $('#appointmentplanmodal').modal('show'); 
                    $('.logged-plan-shown').html(resp);
                    //$('.edit_description_plan').siblings().hide();
                    $('textarea[name=\'e_plan_detail_add\']').closest('.edit_description_plan').hide();
                    
                    //show success message
                    $('span.popup_success_txt').text('Plan updated successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });

    /*select box jquery edit case */
    $("select[name=\'e_field_type\'").change(function(){
    
        var value = $(this).val();
        if(value == 'Selectbox'){ 
            $('.e-add-select-options-div').show();
            $('.e-add-more-option-btn').show();
            $('.e-add-more-select-options-div').show();
            $('.e-add-more-select-options-div').html('');
            var e_option_count = 1;
            $('.e-add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="e_cus_option'+e_option_count+'" placeholder="option" class="form-control " type="text" value=""> </div> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="e_cus_value'+e_option_count+'" placeholder="value" class=" form-control" type="text" value=""> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');

        } else{
            $('.e-add-select-options-div').hide();
            $('.e-add-more-option-btn').hide();        
            $('.e-add-more-select-options-div').hide();            
        }
    });

   $(document).on('click','.e-add-more-option-btn', function(){

        e_option_count++;
        $('.e-add-more-select-options-div').append('<div class="form-group col-md-offset 1 col-md-10 col-sm-10 col-xs-12 p-0 m-l-50 option-div"> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="e_cus_option'+e_option_count+'" placeholder="option" class="form-control " type="text" value=""> </div> <div class="col-md-4 col-sm-4 col-xs-12 p-l-0"> <input name="e_cus_value'+e_option_count+'" placeholder="value1" class=" form-control" type="text" value=""> </div> <div class="col-md-1 col-sm-1 col-xs-1 p-0"> <button class="btn group-ico remove-option-btn" type="button"> <i class="fa fa-minus"></i> </button> </div> </div>');
   });

    $(document).on('click','.remove-option-btn', function(){
        $(this).closest('.option-div').remove();
    });

    $(document).on('click','.remove-option1-btn', function(){
        //$(this).closest('.option-div').find('input').val('');
        $(this).closest('.option-div').remove();
        
        //$(this).closest('.add-select-options-div').removeClass('m-t-10');
        //$(this).closest('.option-div').toggle();
    });
    /*select box jquery edit case end*/


});
</script>

<!-- <script>
    $(document).ready(function(){
        
        //$(document).on('click','.settings',function(){
        $('.settings').on('click',function(){
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
<script>
    /*-------Sweetalert ---------*/
     //swal("Good job!", "You clicked the button!", "success");
</script>    
<script>

    /*---------Three tabs click option----------*/
    /*
    $('.risk-logged-box').hide();
    $('.risk-search-box').hide();
    $('.risk-logged-btn').removeClass('active');
    $('.risk-search-btn').removeClass('active');

    $('.risk-add-btn').on('click',function(){ 
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-add-box').show();
        $(this).closest('.modal-body').find('.risk-add-box').siblings('.risk-tabs').hide();
    });
    $('.risk-logged-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-logged-box').show();
        $(this).closest('.modal-body').find('.risk-logged-box').siblings('.risk-tabs').hide();
    });
    $('.risk-search-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(this).closest('.modal-body').find('.risk-search-box').show();
        $(this).closest('.modal-body').find('.risk-search-box').siblings('.risk-tabs').hide();
    }); */
</script>       

<!-- akhil scripts-->

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
            $('.plan_icon').val(new_class);
            //alert(new_class);
        });
    });
</script>
<!--  -->

<script>    
    //delete plan
    $(document).ready(function(){
        $(document).on('click','.delete-log-plan', function(){
            //alert(1); return false;
            if(!confirm("Are sure you to delete this ?")){
                return false;
            }
            var plan_id = $(this).attr('plan_id');
             //alert(plan_id); return false; 
            $(this).addClass('active_plan');  

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/system/plans/delete/') }}"+'/'+plan_id,
                data : { 'plan_id' : plan_id },
                success : function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == 1){
                        $('.active_plan').closest('.plan-row').html('');

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                        $('span.popup_success_txt').text('Plan Deleted successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                        $(this).closest('.cog-panel').siblings('.cog-panel').find('.pop-notifbox').removeClass('active');
                    }
                    else{
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                        $(this).closest('.cog-panel').siblings('.cog-panel').find('.pop-notifbox').removeClass('active');

                    }       
                }
            });
            return false;

        });
    });
</script>

<script>
    $(document).ready(function(){

        $('input[name=\'search\']').keydown(function(event) { 
        var keyCode = (event.keyCode ? event.keyCode : event.which);   
        if (keyCode == 13) {
            return false;
            //$('.search_files_btn').click();        
        }
        });
        $(document).on('click','.search_plan_builder',function(){

        //alert(1);return false;
        var search = $('input[name=\'search\']').val();
        search = jQuery.trim(search);
        var error = 0;
        if(search == '' || search == '0'){
            $('input[name=\'search\']').addClass('red_border');
            error=1;
        } else{
            $('input[name=\'search\']').removeClass('red_border');
        }

        if(error == 1){
            return false;
        }

        var formdata = $('#plan_search_form').serialize();
        // alert(formdata);
        // return false;

        $('.loader').show();
        $('body').addClass('body-overflow');
        
        //var token = "{{ csrf_token() }}";

        $.ajax({
            type : 'post',
            url  : "{{ url('/system/plans') }}",
            data : formdata,
            success : function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                
                if(resp == ''){
                    $('.searched-plan').html('{{ NO_RECORD }}');
                } else{
                    $('.searched-plan').html(resp);
                }
                //$('.searched-plan').html(resp);
                //$('input[name=\'search\']').val();
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;

        });
    });
</script>
<script>
    $('.description_plan').hide();
    $('.add_plan_desc').on('click',function(){
        autosize($("textarea"));
        $('.description_plan').toggle();
    });
</script>

<script>
    $('.edit_description_plan').hide();
    //$('.edit_description_plan').on('click', function(){
    $(document).on('click','.e_description_plan', function(){
        autosize($("textarea"));
        $('.edit_description_plan').toggle();
    });
</script>

<!-- sortable start -->
<link href="{{ url('public/frontEnd/js/sortable-jquery/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ url('public/frontEnd/js/sortable-jquery/jquery-ui.js') }}"></script>
<script>
      $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
        $( "#e-sortable" ).sortable();
        $( "#e-sortable" ).disableSelection();
      } );
</script>
<!-- sortable end -->
<script type="text/javascript">
    $(document).on('click','.bck_btn',function(){
        $('.sel_icon i').attr('class','');
    });
</script>