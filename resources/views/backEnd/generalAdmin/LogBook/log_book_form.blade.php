@extends('backEnd.layouts.master')
@section('title',' View Log Book Form')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Log
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="Name" value="{{ isset($log_book->title) ? $log_book->title : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Date</label>
                                    <div class="col-lg-10">
                                        <?php if(isset($log_book)) {
                                            if(!empty($log_book->date)) {
                                                $date = date('d M, Y H:i', strtotime($log_book->date));
                                            } else {
                                                $date = '';
                                            }
                                        } ?>
                                        <input type="text" name="txn_amount" class="form-control" placeholder="Date" value="{{ $date }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Details</label>
                                    <div class="col-lg-10">
                                        <textarea name="details" class="form-control" placeholder="Details" readonly="">{{ isset($log_book->details) ? $log_book->details : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <button type="submit" class="btn btn-primary" name="submit1">Save</button> -->
                                                <a href="{{ url('admin/general-admin/log/book') }}">
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