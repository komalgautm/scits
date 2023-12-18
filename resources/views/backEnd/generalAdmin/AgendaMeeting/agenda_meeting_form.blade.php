@extends('backEnd.layouts.master')
@section('title',' View Meeting Form')
@section('content')
<!-- script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js" -->

<!-- <link rel="stylesheet" href="{{ url('public/backEnd/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ url('public/backEnd/js/select2.min.js') }}" /> -->

<?php
    if(isset($meeting)) {

        // $action = url('admin/home/rota-shift/edit/'.$meeting->id);
        $task = "View";
        // $form_id = "edit_shift_plan";
    } 
    // else {
        
    //     $action = url('admin/home/rota-shift/add');
    //     $task = "Add";
    //     $form_id = "add_shift_plan";
    // }
?>

<style type="text/css">

    /*.stf_select .error {
        margin-top:32px;
        position:absolute;
    }
    .selection .select2-selection--multiple .select2-selection__rendered .select2-search .select2-search__field {
        width:100% !important;
    }*/

</style>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Meeting
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ isset($meeting->title) ? $meeting->title : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Staff Present</label>
                                    <div class="col-lg-10">
                                        <div class="admin-name-list">
                                            <ul>
                                                <?php foreach ($present_users as $key => $present_user) { ?>
                                                <li class="p_staff">{{ ucfirst($present_user['name']) }}</li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Staff Absent</label>
                                    <div class="col-lg-10">
                                        <div class="admin-name-list">
                                            <ul>
                                                <?php foreach ($not_present_users as $key => $not_present_user) { ?>
                                                    <li class="p_staff">{{ ucfirst($not_present_user['name']) }}</li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Notes</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" readonly="" rows="4">{{ isset($meeting->notes) ? $meeting->notes : '' }}"</textarea>
                                    </div>
                                </div>

                                <!--  <div class="form-group">
                                    <label class="col-lg-2 control-label">Staff Present</label>
                                    <div class="col-lg-10">
                                        <select class="form-control select-present-user"  multiple="multiple" id="records_list" style="width:100%;" name="attended_user_ids[]">
                                                <option value=""></option>  
                                        </select>
                                    </div>
                                </div>  -->


                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Staff Present</label>
                                    <div class="col-md-9 col-sm-11 col-xs-12">
                                        <div class="col-lg-10">
                                            <select class="select-present-user form-control users_list" multiple="multiple" id="records_list" style="width:100%;" name="attended_user_ids[]">
                                                <option value=""></option>
   
                                            </select>
                                        </div>
                                    </div>
                                </div>     -->    

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <button type="submit" class="btn btn-primary" name="submit1">Save</button> -->
                                                <a href="{{ url('admin/general-admin/agenda/meetings') }}">
                                                    <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
	</section>
</section>						

<script>
    $(document).ready(function(){

        // $(".select-present-user").select2({
        //       // dropdownParent: $('#AgendaMeetingModal'),
        //       placeholder: "Select User"
        // });
        // $(".select-absent-user").select2({
        //       dropdownParent: $('#MeetingAgendaEdit'),
        //       placeholder: "Select User"
        // });
    });
</script>

@endsection