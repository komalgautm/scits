@if(!isset($page_title))
$page_title = '';
@endif

@extends('frontEnd.layouts.api_master')
@section('title','Service Calendar '.$page_title)
@section('content')
<style type="text/css">
    body{
        margin-top:0; 
    }
</style>
<section id="main-content" style="margin-top:0;">
    <section class="wrapper-api" >
        <!-- page start-->
            <section class="panel cus-calendar" >
            <header class="panel-heading head-cal1">
                {{ $page_title }}
            </header>
                @include('frontEnd.common.popup_alert_messages')
            <div class="panel-body">
                <!-- page start-->
                <div class="row" >
                    <aside class="col-lg-12">
                        <div id="calendar" class="has-toolbar"></div>
                    </aside>
                    <aside class="col-lg-9">
                      <div class="outer-cal-part2">
                        <div id="calendar" class="has-toolbar"></div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12 p-0">
                            <div class="top-stats-panel">
                                <ul class="bars" type="none">
                                    <li><span class="bars-pointer label-health"></span> {{ $labels['health_record']['label'] }} </li>
                                    <li><span class="bars-pointer label-incentive"></span> {{ $labels['earning_scheme']['label'] }} </li>
                                    <li><span class="bars-pointer label-sick"></span> Staff Sick Leave</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12 p-0">
                            <div class="top-stats-panel">
                                <ul class="bars" type="none">
                                    <li><span class="bars-pointer label-daily"></span> {{ $labels['daily_record']['label'] }} </li>
                                    <li><span class="bars-pointer label-event"></span> Appointment Plan </li>
                                    <li><span class="bars-pointer label-task"></span> Staff Task Allocation </li>
                                </ul>   
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12 p-0">
                            <div class="top-stats-panel">
                                <ul class="bars" type="none">
                                    <li><span class="bars-pointer label-living"></span> {{ $labels['living_skill']['label'] }}</li>
                                    <li><span class="bars-pointer label-note"></span> Note</li>
                                    <li><span class="bars-pointer  label-log-book"></span> Log Book</li>
                                </ul>  
                            </div>
                        </div>  

                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12 p-0">
                            <div class="top-stats-panel">
                                <ul class="bars" type="none">
                                    <li><span class="bars-pointer label-education"></span> {{ $labels['education_record']['label'] }} </li>
                                    <li><span class="bars-pointer label-annual"></span> Staff Annual Leave</li>
                                </ul>
                            </div>
                        </div>
                      </div>  
                    </aside>
                </div>
                <!-- page end-->
            </div>
        </section>
        <!-- page end-->
    </section>
</section>

<!-- include('frontEnd.serviceUserManagement.elements.calender_add_entry')
include('frontEnd.serviceUserManagement.elements.calender_add_notes') -->
@include('api.serviceUser.elements.calender_event_detail')
@include('api.serviceUser.elements.event_change_request')


<!-- Scirpts to enable drag and drop in the touch devices -->
<!-- <script type="text/javascript" src="{{asset('/public/frontEnd/js/jquery.ui.touch-punch.js')}}"></script> -->
<!-- Scirpts to detect mobile devices -->
<script type="text/javascript" src="{{asset('/public/frontEnd/js/detectmobilebrowser.js')}}"></script>



<script>
    //scroller 
    /*event_count = $('.scroller_hr .external-event').length;
    if(event_count > 4){
        $('.scroller_hr').slimScroll({height:'140px'});            
    }

    event_count = $('.scroller_dr .external-event').length;
    if(event_count > 4){
        $('.scroller_dr').slimScroll({height:'140px'});            
    }

    event_count = $('.scroller_ls .external-event').length;
    if(event_count > 4){
        $('.scroller_ls').slimScroll({height:'140px'});            
    }

     event_count = $('.scroller_edu .external-event').length;
    if(event_count > 4){
        $('.scroller_edu').slimScroll({height:'140px'});            
    }
   
    event_count = $('.scroller_ern .external-event').length;
    if(event_count > 4){
        $('.scroller_ern').slimScroll({height:'140px'});            
    }

    event_count = $('.scroller_cal_evnt .external-event').length;
    if(event_count > 4){
        $('.scroller_cal_evnt').slimScroll({height:'140px'});            
    }

    event_count = $('.scroller_note .external-event').length;
    if(event_count > 4){
        $('.scroller_note').slimScroll({height:'140px'});            
    }*/
