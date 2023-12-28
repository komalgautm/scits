<!-- Calendar view event Details-->
<div class="modal fade" id="calndrViewEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close edit_cal_event"  href="#" style="font-size:18px; padding-right:8px;">
                    <i class="fa fa-pencil" title="Edit"></i>
                </a>
                <a class="close remove-cal-event"  href="#" style="font-size:18px; padding-right:8px;">
                    <i class="fa fa-share" title="Move to Event List"></i>
                </a>
                <h4 class="modal-title"> Event - Detail </h4>
            </div>
            <form method="post" id="add-su-detail-form" action="{{ url('/service/calendar/event/edit') }}">
                <div class="modal-body event-dtl-bg">
                    <div class="calendar-event-details">
                    <!-- Data show with the help of ajax --> 
                    </div>
                </div>
                <div class="modal-footer event-dtl-rd m-t-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning edit-evnt-sub-btn" type="submit" > Confirm </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //making editable
    $(document).ready(function(){
        $(document).on('click','.edit_cal_event', function(){
            $(this).addClass('active');
            $(this).parent().siblings('form').find('.edit_event').removeAttr('disabled');
           
            // $(this).parent().next('form').find('button').removeAttr('disabled');
            // $(this).parent().next('form').find('input').removeAttr('disabled');
            // $(this).parent().next('form').find('textarea').removeAttr('disabled');
            // $(this).parent().next('form').find('select').removeAttr('disabled');
            $('.dpYears').datepicker({
                //format: 'dd/mm/yyyy',
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });
        });

        $('.edit-evnt-sub-btn').click(function(){
            
            if($('.edit_cal_event').hasClass('active')) {
                
                note_value = $('.calendar-event-details .edit_note').val().trim();
         
                if(note_value == ''){
                    $('.calendar-event-details .edit_note').addClass('red_border');
                    return false;
                } else{
                    $('.calendar-event-details .edit_note').removeClass('red_border');                    
                }
                return true;
            }else{
                return false;
            } 
        });

        //move event to event lists
        $('.remove-cal-event').click(function(){
           if(confirm('Do you really want to move this event from Calendar to event list?')){

            }
            else{
                return false;
            }

        });

    });
</script>