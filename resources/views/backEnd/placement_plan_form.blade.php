@extends('backEnd.layouts.master')

@section('title',' Placement Plan Form')

@section('content')

<?php
	if(isset($target))
	{
		$action = url('admin/placement-plan/edit/'.$target->id);
		$task = "Edit";
		$form_id = 'edit_target';
	}
	else
	{
		$action = url('admin/placement-plan/add');
		$task = "Add";
		$form_id = 'add_target';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Target
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">


                            <div class="form-group">
                                <label class="col-lg-2 control-label">Add Task</label>
                                <div class="col-lg-10">
                                    <input type="text" name="task" class="form-control" placeholder="task" value="{{ (isset($target->task)) ? $target->task : '' }}">
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Date</label>
                                <div class="col-lg-10">
                                   <input class="form-control default-date-picker" type="text" value="{{ (isset($target->date)) ? date('d-m-Y',strtotime($target->date)) : '' }}" placeholder="DD-MM-YYYY" name="date" value=""  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <textarea name="description" class="form-control" placeholder="description" rows="2">{{ (isset($target->description)) ? $target->description : '' }}</textarea>
                                </div>
                            </div>                           
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="0" <?php if(isset($target->status)) { if(($target->status == '0')&&($target->date >= $today)){ echo 'selected'; } }  ?>>Active

                                            </option>           
                                            <option value="1" <?php if(isset($target->status)) { if($target->status == '1'){ echo 'selected'; } }   ?>>Completed
                                            
                                            </option>
                                            <option value="0" <?php if(isset($target->status)) { if(($target->status == '0')&&($target->date <= $today)){ echo 'selected'; } }  ?>>Pending
                                            
                                            </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id" value="{{ (isset($target->id)) ? $target->id : '' }}">
										<button type="submit" class="btn btn-primary" name="">Save</button>
										<a href="{{ url('admin/placement-plan') }}">
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
$(document).ready(function() {

    $('.default-date-picker').datepicker({
        //format: 'yyyy-mm-dd'
         format: 'dd-mm-yyyy',
        // maxDate:'+13-02-2017'
        });
    });
</script>

@endsection