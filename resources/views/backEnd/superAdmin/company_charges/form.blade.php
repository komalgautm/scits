@extends('backEnd.layouts.master')
@section('title',' Edit Company Charges')
@section('content')

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    @include('backEnd.common.alert_messages')
                    <header class="panel-heading">
                       Edit Company Charges
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ url('admin/company-charge/edit').'/'.$company_charge['0']['id'] }}" id="edit_company_charge" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Package Type</label>
                                    <div class="col-lg-9">
                                        <?php if($company_charge['0']['package_type'] == 'S'){ $package_type = "Silver"; }elseif($company_charge['0']['package_type'] == 'G'){ $package_type = "Gold";}elseif($company_charge['0']['package_type'] == 'P'){ $package_type = "Platinum";}elseif ($company_charge['0']['package_type'] == 'F') { $package_type = "Free Trial"; } ?>
                                        <input type="text" name="package_type" id="package_type" class="form-control" placeholder="Package Type" value="{{ $package_type }}" maxlength="255" disabled="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Range Start</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="start_range" id="start_range" class="form-control" placeholder="Range Start" value="{{ isset($start_range)? $start_range : '' }}" maxlength="8">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Range End</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="end_range" id="end_range" class="form-control" placeholder="Range End" value="{{ isset($end_range)? $end_range : '' }}" maxlength="8">
                                    </div>
                                </div>
                                <?php if($company_charge['0']['package_type'] == 'F'){ ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Trial Period (in days)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="days" class="form-control" placeholder="Trial Period" value="{{ isset($company_charge['0']['days'])? $company_charge['0']['days'] : ''}}" maxlength="8">
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Monthly Price(£)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="price_monthly" class="form-control" placeholder="Monthly Price" value="{{ isset($company_charge['0']['price_monthly'])? $company_charge['0']['price_monthly'] : ''}}" maxlength="8">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Yearly Price(£)</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="price_yearly" class="form-control" placeholder="Yearly Price" value="{{ isset($company_charge['0']['price_yearly'])? $company_charge['0']['price_yearly'] : ''}}" maxlength="8">
                                    </div>
                                </div>
                                <?php } ?>                          
    							<div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-3 col-lg-10">
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="previous_range" id="previous_range" value="{{ $previous_range }}">
    										<button type="submit" class="btn btn-primary">Save</button>
    										<a href="{{ url('admin/company-charges') }}">
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