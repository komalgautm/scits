<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\LeaveType;
use App\Models\Staffleaves;
use App\Models\LoginInActivity;
use App\Models\ServiceUser;

class AndroidApiController extends Controller
{
    public function user_login(Request $request)
    {
        if($request->user_name===null)
        {
            return response()->json(['success'=> false, 'message'=>'Please provide username..!'], 200);
        }
        if($request->password==null)
        {
            return response()->json(['success'=> false, 'message'=>'Please provide valid password..!'], 200);
        }

        $recordArray = array();
        $check_username = ServiceUser::where('user_name', $request->user_name)->first();
        if (!$check_username) {
            return response()->json(['success'=> false, 'message'=>'Invalid Email Address!'], 200);
        }
        if (!Hash::check($request->password, $check_username->password)) {

            return response()->json(['success'=> false, 'message'=>'Invalid Password!'], 200);

        }else{
            $data['id'] = $check_username->id;
            $data['home_id'] = $check_username->home_id;
            $data['name'] = $check_username->name;
            $data['user_name'] = $check_username->user_name;
            $data['phone_no'] = $check_username->phone_no;
            $data['date_of_birth'] = $check_username->date_of_birth;
            $data['section'] = $check_username->section;
            $data['admission_number'] = $check_username->admission_number;
            $data['short_description'] = $check_username->short_description;
            $data['height'] = $check_username->height;
            $data['weight'] = $check_username->weight;
            $data['hair_and_eyes'] = $check_username->hair_and_eyes;
            $data['markings'] = $check_username->markings;
            $data['image'] = $check_username->image;
            $data['email'] = $check_username->email;
            $data['personal_info'] = $check_username->personal_info;
            $data['education_history'] = $check_username->education_history;
            $data['bereavement_issues'] = $check_username->bereavement_issues;
            $data['drug_n_alcohol_issues'] = $check_username->drug_n_alcohol_issues;
            $data['mental_health_issues'] = $check_username->mental_health_issues;
            $data['current_location'] = $check_username->current_location;
            $data['previous_location'] = $check_username->previous_location;
            $data['mobile'] = $check_username->mobile;
            // $data['last_loc_area_type'] = $check_username->last_loc_area_type;
            // $data['location_get_interval'] = $check_username->location_get_interval;
            $data['created_at'] = $check_username->created_at;
            array_push($recordArray, $data);
            return response()->json(['success'=> true, 'message'=>'You have successfully logged in.','user_data'=> $recordArray[0]], 200);
        }
    }

    public function get_leave_list()
    {
        $recordArray = array();
        $leaves = LeaveType::where('status', 1)->get();
        foreach( $leaves as $leave ){
            $data['id'] = $leave->id; 
            $data['leave_name'] = $leave->leave_name; 
            $data['leave_category'] = $leave->leave_category; 
            array_push($recordArray, $data);
        }

        if(!$recordArray){
            return response()->json(['success'=>false,'message'=>'No data'], 200);
        }
        return response()->json(['success'=>true,'message'=>'','Data'=>$recordArray], 200);
    }

