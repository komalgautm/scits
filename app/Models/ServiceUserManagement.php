<?php

namespace App;
use DB, Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon;
use App\ServiceUserPlacementPlan, App\ServiceUserEarningIncentive, App\ServiceUserHealthRecord, App\ServiceUserBmp, App\ServiceUserRmp, App\ServiceUserIncidentReport, App\Notification, App\ServiceUserDailyRecord, App\ServiceUserLivingSkill, App\ServiceUserEducationRecord, App\ServiceUserAFC;

class ServiceUserManagement extends Model
{
    // protected $table = 'notification';

    public static function personalDetailNotifyCount($service_user_id=null){
        
        // imp fields name, username, DOB, section, admission number, previous addresses (care history), contact numbers,
        $service_user = ServiceUser::select('name','user_name','date_of_birth','section','admission_number','previous_location','mobile')
                        ->where('id',$service_user_id)
                        ->first();
        
        $count_empty = 0;

        if(!empty($service_user)){

            $service_user = $service_user->toArray();
            foreach($service_user as $value){
                if(empty($value)){
                    ++$count_empty;                    
                }
            }

        }
        return $count_empty;
    }

    public static function EarningNotifyCount($service_user_id=null){
        
        $today = date('Y-m-d');
        $su_dr_count = ServiceUserDailyRecord::where('service_user_id', $service_user_id)
                                ->where('created_at','LIKE',$today.'%')
                                ->where('scored','0')
                                ->where('read_notify','0')
                                ->count();

        $su_ls_count = ServiceUserLivingSkill::where('service_user_id', $service_user_id)
                                ->where('created_at','LIKE',$today.'%')
                                ->where('scored','0')
                                ->where('read_notify','0')
                                ->count();

        $su_ed_count = ServiceUserEducationRecord::where('service_user_id', $service_user_id)
                                ->where('created_at','LIKE', $today.'%')
                                ->where('scored','0')
                                ->where('read_notify','0')
                                ->count();

        $ern_sch_count = $su_dr_count+$su_ls_count+$su_ed_count;

        $ern_count = array();
        if($ern_sch_count == 0) {
            $ern_count['color'] = 'label-success';
        } else if($ern_sch_count < 10) {
            $ern_count['color'] = 'label-warning';
        } else {
            $ern_count['color'] = 'label-danger';
        }

        $ern_count['count'] = $ern_sch_count;
        // return $ern_sch_count; 
        return $ern_count;

    }

    public static function AFCNotifyCount($service_user_id = null) {
      
        $first_lap_start = date('Y-m-d 00:00:00');
        $first_lap_end   = date('Y-m-d 06:00:00');

        $second_lap_end  = date('Y-m-d 12:00:00');
        $third_lap_end   = date('Y-m-d 18:00:00');
        
        $fourth_lap_end  = date('Y-m-d 23:59:59');

        $current_time    = date('Y-m-d H:i:s');

        $afc_count_first  = 0;
        $afc_count_second = 0;
        $afc_count_third  = 0;
        $afc_count_fourth = 0;

        $afc_first_lap = ServiceUserAFC::where('service_user_id', $service_user_id)
                                ->where('created_at','>=', $first_lap_start)
                                ->where('created_at','<=', $first_lap_end)
                                ->where('read_notify','0')
                                ->count();

        if($afc_first_lap == 0){ 
            $afc_count_first = 0;
        } else {
            $afc_count_first = $afc_first_lap;
        }

        if($current_time > $first_lap_end){ //if current time is > first lap then only check second lap
            $afc_second_lap = ServiceUserAFC::where('service_user_id', $service_user_id)
                                ->where('created_at','>', $first_lap_end)
                                ->where('created_at','<=', $second_lap_end)
                                ->where('read_notify','0')
                                ->count();
        
            if($afc_second_lap == 0){
                $afc_count_second = 0;
            } else {
                $afc_count_second = $afc_second_lap;
            }
        }

        if($current_time > $second_lap_end){ //if current time is > second lap then only check third lap
            $afc_third_lap = ServiceUserAFC::where('service_user_id', $service_user_id)
                                     ->where('created_at','>', $second_lap_end)
                                    ->where('created_at','<=', $third_lap_end)
                                    ->where('read_notify','0')
                                    ->count();

            if($afc_third_lap == 0){
                $afc_count_third = 0;
            } else {
                $afc_count_third = $afc_third_lap;
            }
        }

        if($current_time > $third_lap_end){ //if current time is > third lap then only check fourth lap
            $afc_fourth_lap = ServiceUserAFC::where('service_user_id', $service_user_id)
                                    ->where('created_at','>', $third_lap_end)
                                    ->where('created_at','<=', $fourth_lap_end)
                                    ->where('read_notify','0')
                                    ->count();
        
            if($afc_third_lap == 0){
                $afc_count_fourth = 0;
            } else {
                $afc_count_fourth = $afc_fourth_lap;
            }
        }
        
        $afc_counts = $afc_count_first+$afc_count_second+$afc_count_third+$afc_count_fourth;

        $afc_count = array();
        if($afc_counts == '0') {
            $afc_count['color'] = 'label-success';
        } else if($afc_counts >= 1) {
            $afc_count['color'] = 'label-warning';
        } else {
            $afc_count['color'] = '';
             //$afc_count['color'] = 'label-danger';
        }

        $afc_count['count'] = $afc_counts;

        return $afc_count;

        /* Note:
            If there is no activity on this for any more than 4-6 hours there will be 1 notification added, increment this each time
            Notification as red if he is missing.
        */
    }

