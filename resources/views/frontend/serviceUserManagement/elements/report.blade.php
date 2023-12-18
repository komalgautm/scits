

<style type="text/css">
    .fa.fa-edit {
      color: #1f88b5;
      font-size: 18px;
      margin-left: 1px;
      margin-top: 6px;
    }
</style>
<script type="text/javascript" src="{{ url('public/frontEnd/js/daterangepicker.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('public/frontEnd/css/daterangepicker.css') }}">

<div class="modal fade" id="ChooseReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <!--  <a class="close view-all-logs mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title=""></i>
                </a> -->
                <h4 class="modal-title"> Report</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="add-new-box risk-tabs custm-tabs">
                        <!-- <form method="post" id="choose_report_form"> -->
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-4 col-sm-2 col-xs-12 p-t-7 text-right"> Select Report: </label>
                                    <div class="col-md-6 col-sm-10 col-xs-12">
                                        <div class="select-bi" style="width:100%;float:left;">
                                            <select class="select-field form-control" style="width:100%;" name="reprt_name">
                                                <option value="">Select Report</option>
                                                <option value="W">Weekly</option>
                                                <option value="M">Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group modal-footer m-t-0 modal-bttm">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <input type="hidden" name="srvcc_usrr_id">
                                
                                <button class="btn btn-warning submt-rprt" type="submit"> Submit </button>
                            </div>
                        <!-- </form> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ReportlogBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title header_txt">  </h4>
            </div>
            @include('frontEnd.common.popup_alert_messages')
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <!-- <button class="btn label-default add-new-btn active" type="button"> Add New </button> -->
                        <!-- <button class="btn label-default logged-btn active" type="button"> Logged </button>
                            <button class="btn label-default search-btn active" type="button"> Search </button> -->
                        <!-- <button class="btn label-default logged-btn active" type="button"> Logged </button>
                            <button class="btn label-default search-btn" type="button"> Search </button> -->
                    </div>
                    <!-- logged plans -->
                    <div class="by-dflt-shw risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged 
                                <button class="btn btn-default pull-right clr-blue m-t-0 m-b-20 snd_mail">Send Report</button>
                            </h3>
                        </div>
                        <div class="modal-space modal-pading reprt-log-book-list text-center">
                            <!-- logged book list be shown here using ajax -->
                        </div>
                        <!-- </form> -->
                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <!-- <button class="btn btn-warning logged_daily_record_btn" type="button"> Confirm</button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Log Book Modal -->