    public function add_user_leave(Request $request)
    {
        if($request->userId==null){
            return response()->json(['success'=> false, 'message'=>'Please provide user id..!'], 200);
        }
        if($request->home_id==null){
            return response()->json(['success'=> false, 'message'=>'Please provide home id..!'], 200);
        }
        if($request->leaveType==null){
            return response()->json(['success'=> false, 'message'=>'Please provide leave Type..!'], 200);
        }

        if($request->start_date==null){
            return response()->json(['success'=> false, 'message'=>'Please provide start date..!'], 200);
        }

        if($request->endDate==null){
            return response()->json(['success'=> false, 'message'=>'Please provide end date..!'], 200);
        }

        if($request->ongoingLeave == "yes"){
            $ongoingLeave = 1;
        }else {
            $ongoingLeave = 0;
        }

        if(empty($request->start_date)){
            $date = $late_date;
        } else {
            $date = $request->start_date;
        }
        if(empty($request->late_time)){
            $late_time = null;
        }else{
            $late_time = $request->late_time;
        }
        if(empty($request->missed_days)){
            $missed_working_days = null;
        }else{
            $missed_working_days = $request->missed_days;
        }

        $add_leave = array(
            'home_id' => $request->home_id,
            'user_id' => $request->userId,
            'leave_type' => $request->leaveType,
            'ongoing_absence' => $ongoingLeave,
            'start_date' => $date,
            'start_date_full_half' => $request->start_date_full_half,
            'end_date' => $request->endDate,    
            'end_date_full_half' => $request->end_date_full_half,
            'late_by' => $late_time,
            'notes' => $request->notes,
            'days' => $missed_working_days,
            'leave_status' => 0,
            'is_deleted' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")  
        );
        $data = Staffleaves::insert($add_leave);
        
        if(!$data){
            return response()->json(['success'=>false,'message'=>'No data'], 200);
        }
        return response()->json(['success'=>true,'message'=>'Record inserted successfully','Data'=>$data], 200);
    }

    public function get_user_leave(Request $request)
    {
        if($request->user_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide user id..!'], 200);
        }
        $recordArray = array();
        $leaves = Staffleaves::where('user_id', $request->user_id)->where('is_deleted', 1)->orderBy('id', 'DESC')->get();

        foreach($leaves as $leave){
            $data['user_id'] = $leave->user_id;
            $data['leave_type'] = $leave->leave_type;
            $data['start_date'] = $leave->start_date;
          
            if(is_null($leave->end_date)){
                $end_date = "";
                $days = 0;
            } else {
                $end_date = $leave->end_date;
                $to = \Carbon\Carbon::parse($leave->start_date);
                $from = \Carbon\Carbon::parse($leave->end_date);
                $days = $to->diffInDays($from);
               
            }
            $data['days'] = $days;
            $data['end_date'] = $end_date;

            if(is_null($leave->notes)){
               $notes = "";
            } else {
                $notes = $leave->notes;
            }
            $data['notes'] = $notes;
          
            $data['leave_status'] = $leave->leave_status;
            $data['created_at'] = \Carbon\Carbon::parse( $leave->created_at)->format('d-m-Y');
            array_push($recordArray, $data);
        }

        if(!$recordArray){
            return response()->json(['success'=>false,'message'=>'No data'], 200);
        }
        return response()->json(['success'=>true,'message'=>'','Data'=>$recordArray], 200);
    }

    public function add_login_activity(Request $request)
    {
        if($request->user_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us user id..!'], 200);
        } else if($request->latitude_in == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us latitude..!'], 200);
        } else if($request->longitude_in == null){
            return response()->json(['success'=> false, 'message'=>'Please provide longitude..!'], 200);
        } else if($request->home_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide home id..!'], 200);
        } else {

            $record = ServiceUser::where('id', $request->user_id)->where('is_deleted', 0)->where('home_id', $request->home_id)->get();
            if( $record->count() == 1 ){
                $activity = new LoginInActivity();
                $activity->user_id = $request->user_id;
                $activity->login_date = date('Y-m-d');
                $activity->latitude_in = $request->latitude_in;
                $activity->longitude_in = $request->longitude_in;
                $activity->home_id = $request->home_id;
                $activity->save();
    
                if($activity->id){
                    return response()->json(['success'=>true,'message'=>'Checked in successfully..! ','Data'=>$activity->id], 200);
                }
                return response()->json(['success'=>false,'message'=>'Error in record insert'], 200);
            } else {
                return response()->json(['success'=>false,'message'=>'Invalid QR code'], 200);
            }
         
           
        }
    }
    public function check_out_activity(Request $request)
    {
        if($request->user_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us user id..!'], 200);
        }
        if($request->activity_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us activity id..!'], 200);
        }
        if($request->latitude_out == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us latitude..!'], 200);
        }
        if($request->longitude_out == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us longitude..!'], 200);
        }
        if($request->home_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us home id..!'], 200);
        }

        $record = ServiceUser::where('id', $request->user_id)->where('is_deleted', 0)->where('home_id', $request->home_id)->get();
        if( $record->count() == 1 ){
            $response = LoginInActivity::where('id', $request->activity_id)->where('user_id', $request->user_id)->where('company_id', $request->company_id)->update(['check_out_time'=>date("Y-m-d H:i:s"), 'latitude_out'=> $request->latitude_out, 'longitude_out'=>$request->longitude_out]);

            if($response){
                return response()->json(['success'=>true,'message'=>'Checked out successfully..! ','Data'=>$response], 200);
            }
            return response()->json(['success'=>false,'message'=>'Error in record update'], 200);
        } else {
            return response()->json(['success'=>false,'message'=>'Invalid QR code'], 200);
        }      
    }

