<?php
namespace App;
use DB,Auth;
use Illuminate\Database\Eloquent\Model;
use App\Incentive, App\ServiceUserDailyRecord, App\ServiceUserEarningDaily, App\DynamicFormBuilder, App\DynamicForm;

class EarningScheme extends Model
{
    protected $table = 'earning_scheme_category';
    
    public function incentives(){
    	return $this->hasMany('App\Incentive','earning_category_id','id');
    }

    public static function incentivesCount($earning_category_id = null){
        $incentive_count = Incentive::where('earning_category_id',$earning_category_id)->where('status','1')->where('is_deleted','0')->count();
        return $incentive_count;
    }

    public static function getRecordsScore($service_user_id = null,$date = null){

        //get daily_record percentage

        $earn_area_percent = EarningAreaPercentage::select('daily_record','education_record','living_skill','mfc')->first();
    
        //$date = date('Y-m-d').' 00:00:00';
        if(empty($date)){
            $date      = date('Y-m-d').' 00:00:00';
            $next_date = date('Y-m-d', strtotime('+1 day')).' 00:00:00';
        } else{
            $date      = date('Y-m-d',strtotime($date)).' 00:00:00';
            $next_date = date('Y-m-d', strtotime('+1 day', strtotime($date))).' 00:00:00';
        }

        //get today's all daily records
        $daily_records = ServiceUserDailyRecord::select('id','daily_record_id','scored','is_deleted','created_at')
                                        ->where('service_user_id',$service_user_id)
                                        ->where('created_at','>=',$date)
                                        ->where('created_at','<',$next_date)
                                        ->where('is_deleted','0')
                                        ->get()
                                        ->toArray();

        //filter not deleted records.
        // filter Rule :
        // if a daily record has scored by yp and removed by manager then it will be calculated in percentage earned
        // if a daily record is not yet scored by yp and removed by manager then it will not be calculated in percentage earned

        $total_records  = 0;
        $records_point  = 0;
        
        foreach($daily_records as $value){
            //if( ($value['is_deleted'] == 0) || ( ($value['is_deleted'] == 1) && ($value['scored'] > 0) ) ){

            ++$total_records;
            if($value['scored'] > 0) {
                
                if($value['scored'] >= 3) {
                    ++$records_point;
                }   
            }
        }

        //get percentage
        if($total_records > 0){
            $scores['daily_record'] = ($records_point / $total_records) * $earn_area_percent->daily_record;
        } else{
            $scores['daily_record'] = 0;
        }
 
        // for educational record
       $education_records = ServiceUserEducationRecord::select('id','education_record_id','scored','is_deleted','created_at')
                                        ->where('service_user_id',$service_user_id)
                                        ->where('created_at','>=',$date)
                                        ->where('created_at','<',$next_date)
                                        ->where('is_deleted','0')
                                        ->get()
                                        ->toArray();

        //filter not deleted records.
        // filter Rule :
        // if a daily record has scored by yp and removed by manager then it will be calculated in percentage earned
        // if a daily record is not yet scored by yp and removed by manager then it will not be calculated in percentage earned

        $total_records  = 0;
        $records_point  = 0;
        
        foreach($education_records as $value){
            //if( ($value['is_deleted'] == 0) || ( ($value['is_deleted'] == 1) && ($value['scored'] > 0) ) ){

            ++$total_records;
            if($value['scored'] > 0) {
                
                if($value['scored'] >= 3) {
                    ++$records_point;
                }   
            }
        }

        //get percentage
        if($total_records > 0){
            $scores['education_record'] = ($records_point / $total_records) * $earn_area_percent->education_record;
        } else{
            $scores['education_record'] = 0;
        }

       // for living skill
       $living_records = ServiceUserLivingSkill::select('id','living_skill_id','scored','is_deleted','created_at')
                                        ->where('service_user_id',$service_user_id)
                                        ->where('created_at','>=',$date)
                                        ->where('created_at','<',$next_date)
                                        ->where('is_deleted','0')
                                        ->get()
                                        ->toArray();

        //filter not deleted records.
        // filter Rule :
        // if a daily record has scored by yp and removed by manager then it will be calculated in percentage earned
        // if a daily record is not yet scored by yp and removed by manager then it will not be calculated in percentage earned

        $total_records  = 0;
        $records_point  = 0;
        
        foreach($living_records as $value){
            //if( ($value['is_deleted'] == 0) || ( ($value['is_deleted'] == 1) && ($value['scored'] > 0) ) ){

            ++$total_records;
            if($value['scored'] > 0) {
                
                if($value['scored'] >= 3) {
                    ++$records_point;
                }   
            }
        }

        //get percentage
        if($total_records > 0){
            $scores['living_skill'] = ($records_point / $total_records) * $earn_area_percent->living_skill;
        } else{
            $scores['living_skill'] = 0;
        }

        //mfc score - count no. of today mfc records
        //If today no mfc record then by default its value will be 25% 
        /* old way, now we are using dynamic forms for storig data
        $su_mfc = ServiceUserMFC::where('service_user_id',$service_user_id)
                                ->where('created_at','>=',$date)
                                ->where('created_at','<',$next_date)
                                ->where('is_deleted','0')
                                ->count();*/
        //get mfc from dynamic forms
        $form_bildr_ids_data = DynamicFormBuilder::select('id')->whereRaw('FIND_IN_SET(5,location_ids)')->get()->toArray();
        $form_bildr_ids      = array_map(function($v) { return $v['id']; }, $form_bildr_ids_data);
        $su_mfc              = DynamicForm::whereIn('form_builder_id',$form_bildr_ids)
                                            ->where('is_deleted','0')
                                            ->where('service_user_id',$service_user_id)
                                            //->where('date',$service_user_id)
                                            ->where('created_at','>=',$date)
                                            ->where('created_at','<',$next_date)
                                            ->count();
                                            //->get()->toArray();
                                            
        if($su_mfc > 0){
            $scores['mfc'] = 0;
        } else{
            $scores['mfc'] = $earn_area_percent->mfc;
        }
          
        //service user daily % target to score to get points  // get latest targte set for su
        $su_earn_target = ServiceUserEarningTarget::getEarningTarget($service_user_id);

        //service user's today all records points obtained 
        $total_su_score = $scores['daily_record'] + $scores['education_record'] + $scores['living_skill'] + $scores['mfc'];

        if($total_su_score < $su_earn_target){
            $rem_target = $su_earn_target - $total_su_score;
        } else{
            $rem_target = 0;
        }
        
        $scores['target']           = $su_earn_target;
        $scores['obtained']         = $total_su_score;  //total score obtained in % //floor
        $scores['pending_target']   = $rem_target;
        $scores['pending_overall']  = 100 - $total_su_score;     //round   
        //echo '<pre>'; print_r($scores); die;
        return $scores;

        /*echo 'total_records='.$total_records.'<br>';
        echo 'records_point='.$records_point; //die;

    	echo '<pre>'; print_r($living_records); 
        echo '<pre>'; print_r($scores); die;*/
    }