<div class="modal fade" id="editReportDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="#ReportlogBookModal">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Edit Report  </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                

                <form id="edit_report_form">
                    <div class="add-new-box risk-tabs custm-tabs report_content ">
                                
                    </div>
                    {{ csrf_field()}}
                </form>

               
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Select social worker modal -->
<div class="modal fade" id="SocialWorkerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <!--  <a class="close view-all-logs mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title=""></i>
                </a> -->
                <h4 class="modal-title"> Report</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="add-new-box risk-tabs custm-tabs">
                        <form method="post" id="" action="{{ url('/send/mail/social/worker')}}">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-4 col-sm-2 col-xs-12 p-t-7 text-right"> Interval: </label>
                                    <div class="col-md-6 col-sm-10 col-xs-12">
                                        <div class="select-bi" style="width:100%;float:left;">
                                            <!-- <input type="text" name="date"> -->
                                            <input type="text" class="form-control" id="hourrange" name="hourrange"  value="" placeholder="Select interval">
                                            <!-- <select class="select-field form-control socl_wrkr" style="width:100%;" name="social_worker_id">
                                                <option value="">Select Social Worker</option>
                                                
                                            </select> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-4 col-sm-2 col-xs-12 p-t-7 text-right"> Select Social Worker: </label>
                                    <div class="col-md-6 col-sm-10 col-xs-12">
                                        <div class="select-bi" style="width:100%;float:left;">
                                            <select class="select-field form-control socl_wrkr js-example-basic-single1" style="width:100%;" name="social_worker_id[]" data-live-search="true" multiple="" id="scl_wrkr_id">
                                                <option value="">Select Social Worker</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group modal-footer m-t-0 modal-bttm">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <input type="hidden" name="srrvc_usr_id">
                                <input type="hidden" name="report_type">
                                {{ csrf_field()}}
                                <button class="btn btn-warning snd_mail_btn"> Submit </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click','.submt-rprt',function(){
        var reprt_name =  $('select[name=reprt_name]').val();
        var srvcc_usrr_id =  $('input[name=srvcc_usrr_id]').val();
        var token = "{{ csrf_token()}}";
        var report_type = '';
        if(reprt_name == 'M'){
            var header_txt = 'Monthly Report';
            var report_type = 'M';

        }else{
            var header_txt = 'Weekly Report';
            var report_type = 'W';
        }
        error = 0;
        if(reprt_name == '') {

            $('select[name=\'reprt_name\']').parent().addClass('red_border');
            error = 1;
        } else {
            $('select[name=\'reprt_name\']').parent().removeClass('red_border');
        }

        
        if(error == 1) {
            return false;
        }
        $.ajax({
            type :  'post',
            url  :  "{{ url('/select/report') }}",
            data :  {'reprt_name':reprt_name,'_token': token,'service_user_id':srvcc_usrr_id},
            //dataType : 'json',
            success: function(resp){

                if(isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0 || resp == ''){
                    $('.header_txt').text(header_txt);
                    $('input[name=report_type]').val(report_type)
                    $('.reprt-log-book-list').html('No Logs Found');
                    $('#ChooseReportModal').modal('hide');
                    $('#ReportlogBookModal').modal('show');

                } else {
                    $('.header_txt').text(header_txt);
                    $('input[name=report_type]').val(report_type);
                    $('.reprt-log-book-list').html(resp);
                    $('#ChooseReportModal').modal('hide');
                    $('#ReportlogBookModal').modal('show');

                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');
                
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).on('click','.edit-mnthly-reprt',function(){
        var log_id = $(this).attr('log_book_id');
        $('.loader').show();
        $.ajax({
            type :  'get',
            url  :  "{{ url('/monthly/report/detail') }}"+'/'+log_id,
            success: function(resp){
                // console.log(resp);
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == 0 || resp == '') {
                    $('.report_content').html('No Record Found');
                    $('#ReportlogBookModal').modal('hide');
                    $('#editReportDetail').modal('show');
                } else {

                    $('.report_content').html(resp);
                    $('#ReportlogBookModal').modal('hide');
                    $('#editReportDetail').modal('show');
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click','.sbmt-edit-rprt',function(){
        var form_data = $('#edit_report_form').serialize();
        
        $('.loader').show();
        $.ajax({
            type : 'post',
            url  : "{{ url('/edit/report/detail') }}",
            data : form_data,
            success: function(resp){
                // console.log(resp); 
                if (isAuthenticated(resp) == false){
                    return false;
                }
                // alert(resp); return false;
                if (resp == '0') {
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();

                } else {
                    
                    $('span.popup_success_txt').text('Report edit successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$('.popup_success').fadeOut()},5000);
                }
                $('#ReportlogBookModal').modal('show');
                $('#editReportDetail').modal('hide');
                $('.loader').hide();
                $('body').addClass('body-overflow');  
            }

        });
        return false;

    });
</script>

<script type="text/javascript">
    $(document).on('click','.sent-reprt',function(){
        var log_book_id = $(this).attr('log_book_id');
        $('.loader').show();
        $.ajax({
            type : 'post',
            url  : "{{ url('/send/mail/careteam') }}"+'/'+log_book_id,
            success: function(resp){

                if (isAuthenticated(resp) == false){
                    return false;
                }
                // alert(resp); return false;
                if (resp == '0') {
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();

                } else {
                    
                    $('span.popup_success_txt').text('Report send to care team successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$('.popup_success').fadeOut()},5000);
                }
                // $('#ReportlogBookModal').modal('show');
                // $('#editReportDetail').modal('hide');
                $('.loader').hide();
                $('body').addClass('body-overflow'); 
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).on('click','.snd_mail',function(){
        var servcc_usrr_id =  $('input[name=srvcc_usrr_id]').val();
        $('input[name=srrvc_usr_id]').val(servcc_usrr_id);
        $('.loader').show();
        $.ajax({
            type:'post',
            url:"{{ url('/select/social/work/send/mail/')}}"+'/'+servcc_usrr_id,
            success:function(resp){
                // console.log(resp);
                if (isAuthenticated(resp) == false){
                    return false;
                }
                $('.socl_wrkr').html(resp);
                $('#SocialWorkerModal').modal('show');
                $('#ReportlogBookModal').modal('hide');

                $('.loader').hide();
                $('body').addClass('body-overflow');
            }

        });
    });
</script>
<script type="text/javascript">
    $(function() {

        $('#hourrange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#hourrange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD')).change();
        });

        $('#hourrange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
<script type="text/javascript">

    $(document).on('click','.snd_mail_btn',function(){
        var sel_date_range      = $('input[name=hourrange]').val();
      
        var srrvc_usr_id        = $('input[name=srrvc_usr_id]').val();
      
        var social_worker_id = $("select[name='social_worker_id[]']")
              .map(function(){return $(this).val();}).get();
          
        error = 0;
        if(sel_date_range == '') {
            // console.log('1');
            $('input[name=\'hourrange\']').parent().addClass('red_border');
            error = 1;
        } else {

            $('input[name=\'hourrange\']').parent().removeClass('red_border');
        }
        if(social_worker_id == '') {
            // console.log('2');
            $('#scl_wrkr_id').parent().addClass('red_border');
            error = 1;
        } else {
            $('#scl_wrkr_id').parent().removeClass('red_border');
        }
        // console.log(error);
        if(error == 1) {
            return false;
        }
        

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single1').select2({
            placeholder: "Select Social Worker",
            allowClear: true
        });
    }); 
</script>
