@extends('backEnd.layouts.master')

@section('title',' Migration Request')

@section('content')

<style type="text/css">
.btn.btn-default.continue {
background-color: #1fb5ad;
border-color: #1fb5ad;
color: #fff;
}

.btn.btn-default.continue:hover {
background-color: #1ca59e;
border-color: #1ca59e;    
}

</style>

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       Service user migaration
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" method="post" action="{{ url('/super-admin/migration/update') }}" id="sup_migration_update">
                           
                                <div class="form-group ">
                                    <label class="col-lg-2 control-label">From (Company)</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft"> </label> -->
                                    <div class="col-lg-10">
                                        <input type="text" value="{{ ucfirst($migration->pre_company) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-2 control-label">From (Home)</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft"></label> -->
                                    <div class="col-lg-10">
                                        <input type="text" value="{{ ucfirst($migration->pre_home_name) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">To (Company)</label>
                                    <div class="col-lg-10">
                                        <input type="text" value="{{ ucfirst($migration->new_company) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">To (Home)</label>
                                    <div class="col-lg-10">
                                        <input type="text" value="{{ ucfirst($migration->new_home_name) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Reason</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="reason" rows="5" disabled="" }} maxlength="1000">{{ (isset($migration->reason)) ? $migration->reason:'' }}</textarea>
                                    </div>
                                </div>
                                            
                                <?php
                                    $status = $migration->status;
                                    if($status == 'P'){
                                        $show_status = 'Pending';
                                    } else if($status == 'C'){
                                        $show_status = 'Cancelled';
                                    } else if($status == 'A'){
                                        $show_status = 'Accepted';
                                    } else if($status == 'R'){
                                        $show_status = 'Rejected';
                                    } else{
                                        $show_status = '';                                            
                                    }
                                ?>
                                <div class="form-group ">
                                    <label class="col-lg-2 control-label">Status</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft">{{ $show_status }}</label> -->
                                    <div class="col-lg-10">
                                        <input class="form-control" disabled="" value="{{ $show_status }}" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Date requested</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" {{ (isset($migration)) ? 'disabled':'' }} value="{{ (isset($migration->created_at)) ? date('d-m-Y g:i a', strtotime($migration->created_at)):'' }}" >
                                    </div>
                                </div>
                                
                                <?php 
                                    if($migration->created_at == $migration->updated_at) { 
                                        $mig_date = '';
                                    }else{
                                        $mig_date = date('d-m-Y g:i a', strtotime($migration->updated_at));
                                    }
                                ?>

                                <?php if( ($status == 'A') || ($status == 'R') ) { ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Date updated</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" {{ (isset($migration)) ? 'disabled':'' }} value="{{ $mig_date }}" maxlength="255">
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if($status == 'P') {
                                    $reply_disable = '';
                                }else{
                                    $reply_disable = 'disabled';
                                } ?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Admin Reply</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="reply" rows="5" {{ $reply_disable }} maxlength="1000">{{ (isset($migration->reply)) ? $migration->reply:'' }}</textarea>
                                    </div>
                                </div>
                                <?php //} ?>
                                
                                <?php if($status == 'P') { //pending ?>                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Action</label>
                                    <div class="col-lg-10">
                                        <select name="new_status" class="form-control">
                                            <option value="">Select Action</option>
                                            <option value="A">Accepted</option>
                                            <option value="R">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>

    							<div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-2 col-lg-10">
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
    										<input type="hidden" name="migration_id" value="{{ $migration->id }}">

                                            <?php if($status == 'P') { ?>
                                                <button type="submit" class="btn btn-primary" name="submit1">Confirm</button>
                                                <a href="{{ url('/super-admin/migrations') }}">
                                                    <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                                </a>
                                            <?php } else {?>
                                                <a href="{{ url('/super-admin/migrations') }}">
                                                    <button type="button" class="btn btn-default continue" name="submit1">Continue
                                                    </button>
                                                </a>
                                            <?php } ?>

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