    //update earning of a particular date
    public static function updateEarning($service_user_id = null, $date = null){
        
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        if(Auth::user()->home_id != $su_home_id){
            return false;
        }
        
        if(empty($date)){
            $date = date('Y-m-d');
        } else{
            $date = date('Y-m-d',strtotime($date));
        }
        //echo $date; die;
        $score = EarningScheme::getRecordsScore($service_user_id,$date); //today records score
        
        $today_earning = ServiceUserEarningDaily::where('service_user_id',$service_user_id)
                                ->whereDate('date','=',$date)
                                ->first();

        if(!empty($today_earning)){

            $today_earning->target          = $score['target'];
            $today_earning->score           = $score['obtained'];
            
        } else{

            $today_earning                  = new ServiceUserEarningDaily;
            $today_earning->service_user_id = $service_user_id;
            $today_earning->target          = $score['target'];
            $today_earning->score           = $score['obtained'];
            //$today_earning->point           = 1;
            $today_earning->date            = $date;
        }

        //update stars
        if($today_earning->save()){
            
            //case 1: Normal case
            //su has score more than the earning target then set the today point = 1 
            if( ($today_earning->score >= $score['target']) && ($today_earning->star_given == 0) ) { //if today earn points % match to todays target

                //Add a star for the yp
                $su_star = ServiceUserEarningStar::where('service_user_id',$service_user_id)->first();

                if(!empty($su_star)){
                                    
                    $pre_star      = $su_star->star;
                    $su_star->star = $pre_star + 1;                            

                } else{
                    $su_star = new ServiceUserEarningStar;
                    $su_star->star = 1;                        
                    $su_star->service_user_id = $service_user_id;
                }

                if($su_star->save()){
                    
                    //updating daily point table that its points has been converted to stars
                    $today_earning->star_given = 1;
                    //$today_earning->point      = 1;
                    $today_earning->save();
                    
                    return $today_earning->id;
                }
            }

            //case 2: Fraud case
            //su had score more than the earning target and given with a point but now remove that point
            /*if($today_earning->score < $previous_earning_score){ //if new score is less than the previous score
               
               //if new score also less than the set target
                if($today_earning->score < $today_earning->target){

                    $today_earning->star_given = 0;
                    $today_earning->point      = 0;
                    $today_earning->save();
                    return $today_earning->id;

                }
            }*/
        }

    
        return false;
    }

