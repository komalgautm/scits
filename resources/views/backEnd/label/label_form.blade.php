@extends('backEnd.layouts.master')

@section('title',' Label Form')

@section('content')

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       Edit Label
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ url('admin/label/edit') }}" id="label_form" enctype="multipart/form-data">
                      
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Default label</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" disabled="" value="{{ $label['name'] }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">New label</label>
                                <div class="col-lg-10">
                                    <input type="text" name="label_name" class="form-control" placeholder="title" value="{{ isset($label['renamed']['name']) ? $label['renamed']['name'] : '' }}" maxlength="255">
                                </div>
                            </div>

                			<div class="form-group">
                                <label class="col-lg-2 control-label">Icon</label>
                                <div class="col-lg-10">
                                <span class="group-ico icon-box"><i class="{{ (isset($label['renamed']['icon'])) ? $label['renamed']['icon'] : $label['icon'] }}"></i> </span>
                                	<input type="hidden" name="label_icon" value="{{ (isset($label['renamed']['icon'])) ? $label['renamed']['icon'] : $label['icon'] }}" class="label_icon" maxlength="255">
                                </div>
                            </div>
							
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="label_id" value="{{ (isset($label['id'])) ? $label['id'] : '' }}">
										<button type="submit" class="btn green btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/labels') }}">
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
            $('.label_icon').val(new_class);                  
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