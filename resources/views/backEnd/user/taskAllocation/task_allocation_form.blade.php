@extends('backEnd.layouts.master')

@section('title',' User Task Allocation')

@section('content')

<?php
	if(isset($u_task_alloc))
	{
		$action = url('admin/user/task-allocation/edit/'.$u_task_alloc->id);
		$task = "Edit";
		$form_id = 'EditUserTaskAllocation';
	}
	else
	{
		$action = url('admin/user/task-allocation/add/'.$user_id);
		$task = "Add";
		$form_id = 'AddUserTaskAllocation';
	}
?>

<style type="text/css">

.form-actions {
margin:20px 0px 0px 0px;
}

.col-lg-offset-2 .btn.btn-primary  {
margin:0px 15px 0px 0px;
} 

</style>

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Care History Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="title" value="{{ (isset($u_task_alloc->title)) ? $u_task_alloc->title : '' }}" maxlength="255">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Detail</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="detail" class="form-control" placeholder="Enter detail" maxlength="1000">{{ (isset($u_task_alloc->details)) ? $u_task_alloc->details : '' }}</textarea>
                                    </div>
                                </div>                   
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Status</label>
                                    <div class="col-lg-10">
                                        <select name="status" class="form-control">
                                                <option value="">Select Status</option>

                                                <option value="1" <?php if(isset($u_task_alloc->status)) { if($u_task_alloc->status == '1'){ echo 'selected'; } }   ?>>Active
                                                </option>

                                                <option value="0" <?php if(isset($u_task_alloc->status)) { if($u_task_alloc->status == '0'){ echo 'selected'; } }   ?>>Inactive
                                                </option>           
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-2 col-lg-10">
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
    										<input type="hidden" name="id" value="">
    										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
    										<a href="{{ url('admin/user/task-allocations/'.$user_id) }}">
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

@endsection