    //su earning history
    public static function earningHistory($service_user_id=null)
    {
        $earn_history = Notification::where('service_user_id',$service_user_id) 
                            ->where('notification_event_type_id','3')
                            ->orderBy('id','desc')
                            //->limit('4')
                            ->get()
                            ->toArray();
    
        $i = 0;
        $response = array();
        
        foreach($earn_history as $value){ 

            if($value['event_action'] == 'ADD_STAR'){
                $hist_message = '1 star added for completing daily tasks';

            } elseif($value['event_action'] == 'SPEND_STAR'){
                
                $inventive_info =   ServiceUserEarningIncentive::select('su_earning_incentive.star_cost','i.name')
                                        ->where('su_earning_incentive.id',$value['event_id'])
                                        ->join('incentive as i','i.id','su_earning_incentive.incentive_id')
                                        ->first();
                
                if(!empty($inventive_info)){
                    
                    if($inventive_info->star_cost > 1){
                        $star = $inventive_info->star_cost." Stars";
                    } else{
                        $star = $inventive_info->star_cost." Star";
                    }

                    $hist_message = $star." Spend for ".ucfirst($inventive_info['name'])." ";
                } else{

                    $label        = '';
                    $hist_message = '';
                }

            } elseif($value['event_action'] == 'REMOVE_STAR'){
                
                $hist_message     = '1 star removed, Not meeting your target.';
                //Management plan to be organised.
            } 

            if(!empty($hist_message)){
                
                $response[$i]['notification_id'] = $value['id']; 
                $response[$i]['message'] = $hist_message; 
                $response[$i]['date']    = date('d M Y, g:i A ',strtotime($value['created_at'])); 
                $i++;
            }
        }
        return $response;
    }

    //su booked incentives list
    public static function bookedIncentives($service_user_id=null){
        
        $booked_incentives  = ServiceUserEarningIncentive::select('su_earning_incentive.id as su_ern_inc_id', 'su_earning_incentive.star_cost','incentive.name','incentive.earning_category_id','su_earning_incentive.time')
                                    ->join('incentive','incentive.id','su_earning_incentive.incentive_id')
                                    ->where('su_earning_incentive.service_user_id', $service_user_id)
                                    ->orderBy('su_earning_incentive.id','desc')
                                    ->get()
                                    ->toArray();
        //echo "<pre>"; print_r($booked_incentives); die;
        foreach ($booked_incentives as $key => $su_incentive) {
            
            //check if this incentive is booked in calendar
            $event_id      = $su_incentive['su_ern_inc_id'];
            $event_type_id = '3';

            $calendar_response       = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type_id);
            $booked_incentives[$key] = array_merge($booked_incentives[$key],$calendar_response);

            //checking is the incentive is suspend 
            // if incentive will be suspend then its id will be present in ServiceUserIncentiveSuspend table
            $inc_suspend_id = ServiceUserIncentiveSuspend::where('su_earning_incentive_id',$event_id)
                                ->where('is_cancelled','0')   //not cancelled
                                ->orderBy('id','desc')
                                ->value('id');
                      
            if(!empty($inc_suspend_id)) {
                $booked_incentives[$key]['suspended_id'] = $inc_suspend_id;
            } else{
                $booked_incentives[$key]['suspended_id'] = '';
            }
        }
        return $booked_incentives;
    } 

    /*public function getTaskDonePercentByLabel($label = null){

        
        if($label == 'daily_record'){
            $records = ServiceUserDailyRecord::where('')
        }
        
    }*/
    //$labels = array('daily_record','education_record','living_skill');
    //,'mfc'

}