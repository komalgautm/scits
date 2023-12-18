@extends('backEnd.layouts.master')

@section('title',' Service User Care History Form')

@section('content')

<!-- <script src="{{ url('public/backEnd/js/jquery.validate.min.js') }}"></script> -->
<style>
    .default-date-picker{
        background-color: #fff !important; 
    }
    .file-arrow {
      color: red;
    }
    .file-name-main {
      float: left;
      width: 100%;
    }
    .alert.alert-success.fade.in {
      float: right;
      width: 50%;
    }
    .alert.alert-error.fade.in {
      float: right;
      width: 50%;
    }
</style>

<!-- fancybox -->
<link rel="stylesheet" href="{{ url('public/frontEnd/css/fancy-box/jquery.fancybox.min.css') }}">
<script src="{{ url('public/frontEnd/css/fancy-box/jquery.fancybox.min.js') }}"></script>

<?php

	if(isset($su_care_history)) {
		$action = url('admin/service-users/care-history/edit/'.$su_care_history->id);
		$task = "Edit";
		$form_id = 'edit_service_users_care_history_form';

        $files  = App\ServiceUserCareHistoryFile::su_history_files($su_care_history->id);
        $files  = json_decode($files, true); 
	} else {
		$action = url('admin/service-users/care-history/add/'.$service_user_id);
		$task = "Add";
		$form_id = 'add_service_users_care_history_form';
        $files  = '';
	}
?>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    @include('backEnd.common.alert_messages')
                    <header class="panel-heading">
                        {{ $task }} Care History Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Title</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class="form-control" placeholder="title" value="{{ (isset($su_care_history->title)) ? $su_care_history->title : '' }}" maxlength="255">
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Date</label>
                                <div class="col-lg-9">
                                   <input class="form-control default-date-picker" type="text" value="{{ (isset($su_care_history->date)) ? date('d-m-Y',strtotime($su_care_history->date)) : date('d-m-Y') }}" placeholder="DD-MM-YYYY" name="date" maxlength="10" readonly="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> Details</label>
                                <div class="col-lg-9">
                                   <textarea class="form-control" name="description" placeholder="detail" rows="4">{{ (isset($su_care_history->description)) ? $su_care_history->description : '' }}</textarea>
                                </div>
                            </div> 
                            @if(!empty($files))
                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="margin-top:-5px">File</label>
                                <div class="col-lg-9">
                                    <div class="file-name-main">
                                        @foreach($files as $key => $value)
                                            <div class="row p-l-10">
                                            <a data-caption="150108039359745.png" data-fancybox="" class="file-name-a wrinkled" href="{{ suCareHistoryFilePath.'/'.$value['file'] }}">1{{ $value['file'] }}</a> 
                                            <a file_id="{{ $value['id'] }}" class="file-arrow delete" href="{{ url('admin/service-users/care-history/delete-file/'.$value['id']) }}">
                                            <span><i class="fa fa-times fa-fw"></i></span>
                                            </a>  
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="col-lg-3 control-label">File</label>
                                <div class="col-lg-9">
                                    <input type="file" multiple="multiple" val="" name="files[]" id="care_history_file">
                                </div>
                            </div>                            

                            <div class="form-actions">
								<div class="row">
                                 <div class="add-admin-btn-area">   
									<div class="col-lg-offset-3 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id" value="{{ (isset($su_care_history->id)) ? $su_care_history->id : '' }}">
										<button type="submit" class="btn btn-primary save-btn" name="submit1">Save</button>
										<a href="{{ url('admin/service-users/care-history/'.$service_user_id) }}">
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

<script>
    $(document).ready(function() {

        $('.default-date-picker').datepicker({
            //format: 'yyyy-mm-dd'
             format: 'dd-mm-yyyy',
            // maxDate:'+13-02-2017'
        });
    });
</script>

@endsection