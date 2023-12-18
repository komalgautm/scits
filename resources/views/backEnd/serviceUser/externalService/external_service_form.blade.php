@extends('backEnd.layouts.master')

@section('title',': External Service Form')

@section('content')

<?php
	if(isset($su_ext_service))
	{  
		$action = url('admin/service-user/external-service/edit/'.$su_ext_service->id);
		$task = "Edit";
		$form_id = 'edit_external_service_form';
	}
	else
	{
		$action = url('admin/service-user/external-service/add/'.$service_user_id);
		$task = "Add";
		$form_id = 'add_external_service_form';
	}
?>
 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       {{ $task }}  Service
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Company Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{ (isset($su_ext_service->company_name)) ? $su_ext_service->company_name : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Contact Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="contact_name" class="form-control" placeholder="Contact Name" value="{{ (isset($su_ext_service->contact_name)) ? $su_ext_service->contact_name : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ (isset($su_ext_service->email)) ? $su_ext_service->email : '' }}" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Phone No.</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone_no" class="form-control" placeholder="Phone Number" value="{{ (isset($su_ext_service->phone_no)) ? $su_ext_service->phone_no : '' }}" maxlength="60">
                                </div>
                            </div>

							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-3 col-lg-10">
                                     <div class="add-admin-btn-area">   
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/service-user/external-service/'.$service_user_id) }}">
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