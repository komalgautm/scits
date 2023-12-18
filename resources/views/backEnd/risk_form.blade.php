@extends('backEnd.layouts.master')

@section('title',':Risk Form')

@section('content')

<?php
	if(isset($risk_info))
	{
		$action = url('admin/risk/edit/'.$risk_info->id);
		$task = "Edit";
		$form_id = 'edit_risk_form';
	} else {
		$action = url('admin/risk/add');
		$task = "Add";
		$form_id = 'add_risk_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Risk
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Descrition</label>
                                <div class="col-lg-9">
                                    <input type="text" name="description" class="form-control" placeholder="description" value="{{ (isset($risk_info->description)) ? $risk_info->description : '' }}" maxlength="255">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Icon</label>
                                <div class="col-lg-3">
	                                <span class="group-ico icon-box"><i class="{{ (isset($risk_info->icon)) ? $risk_info->icon : 'fa fa-info' }}"></i> </span>
	                                <input type="hidden" name="icon" value="{{ (isset($risk_info->icon)) ? $risk_info->icon : 'fa fa-info' }}" class="risk_icon" maxlength="255">
	                            </div>
                            </div>                            
                            
                            <div class="form-group">
								<label class="col-lg-3 control-label">Status</label>
								<div class="col-lg-3">
									<select name="status" class="form-control">
											<option value="">Select Status</option>
											<option value="1" <?php if(isset($risk_info->status)) { if($risk_info->status == '1'){ echo 'selected'; } }   ?>>Active
											
											</option>
											<option value="0" <?php if(isset($risk_info->status)) { if($risk_info->status == '0'){ echo 'selected'; } }   ?>>Inactive

											</option>			
									</select>
								</div>
							</div>
                        
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
								     <div class="add-admin-btn-area">		
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="risk_id" value="{{ (isset($risk_info->id)) ? $risk_info->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/risk') }}">
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

