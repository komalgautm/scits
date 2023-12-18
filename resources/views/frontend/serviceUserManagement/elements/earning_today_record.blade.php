<!-- Today Daily Record Modal -->
<div class="modal fade" id="todayDailyrecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['daily_record'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <div class="recent-task-sec">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Today Tasks
                                </h3>       
                            </div>  
                        </div>
                    <form method="post" action="" id="record_form">
                        <div class="service-user-earning-record modal-space ">
                        <?php  foreach($su_daily_record as $key => $value) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                                <div class="form-group col-md-3 col-sm-3 col-xs-6 p-0">
                                    <label class="col-md-6 col-sm-6 col-xs-6 p-t-7 r-p-0"> Score: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6 p-0">
                                        <div class="select-style small-select">
                                            <select name="" class="sel" disabled="">
                                                <option value="">{{ $value->scored }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9 col-sm-9 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <input name="" class="form-control cus-control" disabled="" value="{{ $value->description }}" type="text" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>

                        </div>
                            
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-warning" type="button" data-dismiss="modal" aria-hidden="true"> Continue </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Today Daily Record Modal End -->

<!-- Today Independent Living Skills Modal -->
<div class="modal fade" id="todaySkillrecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['living_skill'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <div class="recent-task-sec">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Today Tasks
                                </h3>       
                            </div>  
                        </div>
                    <form method="post" action="" id="record_form">
                        <div class="service-user-earning-record modal-space ">
                        <?php  foreach($su_living_skill as $key => $value) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                                <div class="form-group col-md-3 col-sm-3 col-xs-6 p-0">
                                    <label class="col-md-6 col-sm-6 col-xs-6 p-t-7 r-p-0"> Score: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6 p-0">
                                        <div class="select-style small-select">
                                            <select name="" class="sel" disabled="">
                                                <option value="">{{ $value->scored }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9 col-sm-9 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <input name="" class="form-control cus-control" disabled="" value="{{ $value->description }}" type="text" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>

                        </div>
                            
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-warning" type="button" data-dismiss="modal" aria-hidden="true"> Continue </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Today Independent Living Skills End -->


<!-- Today Education Record Modal -->
<div class="modal fade" id="todayEducationRecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['education_record'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <div class="recent-task-sec">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Today Tasks
                                </h3>       
                            </div>  
                        </div>
                    <form method="post" action="" id="record_form">
                        <div class="service-user-earning-record modal-space ">
                        <?php  foreach($su_education_record as $key => $value) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                                <div class="form-group col-md-3 col-sm-3 col-xs-6 p-0">
                                    <label class="col-md-6 col-sm-6 col-xs-6 p-t-7 r-p-0"> Score: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6 p-0">
                                        <div class="select-style small-select">
                                            <select name="" class="sel" disabled="">
                                                <option value="">{{ $value->scored }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9 col-sm-9 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <input name="" class="form-control cus-control" disabled="" value="{{ $value->description }}" type="text" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>

                        </div>
                            
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-warning" type="button" data-dismiss="modal" aria-hidden="true"> Continue </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Today Education Record End -->

<!-- Today MFC/AFC Record Modal -->
<div class="modal fade" id="todayMFCRecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $labels['mfc'] }}</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <div class="recent-task-sec">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Today Tasks
                                </h3>       
                            </div>  
                        </div>
                    <form method="" action="" id="">
                        <div class="service-user-earning-record modal-space ">
                        <?php  foreach($su_mfc_record as $key => $value) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                                <div class="form-group col-md-11 col-sm-11 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <input name="" class="form-control cus-control" disabled="" value="{{ $value->description }}" type="text" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>

                        </div>
                            
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-warning" type="button" data-dismiss="modal" aria-hidden="true"> Continue </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Today MFC/AFC Record End -->

<script>
    $(document).ready(function(){
        $(document).on('click','.today_daily_record', function(){
            $('#todayDailyrecord').modal('show');
        });
        $(document).on('click','.today_skill_record', function(){
            $('#todaySkillrecord').modal('show');
        });
        $(document).on('click','.today_education_record',function(){
            $('#todayEducationRecord').modal('show');
        });
         $(document).on('click','.today_mfc_record', function(){
            $('#todayMFCRecord').modal('show');
        });
    });
</script>

