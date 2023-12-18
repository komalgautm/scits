<?php

namespace App;
use DB, Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class ServiceUserCareTeam extends Model
{
    protected $table = 'su_care_team';

    //send report to care team
    public static function sendReport($service_user_id = null, $title = null, $details = null) {

    	$care_team = DB::table('su_care_team')
                        ->select('id','job_title_id','name','email','phone_no','image','address')
                        ->where('service_user_id',$service_user_id)
                        ->where('is_deleted','0')
                        ->get()->toArray();
        // echo "<pre>"; print_r($care_team); die;
        if(!empty($care_team)){

	        $company_name = PROJECT_NAME;

	        foreach ($care_team as $key => $value) {

	        	$email  = $value->email;
		        $name   = $value->name;

				if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {   
	                Mail::send('emails.report', ['name'=>$name, 'title'=>$title, 'details'=>$details], function($message) use ($email,$company_name)
	                {
	                    $message->to($email,$company_name)->subject('SCITS Report');
	                });
	            } 
		    }	
		}
        return false;
    }
    

}