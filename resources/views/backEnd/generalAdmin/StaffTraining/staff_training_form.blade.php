@extends('backEnd.layouts.master')
@section('title',' View Training Form')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Staff Training
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ isset($training->training_name) ? $training->training_name : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Provider</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="name" value="{{ isset($training->training_provider) ? $training->training_provider : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Month</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="month" disabled="">
                                            <option value=""> Select Month</option>
                                            <option value="1"<?php if(isset($training->training_month)) { if($training->training_month == '1') { echo 'selected'; } } ?>> Jan</option>
                                            <option value="2"<?php if(isset($training->training_month)) { if($training->training_month == '2') { echo 'selected'; } } ?>> Feb </option>
                                            <option value="3"<?php if(isset($training->training_month)) { if($training->training_month == '3') { echo 'selected'; } } ?>> Mar </option>
                                            <option value="4"<?php if(isset($training->training_month)) { if($training->training_month == '4') { echo 'selected'; } } ?>> Apr </option>
                                            <option value="5"<?php if(isset($training->training_month)) { if($training->training_month == '5') { echo 'selected'; } } ?>> May </option>
                                            <option value="6"<?php if(isset($training->training_month)) { if($training->training_month == '6') { echo 'selected'; } } ?>> Jun </option>
                                            <option value="7"<?php if(isset($training->training_month)) { if($training->training_month == '7') { echo 'selected'; } } ?>> Jul </option>
                                            <option value="8"<?php if(isset($training->training_month)) { if($training->training_month == '8') { echo 'selected'; } } ?>> Aug </option>
                                            <option value="9"<?php if(isset($training->training_month)) { if($training->training_month == '9') { echo 'selected'; } } ?>> Sep </option>
                                            <option value="10"<?php if(isset($training->training_month)) { if($training->training_month == '10') { echo 'selected'; } } ?>> Oct </option>
                                            <option value="11"<?php if(isset($training->training_month)) { if($training->training_month == '11') { echo 'selected'; } } ?>> Nov </option>
                                            <option value="12"<?php if(isset($training->training_month)) { if($training->training_month == '12') { echo 'selected'; } } ?>> Dec </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Year</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="year" value="{{ isset($training->training_year) ? $training->training_year : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>
                            <?php if(!empty($active_training)) { ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Active Staff</label>
                                    <div class="col-lg-10">
                                        <div class="admin-name-list">
                                            <ul>
                                                @foreach($active_training as $key => $active)
                                                <li class="p_staff">{{ $active['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(!empty($completed_training)) { ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Completed Staff</label>
                                    <div class="col-lg-10">
                                        <div class="admin-name-list">
                                            <ul>
                                                <?php foreach($completed_training as $key => $completed) { ?>
                                                    <li class="p_staff">{{ $completed['name'] }}</li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(!empty($not_completed_training)) { ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Not Completed Staff</label>
                                    <div class="col-lg-10">
                                        <div class="admin-name-list">
                                            <ul>
                                                @foreach($not_completed_training as $key => $not_completed)
                                                    <li class="p_staff">{{ $not_completed['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                               
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <button type="submit" class="btn btn-primary" name="submit1">Save</button> -->
                                                <a href="{{ url('admin/general-admin/staff/training') }}">
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

@endsection