@extends('backEnd.layouts.master')
@section('title',':Service User Care Team Form')
@section('content')

<?php
	if(isset($member)) {	         
		$action = url('admin/service-user/careteam/edit/'.$team_member_id);
		$task = "Edit";
		$form_id = 'add_care_team_form';
	} else {	
		$action = url('admin/service-user/careteam/add/'.$service_user_id);
		$task = "Add";
		$form_id = 'add_care_team_form';
	}
?>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Care Team Member
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">

                            @if(!isset($member))
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Staff Member</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="staff_member_id" id="staff_mbr_id">
                                        <option value="">Select Staff Member</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user['id'] }}" staff_name="{{ $user['name'] }}" staff_email="{{ $user['email'] }}" phone_no="{{ $user['phone_no'] }}" image="{{ $user['image'] }}" class="sel_staff">{{ $user['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Job Title</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="job_title_id">
                                        <option value="">select Job</option>
                                        @foreach($care_team_job_title as $value)

                                            <option value="{{ $value->id }}" <?php if(isset($member->job_title_id)) {?>{{ ($member->job_title_id == $value->id) ? 'selected' : '' }} <?php } ?>>{{ $value->title }}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ (isset($member->name)) ? $member->name : '' }}" maxlength="255" id="staff_name">
                                </div>
                            </div> 

                            <div class="form-group">
								<label class="col-lg-3 control-label">Email</label>
								<div class="col-lg-9">
								    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ (isset($member->email)) ? $member->email : '' }}" maxlength="255" id="staff_email">
								</div>
							</div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Phone</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone_no" class="form-control" placeholder="Phone number" value="{{ (isset($member->phone_no)) ? $member->phone_no : '' }}" maxlength="15" id="phone_no">
                                </div>
                            </div>
                            <?php
                                $image = careTeam.'/default_user.jpg';
                                if(isset($member->image))
                                {
                                    if(!empty($member->image)){
                                        $image = careTeam.'/'.$member->image;
                                    }
                                }
                            ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-md-9">
                                    <img src="{{ $image }}" id="old_image"  alt="No image" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 100px;">
                                </div>
                            </div>

                            <div class="form-group choose-img-input-area">
                                <label class="col-lg-3 control-label">Image</label>
                                <div class="col-lg-9">
                                    <input type="file" id="img_upload" name="image" val="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Address </label>
                                <div class="col-lg-9">
                                    <textarea name="address" class="form-control" placeholder="Address" rows="4" maxlength="1000">{{ (isset($member->address)) ? $member->address : '' }}</textarea>
                                </div>
                            </div>

                       	    <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
                                     <div class="add-admin-btn-area">   
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="staff_image_name" value="" class="staff_image_name">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
									    <a href="{{ url('admin/service-user/careteam/'.$service_user_id) }}">
											<button type="button" class="btn btn-default" name="cancel">Cancel</button>
										</a>
                                    </div>
									</div>
								</div>
							</div>
                        </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
	</section>
</section>

<!-- Font awesome(icons) -->
@include('backEnd.common.icon_list')
<!-- Font awesome(icons) end -->

<script>
    /*------Font awesome icons script ---------*/
    
    $(document).ready(function(){
        $('.fontwesome-panel').hide();
       
        $('.icon-box').on('click',function(){
            $('#riskModal').hide();
         //  $('body').addClass('fontawesome-open');
           $('.fontwesome-panel').show();

        });

        $('.fontawesome-cross').on('click',function(){
           $('.fontwesome-panel').hide(); 
           $('#riskModal').show();
          // $('body').toggleClass('modal-open');
        });

        // $('#icons .fa-hover a').on('click', function () {
        //     var trim_txt = $(this).find('i');
        //     var new_class = trim_txt.attr('class');
        //     $('.icon-box i').attr('class',new_class);
        //     $('body').toggleClass('modal-open');
        //     $('.fontwesome-panel').hide(); 
        //     $('.risk_icon').val(new_class); 
        //      console.log(new_class);
        // });

         $('#icons-fonts .fa-hover a').on('click', function () {
            var trim_txt = $(this).find('i');
            var new_class = trim_txt.attr('class');
            $('.icon-box i').attr('class',new_class);                  
            $('.fontwesome-panel').hide();
            $('#riskModal').show();  
            $('.risk_icon').val(new_class);                  
        });
    });
</script>

<script>

    $('#icons').hide();
    $('.icon-box').on('click',function(){
        $('#icons').toggle();
    });

</script>

<script>
    $(document).ready(function() {

      function readURL(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e) 
                    {
                        $('#old_image').attr('src', e.target.result);
                    };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img_upload").change(function(){ 
            
            var img_name = $(this).val();
            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
                if(ext =="jpg" || ext =="jpeg" || ext =="gif" || ext =="png")
                {
                    input=document.getElementById('img_upload');
                    if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#img_upload").removeAttr("src");
                      alert("image size should be at least 10KB and upto 2MB");
                      return false;
                    }
                    else
                    {
                      readURL(this);
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
    $(document).ready(function() {

        // $(document).on('click','.sel_staff',function(){
        $(document).on('change','#staff_mbr_id',function(){
            // alert('1');
            // $(this).find('option:selected')
            var abc         = $(this);
            var staff_id    = abc.find('option:selected').val();
            var staff_name  = abc.find('option:selected').attr('staff_name');
            var staff_email = abc.find('option:selected').attr('staff_email');
            var phone_no    = abc.find('option:selected').attr('phone_no');
            var image       = abc.find('option:selected').attr('image');

            $('#staff_name').val(staff_name);
            $('#staff_email').val(staff_email);
            $('#phone_no').val(phone_no);
            $('.staff_image_name').val(image);

            var img = "{{ userProfileImagePath }}";
            var preview_image = '';

            if(image == '' && image == null) {
                preview_image = img+'/default_user.jpg';
            } else {
                preview_image = img+'/'+image;
            }
            $('#old_image').attr('src', preview_image);

        });
    });
</script>

@endsection
