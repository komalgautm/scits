@extends('backEnd.layouts.master')

@section('title',':Independent Living Skills')

@section('content')

<?php
	if(isset($living_skill_info))
	{
		$action = url('admin/living-skill/edit/'.$living_skill_info->id);
		$task = "Edit";
		$form_id = 'edit_living_skill_form';
	}
	else
	{
		$action = url('admin/living-skill/add');
		$task = "Add";
		$form_id = 'add_living_skill_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Skill
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Description</label>
                                <div class="col-lg-9">
                                    <input type="text" name="description" class="form-control" placeholder="description" value="{{ (isset($living_skill_info->description)) ? $living_skill_info->description : '' }}" maxlength="255">
                                </div>
                            </div>                                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Status</label>
                                <div class="col-lg-9">
                                    <select name="status" class="form-control">
											<option value="">Select Status</option>

											<option value="1" <?php if(isset($living_skill_info->status)) { if($living_skill_info->status == '1'){ echo 'selected'; } }   ?>>Active
											</option>

											<option value="0" <?php if(isset($living_skill_info->status)) { if($living_skill_info->status == '0'){ echo 'selected'; } }   ?>>Inactive
											</option>			
									</select>
                                </div>
                            </div> 

                            <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-md-6">
								     <div class="add-admin-btn-area">		
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="skill_id" value="{{ (isset($living_skill_info->id)) ? $living_skill_info->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/living-skill')}}">
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