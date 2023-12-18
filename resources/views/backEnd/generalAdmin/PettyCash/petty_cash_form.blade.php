@extends('backEnd.layouts.master')
@section('title',' View Petty Cash Form')
@section('content')

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Petty Cash
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="" id="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" class="form-control" placeholder="Name" value="{{ isset($petty_cash->title) ? $petty_cash->title : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Transaction Amount</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="txn_amount" class="form-control" placeholder="Transaction Amount" value="{{ isset($petty_cash->txn_amount) ? $petty_cash->txn_amount : '' }}" maxlength="255" readonly="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Transaction Type</label>
                                    <div class="col-lg-10">
                                        <select name="txn_type" class="form-control" disabled="">
                                            <option value="">Select Transaction Type</option>
                                            <option value="W" <?php if(isset($petty_cash->txn_type)) { if($petty_cash->txn_type == 'W'){ echo 'selected'; } }   ?>>WithDraw
                                            </option>
                                            <option value="D" <?php if(isset($petty_cash->txn_type)) { if($petty_cash->txn_type == 'D'){ echo 'selected'; } }   ?>>Deposit
                                            </option>           
                                        </select>
                                    </div>
                                </div>       

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Details</label>
                                    <div class="col-lg-10">
                                        <textarea name="details" class="form-control" placeholder="Transaction Amount" readonly="">{{ isset($petty_cash->details) ? $petty_cash->details : '' }}</textarea>
                                    </div>
                                </div>

                                <?php if(isset($petty_cash->receipt)) {
                                    if(empty($petty_cash->receipt)) {
                                        $file = '';   
                                        $file_name = 'No record found'; 
                                    } else {
                                        $file = pettyCashReceiptPath.'/'.$petty_cash->receipt;
                                        $file_name = $petty_cash->receipt; 
                                    }
                                ?>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Receipt</label>
                                    <div class="col-lg-10">
                                        <a class="wrinkled" href="{{ $file }}" target="_blank">{{ $file_name }}</a>
                                        <!-- <input type="text" name="txn_amount" class="form-control" placeholder="Receipt" value="{{ isset($petty_cash->receipt) ? $petty_cash->receipt : '' }}" maxlength="255" readonly=""> -->
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <button type="submit" class="btn btn-primary" name="submit1">Save</button> -->
                                                <a href="{{ url('admin/general-admin/petty/cash') }}">
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