    public function get_user_activity(request $request)
    {
        if($request->user_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us user id..!'], 200);
        }
        $recordArray = array();
        $activities = LoginInActivity::where('user_id', $request->user_id)->orderBy('id', 'DESC')->where('is_deleted', 0)->get();

       for ($i=0; $i < sizeof($activities); $i++) { 
            $data['id'] = $activities[$i]['id'];
            $data['login_date'] = $activities[$i]['login_date'];
            $data['check_in_time'] = $activities[$i]['check_in_time'];
            $data['latitude_in'] = $activities[$i]['latitude_in'];
            $data['longitude_in'] = $activities[$i]['longitude_in'];
            if(is_null($activities[$i]['check_out_time'])){
                $check_out = "";
            } else {
                $check_out = $activities[$i]['check_out_time'];
            }
            $data['check_out_time'] = $check_out;
            if(is_null($activities[$i]['latitude_out']) || is_null($activities[$i]['longitude_out']) ){
                $latitude_out = "";
                $longitude_out = "";
            } else {
                $latitude_out = $activities[$i]['latitude_out'];
                $longitude_out = $activities[$i]['longitude_out'];
            }
            $data['latitude_out'] = $latitude_out;
            $data['longitude_out'] = $longitude_out;
            array_push($recordArray, $data);
       }

        if($recordArray){
            return response()->json(['success'=>true,'message'=>' ','Data'=>$recordArray], 200);
        }
        return response()->json(['success'=>false,'message'=>'No data'], 200);
    }

    public function QRCode(Request $request)
    {
        if($request->val == 1){
            $qr_id = uniqid('qr');
            $admin = Admin::where('id', $request->id)->update(['qr_code_id' => $qr_id]);
        } 
        $details['qr_code_id'] = Admin::where('id', $request->id)->value('qr_code_id');

        echo json_encode($details);
        
    }

    public function get_company_data(Request $request)
    {
        if($request->qr_id == null){
            return response()->json(['success'=> false, 'message'=>'Please provide us qr_id..!'], 200);
        }
        $details = Admin::where('qr_code_id', $request->qr_id)->first();

        $data['company_id'] = $details->id;
        $data['name'] = $details->name;
        $data['user_name'] = $details->user_name;
        $data['email'] = $details->email;
        $data['company'] = $details->company;
        $data['access_type'] = $details->access_type;
        $data['home_id'] = $details->home_id;
        $data['image'] = $details->image;   
        $data['security_code'] = $details->security_code;   
        $data['qr_code_id'] = $details->qr_code_id;    
        $data['address'] = $details->address;    
        $data['latitude'] = $details->latitude;    
        $data['longitude'] = $details->longitude;  

        if($data){
            return response()->json(['success'=>true,'message'=>' ','Data'=>$data], 200);
        }
        return response()->json(['success'=>false,'message'=>'No data'], 200);

    }
}
