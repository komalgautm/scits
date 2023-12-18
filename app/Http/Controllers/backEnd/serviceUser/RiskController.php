<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceUser, App\ServiceUserRisk, App\DynamicFormBuilder, App\DynamicForm, App\DynamicFormLocation;
use Session, DB;

class RiskController extends Controller
{
    
    public function index($service_user_id, Request $request) {   

        $risks_query = ServiceUserRisk::select('su_risk.id','su_risk.risk_id','su_risk.created_at','r.description','su_risk.status','su_risk.dynamic_form_id','su_risk.rmp_id','su_risk.incident_report_id')
                            ->join('risk as r','r.id','su_risk.risk_id')
                            ->where('su_risk.service_user_id',$service_user_id)
                            ->orderBy('su_risk.created_at','desc');
        //                     ->get()
        //                     ->toArray();
        // echo "<pre>"; print_r($risks_query); die;
        
        $search = '';

        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else {

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 10;
            }
        }    

        if(isset($request->search)) {
            
            $search = trim($request->search);
            // echo $search; die;
            $risks_query = $risks_query->where('r.description','like','%'.$search.'%');             //search by date or title
        }  

        $risks_query = $risks_query->paginate($limit);                      
        
        $page = 'service-users-risk';

        return view('backEnd.serviceUser.risk.risks', compact('page','limit', 'service_user_id','risks_query','search')); 
    }

    public function view(Request $request, $su_risk_id) {
        
        //echo "<pre>"; print_r($request->input()); die;

        $risk_type  = $request->risk;

        $risk_info  = DB::table('su_risk as sur')
                            ->select('sur.id as sur_id','sur.risk_id','sur.created_at','sur.status','sur.dynamic_form_id','sur.rmp_id','sur.incident_report_id','r.description','r.home_id','sur.service_user_id')
                            ->where('sur.id',$su_risk_id)
                            ->join('risk as r','r.id','sur.risk_id')
                            ->first();
        // echo "<pre>"; print_r($risk_info); //die;

        if(empty($risk_info)) {
            return redirect('/admin/service-users')->with('error', COMMON_ERROR);
        }

        if($risk_type == 'risk_change') {
            $dynamic_form_id = $risk_info->dynamic_form_id;
        } else if($risk_type == 'rmp_risk') {
            $dynamic_form_id = $risk_info->rmp_id;
        } else {
            $dynamic_form_id = $risk_info->incident_report_id;
        }

        if($dynamic_form_id == '') {
            return redirect('/admin/service-user/risks/'.$risk_info->service_user_id)->with('error', 'Form is not filled.');
        }
        // echo $dynamic_form_id; die;

        $result = DynamicForm::showFormWithValue($dynamic_form_id, false);
        // echo "<pre>"; print_r($result); die;
        $service_user_id = $result['service_user_id'];
        $result = $result['form_data'];
        // echo $service_user_id; die;
        // return $result;

        $page = 'service-users-risk';
        return view('backEnd.serviceUser.risk.risk_form', compact('result','page','service_user_id', 'su_risk_id'));       
    }

}