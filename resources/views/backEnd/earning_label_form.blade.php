@extends('backEnd.layouts.master')

@section('title',':Earning Scheme Label Form')

@section('content')

<?php //echo "<pre>"; print_r($earning_info); die;
	if(isset($earning_info))
	{
		$action = url('admin/earning-scheme-label/edit/'.$earning_info->id);
		$task = "Edit";
		$form_id = 'edit_earning_scheme_label_form';
	}
	else
	{
		$action = url('admin/earning-scheme-label/add');
		$task = "Add";
		$form_id = 'add_earning_scheme_label_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Earning Scheme Label
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ (isset($earning_info->name)) ? ucfirst($earning_info->name) : '' }}" maxlength="255">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Icon</label>
                                <div class="col-lg-9">
	                                <span class="group-ico icon-box"><i class="{{ (isset($earning_info->icon)) ? $earning_info->icon : 'fa fa-info' }}"></i> </span>
	                                <input type="hidden" name="icon" value="{{ (isset($earning_info->icon)) ? $earning_info->icon : 'fa fa-info' }}" class="risk_icon" maxlength="255">
	                            </div>
                            </div>        

                            <div class="form-group">
                            	<label class="col-lg-3 control-label">Label Type</label>
                            	<div class="col-lg-9">
                            		<select class="form-control" name="label_type">
                            			<option value="">Select Label</option>
                            			<option value="E" <?php isset($earning_info->label_type) && ($earning_info->label_type == 'E') ? 'selected' : ''  ?>>Education/Training</option>
                            			<option value="G" <?php isset($earning_info->label_type) && ($earning_info->label_type == 'G') ? 'selected' : '' ?>>General Behaviour</option>
                            			<option value="I" <?php isset($earning_info->label_type) && ($earning_info->label_type == 'I') ? 'selected' : '' ?>>Independent Living Skills</option>
                            			<option value="M" <?php isset($earning_info->label_type) && ($earning_info->label_type == 'M') ? 'selected' : '' ?>>Missing/Absent from Care</option>
                            		</select>	
                            	</div>	
                            	</label>
                            </div>

							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
                                     <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="user_id" value="{{ (isset($earning_info->id)) ? $earning_info->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/earning-scheme-labels') }}">
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
           $('.fontwesome-panel').show();
        });

        $('.fontawesome-cross').on('click',function(){
           $('.fontwesome-panel').hide(); 
           $('#riskModal').show();
        });

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
@endsection