    public static function placementNotifyCount($service_user_id = null) {
        
        $today = date('Y-m-d');
        $pending_targets = DB::table('su_placement_plan')
                                ->where('service_user_id',$service_user_id)
                                ->whereDate('date', '<=', $today)
                                ->where('status','0')
                                ->where('read_notify','0')
                                ->count();

        $result = array();
        if($pending_targets == '0') {
            $result['color'] = 'label-success';
        } else if($pending_targets < 10) {
            $result['color'] = 'label-warning';
        } else {
             $result['color'] = 'label-danger';
        }

        $result['count'] = $pending_targets;

        return $result;
    }

    public static function healthRecordCount($service_user_id = null) {

        $home_id = Auth::user()->home_id;
        //Health Records
        $health_records = ServiceUserHealthRecord::select('su_health_record.id as health_record_id','su_health_record.service_user_id')
                                        ->join('service_user as su', 'su.id','su_health_record.service_user_id')
                                        ->where('su_health_record.is_deleted', '0')
                                        ->where('su_health_record.service_user_id', $service_user_id)
                                        ->where('su.home_id', $home_id)
                                        ->where('su_health_record.read_notify', '0')
                                        ->orderBy('health_record_id','asc')
                                        ->get()
                                        ->toArray();
        $health_count = 0;
        foreach ($health_records as $key => $health_record) {
            // check if this health_record is booked in calendar
            $event_id   = $health_record['health_record_id'];
            $event_type = '1';
            $service_user_id = $health_record['service_user_id'];

            $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
            if(empty($booking_response['calendar_id'])){ 
                $health_count++;
            
            } 
        }

        $su_health_record = array();
        if($health_count == 0) {
            $su_health_record['color'] = 'label-success';
        } else if($health_count <= 10) {
            $su_health_record['color'] = 'label-warning';
        } else {
            $su_health_record['color'] = 'label-danger';
        }

        $su_health_record['count'] = $health_count;

        return $su_health_record;
    }

    /* public static function getNotificationCount($service_user_id = null,$notification_event_type_id = null) {     
        
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        //$tillDate = Date('Y-m-d');
    
        $counts = DB::table('notification as n')
                            ->select('n.*')
                            //->whereBetween('created_at',[$fromDate, $tillDate])
                            ->whereDate('created_at','>=',$fromDate)
                            ->where('service_user_id', $service_user_id)
                            ->where('notification_event_type_id',$notification_event_type_id)
                            ->count();

        $notif_query = array();
        if($counts == 0) {
            $notif_query['color'] = 'label-success';
        } else if($counts <= 10) {
            $notif_query['color'] = 'label-warning';
        } else {
            $notif_query['color'] = 'label-danger';
        }

        if($notification_event_type_id == '1') {
            $notif_query['count'] = $counts;
        } else if($notification_event_type_id == '2') {
            $notif_query['count'] = $counts;
        } else if($notification_event_type_id == '3') {
            $notif_query['count'] = $counts;
        } else if($notification_event_type_id == '4') {
            $notif_query['count'] = $counts;
        } else {

        }
        return $notif_query;

    }*/
}