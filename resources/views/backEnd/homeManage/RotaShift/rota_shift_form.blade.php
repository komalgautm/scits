@extends('backEnd.layouts.master')
@section('title',' Shift Form')
@section('content')
<!-- script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js" -->

<?php
    if(isset($shift_plan)) {

        $action = url('admin/home/rota-shift/edit/'.$shift_plan->id);
        $task = "Edit";
        $form_id = "edit_shift_plan";
    } else {
        
        $action = url('admin/home/rota-shift/add');
        $task = "Add";
        $form_id = "add_shift_plan";
    }
?>

<style type="text/css">
  .c-slected-value {
    border: 1px solid #ccc;
    cursor: pointer;
    float: left;
    line-height: 1.5;
    min-height: 34px;
    min-width: 40px;
    padding: 6px 30px 6px 15px;
    position: relative;
    width: 100%;
  }
  .option-li {
    cursor: pointer;
    display: block;
    float: left;
    padding: 8px 10px;
    text-align: left;
    width: 100%;
  }
  .custom-drop-dwon {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ccc;
    display: none;
    float: left;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 35px;
    width: 100%;
    z-index: 999;
  }
  .custom-select {
    float: left;
    position: relative;
    width: auto;
    margin-left: 16px;
  }
  .option-li:hover {
    background: #000;
    color: #fff;
  }
  .option-li.selected {
    background: #000 none repeat scroll 0 0;
    color: #fff;
    cursor: pointer;
  }
  .c-slected-value::after {
    content: "";
    font-family: FontAwesome;
    font-size: 18px;
    font-weight: bold;
    height: 30px;
    position: absolute;
    right: -6px;
    top: 4px;
    width: 30px;
  }
  .option-li .check-circle, .c-slected-value .check-circle {
    background: #000 none repeat scroll 0 0;
    border-radius: 100%;
    color: #fff;
    float: left;
    font-size: 11px;
    font-weight: lighter;
    height: 18px;
    line-height: 18px;
    margin-right: 5px;
    text-align: center;
    width: 18px;
  }

  .option-li .check-circle.labels, .c-slected-value .check-circle.labels
  {
   background: #A1A1A1 none repeat scroll 0 0;
  }
  .option-li .check-circle.primary, .c-slected-value .check-circle.primary
  {
   background: #59ACE2 none repeat scroll 0 0;
  }
  .option-li .check-circle.success, .c-slected-value .check-circle.success
  {
   background: #A9D86E none repeat scroll 0 0;
  }
  .option-li .check-circle.info, .c-slected-value .check-circle.info
  {
   background: #8175C7 none repeat scroll 0 0;
  }
  .option-li .check-circle.inverse, .c-slected-value .check-circle.inverse
  {
   background: #344860 none repeat scroll 0 0;
  }
  .option-li .check-circle.warning, .c-slected-value .check-circle.warning
  {
   background: #FCB322 none repeat scroll 0 0;
  }
  .option-li .check-circle.danger, .c-slected-value .check-circle.danger
  {
   background: #FF6C60 none repeat scroll 0 0;
  }
</style>


