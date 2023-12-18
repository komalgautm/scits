@extends('backEnd.layouts.master')
@section('title',':DailyLog')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       View Daily Log
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="" enctype="">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Staff Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="" class="form-control" placeholder="Name" value="{{ (isset($log_info->name)) ? $log_info->name : '' }}" maxlength="255" id="staff_name" disabled="">
                                </div>
                            </div> 

                            <div class="form-group">
								<label class="col-lg-2 control-label">Title</label>
								<div class="col-lg-10">
								    <input type="text" name="" class="form-control" placeholder="" value="{{ (isset($log_info->title)) ? $log_info->title : '' }}" maxlength="255" id="staff_email" disabled="">
								</div>
							</div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Date</label>
                                <div class="col-lg-10">
                                    <input type="text" name="" class="form-control" placeholder="" value="{{ (isset($log_info->date)) ? date('d F Y', strtotime($log_info->date)) : '' }}" maxlength="" id="" disabled="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Details </label>
                                <div class="col-lg-10">
                                    <textarea name="" class="form-control" placeholder="Address" rows="4" maxlength="1000" disabled="">{{ (isset($log_info->details)) ? $log_info->details : '' }}</textarea>
                                </div>
                            </div>

                       	    <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
									    <a href="{{ url('admin/service-user/logbooks/'.$log_info->service_user_id) }}">
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
