@extends('backEnd.layouts.master')
@section('title',':Service User My Money Request')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
    		<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       View Money Request
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Amount</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="amount" class="form-control" placeholder="Name" value="{{ (isset($su_money_req->amount)) ? $su_money_req->amount : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Status</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="job_title_id" disabled="">
                                            <option value="0"<?php if(isset($su_money_req->status)) { if($su_money_req->status=='0') { echo "selected"; } } ?>>Pending</option>
                                            <option value="1"<?php if(isset($su_money_req->status)) { if($su_money_req->status=='1') { echo "selected"; } } ?>>Rejected</option>
                                            <option value="1"<?php if(isset($su_money_req->status)) { if($su_money_req->status=='2') { echo "selected"; } } ?>>Accepted</option>  
                                        </select>
                                    </div>
                                </div>
                                           
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Description </label>
                                    <div class="col-lg-10">
                                        <textarea name="address" class="form-control" placeholder="description" rows="4" maxlength="1000" readonly="">{{ (isset($su_money_req->description)) ? $su_money_req->description : '' }}</textarea>
                                    </div>
                                </div>

                                <?php if(!empty($su_money_req->provider_user_id)) { ?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">User</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" name="job_title_id" disabled="">
                                               @foreach($users as $key => $value)
                                                    <option value="{{ $value->id }}"<?php if($su_money_req->provider_user_id == $value->id) { echo "selected"; } ?>>{{ $value->name }}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Provide Comment </label>
                                        <div class="col-lg-10">
                                            <textarea name="address" class="form-control" placeholder="description" rows="4" maxlength="1000" readonly="">{{ (isset($su_money_req->provider_comment)) ? $su_money_req->provider_comment : '' }}</textarea>
                                        </div>
                                    </div>

                                <?php } ?>
                               

                           	    <div class="form-actions">
        							<div class="row">
        								<div class="col-lg-offset-2 col-lg-10">
        									<input type="hidden" name="_token" value="{{ csrf_token() }}">
        										<!-- <button type="submit" class="btn btn-primary" name="submit1">Save</button> -->
        									    <a href="{{ url('admin/service-user/my-money/request/'.$su_money_req->service_user_id) }}">
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
