<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User, App\ServiceUser, App\ServiceUserHealthRecord, App\Calendar, App\PlanBuilder, App\ServiceUserCalendarNote, App\ServiceUserDailyRecord, App\ServiceUserCalendarEvent, App\ServiceUserEarningIncentive, App\ServiceUserLivingSkill, App\ServiceUserEducationRecord, App\HomeLabel, App\ServiceUserLogBook, App\LogBook;
use DB, Session;

class CalendarController extends Controller
{
    public function index($service_user_id = null){
        
        $service_user = ServiceUser::select('home_id','name')->where('id',$service_user_id)->first();
        
        // echo "<pre>"; print_r($service_user); die;

        if(!empty($service_user)){
            $home_id = $service_user->home_id;  
            
            $page_title = trim($service_user->name)."'s Event Calendar";
            
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
            $appointment_plans = PlanBuilder::select('id','home_id','title')
                                                ->where('home_id',$home_id)
                                                ->get();

            $service_users = ServiceUser::select('id','home_id','name')
                                            ->where('home_id',$home_id)
                                            ->where('status','1')
                                            ->get();
                                            
            $labels = HomeLabel::getLabels($home_id);

            return view('backEnd.serviceUser.calendar.calendar', compact('event_type','service_user_id','page_title','health_records','daily_records','su_incentives','event_records','appointment_plans','service_users','calender_notes','living_skills','education_records','labels','su_log_books'));
        } else{
            return view('frontEnd.error_404');
        }
    }

