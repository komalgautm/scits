@extends('backEnd.layouts.master')
@section('title',': System Guide')
@section('content')

<?php
	if(isset($system_guide))
	{	         
		$action = url('admin/system-guide/edit/'.$system_guide->id);
		$task = "Edit";
		$form_id = 'edit_system_guide_form';
	}
	else
	{	
		$action = url('admin/system-guide/add/'.$sys_guide_category_id);
		$task = "Add";
		$form_id = 'add_system_guide_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} System Guide Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="col-lg-2 control-label"> Question </label>
                                <div class="col-lg-10">
                                    <input name="question" class="form-control" placeholder="Question" rows="4" maxlength="1000" value="{{ (isset($system_guide->question)) ? $system_guide->question : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"> Answer </label>
                                <div class="col-lg-10">
                                    <textarea name="answer" class="form-control" placeholder="Answer" rows="4" maxlength="1000">{{ (isset($system_guide->answer)) ? $system_guide->answer : '' }}</textarea>
                                </div>
                            </div>

                       	    <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										    <a href="{{ url('admin/system-guide/view/'.$sys_guide_category_id) }}">
                                                <button type="button" class="btn btn-default" name="cancel">Cancel</button>
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

        $('#icons-fonts .fa-hover a').on('click', function() {
        
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


@endsection
