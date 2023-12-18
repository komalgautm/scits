<div id="settings" class="tab-pane">
    <div id="settings" class="tab-pane  active">
        <div class="position-center">
            <form role="form" class="form-horizontal" action="{{ url('/staff/member/edit-settings') }}" enctype="multipart/form-data" method="post" id="edit_staff_profile">
            
                <div class="prf-contacts sttng">
                    <h2>  Staff Information</h2>
                </div>

                <?php
                    $image = userProfileImagePath.'/default_user.jpg';
                    if(isset($staff_member->image))
                    {
                        $image = userProfileImagePath.'/'.$staff_member->image;
                    }
                ?>
                <!-- <div class="form-group">
                    <label class="col-lg-2 control-label"></label>
                    <div class="col-lg-6">
                        <img src="{{ $image }}" id="staff_img_old" alt="No image" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 100px;">
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Image</label>
                    <div class="col-md-6">
                        <!-- <input type="file" id="staff_profile_img" name="image" val=""> -->
                        <span class="btn btn-white btn-file">
                           <span class="fileupload-new"><i class="fa fa-upload"></i> Upload
                           </span>
                           <input type="file" id="staff_profile_img" name="image" val="">
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-6">
                        <input name="name" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $staff_member->name }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-6">
                        <input name="user_name" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $staff_member->user_name }}" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Job Title</label>
                    <div class="col-lg-6">
                        <input name="job_title" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $staff_member->job_title }}" required="">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-lg-2 control-label">Access Level</label>
                    <div class="col-lg-6">
                        <input name="access_level" placeholder="" id="name" class="form-control" type="text" maxlength="255">
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Payroll</label>
                    <div class="col-lg-6">
                        <input name="payroll" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $staff_member->payroll }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Holiday Entitlement</label>
                    <div class="col-lg-6">
                        <input name="holiday_entitlement" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $staff_member->holiday_entitlement }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        <textarea rows="6" class="form-control" id="" name="description" maxlength="1000" required="">{{ $staff_member->description }}</textarea>
                    </div>
                </div>

                <div class="prf-contacts sttng">
                    <h2>Contact</h2>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Phone</label>
                    <div class="col-lg-6">
                        <input placeholder=" " name="phone_no" class="form-control" type="text" value="{{ $staff_member->phone_no }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-6">
                        <input name="email" id="email" class="form-control" type="text" value="{{ $staff_member->email }}" required="">
                    </div>
                </div>
                <?php
                    //$user_info->current_location = str_replace('<br />',"\r\n",$user_info->current_location);

                    $staff_member->current_location      = preg_replace('#<br\s*/?>#i', "",$staff_member->current_location); 
                    $staff_member->personal_info         = preg_replace('#<br\s*/?>#i', "",$staff_member->personal_info); 
                    $staff_member->banking_info          = preg_replace('#<br\s*/?>#i', "",$staff_member->banking_info); 
                    
                ?> 
                <div class="form-group">
                    <label class="col-lg-2 control-label">Current Location</label>
                    <div class="col-lg-6">
                        <textarea name="current_location" class="form-control" placeholder="Current location" rows="4" maxlength="2000" required="">{{ $staff_member->current_location }}</textarea>
                    </div>
                </div>
                
                <div class="prf-contacts sttng">
                    <h2>More Info</h2>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Personal Information</label>
                    <div class="col-lg-10">
                        <textarea rows="10" class="form-control" id="" name="personal_info" maxlength="1000" placeholder="Personal Information">{{ $staff_member->personal_info }}</textarea>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-lg-2 control-label">Qualification information</label>
                    <div class="col-lg-10">
                        <textarea rows="10" class="form-control" id="" name="qualification_info" maxlength="1000" placeholder="Qualification information">{{ $staff_member->qualification_info }}</textarea>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Banking Information</label>
                    <div class="col-lg-10">
                        <textarea rows="5" class="form-control" id="" name="banking_info" maxlength="1000" placeholder="Banking Information">{{ $staff_member->banking_info }}</textarea>
                    </div>
                </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Qualification information</label>
                        @if(!$staff_qualification->isEmpty())
                        <div class="input_fields_wrap cus-from-group">
                            @foreach($staff_qualification as $qualification)
                                <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-12 p-0 rem-cert" rel="{{$qualification->id}}" >
                                    <div class="col-md-8 col-sm-8 col-xs-12 p-0">
                                        <input name="" class="form-control" type="text" value="{{ $qualification->name }}" readonly="">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12 p-t-5">
                                        <a class="image" target="blank" href="{{userQualificationImgPath.'/'.$qualification->image}}">View Image</a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <span class="input-group-addon remove-btn-addon">
                                            <button type="button" class="e_remove_cert btn btn-danger">Remove</button>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 p-t-5 rem-cert" >
                            No certificates available
                        </div>
                        <div class="input_fields_wrap cus-from-group">
                        </div>
                        @endif    
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-10 col-sm-10 col-xs-12 add-more-btn">
                            <button class="add_field btn btn-primary btn-posit">Add More Fields <i class="fa fa-plus"></i></button>
                        </div>

                    </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <input type="hidden" name="staff_id" value="{{ $staff_id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ url('/staff/profile/'.$staff_id) }}"><button class="btn btn-default" type="button">Cancel</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function()
    {      
        function readURL(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e) 
                    {
                        $('#staff_img_old').attr('src', e.target.result);
                        //$('#old_image').attr('src', e.target.result).width(150).height(170);
                    };
                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#staff_profile_img").change(function(){   

            var img_name = $(this).val();

            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
          
                if(ext =="jpg" || ext =="jpeg" || ext =="gif" || ext =="png")
                {
                    input=document.getElementById('staff_profile_img');
                    if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#staff_profile_img").removeAttr("src");
                      alert("image size should be at least 10KB and upto 2MB");
                      return false;
                    }
                 }
               else
                {
                    $(this).val('');
                    alert('Please select an image .jpg, .png, .gif file format type.');
                }
            }
        return true;
        }); 
    });
