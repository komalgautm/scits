<!-- Log Book Modal -->
<div class="modal fade" id="ServiceUserAddToCalendarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close view_log_mdl mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Add Log To Calendar</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="add-new-box risk-tabs custm-tabs">
                        <form method="post" action="{{ url('/general/logbook/calendar/add') }}" id="su_add_to_cal_form">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd service-user-list">    
                            </div>
            
                            <div class="form-group modal-footer m-t-0 modal-bttm">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <input type="hidden" name="log_id" value="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-warning" type="submit"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $('.log_book').click(function(){ //alert(1);
        $('#logBookModal').modal('show');
    });

    // $(function(){
    //     $('#su_add_to_cal_form').validate({

    //         rules: {
    //             su_id : "required",

    //         },
    //         messages: {
    //             su_id : "This field is required", 

    //         },
    //         submitHandler:function(form) {
    //             form.submit();
    //         }
    //     })
    //     return false;
    // });

    // Modal Back Button
    $('.view_log_mdl').click(function(){
        $('#logBookModal').modal('show');
        $('.logged-btn').click();
    });
</script>

<script >
    //select options of YPs
    $(".select-field").select2({
        dropdownParent: $('#ServiceUserAddToCalendarModal'),
        placeholder: "Select Option"
    });
</script>