@extends('backEnd.layouts.master')

@section('title',' Category Form')

@section('content')

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       Edit Category
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ url('admin/categories/edit') }}" id="category_form" enctype="multipart/form-data">
                      
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Default Category</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" disabled="" value="{{ $category['name'] }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">New Category</label>
                                <div class="col-lg-8">
                                    <input type="text" name="category_name" class="form-control" placeholder="title" value="{{ isset($category['renamed']['name']) ? $category['renamed']['name'] : '' }}" maxlength="255">
                                </div>
                            </div>

                			<div class="form-group">
                                <label class="col-lg-4 control-label">Icon</label>
                                <div class="col-lg-8">
                                <span class="group-ico icon-box"><i class="{{ (isset($category['renamed']['icon'])) ? $category['renamed']['icon'] : $category['icon'] }}"></i> </span>
                                	<input type="hidden" name="category_icon" value="{{ (isset($category['renamed']['icon'])) ? $category['renamed']['icon'] : $category['icon'] }}" class="category_icon" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">Color</label>
                                <div class="col-lg-8">
                                    <input type="color" id="favcolor" name="category_color" value="{{ $category['color'] }}">
                                </div>
                            </div>
							
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-4 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="category_id" value="{{ (isset($category['id'])) ? $category['id'] : '' }}">
										<button type="submit" class="btn green btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/categories') }}">
											<button type="button" class="btn default btn-default" name="cancel">Cancel</button>
										</a>
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



<!-- Fontwesome Icon Script -->
<script>

    /*------Font awesome icons script ---------*/
    
    $(document).ready(function(){
        $('.fontwesome-panel').hide();
       
        $('.icon-box').on('click',function(){
            // $('#riskModal').hide();
            // $('body').addClass('fontawesome-open');
           $('.fontwesome-panel').show();

        });

        $('.fontawesome-cross').on('click',function(){
           $('.fontwesome-panel').hide(); 
            // $('#riskModal').show();
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
            // $('#riskModal').show();  
            $('.category_icon').val(new_class);                  
        });
    });

</script>

<script>

    $('#icons').hide();
    $('.icon-box').on('click',function(){
        $('#icons').toggle();
    });

</script>


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
</script> -->
@endsection