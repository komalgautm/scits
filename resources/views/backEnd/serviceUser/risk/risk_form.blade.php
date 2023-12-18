@extends('backEnd.layouts.master')
@section('title',':Risk Form')
@section('content')

<style type="text/css">
    #d_risk_view_form .btn.btn-default {
        margin-left: 54px;
    } 
    #d_risk_view_form .form-control {
        /*pointer-events: none;*/
        background: #EEEEEE; 
    } 
    #d_risk_view_form .input-group-btn.add-on {
        pointer-events: none;
    }
</style>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       View Form
                    </header>
                    <div class="panel-body">
                        <form method="post" action="" id="d_risk_view_form"> 
                            <div class="position-center dynamic-form-width">
                                {!! $result !!}
                                <div class="form-group">
                                    <div class="row pad-0-left">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <a href="{{ url('admin/service-user/risks/'.$service_user_id) }}">
                                                <button type="button" class="btn btn-default" name="cancel">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
	</section>
</section>

@endsection
