@extends('backEnd.layouts.master')

@section('title',':Earning Scheme Form')

@section('content')

<?php
	if(isset($incentives))
	{	
		$action = url('admin/earning-scheme/incentive/edit/'.$incentives->id);
		$task = "Edit";
		$form_id = 'edit_incentive_earning_scheme_form';
	}
	else
	{	
		
		$action = url('admin/earning-scheme/incentive/add/'.$earning_category_id);
		$task = "Add";
		$form_id = 'add_incentive_earning_scheme_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Incentive
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-10">
                                    <input type="hidden" name="earning_category_id" class="form-control" placeholder="earning_category_id" value="{{ (isset($incentives->earning_category_id)) ? $incentives->earning_category_id : '' }}">
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ (isset($incentives->name)) ? $incentives->name : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Stars</label>
                                <div class="col-lg-9">
                                    <input type="text" name="stars" class="form-control" placeholder="stars" value="{{ (isset($incentives->stars)) ? $incentives->stars : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Details</label>
                                <div class="col-lg-9">
                                    <textarea name="details" class="form-control" placeholder="details" rows="4" maxlength="1000">{{ (isset($incentives->details)) ? $incentives->details : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">url</label>
                                <div class="col-lg-9">
                                    <input type="text" name="url" class="form-control" placeholder="url" value="{{ (isset($incentives->url)) ? $incentives->url : '' }}" maxlength="255">
                                </div>
                            </div>
                            
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Icon</label>
                                <span class="group-ico icon-box"><i class="{{ (isset($user_info->icon)) ? $user_info->icon : 'fa fa-info' }}"></i> </span>
                                <input type="hidden" name="icon" value="{{ (isset($user_info->icon)) ? $user_info->icon : 'fa fa-info' }}" class="risk_icon">
                            </div>  -->                           
                            
                            <div class="form-group">
								<label class="col-lg-3 control-label">Status</label>
								<div class="col-lg-9">
									<select name="status" class="form-control">
											<option value="">Select Status</option>

											<option value="1" <?php if(isset($incentives->status)) { if($incentives->status == '1'){ echo 'selected'; } }   ?>>Active
											</option>

											<option value="0" <?php if(isset($incentives->status)) { if($incentives->status == '0'){ echo 'selected'; } }   ?>>Inactive
											</option>			
									</select>
								</div>
							</div>
                        
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
                                     <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id" value="{{ (isset($incentives->id)) ? $incentives->id : '' }}">
											
											<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										    <a href="{{ url('admin/earning-scheme/incentive/'.$earning_category_id) }}">
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
<!-- <script>
	$(document).ready(function(){
		//alert(1);
		$(document).on('click','.risk_icon', function(){
			alert(2); return false;	
		});
			
	});
		
</script> -->

<script>

    $('#icons').hide();
    $('.icon-box').on('click',function(){
        $('#icons').toggle();
    });

</script>


@endsection
<!-- <script>
$(document).ready(function()
{
  function readURL(input) 
    {
      	if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e) 
                {
                    $('#old_image').attr('src', e.target.result).width(150).height(170);
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
</script> -->

