<div id="staff_contacts" class="tab-pane">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="prf-contacts">
                <h2> <span><i class="fa fa-map-marker"></i></span> Location <!-- <a href="javascript:void(0)" class="staff_location-edit-btn" clmn-name="current_location"><i class="fa fa-pencil profile"></i> </a> --> </h2>
                <div class="location-info current_location"><p>{!! $staff_member->current_location !!}</p></div>

                <!-- <div class="location-info ">    
                    <strong style="color:#3399CC;">Previous Location</strong><br>
                    <div class="previous_location"><p></p></div>
                    
                </div> -->
                <h2> <span><i class="fa fa-phone"></i></span> contacts<!--  <a href="javascript:void(0)" class="staff-contact-edit-btn" phone_no="{{ $staff_member->phone_no }}" email="{{ $staff_member->email }}"><i class="fa fa-pencil profile"></i></a>  --></h2>
                <div class="location-info">
                    <p><strong style="color:#3399CC;">Phone</strong> :  {!! $staff_member->phone_no !!}<br>
                        <br>
                        <strong style="color:#3399CC;">Email</strong> : {!! $staff_member->email !!}<br>
                        <br>
                        <!-- <strong style="color:#3399CC;">Facebook</strong> :<br>
                        <strong style="color:#3399CC;">Twitter</strong> :    -->                                  
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div id="map-canvas"></div>
        </div>
    </div>
</div>

<!-- Current Location -->
    <div class="modal fade" id="staff_location_info_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Location Information</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                <form method="post" action="{{ url('/staff/member/edit-location') }}" enctype="multipart/form-data" id='staff_edit_location_info'>

                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                            <div class="form-group p-0 col-md-12 col-sm-12 col-xs-12 add-rcrd">
                                <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 location-info-label">Current Location</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <textarea name="current_location" required class="form-control staff_edit_current_location" rows="5" maxlength="1000"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-bttm m-b-10">
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

<!--Edit Contacts popup -->
<div class="modal fade" id="staff_contact_info_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Contact Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">         
            <form method="post" action="{{ url('/staff/member/edit-contact') }}" id='edit_contact_info'>

                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Phone :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="text" class="form-control staff-edit-contact-phone" name="phone_no" required value="" maxlength="15" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Email :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="email" class="form-control staff-edit-contact-email" name="email" required value="" maxlength="255" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-bttm m-b-10">
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
    $(document).ready(function(){
        $('.staff_location-edit-btn').click(function()
        {
            var current_location = $('.current_location').text();

            $('.staff_edit_current_location').val(current_location);
            $('#staff_location_info_model').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.staff-contact-edit-btn').click(function()
        {   
            var phone_no = $(this).attr('phone_no');
            var email = $(this).attr('email');

            $('.staff-edit-contact-phone').val(phone_no);
            $('.staff-edit-contact-email').val(email);
            $('#staff_contact_info_model').modal('show');
        });
    });
</script>

<script>
    $(function() {
        $("#staff_edit_location_info").validate({
            rules: {
                current_location: {
                    required: true,
                    regex: /^[a-zA-Z0-9'"-=+,.&# \n]{1,200}$/
                },
            },
            messages: {
                current_location: {
                    required: "This field is required.",
                    regex: "Special charaters are not allowed."
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

<script>
    $(function() {
        $("#edit_contact_info").validate({
            rules: {
                phone_no: {
                    required: true,
                    regex: /^[0-9 +]{10,13}$/
                },
            },
            messages: {
                 phone_no: {
                    //required: "This field is required.",
                    regex: "This field must contain 10 to 13 digits"
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>


