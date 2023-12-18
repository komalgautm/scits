<?php
namespace App\Http\Controllers\backEnd\generalAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\User, App\AgendaMeeting;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class AgendaMeetingController extends Controller
{
    public function index(Request $request) {	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }
        $meeting_query = AgendaMeeting::select('id','title','created_at')
                                        ->where('is_deleted','0')
                                        ->where('home_id',$home_id)
                                        ->orderBy('id','desc');
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else {

            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search)) {
            $search      = trim($request->search);
            $meeting_query = $meeting_query->where('title','like','%'.$search.'%');
        }

        /*if($limit == 'all') {
            $users = $users_query->get();
        } else{
            $users = $users_query->paginate($limit);
        }*/

        $meetings = $meeting_query->paginate($limit);

        //$users = DB::table('user')->select('id','name','user_name', 'email', 'access_level')->paginate(25);
        $page = 'agenda_meeting';
       	return view('backEnd/generalAdmin/AgendaMeeting/agenda_meetings', compact('page','limit','meetings','search')); //users.blade.php
    }

    	
   	public function view($meeting_id = null) { 

        $home_id = Session::get('scitsAdminSession')->home_id;
       	$meeting = AgendaMeeting::where('id', $meeting_id)
                                    ->first();

        // echo "<pre>"; print_r($meeting); die;
        $present_users = '';
        $not_present_users = '';
        $users = '';
        if(!empty($meeting)) {
            $staff_present     = explode(',', $meeting->staff_present);
            $staff_not_present = explode(',', $meeting->staff_not_present);
            //echo "<pre>"; print_r($staff_present); print_r($staff_not_present); die;
            $present_users = User::select('id','user_name','name')->where('home_id',$home_id)->where('is_deleted','0')->whereIn('id',$staff_present)->get()->toArray();
            $not_present_users = User::select('id','user_name','name')->where('home_id',$home_id)->where('is_deleted','0')->whereIn('id',$staff_not_present)->get()->toArray();
            // echo "<pre>"; print_r($present_users); print_r($not_present_users); die;
        }


        $page = 'agenda_meeting';
        return view('backEnd/generalAdmin/AgendaMeeting/agenda_meeting_form', compact('meeting','page','users','present_users','not_present_users'));
    }

  

}
