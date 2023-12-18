<?php
namespace App\Http\Controllers\backEnd\generalAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\WeeklyAllowance;  
use DB; 
use Illuminate\Support\Facades\Mail;

class WeeklyAllowanceController extends Controller
{
    public function index(Request $request) {	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $weekly_allowance_query = WeeklyAllowance::select('weekly_allowance.id','weekly_allowance.service_user_id','weekly_allowance.amount','weekly_allowance.created_at','weekly_allowance.status','su.name')
                                ->join('service_user as su', 'su.id','weekly_allowance.service_user_id')
                                ->where('su.home_id',$home_id)
                                ->orderBy('weekly_allowance.id','desc');
        
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
            $weekly_allowance_query = $weekly_allowance_query->where('name','like','%'.$search.'%');
        }

        $weekly_allowance = $weekly_allowance_query->paginate($limit);

        $page = 'weekly_allowance';
       	return view('backEnd/generalAdmin/WeeklyAllowance/weekly_allowance', compact('page','limit','weekly_allowance','search'));
    }


  

}
