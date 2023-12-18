@extends('backEnd.layouts.master')

@section('title',' System Admin Form')

@section('content')

<style type="text/css">
 .col-lg-offset-2 .btn.btn-primary {
     margin: 0px 10px 0px 0px;   
 }   
</style>


 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                
                       <?php if(!isset($user)) {
                           echo 'Add';
                           $form_id =  'SuperAdminUserAddForm';
                       } else {
                           echo 'Edit'; 
                           $form_id =  'SuperAdminUserEditForm';
                           if(isset($del_status)) {
                                if($del_status == '1') {
                                    $disabled = 'disabled';
                                    $task = 'View';
                                } else {
                                    $disabled = '';
                                }
                            }
                       } ?>
                
                       Super Admin User
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ (isset($user->name)) ? $user->name : '' }}" maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Username</label>
                                <div class="col-lg-9">
                                    <input type="text" name="user_name" class="form-control" placeholder="username" value="{{ (isset($user->user_name)) ? $user->user_name : '' }}"   maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>   
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ (isset($system_admins->password)) ? $system_admins->password : '' }}" >
                                </div>
                            </div>         -->                   
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" placeholder="email" value="{{ (isset($user->email)) ? $user->email : '' }}" maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>                            
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Company</label>
                                <div class="col-lg-10">
                                    <input type="text" name="company" class="form-control" placeholder="company" value="{{ (isset($system_admins->company)) ? $system_admins->company : '' }}" maxlength="255">
                                </div>
                            </div> 
 -->                        

                            <?php
                                $image = env('APP_URL').adminImgPath.'/default_user.jpg';
                                if(isset($user->image))
                                {   if(!empty($user->image)) {
                                        $image = env('APP_URL').adminImgPath.'/'.$user->image;
                                    }
                                }
                            ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <img src="{{ $image }}" id="old_image" alt="No image" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 100px;">
                                </div>
                            </div>

                            <div class="form-group choose-img-input-area">
                                <label class="col-lg-3 control-label">Image</label>
                                <div class="col-md-9">
                                    <input type="file" id="img_upload" name="image" val="" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>                            
                            
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
                                      <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="user_id" value="{{ (isset($user->id)) ? $user->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1" {{ (isset($del_status)) ? $disabled: '' }}>Save</button>
                                        @if(isset($del_status))
                                            @if($del_status == '1') 
                                                <a href="{{ url('/super-admin/users'.'?user=archive') }}">
                                                    <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                            @else
                                                <a href="{{ url('/super-admin/users') }}">
                                                        <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                            @endif
                                        @else
										<a href="{{ url('/super-admin/users') }}">
											<button type="button" class="btn btn-default" name="cancel">Cancel</button>
										</a>
                                         @endif
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
                    $('#old_image').attr('src', e.target.result);
                    //$('#old_image').attr('src', e.target.result).width(150).height(170);
                };
            reader.readAsDataURL(input.files[0]);
        }
    }
        $("#img_upload").change(function()
        {   
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

@endsection