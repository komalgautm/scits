@extends('backEnd.layouts.master')

@section('title',':MFC')

@section('content')

<?php
	if(isset($mfc_records))
	{
		$action = url('admin/mfc/edit/'.$mfc_records->id);
		$task = "Edit";
		$form_id = 'edit_mfc_form';
	}
	else
	{
		$action = url('admin/mfc/add');
		$task = "Add";
		$form_id = 'add_mfc_form';
	}
?>
<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  MFC
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <input type="text" name="description" class="form-control" placeholder="description" value="{{ (isset($mfc_records->description)) ? $mfc_records->description : '' }}" maxlength="255">
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
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <select name="status" class="form-control">
										<option value="">Select Status</option>

										<option value="1" <?php if(isset($mfc_records->status)) { if($mfc_records->status == '1'){ echo 'selected'; } } ?>>Active
										</option>

										<option value="0" <?php if(isset($mfc_records->status)) { if($mfc_records->status == '0'){ echo 'selected'; } } ?>>Inactive
										</option>			
									</select>
                                </div>
                            </div>

                            <div class="form-actions">
								<div class="row">
									<div class="col-md-offset-2 col-md-6">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="mfc_id" value="{{ (isset($mfc_records->id)) ? $mfc_records->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit2">Save</button>
										<a href="{{ url('admin/mfc-records') }}">
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