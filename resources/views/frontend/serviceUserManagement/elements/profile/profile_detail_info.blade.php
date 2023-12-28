<div id="profile_detail" class="tab-pane">
    <div class="position-center">
        <div class="prf-contacts sttng" id="personal_info">
            <h2 class="accordion-header"> Personal Information <a href="javascript:void(0)" class="info-edit-btn" clmn-name="personal_info"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info persnl-detail" style="display: block;" id="personal_data">{!! $patient->personal_info !!}</div>
            <h2 class="accordion-header">Education history <a href="javascript:void(0)" class="info-edit-btn" clmn-name="education_history"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info" id="education_data">{!! $patient->education_history !!}</div>
            <h2 class="accordion-header">Bereavement issues <a href="javascript:void(0)" class="info-edit-btn" clmn-name="bereavement_issues"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info" id="bervement_data">{!! $patient->bereavement_issues !!}</div>
            <h2 class="accordion-header">Drug &amp; alcohol issues <a href="javascript:void(0)" class="info-edit-btn" clmn-name="drug_n_alcohol_issues"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info" id="drug_data">{!! $patient->drug_n_alcohol_issues !!}</div>
            <h2 class="accordion-header">Mental Health issue<a href="javascript:void(0)" class="info-edit-btn" clmn-name="mental_health_issues"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info" id="mental_data">{!! $patient->mental_health_issues !!}</div>
        </div>
    </div>
</div>
<!--detail Information popup-->
<div class="modal fade" id="detail_info_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Profile</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form data-pid='personal_details_edit' enctype="multipart/form-data" id='edit_detail_info'>
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                            <div class="form-group p-0 col-md-12 col-sm-12 col-xs-12 add-rcrd">
                                <label class="col-md-12 col-sm-12 col-xs-12 p-t-7 detail-info-label">Information</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <textarea name="" class="form-control detail-info-txt" rows="15" maxlength="2000" id="persnl_inf"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-bttm m-t-0">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                            <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning" type="button" onclick="get_detail_info()"> Confirm </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.prf-contacts .full-info').hide();
    $('.prf-contacts .persnl-detail').show();
    $(document).ready(function() {
        $('.prf-contacts h2').click(function() {
            // alert()
            $('.prf-contacts .full-info').hide();
            $(this).next('.full-info').show();
        });
    });
</script>
<script>
    $(document).ready(function() {
        //showing more info model
        $('.info-edit-btn').click(function() {
            var heading = $(this).parent().text();
            var text = $(this).parent().next('div').text();
            var text_clmm_name = $(this).attr('clmn-name');
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        });
    });
</script>
<script>
    function get_detail_info()
    {
        var token='<?php echo csrf_token();?>'
        $.ajax({  

        type:"POST",
        url:"{{url('/service/user/edit-details')}}",
        data:new FormData( $("#edit_detail_info")[0]),
        async : false,
        contentType : false,
        cache : false,
        processData: false,
        success:function(data)
        {
            console.log(data);
            $(window).scrollTop(0);
            $('#detail_info_model').modal('hide');
            if($.trim(data)=="done")
            {
             
                $('.ajax-alert-suc') .show();
                $('.msg').text("User Info updated successfully.");
                $('.ajax-alert-suc').fadeIn();
                setTimeout(function(){
                $(".ajax-alert-suc").fadeOut();
                window.location.reload();
                }, 4000);
            // $(".ajax-alert-suc").fadeOut(5000);
            }
            else if($.trim(data)=="error")
            {
                $('.ajax-alert-err') .show();
                $('.msg').text("User Info could not be updated.");
                $(".ajax-alert-err").fadeOut(5000);
            }
            else{
                $('#personal_info').html(data);
                $('.ajax-alert-suc') .show();
                $('.msg').text("User Info updated successfully.");
                $('.ajax-alert-suc').fadeIn();
                setTimeout(function(){
                $(".ajax-alert-suc").fadeOut();
                // window.location.reload();
                }, 4000);
            }
            
        }  
        
        });
    }
</script>
<script>
    function get_user_data(event,id)
    {
        var id=id;
        var personal_data=$('#personal_data');
        var education_data=$("#education_data");
        var bervement_data=$("#bervement_data");
        var drug_data=$("#drug_data");
        var mental_data=$("#mental_data");
        // alert(personal_data)
        if(id==1)
        {
            $('#ram1').addClass('active-header').removeClass('inactive-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            personal_data.show();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            var heading = "Personal Information";
            var text = personal_data.text();
            var text_clmm_name = "personal_info";
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        }
        else if(id==2)
        {
            personal_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            education_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('active-header').removeClass('inactive-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            var heading = "Education history";
            var text = education_data.text();
            var text_clmm_name = "education_history";
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        }
        else if(id==3)
        {
            personal_data.hide();
            education_data.hide();
            drug_data.hide();
            mental_data.hide();
            bervement_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('active-header').removeClass('inactive-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            var heading = "Bereavement issues";
            var text = bervement_data.text();
            var text_clmm_name = "bereavement_issues";
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        }
        else if(id==4)
        {
            personal_data.hide();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            drug_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('active-header').removeClass('inactive-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            var heading = "Drug & alcohol issues";
            var text = drug_data.text();
            var text_clmm_name = "drug_n_alcohol_issues";
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        }
        else if(id==5)
        {
            personal_data.hide();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('active-header').removeClass('inactive-header');
            var heading = "Mental Health issue";
            var text = mental_data.text();
            var text_clmm_name = "mental_health_issues";
            $('.detail-info-label').text(heading);
            $('.detail-info-txt').text(text);
            $('.detail-info-txt').attr('name', text_clmm_name);
            $('#detail_info_model').modal('show');
            setTimeout(function() {
                var elmnt = document.getElementById("persnl_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#persnl_inf').height(scroll_height);
            }, 200);
        }
        
    }
</script>
<script>
    function ram(id)
    {
        var personal_data=$('#personal_data');
        var education_data=$("#education_data");
        var bervement_data=$("#bervement_data");
        var drug_data=$("#drug_data");
        var mental_data=$("#mental_data");
        if(id==1)
        {
            $('#ram1').addClass('active-header').removeClass('inactive-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            personal_data.show();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            
        }
        else if(id==2)
        {
            personal_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            education_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('active-header').removeClass('inactive-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
            
        }
        else if(id==3)
        {
            personal_data.hide();
            education_data.hide();
            drug_data.hide();
            mental_data.hide();
            bervement_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('active-header').removeClass('inactive-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
           
        }
        else if(id==4)
        {
            personal_data.hide();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.hide();
            drug_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('active-header').removeClass('inactive-header');
            $('#ram5').addClass('inactive-header').removeClass('active-header');
           
        }
        else if(id==5)
        {
            personal_data.hide();
            education_data.hide();
            bervement_data.hide();
            drug_data.hide();
            mental_data.show();
            $('#ram1').addClass('inactive-header').removeClass('active-header');
            $('#ram2').addClass('inactive-header').removeClass('active-header');
            $('#ram3').addClass('inactive-header').removeClass('active-header');
            $('#ram4').addClass('inactive-header').removeClass('active-header');
            $('#ram5').addClass('active-header').removeClass('inactive-header');
            
        }
    }
</script>
