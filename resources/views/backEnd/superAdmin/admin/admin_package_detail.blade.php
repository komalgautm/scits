@extends('backEnd.layouts.master')

@section('title',' System Admin Package Detail')

@section('content')


 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       Admin Current Package Detail
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ url('admin/system-admin/package/detail/'.$system_admin_id)}}" id="package_detail_info">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Package Name</label>
                                <div class="col-lg-10">
                                    <?php if(isset($package_detail)){ 
                                            if($package_detail->package_type == 'F'){
                                                $package_name = 'Free Trail';
                                            } elseif ($package_detail->package_type == 'S') {
                                                $package_name = 'Silver';
                                            } elseif ($package_detail->package_type == 'G') {
                                                $package_name = 'Gold';
                                            } else{
                                                $package_name = 'Platinum';
                                            }
                                        }

                                        ?>
                                    <input type="text" name="name" class="form-control" placeholder="Package Name" value="{{ $package_name }}" maxlength="255" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Home Range</label>
                                <div class="col-lg-10">
                                    <input type="text" name="user_name" class="form-control" placeholder="Home Range" value="{{ isset($last_range)? $last_range : ''}}"  maxlength="255" disabled="">
                                </div>
                            </div>   
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ (isset($system_admins->password)) ? $system_admins->password : '' }}" >
                                </div>
                            </div>         -->                   
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Amount</label>
                                <div class="col-lg-10">
                                    <input type="text" name="email" class="form-control" placeholder="Amount" value="£ {{ isset($paid_amount)? $paid_amount : '0'}}" maxlength="255" disabled="">
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Expiry Date</label>
                                <div class="col-lg-10">
                                    <input type="text" name="company" class="form-control" placeholder="Expiry Date" value="{{ isset($package_detail->expiry_date)? date('d M, Y',strtotime($package_detail->expiry_date)) : ''}}" maxlength="255" disabled="">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Add Extra Day</label>
                                <div class="col-lg-10">
                                    <input type="text" name="extra_day" class="form-control" placeholder="Add Extra Day" value="" maxlength="2">
                                </div>
                            </div> 

                            
                            
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="system_admin_id" value="{{ $system_admin_id }}">
										<input type="hidden" name="company_charges_id" value="{{ $package_detail->id }}">
										
										<button type="submit" class="btn btn-primary">Save</button>
                                        
										<a href="{{ url('admin/system-admins') }}">
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

