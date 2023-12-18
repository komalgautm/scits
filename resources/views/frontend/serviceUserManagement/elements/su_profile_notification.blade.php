{!! $notifications !!}
<div class="col-md-12 col-12 col-xs-12 view-more-noti text-right">
    <a href="javascript:void(0)">View More</a>
</div>
<!-- View more notification Modal -->
<div class="modal fade" id="ViewMoreNotificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content notify">
            <div class="modal-header notify">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifications</h4>
            </div>
            <div class="modal-body notify m-b-10">
                <div class="notify-sec" >
                    <form class="form-horizontal" id="notif_filter_form">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 control-label">From</label>
                                <div class="input-group">
                                <input type="text" name="start_date" readonly="" class="form-control startdate_picker" placeholder="Start date" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 control-label">To</label>
                                <div class="input-group">
                                <input type="text" name="end_date" readonly="" class="form-control enddate_picker"  placeholder="End date" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <button class="btn btn-primary filter_notif_btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="below-divider">
                        </div>
                    </div>
                    <div class="notify-panels" >
                        <div class="notifiScroller">
                            <!-- dynamic notifications will be shown here -->
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer notify">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<!-- View more notification Modal end -->

<script>
    var today  = new Date; 

    $('.startdate_picker').datetimepicker({
        format: 'dd-mm-yyyy',
        endDate: today,
        minView : 2
    });
    
    $('.enddate_picker').datetimepicker({
        format: 'dd-mm-yyyy',
        endDate: today,
        minView : 2
    });

    $('.startdate_picker').on('click', function(){
        $('.startdate_picker').datetimepicker('show');
    });

    $('.startdate_picker').on('change', function(){
        $('.startdate_picker').datetimepicker('hide');
    });

    $('.enddate_picker').on('click', function(){
        $('.enddate_picker').datetimepicker('show');
    });

    $('.enddate_picker').on('change', function(){
        $('.enddate_picker').datetimepicker('hide');
    });
    
</script>

<script>
    $('.view-more-noti a').on('click',function(){
        
        var service_user_id = "{{ $service_user_id }}";
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            url : "{{ url('/service/notifications/') }}",
            type: "post",
            data: { 'service_user_id' : service_user_id },
            success:function(resp){

                $(".notifiScroller").html(resp);
                $('#notif_filter_form')[0].reset();
                $('#ViewMoreNotificationModal').modal('show');
                
                $('.loader').hide();
                $('body').removeClass('body-overflow');

            }
        });
    });

    $(document).on('click','.filter_notif_btn',function(){
        
        var error = 0;
        var start_date = $('input[name=\'start_date\']').val();
        var end_date   = $('input[name=\'end_date\']').val();
        if(start_date == '') {
            $('input[name=\'start_date\']').addClass('red_border');
            error = 1; 
        } else {
            $('input[name=\'start_date\']').removeClass('red_border');
        }
        if(end_date == '') {
            $('input[name=\'end_date\']').addClass('red_border');
            error = 1; 
        } else {
            $('input[name=\'end_date\']').removeClass('red_border');
        }
        if(error == 1) {
            return false;
        }

        var formdata = $('#notif_filter_form').serialize();
        
        $('.loader').show();
        $('body').addClass('body-overflow');
        
        $.ajax({
            url : "{{ url('/service/notifications/') }}",
            type: "post",
            data: formdata,
            success:function(resp){

                $(".notifiScroller").html(resp);
                $('#ViewMoreNotificationModal').modal('show');
                
                $('.loader').hide();
                $('body').removeClass('body-overflow');                
            }
        });
        return false;
    });
</script>

<script>
    //notification scroller
    $(".notifiScroller").slimScroll({height:'348px'});
</script>
<!-- {height:'448px'}  -->