@extends('frontEnd.layouts.master')
@section('title','Welcome')
@section('content')

<style type="text/css">
	#welcom_form1 .form-group {
	  float: left;
	  width: 100%;
	}
	#welcom_form1 {
	  float: left;
	  margin: 30px 0 20px;
	  width: 100%;
	}
	.wrapper.page_ne {
	  display: inline-block;
	  height: calc(100vh - 152px);
	  margin-top: 80px;
	  padding: 60px 30px;
	  width: 100%;
	}

</style>
<section id="main-content" class="">
    <section class="wrapper page_ne">
        <div class="row">
			<div class="col-sm-8 col-sm-offset-2">
                <section class="panel">
                
                    <header class="panel-heading">
                       Welcome 
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="" role="form" method="post" action="{{ url('/agent/welcome') }}" id="welcom_form1">
                            
                            
		                        <div class="form-group m-t-60">
	                                <label class="col-sm-12 control-label">Selected Company</label>
	                                <div class="col-sm-12">
	                                    <select class=" form-control" name="company" disabled="">
	                                    	<option value="">Select Company</option>
	                                    	@foreach($all_companies as $key => $value)
												<option value="{{ $value['id']}}" <?php if(isset($company_id)){ if($company_id == $value['id']){ echo "selected";}} ?>>{{ $value['company']}}</option>
											@endforeach
											<option value="">xyz</option>
										</select>
	                                </div>
	                            </div>	
	                            <?php if(Auth::user()->home_id){
		                            	$home_ids = Auth::user()->home_id;
		                            } 
	                            
	                            ?>
	                            
	                          	<div class="form-group m-t-60">
									<label class="col-sm-12 control-label">Select Home</label>
									<div class="col-sm-12">
									    <select class="form-control" name="home_id">
											<option value="">Select Home</option>
									    	@foreach ($homes as $key => $value)
												<option value="{{$value['id']}}" <?php if(isset($home_ids)){ if($home_ids == $value['id']){ echo "selected";}}?>>{{$value['title']}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-actions"  style="margin-bottom:60px; ">
										<div class="col-sm-12 text-center">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											
											<button type="submit" class="btn btn-primary">Continue</button>
											<a href="{{ url('/') }}">
												<button type="button" class="btn btn-default" name="cancel">Cancel</button>
											</a>
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