    public function event_detail(Request $request) { //view calendar event detail

        $data               = $request->input();
        $event_id           = $data['event_id'];
        $event_type         = $data['event_type'];
        $event_date         = $data['event_date'];
        $calendar_id        = $data['calendar_id'];
        $service_user_id    = $data['service_user_id'];
        $home_id            = ServiceUser::where('id',$service_user_id)->value('home_id');

        //For Event Change Request
        $evnt_chnge_req_fields  = '';
        $evnt_chnge_req_fields .= '<input type="hidden" name="calendar_id" type="text" value="'.$calendar_id.'"/>';
        $evnt_chnge_req_fields .= '<input type="hidden" name="event_date" type="text" value="'.$event_date.'"/>';
        
        if($event_type == '2') {
            $su_daily_record = ServiceUserDailyRecord::select('su_daily_record.id as su_daily_record_id','su_daily_record.daily_record_id','su_daily_record.details','su_daily_record.scored', 'dr.description')
                                                ->join('daily_record as dr', 'dr.id','su_daily_record.daily_record_id')
                                                ->where('su_daily_record.id', $event_id)
                                                ->join('service_user as sr', 'sr.id','su_daily_record.service_user_id')
                                                ->where('su_daily_record.added_to_calendar', '1')
                                                ->where('sr.home_id', $home_id)
                                                ->first()
                                                ->toArray();

            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Daily Record" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_record_desc" disabled="disabled" class="form-control" value="'. $su_daily_record['description'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Score: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <div class="select-style">
                                            <select name="su_record_score" class="edit_event" disabled="disabled">
                                            <option value="0"'; if($su_daily_record['scored'] == '0') { echo 'selected'; } echo'>0</option>
                                            <option value="1"'; if($su_daily_record['scored'] == '1') { echo 'selected'; } echo'>1</option>
                                            <option value="2"'; if($su_daily_record['scored'] == '2') { echo 'selected'; }echo'>2</option>
                                            <option value="3"'; if($su_daily_record['scored'] == '3') { echo 'selected'; }echo'>3</option>
                                            <option value="4"'; if($su_daily_record['scored'] == '4') { echo 'selected'; }echo'>4</option>
                                            <option value="5"'; if($su_daily_record['scored'] == '5') { echo 'selected'; }echo'>5</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_record_detail" class="form-control txtarea edit_event" value="">'.$su_daily_record['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_daily_record_id" type="text" value="'.$su_daily_record['su_daily_record_id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';
        } else if($event_type == '1') {

            $su_health_record = ServiceUserHealthRecord::select('su_health_record.id as health_record_id','su_health_record.title','su_health_record.details')
                                            ->join('service_user as su', 'su.id','su_health_record.service_user_id')
                                            ->where('su_health_record.id', $event_id)
                                            ->where('su.home_id', $home_id)
                                            ->first()
                                            ->toArray();

            echo '<div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class=" form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Health Record" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_record_title" disabled="disabled" class="form-control" value="'.$su_health_record['title'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_record_detail" class="form-control txtarea edit_event" value="">'.$su_health_record['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_health_record_id" type="text" value="'.$su_health_record['health_record_id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';                        
        } else if($event_type == '5') {

            $su_note = ServiceUserCalendarNote::select('su_calendar_note.id','su_calendar_note.title as note_title','su_calendar_note.note as title')
                                        ->join('service_user as su', 'su.id','su_calendar_note.service_user_id')
                                        ->where('su_calendar_note.id', $event_id)
                                        ->where('su.home_id', $home_id)
                                        ->first()
                                        ->toArray();
        
            echo   '<div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class=" form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Service User Note" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                    <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <input name="note_title" disabled="disabled" class="form-control edit_event edit_note" maxlength="255" value="'.$su_note['note_title'].'"/>
                                    </div>
                                </div>
                                <div class=" form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_note_title" class="form-control txtarea edit_event edit_detail" value="">'.$su_note['title'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_note_id" type="text" value="'.$su_note['id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';

        } else if($event_type == '4') {

            //dynamic events
            $form_response = PlanBuilder::showFormWithValue($event_id);
                
            if($form_response['response'] == true){
                
                $event_form = $form_response['pattern'];
                //return $event_form;
            } else{
                $event_form = '';
            }

            echo '  <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input name="" value="Event Record" type="text" class="form-control" readonly="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-t-5 p-0 text-right"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input name="" value="'.$form_response['title'].'" type="text" class="form-control" readonly="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" type="text" name="su_calendar_event_id" value="'.$event_id.'"/>
                    <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                    echo $evnt_chnge_req_fields;
            echo  $event_form;
            // $result['response']     = true; 
            // return $result;
        } else if($event_type == '3') {
            $su_incentive = ServiceUserEarningIncentive::select('su_earning_incentive.id as su_ern_inc_id', 'su_earning_incentive.star_cost','incentive.name','su_earning_incentive.time','su_earning_incentive.detail')
                                    ->join('incentive','incentive.id','su_earning_incentive.incentive_id')
                                    ->where('su_earning_incentive.id', $event_id)
                                    ->orderBy('su_earning_incentive.id','desc')
                                    ->join('service_user as su', 'su.id','su_earning_incentive.service_user_id')
                                    ->where('su.home_id', $home_id)
                                    ->first()
                                    ->toArray();
            // echo "<pre>";
            // print_r($su_incentive);
            // die;
            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Incentive" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Name: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="incentive_name" disabled="disabled" class="form-control" value="'.$su_incentive['name'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Stars Spend: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                           <div class="stars-sec">';
                                                for($i=1; $i <= $su_incentive['star_cost']; $i++) {
                                                    echo '<span class="inc-detail-star"><i class="fa fa-star"></i></span>';
                                                }
                                            echo '</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Time: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_incentive_time" disabled="disabled" class="form-control edit_event" value="'.$su_incentive['time'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_incentive_detail" class="form-control txtarea edit_event" value="">'.$su_incentive['detail'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_incentive_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';
        } elseif($event_type == '6') {
            $staff_annual_leave = StaffAnnualLeave::select('staff_annual_leave.id','staff_annual_leave.title','staff_annual_leave.leave_date','staff_annual_leave.reason','staff_annual_leave.comments')
                                ->where('staff_annual_leave.id', $event_id)
                                ->join('user', 'user.id','staff_annual_leave.staff_member_id')
                                ->where('staff_annual_leave.home_id', $home_id)
                                ->first()
                                ->toArray();
            
            $leave_date = date('d-m-Y', strtotime($staff_annual_leave['leave_date']));

            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Staff Annual Leave" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="annual_leave_title" disabled="disabled" class="form-control edit_event edit_note" value="'.$staff_annual_leave['title'].'" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 cog-panel datepicker-sttng p-0">
                                    <label class="col-sm-1 col-xs-12 r-p-0"> Leave Date: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                            <input name="annual_leave_leave_date" type="text" value="'.$leave_date.'" size="16" readonly class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Reason: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="annual_leave_reason" class="form-control txtarea edit_event edit_detail" value="">'.$staff_annual_leave['reason'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0 p-l-0">Comment:</label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="annual_leave_comment" class="form-control txtarea edit_event" value="">'.$staff_annual_leave['comments'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="staff_annual_leave_id" type="text" value="'.$staff_annual_leave['id'].'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';
        } elseif($event_type == '7') {
            $staff_sick_leave = StaffSickLeave::select('staff_sick_leave.id','staff_sick_leave.title','staff_sick_leave.leave_date','staff_sick_leave.reason','staff_sick_leave.comments')
                                ->where('staff_sick_leave.id', $event_id)
                                ->join('user', 'user.id','staff_sick_leave.staff_member_id')
                                ->where('staff_sick_leave.home_id', $home_id)
                                ->first()
                                ->toArray();
            
            $leave_date = date('d-m-Y', strtotime($staff_sick_leave['leave_date']));

            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Staff Sick Leave" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="sick_leave_title" disabled="disabled" class="form-control edit_event edit_note" value="'.$staff_sick_leave['title'].'" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 cog-panel datepicker-sttng p-0">
                                    <label class="col-sm-1 col-xs-12 r-p-0"> Leave Date: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                            <input name="sick_leave_leave_date" type="text" value="'.$leave_date.'" size="16" readonly class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Reason: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="sick_leave_reason" class="form-control txtarea edit_event edit_detail" value="">'.$staff_sick_leave['reason'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0 p-l-0">Comment:</label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="sick_leave_comment" class="form-control txtarea edit_event" value="">'.$staff_sick_leave['comments'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="staff_sick_leave_id" type="text" value="'.$staff_sick_leave['id'].'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                                
                        echo '</div>
                        </div>';
        }   elseif($event_type == '8') {
            $staff_task_allocation = StaffTaskAllocation::select('staff_task_allocation.id','staff_task_allocation.title','staff_task_allocation.details')
                                ->where('staff_task_allocation.id', $event_id)
                                ->join('user', 'user.id','staff_task_allocation.staff_member_id')
                                ->where('staff_task_allocation.home_id', $home_id)
                                ->first()
                                ->toArray();
            
            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Staff Task Allocation" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="task_title" disabled="disabled" class="form-control edit_event edit_note" value="'.$staff_task_allocation['title'].'" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="task_detail" class="form-control txtarea edit_event edit_detail" value="">'.$staff_task_allocation['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="staff_task_id" type="text" value="'.$staff_task_allocation['id'].'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                        echo '</div>
                        </div>';
        }  else if ($event_type == '9') {
            $su_living_skill = ServiceUserLivingSkill::select('su_living_skill.id as su_living_skill_id','su_living_skill.living_skill_id','ls.description','su_living_skill.details','su_living_skill.scored')
                                                ->join('living_skill as ls', 'ls.id','su_living_skill.living_skill_id')
                                                ->where('su_living_skill.id', $event_id)
                                                ->join('service_user as su', 'su.id','su_living_skill.service_user_id')
                                                ->where('su_living_skill.added_to_calendar', '1')
                                                ->where('su.home_id', $home_id)
                                                ->first()
                                                ->toArray();

            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Living Skill" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_skill_desc" disabled="disabled" class="form-control" value="'. $su_living_skill['description'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Score: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <div class="select-style">
                                            <select name="su_skill_score" class="edit_event" disabled="disabled">
                                            <option value="0"'; if($su_living_skill['scored'] == '0') { echo 'selected'; } echo'>0</option>
                                            <option value="1"'; if($su_living_skill['scored'] == '1') { echo 'selected'; } echo'>1</option>
                                            <option value="2"'; if($su_living_skill['scored'] == '2') { echo 'selected'; }echo'>2</option>
                                            <option value="3"'; if($su_living_skill['scored'] == '3') { echo 'selected'; }echo'>3</option>
                                            <option value="4"'; if($su_living_skill['scored'] == '4') { echo 'selected'; }echo'>4</option>
                                            <option value="5"'; if($su_living_skill['scored'] == '5') { echo 'selected'; }echo'>5</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_skill_detail" class="form-control txtarea edit_event" value="">'.$su_living_skill['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_living_skill_id" type="text" value="'.$su_living_skill['su_living_skill_id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                        echo '</div>
                        </div>';
        }   else if ($event_type == '10') {
            $su_education_record = ServiceUserEducationRecord::select('su_education_record.id as su_education_record_id','su_education_record.education_record_id','er.description','su_education_record.details','su_education_record.scored')
                                                ->join('education_record as er', 'er.id','su_education_record.education_record_id')
                                                ->where('su_education_record.id', $event_id)
                                                ->join('service_user as su', 'su.id','su_education_record.service_user_id')
                                                ->where('su_education_record.added_to_calendar', '1')
                                                ->where('su.home_id', $home_id)
                                                ->first()
                                                ->toArray();
    
            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Event Type: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Education Record" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Title: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <input name="su_education_desc" disabled="disabled" class="form-control" value="'. $su_education_record['description'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Score: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <div class="select-style">
                                            <select name="su_education_score" class="edit_event" disabled="disabled">
                                            <option value="0"'; if($su_education_record['scored'] == '0') { echo 'selected'; } echo'>0</option>
                                            <option value="1"'; if($su_education_record['scored'] == '1') { echo 'selected'; } echo'>1</option>
                                            <option value="2"'; if($su_education_record['scored'] == '2') { echo 'selected'; }echo'>2</option>
                                            <option value="3"'; if($su_education_record['scored'] == '3') { echo 'selected'; }echo'>3</option>
                                            <option value="4"'; if($su_education_record['scored'] == '4') { echo 'selected'; }echo'>4</option>
                                            <option value="5"'; if($su_education_record['scored'] == '5') { echo 'selected'; }echo'>5</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-2 col-xs-12 color-themecolor r-p-0 p-t-5 p-0 text-right"> Details: </label>
                                    <div class="col-sm-10 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="su_education_detail" class="form-control txtarea edit_event" value="">'.$su_education_record['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="su_education_record_id" type="text" value="'.$su_education_record['su_education_record_id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>';
                                echo $evnt_chnge_req_fields;
                        echo '</div>
                        </div>';
        } else if ($event_type == '11') {
            $log_book = LogBook::select('log_book.id as log_book_id','log_book.details','log_book.title')
                                                ->where('log_book.id', $event_id)
                                                ->where('log_book.home_id', $home_id)
                                                ->first()
                                                ->toArray();
    
            echo '      <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor p-t-5 r-p-0"> Event Type: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <input name="su_event_type" class="form-control" value="Log Book" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor p-t-5 r-p-0"> Title: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <input name="log_book_title" disabled="disabled" class="form-control" value="'. $log_book['title'].'" type="text">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor p-t-5 r-p-0"> Details: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="log_book_detail" class="form-control txtarea edit_event edit_detail" value="">'.$log_book['details'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="log_book_id" type="text" value="'.$log_book['log_book_id'].'"/>
                                <input type="hidden" name="event_id" type="text" value="'.$event_id.'"/>
                                <input type="hidden" name="event_type" type="text" value="'.$event_type.'"/>
                            </div>
                        </div>';
        }  else {
            
        }
    }
    /*Note: About this event_detail function in controller
        This controller is used for viewing the detail of calendar events which has been booked into the calendar.
    */
}