<!-- Calendar view event Details-->
<div class="modal fade" id="calndrViewEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- <a class="close edit_cal_event"  href="#" style="font-size:18px; padding-right:8px;">
                    <i class="fa fa-pencil" title="Edit"></i>
                </a>
                <a class="close remove-cal-event"  href="#" style="font-size:18px; padding-right:8px;">
                    <i class="fa fa-share" title="Move to Event List"></i>
                </a> -->
                <h4 class="modal-title"> Event - Detail </h4>
            </div>
            <form method="post" id="add-su-detail-form">
                <div class="modal-body event-dtl-bg">
                    <div class="calendar-event-details">
                        <!-- Data show with the help of ajax --> 
                    </div>
                </div>
                
                <div class="modal-footer event-dtl-rd m-t-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>
