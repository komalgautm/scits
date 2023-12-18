@extends('backEnd.layouts.master')

@section('title',' User Sick Leaves')

@section('content')

<?php
	if(isset($u_sick_leave))
	{
		$action = url('admin/user/sick-leave/edit/'.$u_sick_leave->id);
		$task = "Edit";
		$form_id = 'EditUserSickLeave';
	}
	else
	{
		$action = url('admin/user/sick-leave/add/'.$user_id);
		$task = "Add";
		$form_id = 'AddUserSickLeave';
	}
?>

<style type="text/css">
 
 .form-actions {
 margin:20px 0px 0px 0px;   
 }

 .col-lg-offset-2 .btn.btn-primary {
  margin:0px 10px 0px 0px;  
 }
</style>

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Sick Leave Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="title" value="{{ (isset($u_sick_leave->title)) ? $u_sick_leave->title : '' }}" maxlength="255">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Leave Date</label>
                                    <div class="col-lg-10">
                                       <input class="form-control default-date-picker" type="text" value="{{ (isset($u_sick_leave->leave_date)) ? date('d-m-Y',strtotime($u_sick_leave->leave_date)) : '' }}" placeholder="DD-MM-YYYY" name="leave_date" value="" maxlength="10" readonly="">
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Reason</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="reason" class="form-control" placeholder="Enter reason" maxlength="1000">{{ (isset($u_sick_leave->reason)) ? $u_sick_leave->reason : '' }}</textarea>
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Comment</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="comment" class="form-control" placeholder="Enter comments" maxlength="1000">{{ (isset($u_sick_leave->comments)) ? $u_sick_leave->comments : '' }}</textarea>
                                    </div>
                                </div>                 
                                
                                <div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-2 col-lg-10">
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
    										<input type="hidden" name="id" value="">
    										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
    										<a href="{{ url('admin/user/sick-leaves/'.$user_id) }}">
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
            // startDate: today,
            // minView : 2
            // maxDate:'+13-02-2017'
        });
    });
</script>

@endsection