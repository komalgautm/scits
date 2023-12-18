<?php

namespace App;
use DB, Auth;
use Illuminate\Database\Eloquent\Model;
use App\ServiceUserCalendarEvent, App\ServiceUserEarningIncentive, App\ServiceUserLogBook, App\ServiceUserHealthRecord;
class EventChangeRequest extends Model
{
    protected $table = 'event_change_request';

    public static function getChangeRequest($service_user_id = null) {

    	

    	$su_event_reqs_query = EventChangeRequest::select('event_change_request.id','event_change_request.new_date','event_change_request.date','event_change_request.calendar_id','event_change_request.reason','c.calendar_event_type_id','c.event_id')->join('calendar as c', 'c.id','event_change_request.calendar_id')
                                            ->where('event_change_request.service_user_id', $service_user_id)
                                            ->orderBy('event_change_request.id','desc');
                                            //->get()
                                            //->toArray();
		//$su_event_reqs = $su_event_reqs_query->>get()->toArray();
        // if($action_type == 'VIEWS') {
    		$su_event_reqs = $su_event_reqs_query->paginate(15)->toArray();
    		$su_event_reqs_pag = $su_event_reqs_query->paginate(15);
        // } else {
            // $su_event_reqs = $su_event_reqs_query->paginate(10)->toArray();
        // }
		//echo "<pre>"; print_r($su_event_reqs); die;
        $event_request = '';

        if(empty($su_event_reqs)) {
        	$event_request = '<div class="text-center"> No Record Found.</div>';
        } else {
        	//echo "1"; die;
        	foreach($su_event_reqs['data'] as $su_event_req) {
        		//echo '<pre>'; print_r($su_event_req['calendar_event_type_id']); //die;
        		if($su_event_req['calendar_event_type_id'] == '1') {
        		
        			$description = ServiceUserHealthRecord::select('title as description')->where('id', $su_event_req['event_id'])->first();

        		} else if($su_event_req['calendar_event_type_id'] == '2') {
        			
        			$description = DB::table('su_daily_record')->select('dr.description')
                                        ->join('daily_record as dr','dr.id','su_daily_record.daily_record_id')
                                        ->where('su_daily_record.id', $su_event_req['event_id'])
                                        ->first();
                    // echo "<pre>"; print_r($description); die;

        		} else if($su_event_req['calendar_event_type_id'] == '3') {

        			$description = ServiceUserEarningIncentive::select('su_earning_incentive.star_cost','i.name as description','esc.title as category_name')
                                                ->where('su_earning_incentive.id', $su_event_req['event_id'])
                                                ->join('incentive as i','i.id','su_earning_incentive.incentive_id')
                                                ->join('earning_scheme_category as esc','esc.id','i.earning_category_id')
                                                ->first();

		        } else if($su_event_req['calendar_event_type_id'] == '4') {

		        	$description = ServiceUserCalendarEvent::select('su_calendar_event.id as su_calendar_event_id','su_calendar_event.title as description')
										->where('su_calendar_event.id', $su_event_req['event_id'])
										->first();

		        } else if($su_event_req['calendar_event_type_id'] == '5') {

                    $description = ServiceUserCalendarNote::select('title as description')
                                                            ->where('su_calendar_note.id', $su_event_req['event_id'])
                                                            ->first();

		        } else if($su_event_req['calendar_event_type_id'] == '9') {
		        	$description =  DB::table('su_living_skill')->select('ls.description')
                                            ->join('living_skill as ls','ls.id','su_living_skill.living_skill_id')
                                            ->where('su_living_skill.id', $su_event_req['event_id'])
                                            ->first();

		        } else if($su_event_req['calendar_event_type_id'] == '10') {
		        	$description = DB::table('su_education_record')->select('er.description')
                                                    ->join('education_record as er','er.id','su_education_record.education_record_id')
                                                    ->where('su_education_record.id', $su_event_req['event_id'])
                                                    ->first();

		        } else if($su_event_req['calendar_event_type_id'] == '11') {

		        	$description = ServiceUserLogBook::select('su_log_book.id as su_log_book_id','lb.title as description')
										->join('log_book as lb','lb.id','su_log_book.id')
										->where('lb.added_to_calendar','1')
										->where('su_log_book.id', $su_event_req['event_id'])
										->first();

		        } else {
        			continue;
        		}

                // if($action_type == 'VIEWS') {
                    $description    = (isset($description->description)) ? $description->description : '';
                    $cal_date       = date('d-m-Y', strtotime($su_event_req['date']));
            		$event_request .='<div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 ">
    				                    <div class="form-group col-md-12 col-sm-12 col-xs-12 r-p-0">
    				                         <div class="input-group popovr ">
    				                             <a  class="form-control curs-point view-req-form" event_change_request='.$su_event_req['id'].'>'.$description.' ('.$cal_date.')</a>
    				                        </div>
    				                     </div>
    				                </div>';
                // } 
                /*else if($action_type == 'VIEW') {
                    $description    = (isset($description->description)) ? $description->description : '';
                    $event_request .='<div class="view-req-change">   
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <input type="text" class="form-control" disabled="disabled" placeholder="" value="'.$description.'" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <input type="text" class="form-control" disabled="disabled" placeholder="" value="'.$su_event_req['date'].'" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> New Date: </label>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <input type="text" class="form-control" disabled="disabled" placeholder="" value="'.$su_event_req['new_date'].'" />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Reason: </label>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <textarea disabled="disabled" class="form-control detail-info-txt" rows="3" value="'.$su_event_req['reason'].'"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Status: </label>
                                                <div class="col-md-10 col-sm-10 col-xs-10" id="req_status"> 
                                                    <select name="status" class="form-control">
                                                        <option value="">Select Status</option>
                                                        <option value="2">Accept</option>
                                                        <option value="1">Reject</option> 
                                                    </select>   
                                                </div>
                                            </div>
                                        
                                            <div class="form-group modal-footer m-t-0 modal-bttm">
                                                <input type="hidden" value="'.$su_event_req['id'].'" name="req_id" id="req_id">
                                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                                <button class="btn btn-warning" type="submit"> Submit </button>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <button class="btn btn-warning close" type="submit"> Continue </button> -->
                                            </div>
                                      </div>';
                } */
                
        	}
        }
	        // if($action_type == 'VIEWS') {
                $event_request .= $su_event_reqs_pag->links();
            // } 
        return $event_request; 

    }
}
