<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ServiceUserRisk;
use App\Models\Risk;
use App\Models\FormBuilder;
use App\Models\ServiceUser;
use App\Models\ServiceUserRmp;
use App\Models\ServiceUserIncidentReport;
use App\Models\DynamicForm;
use App\Models\Notification;
use App\Models\User;
use App\Models\ServiceUserCareTeam;
use App\Models\BodyMap;
use App\Models\DynamicFormBuilder; 
use App\Models\HomeLabel;
use DB,Auth;

class RiskController extends Controller
{
    public function index(Request $request,$service_user_id = null){
       
        $data = $request->input();
        $home_id = Auth::user()->home_id;
        $user_id = Auth::user()->id;
        $today = date('Y-m-d 00:0:00');
        $service_users = ServiceUser::select('id','name')
                            ->where('home_id',$home_id)
                            ->where('is_deleted','0')
                            ->get();       
        $staff_members  =   User::where('is_deleted','0')
                                ->where('home_id', Auth::user()->home_id)
                                ->get();
        
           $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
           $service_user_name = ServiceUser::where('id',$service_user_id)->value('name');
          
           $today = date('Y-m-d');
           //filter
           

             
            if(!empty($data)){
                
                // $log_book_records = DB::table('log_book')
                //                 ->select('log_book.*', 'user.name as staff_name','category.color as category_color')
                //                 ->whereIn('log_book.id',$su_logs)
                //                 ->join('user', 'log_book.user_id', '=', 'user.id')
                //                 ->join('category', 'log_book.category_id', '=', 'category.id')
                //                 ->orderBy('date','desc');
                $log_book_records =  DB::table('su_risk as sur')
                                ->select('sur.*','d.*', 'u.name as staff_name','r.description','r.icon')
                                ->join('dynamic_form as d','d.id','sur.dynamic_form_id')
                                ->join('risk as r','r.id','sur.risk_id')
                            ->join('service_user', 'sur.service_user_id', '=', 'service_user.id')
                            ->leftJoin('user as u','u.id','d.user_id')
                                ->where('sur.service_user_id',$service_user_id)
                                ->where('sur.home_id',$home_id)
                                ->where('r.is_deleted',"0")
                                ->orderBy('sur.created_at','desc');
        
                                       //->whereDate('su_health_record.created_at', '=', $today)
                
                if(isset($request->start_date) && $request->start_date!='null') {
                    $log_book_records = $log_book_records->whereDate('sur.created_at', '>=', $request->start_date);
                    // Log::info("Start Date Logs.");
                    // Log::info($log_book_records->get()->toArray());
                }
                if(isset($request->end_date) && $request->end_date!='null') {
                    $log_book_records = $log_book_records->whereDate('sur.created_at', '<=', $request->end_date);       
                    // Log::info("End Date Logs.");
                    // Log::info($log_book_records->get()->toArray());
                }
                if(isset($request->keyword) && $request->keyword!='null') {
                    $log_book_records = $log_book_records->where('d.details', 'like', '%'.$request->keyword.'%');       
                    // Log::info("End Date Logs.");
                    // Log::info($log_book_records->get()->toArray());
                }


                //$log_book_records = $log_book_records->get()->toArray();
                $log_book_records = $log_book_records->get();
                $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
                //print_r($log_book_records);
                //die;
                
                return compact('log_book_records');
                
            }
           
           $log_book_records = DB::table('su_risk as sur')
                                ->select('sur.*','d.*', 'u.name as staff_name','r.description','r.icon')
                                ->join('dynamic_form as d','d.id','sur.dynamic_form_id')
                                ->join('risk as r','r.id','sur.risk_id')
                               ->whereDate('sur.created_at', '=', $today)
                               ->join('service_user', 'sur.service_user_id', '=', 'service_user.id')
                               ->leftJoin('user as u','u.id','d.user_id')
                                ->where('sur.service_user_id',$service_user_id)
                                ->where('sur.home_id',$home_id)
                                ->where('r.is_deleted',"0")
                                ->orderBy('sur.created_at','desc')->get();
            
            $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
            
           
        
        
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        if($su_home_id != Auth::user()->home_id){
            echo ''; die;
        }

        $risks_query = ServiceUserRisk::select('su_risk.id','su_risk.risk_id','su_risk.created_at','r.description','su_risk.status')
                    ->join('risk as r','r.id','su_risk.risk_id')
                    ->where('su_risk.service_user_id',$service_user_id);

        if(isset($_GET['search'])) { 
            $risks_query = $risks_query->where('r.description','like','%'.$_GET['search'].'%');
        }
        // sourabh
        if(isset($_GET['start_date']) && $_GET['start_date']!='null'){
            
            $risks_query = $risks_query->whereDate('su_risk.created_at','>=',$_GET['start_date']);
        }
        if(isset($_GET['end_date']) && $_GET['end_date']!='null') {
            $risks_query = $risks_query->whereDate('su_risk.created_at','<=',$_GET['end_date']);
        }
        if(isset($_GET['category_id']) && $_GET['category_id']!="all"){           
            $risks_query = $risks_query->where('su_risk.status','=',$_GET['category_id']);          
        }
        if(isset($_GET['keyword']) && $_GET['keyword']!=''){
            $risks_query = $risks_query->where('r.description','like','%'.$_GET['keyword'].'%');            
        }
        // sourabh
               
        $risks = $risks_query->orderBy('su_risk.id','desc')
                    ->paginate(10);
        
        $labels = HomeLabel::getLabels($home_id);
        //getting form patterns
        $form_pattern['bmp_rmp'] = '';
        $form_pattern['risk'] = '';
        $form_pattern['su_rmp'] = '';
        $form_pattern['su_bmp'] = '';
        $form_pattern['su_mfc'] = '';
        $form_pattern['incident_report'] = '';
        $dynamic_forms = DynamicFormBuilder::getFormList();
        $patient = DB::table('service_user')->where('id',$service_user_id)->where('is_deleted','0')->first();
        return view('frontEnd.serviceUserManagement.risk', compact('user_id', 'service_user_id', 'service_user_name', 'home_id', 'su_home_id', 'log_book_records', 'service_users','staff_members','risks','dynamic_forms','form_pattern','labels','patient'));
    }
}
