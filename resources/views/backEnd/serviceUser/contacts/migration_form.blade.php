@extends('backEnd.layouts.master')

@section('title',' Migration Form Service User')

@section('content')
<?php //echo '<pre>'; print_r($migration); die; ?>
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
                            <form class="form-horizontal" role="form" method="post" action="{{ url('admin/service-users/migration/send-request') }}" id="send_migration_request_form">
                           
                                <div class="form-group ">
                                    <label class="col-lg-3 control-label">From (Company)</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft"></label> -->
                                    <div class="col-lg-9">
                                        <?php if(isset($migration)) {
                                                $company = $migration->pre_company;
                                                $home    = $migration->pre_home_name;
                                            } else {
                                                //$company = Session::get('scitsAdminSession')->company;
                                                $company = $pre_company_name;
                                                $home    = $home_name;
                                            }
                                         ?>

                                        <input type="text" value="{{ ucfirst($company) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-3 control-label">From (Home)</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft"></label> -->
                                    <div class="col-lg-9">
                                        <input type="text" value="{{ ucfirst($home) }}" disabled="" class="form-control" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">To (Company)</label>
                                    <div class="col-lg-9">
                                        <?php if(isset($migration)) { ?>
                                            <input type="text" value="{{ ucfirst($migration->new_company) }}" disabled="" class="form-control">
                                        <?php } else { ?>
                                            <select name="company" class="form-control">
                                                <option value="">Select Company</option>
                                                @foreach($companies as $value)
                                                <option value="{{ $value['id'] }}" <?php if(isset($migration->new_home_id)) { if($migration->new_home_id == $value['id'] ) { echo 'selected'; } } ?> >{{ ucfirst($value['company']) }}</option>
                                                @endforeach
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">To (Home)</label>
                                    <div class="col-lg-9">
                                        <?php if(isset($migration)) { ?>
                                            <input type="text" value="{{ ucfirst($migration->new_home_name) }}" disabled="" class="form-control" maxlength="255">
                                        <?php } else { ?>
                                            <select name="new_home_id" class="form-control">
                                                <option value="">Select Home</option>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Reason</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="reason" rows="5" {{ (isset($migration)) ? 'disabled':'' }} maxlength="1000">{{ (isset($migration->reason)) ? $migration->reason:'' }}</textarea>
                                    </div>
                                </div>
                                            
                                <?php
                                if(isset($migration->status)){

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
                                    <label class="col-lg-3 control-label">Status</label>
                                    <!-- <label class="col-lg-10 col-sm-9 control-label text-lft">{{ $show_status }}</label> -->
                                    <div class="col-lg-9">
                                        <select name="new_home_id" class="form-control" {{ (isset($migration)) ? 'disabled':'' }}>
                                            <option value="" >{{ $show_status }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Date requested</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" {{ (isset($migration)) ? 'disabled':'' }} value="{{ (isset($migration->created_at)) ? date('d-m-Y g:i a', strtotime($migration->created_at)):'' }}" maxlength="255">
                                    </div>
                                </div>
                                
                                <?php if( ($status == 'A') || ($status == 'R') ) { ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Date updated</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" {{ (isset($migration)) ? 'disabled':'' }} value="{{ (isset($migration->updated_at)) ? date('d-m-Y g:i a', strtotime($migration->updated_at)):'' }}" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Admin Reply</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="reason" rows="5" {{ (isset($migration)) ? 'disabled':'' }} maxlength="1000">{{ (isset($migration->reply)) ? $migration->reply:'' }}</textarea>
                                    </div>
                                </div>
                                <?php } } ?>

    							<div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-3 col-lg-10">
                                         <div class="add-admin-btn-area">   
                                            @if(!isset($migration->reason))
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
    										<input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
    										<button type="submit" class="btn btn-primary save-btn" name="submit1">Send Request</button>
    										<a href="{{ url('/admin/service-users/migrations/'.$service_user_id) }}">
    											<button type="button" class="btn btn-default" name="cancel">Cancel</button>
    										</a>
                                            @else
                                            @if($migration->status == 'P')
                                            <a href="{{ url('/admin/service-users/migration/cancel-request/'.$migration->id) }}" class="cancel-req-btn">
                                                <button type="button" class="btn btn-danger">Cancel Request</button>
                                            </a>
                                            @endif
                                            <a href="{{ url('/admin/service-users/migrations/'.$service_user_id) }}">
                                                <button type="button" class="btn btn-default" name="submit1">Continue</button>
                                            </a>
                                            @endif
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
    $(document).ready(function()
    {   
        $('select[name=\'company\']').val('');
        
        $('select[name=\'company\']').change(function(event)
        { 
            var company = $(this).val(); 
            if(company == ''){
            //$('.company_error').html('<label for="company_name" generated="true" class="error">This field is required.</label>');
            return false;
            } else{
            //$('.company_error').html('');
            }

            $('.loader').show();
            $.ajax({
                type: 'get',
                url : "{{ url('/admin/migration/get-company') }}"+'/'+company,
                success:function(resp)
                {   
                    $('select[name=\'new_home_id\'] option').remove();
                    $('select[name=\'new_home_id\']').append('<option value="">Select Home</option>'+resp);
                    $('.loader').hide();        
                }
            });
    });
});
</script>
<script>
    $('.cancel-req-btn').click(function(){
        if(confirm('Do you really want to cancel the migration request ?')){
            return true;
        } else{
            return false;
        }
    });
</script>

@endsection