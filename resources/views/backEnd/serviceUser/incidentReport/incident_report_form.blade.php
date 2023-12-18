@extends('backEnd.layouts.master')

@section('title',' Incident Report')

@section('content')

<?php
	if(isset($incident_report))
	{
		$action = url('admin/service-user/incident/edit/'.$incident_report->id);
		$task = "Edit";
		$form_id = 'edit_incident_form';
        // $service_user_id = $incident_report->service_user_id;
	}
	else
	{
		$action = url('admin/service-user/incident/add/'.$service_user_id);
		$task = "Add";
		$form_id = 'add_incident_form';
	}
?>
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Incident
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-10 col-xs-11">
                                    <input type="text" name="title" class="form-control" placeholder="title" value="{{ (isset($incident_report->title)) ? $incident_report->title : '' }}">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Score</label>
                                <div class="col-lg-10">

                                    <select name="score" class="form-control">
										<option value="" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '0'){ echo 'selected'; } }   ?>>0 </option>
										<option value="1" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '1'){ echo 'selected'; } }   ?>>1 </option>
										<option value="2" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '2'){ echo 'selected'; } }   ?>>2 </option>
										<option value="3" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '3'){ echo 'selected'; } }   ?>>3 </option>
										<option value="4" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '4'){ echo 'selected'; } }   ?>>4 </option>
										<option value="5" <?php if(isset($mfc_records->score)) { if($mfc_records->score == '5'){ echo 'selected'; } }   ?>>5 </option>
									</select>

                                </div>
                            </div>  --> 

                            <div class="dynamic-incident-form-fields">
                                {!! $form_pattern['incident_report'] !!}
                            </div>
                            
                            <!-- <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 control-label"> date: </label>
                                <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                    <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date="" class="input-group date dpYears">
                                        <input name="formdata[date]" readonly="" value="" size="16" class="form-control" type="text">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary add-on" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-actions">
								<div class="row">
									<div class="col-md-offset-2 col-md-6">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="inc_rep_id" value="{{ (isset($mfc_records->id)) ? $mfc_records->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/service-user/incident-reports/'.$service_user_id) }}">
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
    $(document).ready(function(){
        //alert(1);
        //e.preventDefault();
        $('.dpYears').datepicker();
    });

    
</script>

@endsection