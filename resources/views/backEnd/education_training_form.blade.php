@extends('backEnd.layouts.master')

@section('title',':Education Training')

@section('content')

<?php
	if(isset($edu_tr_rcrds))
	{
		$action = url('admin/education-training/edit/'.$edu_tr_rcrds->id);
		$task = "Edit";
		$form_id = 'edit_education_training_form';
	}
	else
	{
		$action = url('admin/education-training/add');
		$task = "Add";
		$form_id = 'add_education_training_form';
	}
?>
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Education/Training
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Description</label>
                                <div class="col-lg-9">
                                    <!-- <textarea name="description" class="form-control" placeholder="description" rows="2">{{ (isset($edu_tr_rcrds->description)) ? $edu_tr_rcrds->description : '' }}</textarea> -->

                                    <input type="text" name="description" value="{{ (isset($edu_tr_rcrds->description)) ? $edu_tr_rcrds->description : '' }}" class="form-control">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Score</label>
                                <div class="col-lg-10">

                                    <select name="score" class="form-control">
										<option value="" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '0'){ echo 'selected'; } }   ?>>0 </option>
										<option value="1" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '1'){ echo 'selected'; } }   ?>>1 </option>
										<option value="2" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '2'){ echo 'selected'; } }   ?>>2 </option>
										<option value="3" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '3'){ echo 'selected'; } }   ?>>3 </option>
										<option value="4" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '4'){ echo 'selected'; } }   ?>>4 </option>
										<option value="5" <?php if(isset($edu_tr_rcrds->score)) { if($edu_tr_rcrds->score == '5'){ echo 'selected'; } }   ?>>5 </option>
									</select>

                                </div>
                            </div>  -->                           
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Status</label>
                                <div class="col-lg-9">
                                    <select name="status" class="form-control">
											<option value="">Select Status</option>

											<option value="1" <?php if(isset($edu_tr_rcrds->status)) { if($edu_tr_rcrds->status == '1'){ echo 'selected'; } } ?>>Active
											</option>

											<option value="0" <?php if(isset($edu_tr_rcrds->status)) { if($edu_tr_rcrds->status == '0'){ echo 'selected'; } } ?>>Inactive
											</option>			
									</select>
                                </div>
                            </div>

                            <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-md-6">
								     <div class="add-admin-btn-area">		
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="edu_tr_id" value="{{ (isset($edu_tr_rcrds->id)) ? $edu_tr_rcrds->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/education-trainings')}}">
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

@endsection