<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
			<div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $task }} Shift 
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form class="form-horizontal" role="form" method="post" action="{{ $action }}" id="{{ $form_id }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Shift</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ isset($shift_plan->name) ? $shift_plan->name : '' }}" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Start Time</label>
                                    <div class="col-lg-10">

                                        <select class="form-control e_start_time" name="start_time">
                                            @if($rota_time_format == '12')
                                            <option value="">Select Time</option>
                                            <?php 
                                                for ($i=1; $i <= 24; $i++) { 
                                                    if($i <= 12) { ?>
                                                        <option value="{{ $i }}" <?php if(isset($shift_plan->start_time)){ if($shift_plan->start_time == $i){ echo 'selected'; }} ?> >{{ $i }} am</option>
                                             <?php  } else { $time = $i-12; ?> 
                                                    <option value="{{ $i }}" <?php if(isset($shift_plan->start_time)){ if($shift_plan->start_time == $i){ echo 'selected'; } }  ?>>{{ $time }} pm</option>
                                            <?php }} ?>
                                            @endif
                                            @if($rota_time_format == '24')
                                            <option value="">Select Time</option>
                                            <?php 
                                                for ($i=1; $i <= 24; $i++) { ?>
                                                    <option value="{{ $i }}" <?php if(isset($shift_plan->start_time)){ if($shift_plan->start_time == $i){ echo 'selected'; }} ?> >{{ $i }}</option>
                                             
                                            <?php } ?>
                                            @endif
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">End Time</label>
                                    <div class="col-lg-10">

                                        <?php //if(isset($shift_plan->end_time)) {?>
                                            <select class="form-control e_end_time" name="end_time">
                                                @if($rota_time_format == '12')
                                                <option value="">Select Time</option>
                                                <?php 
                                                    for ($i=1; $i <= 24; $i++) { 
                                                        if($i <= 12) { ?>
                                                            <option value="{{ $i }}" <?php if(isset($shift_plan->end_time)) { if($shift_plan->end_time == $i){ echo 'selected'; }} ?> >{{ $i }} am</option>
                                                 <?php  } else { $time = $i-12; ?> 
                                                <option value="{{ $i }}" <?php if(isset($shift_plan->end_time)) { if($shift_plan->end_time == $i){ echo 'selected'; }} ?>>{{ $time }} pm</option>
                                                <?php } } ?>
                                                @endif
                                                @if($rota_time_format == '24')
                                                <option value="">Select Time</option>
                                                <?php 
                                                    for ($i=1; $i <= 24; $i++) { ?>
                                                        <option value="{{ $i }}" <?php if(isset($shift_plan->end_time)) { if($shift_plan->end_time == $i){ echo 'selected'; }} ?> >{{ $i }}</option>
                                                 <?php  } ?>
                                                @endif
                                            </select>
                                        <?php //} else {?> 
                                            <!-- <select class="form-control e_end_time" name="end_time">
                                                <option value="">Select Time</option> -->
                                                <!-- end date option comes dyamic -->

                                            <!-- </select> -->
                                        <?php //} ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Color</label>
                                    <div class="custom-select">
                                        <span class="c-slected-value">
                                            <i class="check-circle {{ (isset($shift_plan->color)) ? $shift_plan->color : 'labels' }}">
                                        </span>
                                        <ul class="custom-drop-dwon">
                                            <li class="option-li status-color" color_id="1" ><i class="check-circle labels"></i> </li>
                                            <li class="option-li status-color" color_id="2" ><i class="check-circle primary"></i> </li>
                                            <li class="option-li status-color" color_id="3" ><i class="check-circle success"></i> </li>
                                            <li class="option-li status-color" color_id="4" ><i class="check-circle info"></i> </li>
                                            <li class="option-li status-color" color_id="5" ><i class="check-circle inverse"></i> </li>
                                            <li class="option-li status-color" color_id="6" ><i class="check-circle warning"></i> </li>
                                            <li class="option-li status-color" color_id="7" ><i class="check-circle danger"></i> </li>
                                        </ul>
                                    </div>
                                </div>
    							<div class="form-actions">
    								<div class="row">
    									<div class="col-lg-offset-2 col-lg-10">
    										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="shift_color_id" value="{{ (isset($shift_plan->rota_shift_color_id)) ? $shift_plan->rota_shift_color_id : '1' }}" id="rota_shift_color">
                                            <input type="hidden" name="id" value="{{ (isset($shift_plan->id)) ? $shift_plan->id : '' }}">
    										<button type="submit" class="btn btn-primary" name="submit1">Save</button>
    										<a href="{{ url('admin/home/rota-shift') }}">
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

<script>
    $(document).ready(function(){
        $('.status-color').click(function(){
            var color_id = $(this).attr('color_id');
            $('#rota_shift_color').val(color_id);
        });
    });
</script>

<script>
  $(document).ready(function(){
    $('.c-slected-value').on('click',function(){
      $('.custom-drop-dwon').slideToggle(100);
    });
    $('.option-li').on('click', function()
    {                 
     var selctd_val = $(this).html();      
     $(".c-slected-value").html(selctd_val);
      //alert(selctd_val)
     $('.custom-drop-dwon').hide();
    });

    $('.custom-drop-dwon').click(function(event){
        event.stopPropagation();
        });

      $('.c-slected-value').click(function(event){
          event.stopPropagation();
      });
      $('body').on('click',function(){
        $('.custom-drop-dwon').hide();
        });
  });
</script>

<script>
    //for making sure end time should not be less than start time
    // $(document).on('change','.e_start_time',function(){
    //     var start_time = $(this).val();
    //     var content = '';
    //     for (var i=1; i<=24; i++) { 
            
    //         if(i < start_time) {
    //             disabled = 'disabled';
    //         }else {
    //             disabled = '';
    //         }
    //         // content += '<option value="">Select Time</option>';
    //         if(i<=12) { 
                
    //             content += '<option value="'+ i +'" '+disabled+'>'+ i +' am</option>';
    //         } else { 
    //             var time = i-12;
    //             content += '<option value="'+ i +'" '+disabled+'>'+ time +' pm</option>';
    //         }
    //     }
    //     $('.e_end_time').html(content);
    // });           
</script>

@endsection