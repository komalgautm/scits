@extends('backEnd.layouts.master')
@section('title',' Shift Form')
@section('content')
<!-- script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js" -->

<?php
    if(isset($shift_plan)) {

        $action = url('admin/home/rota-shift/edit/'.$shift_plan->id);
        $task = "Edit";
        $form_id = "edit_shift_plan";
    } else {
        
        $action = url('admin/home/rota-shift/add');
        $task = "Add";
        $form_id = "add_shift_plan";
    }
?>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Shift 
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Shift</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ isset($shift_plan->name) ? $shift_plan->name : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Start Time</label>
                                <div class="col-lg-10">

                                    <select class="form-control e_start_time" name="start_time">
                                        <option value="">Select Time</option>
                                        <?php 
                                            for ($i=1; $i <= 24; $i++) { 
                                                if($i <= 12) { ?>
                                                    <option value="{{ $i }}" <?php if(isset($shift_plan->start_time)){ if($shift_plan->start_time == $i){ echo 'selected'; }} ?> >{{ $i }} am</option>
                                         <?php  } 
                                                else { $time = $i-12; ?> 
                                                <option value="{{ $i }}" <?php if(isset($shift_plan->start_time)){ if($shift_plan->start_time == $i){ echo 'selected'; } }  ?>>{{ $time }} pm</option>
                                        <?php }} ?>
                                    </select>
                                
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">End Time</label>
                                <div class="col-lg-10">

                                    <?php if(isset($shift_plan->end_time)) {?>
                                        <select class="form-control e_end_time" name="end_time">
                                            <option value="">Select Time</option>
                                            <?php 
                                                for ($i=1; $i <= 24; $i++) { 
                                                    if($i <= 12) { ?>
                                                        <option value="{{ $i }}" <?php if($shift_plan->end_time == $i){ echo 'selected'; } ?> >{{ $i }} am</option>
                                             <?php  } else { $time = $i-12; ?> 
                                            <option value="{{ $i }}" <?php if($shift_plan->end_time == $i){ echo 'selected'; } ?>>{{ $time }} pm</option>
                                            <?php } } ?>
                                        </select>
                                    <?php } else {?> 
                                        <select class="form-control e_end_time" name="end_time">
                                            <!-- end date option comes dyamic -->

                                        </select>
                                    <?php } ?>
                                </div>
                            </div>

							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ (isset($shift_plan->id)) ? $shift_plan->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/home/rota-shift') }}">
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

<script>
    $(document).on('change','.e_start_time',function(){
        var start_time = $(this).val();
        var content = '';
        for (var i=1; i<=24; i++) { 
            
            if(i < start_time) {
                disabled = 'disabled';
            }else {
                disabled = '';
            }

            if(i<=12) { 
                
                content += '<option value="'+ i +'" '+disabled+'>'+ i +' am</option>';
            } else { 
                var time = i-12;
                content += '<option value="'+ i +'" '+disabled+'>'+ time +' pm</option>';
            }
        }
        $('.e_end_time').html(content);
    });           
</script>

@endsection