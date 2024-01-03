<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DB;
use App\Models\User;
use App\Models\ServiceUser;
use App\Models\ServiceUserHealthRecord;
use App\Models\Calendar;
use App\Models\PlanBuilder;
use App\Models\ServiceUserCalendarNote;
use App\Models\ServiceUserDailyRecord;
use App\Models\ServiceUserCalendarEvent;
use App\Models\ServiceUserEarningIncentive;
use App\Models\ServiceUserLivingSkill;
use App\Models\ServiceUserEducationRecord;
use App\Models\HomeLabel;
use App\Models\ServiceUserLogBook;
use App\Models\LogBook;
use App\Models\MandatoryLeave;

class CalendarController extends Controller
{
    public function index($service_user_id = null) {
        // echo 1;die;
        $data['staff_members']  =   User::where('is_deleted','0')
                                    ->where('home_id', Auth::user()->home_id)
                                    ->get();
        
        $service_user = ServiceUser::select('home_id','name')->where('id',$service_user_id)->first();
        
        // if(!empty($service_user)){
        if(isset($service_user) && $service_user !=''){
            $home_id = Auth::user()->home_id;   
            
            if($service_user->home_id != $home_id){
                return redirect('/')->with('error',UNAUTHORIZE_ERR); 
            }

            $data['page_title'] = trim($service_user->name)."'s Event Calendar";
            
            //Health Records
            $health_records = ServiceUserHealthRecord::select('su_health_record.id as health_record_id','su_health_record.title')
                                            ->join('service_user as su', 'su.id','su_health_record.service_user_id')
                                            ->where('su_health_record.service_user_id', $service_user_id)
                                            ->where('su_health_record.is_deleted', '0')
                                            ->where('su.home_id', $home_id)
                                            ->orderBy('health_record_id','desc')
                                            ->get()
                                            ->toArray();
        
            foreach ($health_records as $key => $health_record) {
                // check if this health_record is booked in calendar
                $event_id   = $health_record['health_record_id'];
                $event_type = '1';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $health_records[$key] = array_merge($health_records[$key],$booking_response);

            }
            
            //Daily Records
            $daily_records = ServiceUserDailyRecord::select('su_daily_record.id as su_daily_record_id','su_daily_record.daily_record_id','dr.description' )
                                                    ->join('daily_record as dr', 'dr.id','su_daily_record.daily_record_id')
                                                    ->join('service_user as su', 'su.id','su_daily_record.service_user_id')
                                                    ->where('su_daily_record.service_user_id', $service_user_id)
                                                    ->where('su_daily_record.is_deleted', '0')
                                                    ->where('su_daily_record.added_to_calendar', '1')
                                                    ->where('su.home_id',$home_id)
                                                    ->orderBy('su_daily_record.id','desc')
                                                    ->get()
                                                    ->toArray();

            foreach ($daily_records as $key => $daily_record) {
                //check if this health record is booked in calendar
                $event_id = $daily_record['su_daily_record_id'];
                $event_type = '2';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $daily_records[$key] = array_merge($daily_records[$key],$booking_response);
            }   

            //Living Skills
            $living_skills = ServiceUserLivingSkill::select('su_living_skill.id as su_living_skill_id','su_living_skill.living_skill_id','ls.description')
                                                    ->join('living_skill as ls','ls.id','su_living_skill.living_skill_id')
                                                    ->join('service_user as su', 'su.id','su_living_skill.service_user_id')
                                                    ->where('su_living_skill.service_user_id', $service_user_id)
                                                    ->where('su_living_skill.is_deleted','0')
                                                    ->where('su_living_skill.added_to_calendar', '1')
                                                    ->where('su.home_id', $home_id)
                                                    ->orderBy('su_living_skill.id','desc')
                                                    ->get()
                                                    ->toArray();

            foreach ($living_skills as $key => $living_skill) {
                //check if this living skill is booked in calendar
                $event_id = $living_skill['su_living_skill_id'];
                $event_type = '9';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $living_skills[$key] = array_merge($living_skills[$key],$booking_response);
            }   
            //Living Skills End

            //Education Records
            $education_records = ServiceUserEducationRecord::select('su_education_record.id as su_education_record_id','su_education_record.education_record_id','er.description')
                                                    ->join('education_record as er','er.id','su_education_record.education_record_id')
                                                    ->join('service_user as su', 'su.id','su_education_record.service_user_id')
                                                    ->where('su_education_record.service_user_id', $service_user_id)
                                                    ->where('su_education_record.is_deleted','0')
                                                    ->where('su_education_record.added_to_calendar', '1')
                                                    ->where('su.home_id', $home_id)
                                                    ->orderBy('su_education_record.id','desc')
                                                    ->get()
                                                    ->toArray();

            foreach ($education_records as $key => $education_record) {
                //check if this education record is booked in calendar
                $event_id = $education_record['su_education_record_id'];
                $event_type = '10';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $education_records[$key] = array_merge($education_records[$key],$booking_response);
            }   
            //Education Records End
            
            //earningScheme incentives
            $su_incentives   = ServiceUserEarningIncentive::select('su_earning_incentive.id as su_ern_inc_id', 'su_earning_incentive.star_cost','incentive.name')
                                        ->join('incentive','incentive.id','su_earning_incentive.incentive_id')
                                        ->where('su_earning_incentive.service_user_id', $service_user_id)
                                        ->where('incentive.is_deleted','0')
                                        // ->where('su.home_id', $home_id)
                                        ->orderBy('su_earning_incentive.id','desc')
                                        ->get()
                                        ->toArray();

            foreach ($su_incentives as $key => $su_incentive) {
                //check if this incentive is booked in calendar
                $event_id   = $su_incentive['su_ern_inc_id'];
                $event_type = '3';

                $booking_response    = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $su_incentives[$key] = array_merge($su_incentives[$key],$booking_response);
            }

            //calendar added events
            $event_records = ServiceUserCalendarEvent::select('su_calendar_event.id as su_calendar_event_id','su_calendar_event.title','su.id as su_id')
                                        ->join('service_user as su', 'su.id', 'su_calendar_event.service_user_id')
                                        ->where('su_calendar_event.service_user_id', $service_user_id)
                                        ->where('su.home_id',$home_id)
                                        ->where('su_calendar_event.is_deleted','0')
                                        ->orderBy('su_calendar_event.id','desc')
                                        ->get()
                                        ->toArray();

            foreach ($event_records as $key => $event_record) {

                //check if this event_record is booked in calendar
                $event_id = $event_record['su_calendar_event_id'];
                $event_type = '4';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $event_records[$key] = array_merge($event_records[$key],$booking_response);
            }

            //calendar added notes
            $calender_notes = ServiceUserCalendarNote::select('su_calendar_note.id','su_calendar_note.title as note_title','su_calendar_note.note as title')
                                    ->join('service_user as su', 'su.id','su_calendar_note.service_user_id')
                                    ->where('su_calendar_note.service_user_id', $service_user_id)
                                    ->where('su.home_id', $home_id)
                                    ->where('su_calendar_note.is_deleted', '0')
                                    ->orderBy('su_calendar_note.id','desc')
                                    ->get()
                                    ->toArray();
        
            foreach($calender_notes as $key => $calender_note){
                
                // check if this note is booked in calendar
                $event_id   = $calender_note['id'];
                $event_type = '5';
                
                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $calender_notes[$key] = array_merge($calender_notes[$key],$booking_response);
            }

            //service user log records
            $su_log_books = ServiceUserLogBook::select('su_log_book.id as su_log_book_id','lb.title as log_title','su_log_book.service_user_id','lb.id as log_book_id')
                                        ->join('log_book as lb','lb.id','su_log_book.log_book_id')
                                        ->where(['lb.added_to_calendar'=>'1', 'lb.is_deleted'=>'0'])
                                        ->where('su_log_book.service_user_id', $service_user_id)

                                        ->get()
                                        ->toArray();
            // echo "<pre>"; print_r($su_log_books); die;
            foreach ($su_log_books as $key => $su_log_book) {
                
                //check if this log record is booked in calendar
                $event_id   = $su_log_book['log_book_id'];
                $event_type = '11';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $su_log_books[$key] = array_merge($su_log_books[$key],$booking_response);
            }

            //data for add entry form
            $data['appointment_plans'] = PlanBuilder::select('id','home_id','title')
                                                ->where('home_id',$home_id)
                                                ->where('is_deleted','0')
                                                ->get();
            $data['service_users'] = ServiceUser::select('id','home_id','name')->where('home_id',$home_id)->where('status','1')->get();
            $data['labels'] = HomeLabel::getLabels($home_id);
            $data['guide_tag']='su_cal';


            // Mandatory Leave
            $mandatory_leave_records = MandatoryLeave::select('mandatory_leaves.id as mandatory_leaves_id', 'mandatory_leaves.title', 'su.id as su_id')
            ->join('service_user as su', 'su.id', 'mandatory_leaves.service_user_id')
            ->where('mandatory_leaves.service_user_id', $service_user_id)
            ->where('su.home_id', $home_id)
            ->where('mandatory_leaves.is_deleted', '0')
            ->orderBy('mandatory_leaves.id', 'desc')
            ->get()
            ->toArray();

            // echo "<pre>"; print_r($mandatory_leave_records); die;

            foreach ($mandatory_leave_records as $key => $mandatory_leave_record) {
                
                //check if this log record is booked in calendar
                $event_id   = $mandatory_leave_record['mandatory_leaves_id'];
                $event_type = '12';

                $booking_response = Calendar::checkIsEventAddedtoCalendar($service_user_id,$event_id,$event_type);
                $mandatory_leave_records[$key] = array_merge($mandatory_leave_records[$key],$booking_response);
            }

            // End Mandatory Leave
            // echo "<pre>"; print_r($mandatory_leave_records); die;
            $data['event_type']=$event_type;
            $data['service_user_id']=$service_user_id;
            $data['health_records']=$health_records;
            $data['daily_records']=$daily_records;
            $data['su_incentives']=$su_incentives;
            $data['event_records']=$event_records;
            $data['calender_notes']=$calender_notes;
            $data['living_skills']=$living_skills;
            $data['education_records']=$education_records;
            $data['su_log_books']=$su_log_books;
            $data['mandatory_leave_records']=$mandatory_leave_records;
            return view('frontEnd.serviceUserManagement.calendar',$data);
        } else {
            return view('frontEnd.error_404');
        }
    }

