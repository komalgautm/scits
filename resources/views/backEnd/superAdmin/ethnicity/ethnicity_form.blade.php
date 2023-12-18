@extends('backEnd.layouts.master')

@section('title',' Ethnicity Form')

@section('content')

<style type="text/css">
  
  .form-actions {
   margin:20px 0px 0px 0px;
  }

 .form-actions .btn.btn-primary {
  margin:0px 10px 0px 0px; 
 }
 
</style>

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                
                       <?php if(!isset($ethnicity)) {
                           echo 'Add';
                           $form_id =  'SuperAdminEthnicityAddForm';
                       } else {
                           echo 'Edit'; 
                           $form_id =  'SuperAdminEthnicityEditForm';
                       } ?>
                
                      Ethnicity
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="{{ $form_id }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ (isset($ethnicity->name)) ? $ethnicity->name : '' }}" maxlength="255">
                                </div>
                            </div>
                            
							<div class="form-actions">
								<div class="row">
									<div class="col-lg-offset-2 col-lg-10">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="user_id" value="{{ (isset($ethnicity->id)) ? $ethnicity->id : '' }}">
										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
										<a href="{{ url('super-admin/ethnicities') }}">
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