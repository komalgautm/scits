@extends('backEnd.layouts.master')
@section('title',':LivingSkills')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       View Record
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="" enctype="">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Date</label>
                                <div class="col-lg-10">
                                    <input type="text" name="" class="form-control" placeholder="" value="{{ (isset($ls_info->created_at)) ? date('d F Y', strtotime($ls_info->created_at))  : '' }}" maxlength="255" id="staff_email" disabled="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" name="" class="form-control" placeholder="Name" value="{{ (isset($ls_info->description)) ? $ls_info->description : '' }}" maxlength="255" id="staff_name" disabled="">
                                </div>
                            </div> 

                            <div class="form-group">
								<label class="col-lg-2 control-label">Scored</label>
								<div class="col-lg-10">
								    <input type="text" name="" class="form-control" placeholder="" value="{{ (isset($ls_info->scored)) ? $ls_info->scored : '' }}" maxlength="255" id="staff_email" disabled="">
								</div>
							</div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Details </label>
                                <div class="col-lg-10">
                                    <textarea name="" class="form-control" placeholder="Details" rows="4" maxlength="1000" disabled="">{{ (isset($ls_info->details)) ? $ls_info->details : '' }}</textarea>
                                </div>
                            </div>

                       	    <div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
									    <a href="{{ URL::PREVIOUS() }}">
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
