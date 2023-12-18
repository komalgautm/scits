<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;


class Calendar extends Model
{
    protected $table = 'calendar';

    //checking is the event present in the calendar - i.e. booked to a date in calendar

    public static function checkIsEventAddedtoCalendar($service_user_id = null,$event_id = null,$event_type_id = null){
        

        $calendar_info_query = Calendar::select('id as calendar_id','event_date','calendar_event_type_id')
                                ->where('event_id',$event_id)
                                ->where('calendar_event_type_id',$event_type_id);
                                        
        if(!empty($service_user_id)) {
            $calendar_info_query = $calendar_info_query->where('service_user_id',$service_user_id);
        }
        
        $calendar_info = $calendar_info_query->first();

        if(!empty($calendar_info)){
            $data['calendar_id'] = $calendar_info->calendar_id;
            $data['event_date']  = $calendar_info->event_date;
            $data['event_type']  = $calendar_info->calendar_event_type_id;
            
        } else{
            $data['calendar_id'] = '';
            $data['event_date']  = '';
            $data['event_type']  = $event_type_id;
        }

        return $data;

    }

}