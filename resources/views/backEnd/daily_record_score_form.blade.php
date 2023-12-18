@extends('backEnd.layouts.master')

@section('title',':Daily Log')

@section('content')

<?php
	if(isset($dr_score))
	{
		$action = url('admin/daily-record-score/edit/'.$dr_score->id);
		$task = "Edit";
		$form_id = 'edit_daily_record_score_form';
	}
	/*else
	{
		$action = url('admin/daily-record/add');
		$task = "Add";
		$form_id = 'add_daily_record_form';
	}*/
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Log Score
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Score</label>
                                <div class="col-lg-10">
                                    <input type="text" name="score" class="form-control" placeholder="Score" value="{{ (isset($dr_score->score)) ? $dr_score->score : '' }}">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Score</label>
                                <div class="col-lg-9">

                                    <select name="score" class="form-control" disabled="disabled">
										<option value="" <?php if(isset($dr_score->score)) { if($dr_score->score == '0'){ echo 'selected'; } }   ?>>0 </option>
										<option value="1" <?php if(isset($dr_score->score)) { if($dr_score->score == '1'){ echo 'selected'; } }   ?>>1 </option>
										<option value="2" <?php if(isset($dr_score->score)) { if($dr_score->score == '2'){ echo 'selected'; } }   ?>>2 </option>
										<option value="3" <?php if(isset($dr_score->score)) { if($dr_score->score == '3'){ echo 'selected'; } }   ?>>3 </option>
										<option value="4" <?php if(isset($dr_score->score)) { if($dr_score->score == '4'){ echo 'selected'; } }   ?>>4 </option>
										<option value="5" <?php if(isset($dr_score->score)) { if($dr_score->score == '5'){ echo 'selected'; } }   ?>>5 </option>
									</select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Title</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class="form-control" placeholder="Score" value="{{ (isset($dr_score->title)) ? $dr_score->title : '' }}" maxlength="255">
                                </div>
                            </div>
                                                       
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <select name="status" class="form-control">
											
											<option value="">Select Status</option>
											<option value="1" <?php if(isset($dr_score->status)) { if($dr_score->status == '1'){ echo 'selected'; } }   ?>>Active
											</option>

											<option value="0" <?php if(isset($dr_score->status)) { if($dr_score->status == '0'){ echo 'selected'; } }   ?>>Inactive
											</option>			
									</select>
                                </div>
                            </div> --> 

                            <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-md-6">
                                     <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="dr_score_id" value="{{ (isset($dr_score->id)) ? $dr_score->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/daily-record-scores')}}">
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