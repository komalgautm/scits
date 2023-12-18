@extends('backEnd.layouts.master')

@section('title',':Access Level Form')

@section('content')

<?php
	if(isset($access_name))
	{
		$action  = url('admin/home/access-level/edit/'.$access_name->id);
		$task    = "Edit";
		$form_id = 'edit_access_name_form';
	}
	else
	{
		$action  = url('admin/home/access-level/add');
		$task    = "Add";
		$form_id = 'add_access_name_form';
	}
?>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }} Name
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                        
                        <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                             
                            <!-- Input Field -->
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ (isset($access_name->name)) ? $access_name->name : '' }}">
                                </div>
                            </div>                            

							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="access_level_right_id" value="{{ (isset($access_name->id)) ? $access_name->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('admin/home/access-levels') }}">
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