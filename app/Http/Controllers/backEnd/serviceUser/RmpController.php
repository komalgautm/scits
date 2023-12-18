<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceUser, App\FormBuilder, App\ServiceUserRmp, App\DynamicFormBuilder, App\DynamicForm, App\DynamicFormLocation;
use Session;

class RmpController extends Controller
{
    public function index($service_user_id, Request $request) {   

        $this_location_id  = DynamicFormLocation::getLocationIdByTag('rmp');
        $su_rmp_records       = DynamicForm::select('dynamic_form.id','dynamic_form.user_id','dynamic_form.title','dynamic_form.date','u.name')
                                    ->join('user as u','u.id','dynamic_form.user_id')
                                    ->where('dynamic_form.location_id',$this_location_id)
                                    ->where('dynamic_form.service_user_id',$service_user_id)
                                    ->where('dynamic_form.is_deleted','0')
                                    ->orderBy('dynamic_form.id','desc');
                                    // ->get()->toArray();
        // echo "<pre>"; print_r($su_rmp_recordssu_rmp_records); die;
        
        $search = '';

        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else{

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 10;
            }
        }    

        if(isset($request->search)) {
            
            $search = trim($request->search);
            // echo $search; die;
            $su_rmp_records = $su_rmp_records->where('dynamic_form.title','like','%'.$search.'%');             //search by date or title
        }  

        $su_rmp_records = $su_rmp_records->paginate($limit);                      
        
        $page = 'service-users-rmp';
        return view('backEnd.serviceUser.rmp.rmps', compact('page','limit', 'service_user_id','su_rmp_records','search')); 
    }

    public function view(Request $request, $d_rmp_form_id) {
        
        // echo $d_rmp_form_id; die;
        $result = DynamicForm::showFormWithValue($d_rmp_form_id, false);
        // echo "<pre>"; print_r($result); die;
        $service_user_id = $result['service_user_id'];
        $result = $result['form_data'];
        // echo $service_user_id; die;
        // return $result;

        $page = 'service-users-rmp';
        return view('backEnd.serviceUser.rmp.rmp_form', compact('result','page','service_user_id', 'd_rmp_form_id'));       
    }

}