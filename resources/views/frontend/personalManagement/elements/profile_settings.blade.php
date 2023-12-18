<div id="profile_settings" class="tab-pane">
    <div id="settings" class="tab-pane  active">
        <div class="position-center">
            <form role="form" class="form-horizontal" action="{{ url('/my-profile/edit') }}" enctype="multipart/form-data" method="post" id="edit_my_profile">
            
                <div class="prf-contacts sttng">
                    <h2>  Profile Information</h2>
                </div>

                <?php
                    $image = userProfileImagePath.'/default_user.jpg';
                    if(isset($manager_profile->image))
                    {
                        $image = userProfileImagePath.'/'.$manager_profile->image;
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
                        <input type="file" id="my_profile_img" name="image" val="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-6">
                        <input name="name" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $manager_profile->name }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Job Title</label>
                    <div class="col-lg-6">
                        <input name="job_title" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $manager_profile->job_title }}" readonly="">
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
                        <input name="payroll" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $manager_profile->payroll }}" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Holiday Entitlement</label>
                    <div class="col-lg-6">
                        <input name="holiday_entitlement" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $manager_profile->holiday_entitlement }}" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        <textarea rows="6" class="form-control" id="" name="description" maxlength="1000" required="">{{ $manager_profile->description }}</textarea>
                    </div>
                </div>

                <div class="prf-contacts sttng">
                    <h2> Account Credentials </h2>
                </div>
               <div class="form-group">
                    <label class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-6">
                        <input name="user_name" placeholder="" id="name" class="form-control" type="text" maxlength="255" value="{{ $manager_profile->user_name }}" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label"></label>
                    <div class="col-lg-6">
                        <a data-toggle="modal" href="#changePasswordModal" class="clr-blue chnge_passwrd_btn" style='font-size:15px'><button class="btn btn-primary" type="submit">Change Password</button></a>
                        
                    </div>
                </div>

                <div class="prf-contacts sttng">
                    <h2>Contact</h2>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Phone</label>
                    <div class="col-lg-6">
                        <input placeholder=" " name="phone_no" class="form-control" type="text" value="{{ $manager_profile->phone_no }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-6">
                        <input name="email" id="email" class="form-control" type="text" value="{{ $manager_profile->email }}" required="">
                    </div>
                </div>
                <?php
                    //$user_info->current_location = str_replace('<br />',"\r\n",$user_info->current_location);

                    $manager_profile->current_location      = preg_replace('#<br\s*/?>#i', "",$manager_profile->current_location); 
                    $manager_profile->personal_info         = preg_replace('#<br\s*/?>#i', "",$manager_profile->personal_info); 
                    $manager_profile->banking_info          = preg_replace('#<br\s*/?>#i', "",$manager_profile->banking_info); 

                ?> 
                <div class="form-group">
                    <label class="col-lg-2 control-label">Current Location</label>
                    <div class="col-lg-6">
                        <textarea name="current_location" class="form-control" placeholder="Current location" rows="4" maxlength="2000" required="">{{ $manager_profile->current_location }}</textarea>
                    </div>
                </div>
                
                <div class="prf-contacts sttng">
                    <h2>More Info</h2>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Personal Information</label>
                    <div class="col-lg-10">
                        <textarea rows="10" class="form-control" id="" name="personal_info" maxlength="1000" placeholder="Personal Information">{{ $manager_profile->personal_info }}</textarea>
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="col-lg-2 control-label">Qualification information</label>
                    <div class="col-lg-10">
                        <textarea rows="10" class="form-control" id="" name="qualification_info" maxlength="1000" placeholder="Qualification information"> $manager_profile->qualification_info </textarea>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Banking Information</label>
                    <div class="col-lg-10">
                        <textarea rows="5" class="form-control" id="" name="banking_info" maxlength="1000" placeholder="Banking Information">{{ $manager_profile->banking_info }}</textarea>
                    </div>
                </div>
                @if(!$my_qualification->isEmpty())
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Qualification information</label>
                        <div class="input_fields_wrap cus-from-group">
                            @foreach($my_qualification as $qualification)
                                <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-12 p-0 rem-cert" rel="{{$qualification->id}}" >
                                    <div class="col-md-8 col-sm-8 col-xs-12 p-0">
                                        <input name="" class="form-control" type="text" value="{{ $qualification->name }}" readonly="">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12 p-t-5">
                                        <a class="image" target="blank" href="{{userQualificationImgPath.'/'.$qualification->image}}">View Image</a>
                                    </div>
                                    <!-- <div class="col-md-2 col-sm-2 col-xs-12">
                                        <span class="input-group-addon remove-btn-addon">
                                            <button type="button" class="e_remove_cert btn btn-danger">Remove</button>
                                        </span>
                                    </div> -->
                                </div>
                            @endforeach
                        
                        </div>
                        <!-- <div class="add-more-btn">
                            <button class="add_field btn btn-primary">Add More Fields <i class="fa fa-plus"></i></button>
                        </div> -->

                    </div>
                @endif  
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <input type="hidden" name="manager_id" value="{{ $manager_id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="#"><button class="btn btn-default" type="button">Cancel</button></a>
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

        $("#my_profile_img").change(function(){   

            var img_name = $(this).val();

            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
          
                if(ext =="jpg" || ext =="jpeg" || ext =="gif" || ext =="png")
                {
                    input=document.getElementById('my_profile_img');
                    if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#my_profile_img").removeAttr("src");
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

<script>
    $(function() {
        $("#edit_my_profile").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                name: {
                    required: true,
                    regex: /^[a-zA-Z'.\s]{1,40}$/
                },
                /*job_title: {
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
                }, */
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
                    regex: "This Field should contain alphabetss only."
                },               
                email: {
                    required: "This field is required.",
                    regex: "This Email is not valid."
                },                
               /* job_title: {
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
                },*/
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
                if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                {
                  $(this).val('');
                  $(".qual_upload").removeAttr("src");
                  alert("file size should be at least 10KB and upto 2MB");
                  return false;
                }
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