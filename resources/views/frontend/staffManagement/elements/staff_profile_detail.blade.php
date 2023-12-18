<div id="staff_profile" class="tab-pane">
    <div class="position-center">
        <div class="prf-contacts sttng stf-details">
            <h2 class="accordion-header"> Personal Information <!-- <a href="javascript:void(0)" class="staff-info-edit-btn" clmn-name="personal_info"><i class="fa fa-pencil profile"></i></a> --></h2>
            <div class="accordion-content full-info persnl-detail" style="display: block;">{!! $staff_member->personal_info !!}</div>
            
            <h2 class="accordion-header"> Banking Information <!-- <a href="javascript:void(0)" class="staff-info-edit-btn" clmn-name="banking_info"><i class="fa fa-pencil profile"></i></a> --></h2>
            <div class="accordion-content full-info">{!! $staff_member->banking_info !!}</div>
            
            <!-- <h2 class="accordion-header"> Qualification Information a href="javascript:void(0)" class="staff-info-edit-btn" clmn-name="qualification_info"><i class="fa fa-pencil profile"></i></a></h2>
            <div class="accordion-content full-info"> $staff_member->qualification_info </div> -->

        </div>
    </div>
</div>

<!--detail Information popup-->
<div class="modal fade" id="staff_detail_info_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Profile</h4>
            </div>
            <div class="modal-body">
                <div class="row">
            <form method="post" action="{{ url('/staff/member/edit-profile') }}" id='edit_detail_info'>
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group p-0 col-md-12 col-sm-12 col-xs-12 add-rcrd">
                            <label class="col-md-12 col-sm-12 col-xs-12 p-t-7 staff-detail-info-label">Information</label>
                            <div class="col-md-12 col-sm-12 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <textarea name="staff_profile_info" class="form-control stf-detail-info-txt" rows="15" maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-bttm m-t-0 m-b-5">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="staff_id" value="{{ $staff_id }}">
                        <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning" type="submit"> Confirm </button>
                    </div>
                </div>
            </form>
            </div>           
        </div>
    </div>
 </div>

<script>
    $('.stf-details .full-info').hide();
    $('.stf-details .persnl-detail').show();
    
    $(document).ready(function(){ 
        $('.stf-details h2').click(function(){
            $('.stf-details .full-info').hide();
            $(this).next('.full-info').show();
        });
    });
</script>
<script>
    $(document).ready(function(){

        //showing more info model
        $('.staff-info-edit-btn').click(function(){
            var heading = $(this).parent().text();
            var text = $(this).parent().next('div').text();
            var text_clmm_name = $(this).attr('clmn-name');

            $('.staff-detail-info-label').text(heading);
            $('.stf-detail-info-txt').text(text);
            $('.stf-detail-info-txt').attr('name',text_clmm_name);

            $('#staff_detail_info_model').modal('show');
        });
    });
</script>