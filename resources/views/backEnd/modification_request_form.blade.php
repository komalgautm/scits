@extends('backEnd.layouts.master')

@section('title',': Modification Request')

@section('content')

<?php
	if(isset($modification_request))
	{
		$action = url('admin/modification-request/edit/'.$modification_request->id);
		/*if($modification_request->solved == 0)	{
			$disabled = true;
		} else {
			$disabled = false;
		}*/
		$task = "Edit";
		$form_id = 'edit_modification_request_form';
	}
	else
	{
		$action = url('admin/daily-record/add');
		$task = "Add";
		$form_id = 'add_daily_record_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Modification Request
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Action</label>
                                <div class="col-lg-10">
                                    <select name="action" class="form-control modify_req">
											<option value="edit" <?php if(isset($modification_request->action)) { if($modification_request->action == 'edit'){ echo 'selected'; } } ?>>Edit</option>
											<option value="delete" <?php if(isset($modification_request->action)) { if($modification_request->action == 'delete'){ echo 'selected'; } } ?>>Delete</option>			
									</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Content</label>
                                <div class="col-lg-10">
                                    <textarea name="content" class="form-control modify_req" placeholder="content" rows="4">{{ (isset($modification_request->content)) ? $modification_request->content : '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Reason</label>
                                <div class="col-lg-10">
                                    <textarea name="reason" class="form-control modify_req" placeholder="reason" rows="4">{{ (isset($modification_request->reason)) ? $modification_request->reason : '' }}</textarea>
                                </div>
                            </div>
                            
                            
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Score</label>
                                <div class="col-lg-10">

                                    <select name="score" class="form-control">
										<option value=""  <?php if(isset($modification_request->score)) { if($modification_request->score == '0'){ echo 'selected'; } }   ?>>0 </option>
										<option value="1" <?php if(isset($modification_request->score)) { if($modification_request->score == '1'){ echo 'selected'; } }   ?>>1 </option>
										<option value="2" <?php if(isset($modification_request->score)) { if($modification_request->score == '2'){ echo 'selected'; } }   ?>>2 </option>
										<option value="3" <?php if(isset($modification_request->score)) { if($modification_request->score == '3'){ echo 'selected'; } }   ?>>3 </option>
										<option value="4" <?php if(isset($modification_request->score)) { if($modification_request->score == '4'){ echo 'selected'; } }   ?>>4 </option>
										<option value="5" <?php if(isset($modification_request->score)) { if($modification_request->score == '5'){ echo 'selected'; } }   ?>>5 </option>
									</select>

                                </div>
                            </div>  -->                           
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Solved</label>
                                <div class="col-lg-10">
                                    <select name="solved" class="form-control modify_req solved">
											<option value="1" <?php if(isset($modification_request->solved)) { if($modification_request->solved == '1'){ echo 'selected'; } } ?>>Yes</option>
											<option value="0" <?php if(isset($modification_request->solved)) { if($modification_request->solved == '0'){ echo 'selected'; } } ?>>No</option>			
									</select>
                                </div>
                            </div> 

                            <div class="form-actions">
								<div class="row">
									<div class="col-md-offset-2 col-md-6">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="request_id" value="{{ (isset($modification_request->id)) ? $modification_request->id : '' }}">
										@if($modification_request->solved == '0')
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/modification-requests')}}">
											<button type="button" class="btn btn-default" name="cancel">Cancel</button>
										</a>
										@endif
										@if($modification_request->solved == '1')
										<a href="{{ url('admin/modification-requests')}}">
											<button type="button" class="btn btn-warning" name="cancel">Continue</button>
										</a>
										@endif
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
	$(document).ready(function(){
		var solved = $('select[name=\'solved\']').val();
		//alert(solved); 
		if(solved == 1){

			$('.modify_req').attr('disabled', true);
		}
		else{
			$('.modify_req').attr('disabled', true);
			$('.modify_req.solved').attr('disabled', false);
		}
	});
</script>
@endsection