    public function add_event(Request $request){

        if($request->isMethod('post')) {
            $data = $request->input();

            $home_id    = Auth::user()->home_id;
            $su_home_id = ServiceUser::where('id',$data['service_user_id'])->value('home_id');
            if($su_home_id != $home_id){
                //return redirect('/')->with('error',UNAUTHORIZE_ERR); 
                $result['response'] = false;
                return $result;
            }

            $calendar                         = new Calendar;
            $calendar->service_user_id        = $data['service_user_id'];
            $calendar->calendar_event_type_id = $data['event_type'];
            $calendar->event_id               = $data['event_id'];
            $calendar->event_date             = date('Y-m-d',strtotime($data['event_date']));
            $calendar->home_id                = $home_id;
            if($calendar->save()){
                $result['response'] = true;
                $result['calendar_id'] = $calendar->id;
            } else{
                $result['response'] = false;
                $result['calendar_id'] = 0;
            }
            return $result;
        }       

    }
    public function move_event(Request $request){

        $data = $request->all();
        $event_calendar_id = $data['event_calendar_id'];

        $calendar = Calendar::find($event_calendar_id);
        if(!empty($calendar)) {
        
            $su_home_id = ServiceUser::where('id',$calendar->service_user_id)->value('home_id');
            if($su_home_id != Auth::user()->home_id){
                echo 'false'; die;
            }
            
            $calendar->event_date   = date('Y-m-d',strtotime($data['event_date']));

            if($calendar->save()){
                echo 'true';
            }
            else{
                echo 'false';
            }
            die;
        }
    }
}
