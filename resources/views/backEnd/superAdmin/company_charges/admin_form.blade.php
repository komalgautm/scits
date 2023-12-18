@extends('backEnd.layouts.master')

@section('title',' System Admin Form')

@section('content')

<style type="text/css">
 .add-admin-btn-area .save-btn {
 margin:0px 10px 0px 0px;   
 }   
</style>

<?php
	if(isset($system_admins))
	{
		$action = url('admin/system-admin/edit/'.$system_admins->id);
		$task = "Edit";
		$form_id = 'edit_system_admins_form';

        if(isset($del_status)) {
            if($del_status == '1') {
                $disabled = 'disabled';
                $task = 'View';
            } else {
                $disabled = '';
            }
        }
	}
	else
	{
		$action = url('admin/system-admin/add');
		$task = "Add";
		$form_id = 'add_system_admins_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Admin
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ (isset($system_admins->name)) ? $system_admins->name : '' }}" maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" name="user_name" class="form-control" placeholder="username" value="{{ (isset($system_admins->user_name)) ? $system_admins->user_name : '' }}" {{ (isset($system_admins)) ? 'readonly': '' }} maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>   
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ (isset($system_admins->password)) ? $system_admins->password : '' }}" >
                                </div>
                            </div>         -->                   
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" placeholder="email" value="{{ (isset($system_admins->email)) ? $system_admins->email : '' }}" maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Company</label>
                                <div class="col-lg-10">
                                    <input type="text" name="company" class="form-control" placeholder="company" value="{{ (isset($system_admins->company)) ? $system_admins->company : '' }}" maxlength="255" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div> 

                            <?php
                                $image = adminImgPath.'/default_user.jpg';
                                if(isset($system_admins->image))
                                {
                                    $image = adminImgPath.'/'.$system_admins->image;
                                }
                            ?>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-10">
                                    <img src="{{ $image }}" id="old_image" alt="No image" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 100px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Image</label>
                                <div class="col-md-8">
                                    <input type="file" id="img_upload" name="image" val="" {{ (isset($del_status)) ? $disabled: '' }}>
                                </div>
                            </div>                            
                            
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
                                     <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="user_id" value="{{ (isset($system_admins->id)) ? $system_admins->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1" {{ (isset($del_status)) ? $disabled: '' }}>Save</button>
                                        @if(isset($del_status))
                                            @if($del_status == '1') 
                                                <a href="{{ url('admin/system-admins/'.'?user=archive') }}">
                                                    <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                            @else
                                                <a href="{{ url('admin/system-admins') }}">
                                                        <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                            @endif
                                        @else
										<a href="{{ url('admin/system-admins') }}">
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