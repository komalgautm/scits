@extends('backEnd.layouts.master')

@section('title',':File Manager Form')

@section('content')
<!-- <script src="{{ url('public/backEnd/js/jsvalidation/jquery.form.js') }}"></script> -->
<!-- <script src="{{ url('public/backEnd/js/jsvalidation/jquery-3.1.1.min.js') }}"></script> -->
<script src="{{ url('public/backEnd/js/jquery.validate.min.js') }}"></script>
<!-- <script src="{{ url('public/backEnd/js/jsvalidation/additional-methods.min.js') }}"></script> -->
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                    Add Files
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="files_add_form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Category</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="file_category_id">
                                            <option value="">Select Category</option>
                                            @foreach($file_category as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
              
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">File</label>
                                    <div class="col-lg-9">
                                        <input type="file" id="img_upload" name="files[]" val="" multiple="multiple">
                                    </div>
                                </div>

    							<div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-3 col-lg-10">
                                          <div class="add-admin-btn-area">   
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
    										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
    										<a href="{{ url('admin/service-user/file-managers/'.$service_user_id) }}">
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



<script>
    $("#files_add_form").validate({
        rules: 
        {   
            "file_category_id": {
                required: true,
                // extension: "png|jpg|gif|jpeg"
            },
            "files[]": {
                required: true,
                // extension: "png|jpg|gif|jpeg"
            }
            
        },
        messages: 
        {   
            "file_category_id": {
                required: 'Please select Category',
                // extension: "Please select image in png,jpg and jpeg format."
            },
            "files[]": {
                required: 'Please select file',
                // extension: "Please select image in png,jpg and jpeg format."
            }
        }

    });
</script>


<script>
    $(document).ready(function() {

        // function readURL(input) 
        // {
        //   	if (input.files && input.files[0])
        //     {
        //         var reader = new FileReader();
        //         reader.onload = function (e) 
        //             {
        //                 //$('#old_image').attr('src', e.target.result).width(150).height(170);
        //                 $('#old_image').attr('src', e.target.result);
        //             };
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

      	$("#img_upload").change(function(){	
            
          	var img_name = $(this).val();
          	if(img_name != "" && img_name!=null)
          	{
            	var img_arr=img_name.split('.');
            	var ext = img_arr.pop();
            	ext     = ext.toLowerCase();
            	if(ext =="jpg" || ext =="jpeg" || ext =="png" || ext =="pdf" || ext =="doc" || ext =="docx" || ext =="wps")
    			{
    	            input=document.getElementById('img_upload');
    	            /*if(input.files[0].size > 2097152 || input.files[0].size <  10240)
    	            {
    	              $(this).val('');
    	              $("#img_upload").removeAttr("src");
    	              alert("file size should be at least 10KB and upto 2MB");
    	              return false;
    	            }
    	            else
    	            {*/
    	              readURL(this);
    	            //}   
    	        }
               else
    	        {
    	           	$(this).val('');
    	           	alert('Only .jpg,jpeg,png,pdf,doc,docx,wps formats are allowed.');
    	        }
    	    }
    	    return true;
    	}); 
    });
</script>



@endsection