</script>

<script>
       /* initialize the external events
     -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()), // use the element's text as the event title
            color: $(this).css("background-color"),
            event_id: $(this).attr('event_id'),
            event_type: $(this).attr('event_type'),
            //calendar_id: 0
        };
        //alert(eventObject.id); //return false;
        // store the Event Object in the DOM element so we can get to it later
        var object = $(this).data('eventObject', eventObject);
        //alert(object); return false;

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    /* initialize the calendar
     -----------------------------------------------------------------*/
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();  

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },

        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            $('.loader').show();
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');
            var selected_event = $(this);
            //console.log(originalEventObject);

            var event_type  = originalEventObject.event_type;
            var event_id    = originalEventObject.event_id;
            var service_user_id = "{{ $service_user_id }}";
            var token       = "{{ csrf_token() }}";

            var event_year = date.getFullYear();
            var event_month = date.getMonth() + 1;
            var event_day = date.getDate();
            var event_date = event_year+'-'+event_month+'-'+event_day;
           
            $.ajax({
                type : 'post',
                //url  : "{{ url('/service/calendar/add-event') }}",
                url  : "{{ url('/service/calendar/event/add') }}",
                data : { 'service_user_id':service_user_id, 'event_type':event_type, 'event_id':event_id, 'event_date':event_date, '_token':token },
                dataType: 'json',
                success: function(resp){
                    
                    var response = resp['response'];
                    var calendar_id = resp['calendar_id'];          

                    if(response == true){
                        
                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start       = date;
                        copiedEventObject.allDay      = allDay;
                        copiedEventObject.calendar_id = calendar_id;
                     
                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        //if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            selected_event.remove();
                        //}
                        $('.loader').hide();
                    } else{
                        $('.loader').hide();
                        alert('Event could not be added. Please try again after some time.');
                    }
                }
            });
            return false;
        },

        eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
         
            //alert(event.title + " was dropped on " + event.start.format());
            //alert(event.title + " was dropped on " + event.start);

            if (confirm("Are you sure about this change?")) {
         
                $('.loader').show();
                var event_calendar_id = event.calendar_id;
              
                var token   = "{{ csrf_token() }}";
               
                var event_year  = event.start.getFullYear();
                var event_month = event.start.getMonth() + 1;
                var event_day   = event.start.getDate();
                var event_date  = event_year+'-'+event_month+'-'+event_day;

                $.ajax({
                    type : 'post', 
                    url  : "{{ url('/service/calendar/event/move') }}",
                    data : { 'event_calendar_id' : event_calendar_id, '_token' : token, 'event_date' : event_date},
                    success : function(resp)
                    {
                        if(resp == 'false'){
                            revertFunc();
                            $('.ajax-alert-err').show();
                            $('.ajax-alert-err .msg').text("{{ COMMON_ERROR }}");
                            setTimeout(function(){$(".notification-box").fadeOut()}, 5000);
                        }
                        $('.loader').hide();
                    }
                });
            }
            else{
                revertFunc();
            }
        },
        events: [
                            
            <?php
                if(!empty($health_records)) {
                    foreach ($health_records as $key => $value) { 
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m',strtotime($value['event_date'])) - 1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['health_record_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];
            ?>
            {
                title:       '{{ $value['title'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day }}'),
                color:       '#1fb5ad',
                event_id:    '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
          
            <?php } }   } ?>

            <?php 
                if(!empty($daily_records)) { 
                    foreach ($daily_records as $key => $value) {
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m', strtotime($value['event_date']))-1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['su_daily_record_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];
            ?>
            {
                title:       '{{ $value['description'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day}}'),
                color:       '#99CBE2',
                event_id :   '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
            <?php } }  } ?>

            <?php 
                if(!empty($living_skills)) { 
                    foreach ($living_skills as $key => $value) {
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m', strtotime($value['event_date']))-1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['su_living_skill_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];
            ?>
            {
                title:       '{{ $value['description'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day}}'),
                color:       '#A9D86E',
                event_id :   '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
            <?php } }  } ?>

            <?php 
                if(!empty($education_records)) { 
                    foreach ($education_records as $key => $value) {
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m', strtotime($value['event_date']))-1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['su_education_record_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];
            ?>
            {
                title:       '{{ $value['description'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day}}'),
                color:       '#344860',
                event_id :   '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
            <?php } }  } ?>

            <?php 
                if(!empty($su_incentives)) { 
                    foreach ($su_incentives as $key => $value) {
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m',strtotime($value['event_date'])) - 1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['su_ern_inc_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];

           ?>
            {
                title:       '{{ $value['name'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day }}'),
                color:       '#9566B6',
                event_id:    '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
           <?php }  }   } ?>

           <?php 
                if(!empty($event_records)) { 
                    foreach ($event_records as $key => $value) {
                        if(!empty($value['calendar_id'])) {
                            $event_day   = date('d',strtotime($value['event_date']));
                            $event_mon   = date('m',strtotime($value['event_date'])) - 1;
                            $event_year  = date('Y',strtotime($value['event_date']));

                            $event_id    = $value['su_calendar_event_id'];
                            $event_type  = $value['event_type'];
                            $calendar_id = $value['calendar_id'];

           ?>
            {
                title:       '{{ $value['title'] }}',
                start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day }}'),
                color:       '#3398CC',
                event_id:    '{{ $event_id }}',
                event_type:  '{{ $event_type }}',
                calendar_id: '{{ $calendar_id }}'
            },
           <?php }  }   } ?>

            <?php
                if(!empty($calender_notes)) { //echo '<pre>'; print_r($calender_notes); die;
                 foreach ($calender_notes as $key => $value) { 
                    if(!empty($value['calendar_id'])) {
                        $event_day   = date('d',strtotime($value['event_date']));
                        $event_mon   = date('m',strtotime($value['event_date'])) - 1;
                        $event_year  = date('Y',strtotime($value['event_date']));

                        // if(strlen($value['title']) > 42){
                        //     $event_title = substr($value['title'],0,42).'...';
                        // } else{
                        //     $event_title = substr($value['title'],0,42);       
                        // }
                        //$pattern     = '/[^a-zA-Z0-9]/u';
                       // $event_title = preg_replace($pattern, ' ', (string) $event_title);
                        $event_id    = $value['id'];
                        $event_type  = $value['event_type'];
                        $calendar_id = $value['calendar_id'];
                 ?>
                {
                    title:       '{{ $value['note_title'] }}',
                    start:       new Date('{{ $event_year }}', '{{ $event_mon }}', '{{ $event_day }}'),
                    color:       '#999999',
                    event_id:    '{{ $event_id }}',
                    event_type:  '{{ $event_type }}',
                    calendar_id: '{{ $calendar_id }}'
                },
            <?php  } } } ?>
        ],

        eventClick: function(event) { 
            //alert(1);
            // console.log(event);
            var event_calendar_id = event.calendar_id;
            var event_type = event.event_type;
            var event_id = event.event_id;
            
            var event_year  = event.start.getFullYear();
            var event_month = event.start.getMonth() + 1;
            var event_day   = event.start.getDate();
            var event_date  = event_day+'-'+event_month+'-'+event_year;
            var service_user_id = "{{ $service_user_id }}";
            // var remove_url = "{{ url('/service/calendar/event/remove') }}"+'/'+event_calendar_id;

            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type: 'get',
                url : "{{ url('api/service/calendar/event/view') }}",
                data: { 'event_type' : event_type, 'event_id' : event_id, 'event_date': event_date, 'calendar_id' : event_calendar_id, 'service_user_id':service_user_id },
                success : function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    
                    $('.calendar-event-details').html(resp);
                    // $('.remove-cal-event').attr('href',remove_url);
                    $('#calndrViewEvent').modal('show');
                    // $('.edit_cal_event').removeClass('active');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }    
            });
            return false;

            /*if (event.url) {
                window.open(event.url);
                return false;
            }*/
            
        },
        eventAfterRender: function(event, element, view) {
	      var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
			if(jQuery.browser.mobile || isiPad ){
				element.draggable();
				$('.fc-view tbody').draggable();
			}
	    }
  		   
    });
</script>
<!--
Note: here in calender month is one number in minus
 -->

@endsection