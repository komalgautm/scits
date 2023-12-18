@extends('backEnd.layouts.master')

@section('title',':Job Title Form')

@section('content')

<?php
	if(isset($job_title))
	{
		$action = url('admin/care-team-job-title/edit/'.$job_title->id);
		$task = "Edit";
		$form_id = 'edit_job_title_form';
	}
	else
	{
		$action = url('admin/care-team-job-title/add');
		$task = "Add";
		$form_id = 'add_job_title_form';
	}
?>

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Job Title
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                        
                        <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                             
                            <!-- Input Field -->
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Job Title</label>
                                <div class="col-lg-7">
                                    <input type="text" name="title" class="form-control" placeholder="job title" value="{{ (isset($job_title->title)) ? $job_title->title : '' }}">
                                </div> 
                                <div class="col-lg-3">
                                	<span title="If social worker (capitalised) is not entered then the YP app complaint process will not work correctly." data-placement="bottom" data-toggle="tooltip" class="btn tooltips tooltip_mseg" type="button"><i class="fa fa-info"></i>
                                	</span>
                                </div>
                            </div>                            

							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="job_title_id" value="{{ (isset($job_title->id)) ? $job_title->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/care-team-job-titles') }}">
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