</script>

<!-- <script>
    $(function(){
        $('#edit_staff_profile').validate({
            rules: {

                name: {
                    required: true,
                    regex: /^[a-zA-Z'.\s]{1,40}$/
                },
                email: {
                    required: true,
                    email: true
                },
                job_title: {
                    required: true,
                    regex: /^[a-zA-Z0-9'.\s]{1,40}$/
                },

            },
            messages: {
                name: {
                    required: "This field is required.",
                    regex: "Only alphabets allowed.", 
                }, 
                job_title: {
                    required: "This field is required.",
                    regex: "Only alphabets allowed.", 
                },
                email: "This filed is required.",
                
            },
            submitHandler: function(form){
                form.submit();
            }
        });
        return false;
    });
</script> -->
<script>
    $(function() {
        $("#edit_staff_profile").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                name: {
                    required: true,
                    regex: /^[a-zA-Z'.\s]{1,40}$/
                },
                job_title: {
                    required: true,
                    regex: /^[a-zA-Z0-9'.\s]{1,40}$/
                },
                payroll: {
                    required: true,
                    regex: /^[a-zA-Z0-9'.\s]{1,40}$/
                },
                holiday_entitlement: {
                    required: true,
                    regex: /^[a-zA-Z0-9'.\s]{1,40}$/
                }, 
                phone_no: {
                    required : true,
                    regex: /^[0-9\s]{10,13}/
                },
                current_location: "required",
                description: "required",
            },
            messages: {
                name: {
                    required: "This field is required.",
                    regex: "Invalid Character."
                },               
                email: {
                    required: "This field is required.",
                    regex: ""
                },                
                job_title: {
                    required: "This field is required.",
                    regex: "Invalid Character."
                },                
                payroll: {
                    required: "This field is required.",
                    regex: "Invalid Character."
                },                
                holiday_entitlement: {
                    required: "This field is required.",
                    regex: "Invalid Character."
                },
                phone_no: {
                    required: "This field is required.",
                    regex: "Only numerical value allowed."
                },
                current_location: "This field is required.",
                description: "This field is required.",
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

<script type="text/javascript">
    $(".e_remove_cert").on('click',function(){
        var e_remove_btn = $(this);
        var id = $(this).closest('.rem-cert').attr('rel');
        $.ajax({
            url:"{{url('user/qualification/delete')}}" + "/" +id,
            post:"GET",
            success: function(data)
            {
                alert('{{ DEL_RECORD }}');
                e_remove_btn.closest('.rem-cert').remove();
                $('.loader').hide();
                $('body').removeClass('body-overflow');

            },
            error: function()
            {
                alert('{{ COMMON_ERROR }}');
                /*$('.loader').hide();
                $('body').removeClass('body-overflow');*/
            }
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field"); //Add button ID
       
        var x = 1; //initlal text box count
        $(add_button).unbind().click(function(e){ //on add input button click
         
            e.preventDefault();
            //if(x < max_fields){ //max input box allowed
                x++; //text box increment
                //alert(x);
                // $(wrapper).append('<div class="appended-whole-div append-posit form-group col-lg-10 col-md-10 col-sm-10 col-xs-12"><div class="multi-upload col-md-9 col-sm-9 col-xs-12 p-0"><div class="form-group"><input type="text" name="qualification[]" class="form-control" /></div><div class="form-group"><div class="input-group"><div class="btn-file"><span class="btn btn-white"><span class="fileupload-exists"><i class="fa fa-upload"></i> Upload</span><input name="qualifiaction_cert[]" class="qual_upload" type="file"></span></div><span class="input-group-addon remove-addon"><a href="#" class="remove_field btn btn-danger">Remove</a></span></div></div></div></div>'); //add input box
                $(wrapper).append(`<div class="appended-whole-div form-group col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <div class="multi-upload">
                                            <div class="form-group">
                                                <input type="text" name="qualification[]" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    
                                                        <span class="btn btn-white btn-file">
                                                           <span class="fileupload-new"><i class="fa fa-upload"></i> Upload
                                                           </span>
                                                           <input name="qualifiaction_cert[]" class="default qual_upload" type="file">
                                                        </span>
                                                    
                                                    <span class="input-group-addon remove-addon"><a href="#" class="remove_field btn btn-danger">Remove</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`); //add input box
            //}
        });
       
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).closest ('.appended-whole-div').remove(); x--;
            //$(this).parent();

        })
    });
</script>


<script>
$(document).ready(function()
{
    // $(".qual_upload").change(function()
    $(document).on('change','.qual_upload',function()
    {   
        var img_name = $(this).val();
        if(img_name != "" && img_name!=null)
        {
            var img_arr=img_name.split('.');
            var ext = img_arr.pop();
            ext     = ext.toLowerCase();
            if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'pdf' || ext == 'doc' || ext == 'docx')
            {
                input=document.getElementsByClassName('qual_upload');
                // if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                // {
                //   $(this).val('');
                //   $(".qual_upload").removeAttr("src");
                //   alert("file size should be at least 10KB and upto 2MB");
                //   return false;
                // }
             }
           else
            {
                $(this).val('');
                alert('Please select an image .jpg, .png, .pdf, .doc, .docx, .jpeg file format type.');
            }
        }
    return true;
    }); 

});
</script>