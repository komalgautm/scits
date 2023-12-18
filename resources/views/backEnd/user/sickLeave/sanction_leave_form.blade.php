@extends('backEnd.layouts.master')

@section('title',' Sanction Leaves')

@section('content')
<script type="text/javascript" src="{{url('public/backEnd/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('public/backEnd/css/select2.min.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{url('public/backEnd/css/jquery.datetimepicker.css')}}">
<script type="text/javascript" src="{{url('public/backEnd/js/jquerydatetimepicker.js')}}"></script> -->

 <section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    @include('backEnd.common.alert_messages')
                    <header class="panel-heading">
                        Sanction Sick Leave Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" method="post" action="{{ url('admin/user/sick-leave/sanction/'.$user_id)}}" id="sanction_leave_form">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Sanction Sick Leave</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="sanction_leave">
                                            <option value="">Sanction Sick Leave </option>
                                            <option value="A"<?php if(isset($sanction_sk_lv_info->status)){ if($sanction_sk_lv_info->status == 'A'){ echo "selected";}} ?>>Approve</option>
                                            <option value="R" <?php if(isset($sanction_sk_lv_info->status)){ if($sanction_sk_lv_info->status == 'R'){ echo "selected";}} ?>>Reject</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Home</label>
                                    <div class="col-lg-9">
                                        
                                        <select class="form-control js-example-basic-single sel_home"  name="home_id">
                                            <option value="">Select Home</option>
                                            @if(!empty($get_homes))
                                                @foreach($get_homes as $key => $value)
                                                    <option value="{{$value['id']}}"  <?php if(isset($sanction_sk_lv_info->home_id)){ if($sanction_sk_lv_info->home_id == $value['id']){ echo "selected";}} ?>>{{$value['title']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Login Date <i data-toggle="tooltip" title="Selected staff user will be able to login only dated {{ date('m/d/Y',strtotime($sick_leave_info['leave_date'])) }}" class="fa fa-info-circle"></i> </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="leave_date" readonly="" value="{{ isset($sick_leave_info['leave_date'])? date('m/d/Y',strtotime($sick_leave_info['leave_date'])) : '' }}">
                                    </div>
                                </div>
                                
                                <?php if(isset($sanction_sk_lv_info->staff_user_id)){
                                        $staff_user_id = $sanction_sk_lv_info->staff_user_id;

                                        $staff_name = App\User::where('id',$staff_user_id)
                                                            ->where('user_type','N')
                                                            ->where('is_deleted','0')
                                                            ->first();    
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Staff User</label>
                                    <div class="col-lg-9">
                                        <select class="form-control js-example-basic-single sel_usr" name="staff_user_id">
                                            <?php if(isset($staff_name)){ ?>
                                                <option value="{{$staff_name->id}}">{{$staff_name->name}}</option>
                                            <?php } else{ ?>
                                                <option value="">Select Staff User</option>
                                            <?php } ?>
                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Staff Rota </label>
                                    <div class="col-lg-9">
                                        <select class="form-control staff_shift" name="rota_shift_id">
                                            
                                            <?php if(isset($rota_shift->name)){ ?>
                                                <option value="{{$rota_shift->id}}">{{$rota_shift->name}} {{ ($rota_shift->start_time) }} - {{ ($rota_shift->end_time) }}</option>
                                            <?php } else{ ?>
                                                <option value="">Select Staff Rota</option>
                                            <?php } ?>
                                            
                                        </select>
                                        
                                        
                                    </div>
                                </div>
                                <div class="form-actions">
    								<div class="row">
                                     <div class="add-admin-btn-area">   
    									<div class="col-lg-offset-3 col-lg-10">
                                            <input type="hidden" name="sick_leave_id" value="{{ $u_sick_leave_id }}">
    										<input type="hidden" name="user_id" id="staf_user_id" value="{{ $user_id }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    										
    										<button type="submit" class="btn btn-primary save-btn">Save</button>
    										<a href="{{ url('admin/user/sick-leaves/'.$user_id) }}">
    											<button type="button" class="btn btn-default" name="cancel">Cancel</button>
    										</a>
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



<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    }); 
</script>

<script type="text/javascript">
    $(document).on('change','.sel_home',function(){
        var home_id = $(this).val();
        var user_id = $('#staf_user_id').val();
        // alert(user_id);
        $('.loader').show(); 
        $.ajax({
            type:'post',
            url : "{{ url('admin/user/sick-leave/user-list')}}"+'/'+home_id+'/'+user_id,
            success:function(resp){
                // console.log(resp);
                if(resp != ''){

                    $('.sel_usr').html(resp);
                }
            }
        });
        $('.loader').hide();
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        // var today = new Date();
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

        $('#date').datepicker({
            // autoclose: true,
            startDate: today
            // format: 'dd/mm/yyyy'
        });
        // $('#choose_date').datepicker({
        //     Number, String. Default: 0, “days”
        // });
        // var date = "{{ date('d-m-Y')}}";
        // console.log(date);
        // date.setDate(date.getDate());

        // $('#date').datepicker({ 
        //     currentDate : date,
        // });
    });

</script>

<script type="text/javascript">
    $(document).on('change','.sel_usr',function(){
        var sel_home_id        = $('select[name=home_id]').val();
        var sel_staff_user_id  = $('select[name=staff_user_id]').val();
        var sel_date           = $('input[name=date]').val();
        var _token             = "{{ csrf_token()}}";
        $('.loader').show();
        $.ajax({
            type:'post',
            url : "{{ url('admin/user/rota')}}",
            data : { 'sel_home_id' : sel_home_id, 'sel_staff_user_id': sel_staff_user_id ,'sel_date':sel_date,'_token':_token},
            success:function(resp){
                // console.log(resp);
                if(resp != ''){
                    $('.staff_shift').html(resp);
                }
            }
        });
        $('.loader').hide();
    });
</script>
@endsection