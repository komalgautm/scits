<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomeLabel, App\ServiceUser, App\ServiceUserEarningTarget, App\ServiceUserEarningStar, App\EarningScheme, App\Incentive, App\EarningAreaPercentage, App\ServiceUserDailyRecord, App\ServiceUserLivingSkill, App\ServiceUserEducationRecord, App\DynamicFormLocation, App\DynamicForm, App\EarningSchemeLabel,App\EarningSchemeLabelRecord;
use DB, Session;

class EarningSchemeController extends Controller
{
    public function index($service_user_id, Request $request) {
        

        $home_id = Session::get('scitsAdminSession')->home_id;
         //echo $home_id; die;

        $labels         = HomeLabel::getLabels($home_id);             
        $earning_target = ServiceUserEarningTarget::getEarningTarget($service_user_id);   

        $total_stars    = ServiceUserEarningStar::where('service_user_id',$service_user_id)->value('star');
        $total_stars    = (int)$total_stars; 

        $earning_scheme = EarningScheme::where('home_id', $home_id)
                                        ->where('status', '1')
                                        ->orderBy('id','desc')
                                        ->get()
                                        ->toArray();

        foreach ($earning_scheme as $key => $value) {
            $incentives_count = Incentive::where('earning_category_id',$value['id'])
                                          ->where('status','1')
                                          ->count();
            $earning_scheme[$key]['incentives_count'] = $incentives_count;
        }

        $record_score      = EarningScheme::getRecordsScore($service_user_id);
        $earn_area_percent = EarningAreaPercentage::select('daily_record','education_record','living_skill','mfc')->first();
        $earn_history      = EarningScheme::earningHistory($service_user_id);

        $earning_scheme_label = EarningSchemeLabel::where('deleted_at',null)->get()->toArray();
        $service_user_labels  = ServiceUser::where('id',$service_user_id)->value('earning_scheme_label_id');
        $service_user_labels  = explode(',',$service_user_labels);
        // echo "<pre>"; print_r($earning_scheme_label); die;
        //$booked_incentives="sxss";

        $page = 'service-users-earn-schm';
        
        return view('backEnd.serviceUser.earningScheme.earning_scheme', compact('page','service_user_id','labels','earning_target','total_stars','earning_scheme','record_score','earn_area_percent','earn_history','earning_scheme_label','service_user_labels')); 
    }


    /*------ Incentives Start ------*/
    public function view_incentive($earning_category_id) { 

        $incentive = Incentive::select('incentive.id','name','stars','details','url','earning_scheme_category.title')
                                ->leftJoin('earning_scheme_category','earning_scheme_category.id','incentive.earning_category_id')
                                ->where('earning_category_id', $earning_category_id)
                                ->get()
                                ->toArray();
     
        foreach ($incentive as $key => $value) {
    
        echo   '<div class="incen-main">
                    <div class="">
                        <h4> '.$value['name'].' 
                            <a href="'.url('/service/earning-scheme/incentive/add?incentive_id='.$value['id']).'"  class="confirm_to_clndr" stars_need="'.$value['stars'].'">
                            </a>
                        </h4>
                    </div>
                    <p>'.$value['details'].'</p>
                    <a href="'.$value['url'].'" target="_blank" class="incen-link">'.$value['url'].'</a>
                    <div class="stars-sec">
                        <span class="star-head"> Stars : </span>';
                        for($i=1; $i <= $value['stars']; $i++) {
                            echo '<span><i class="fa fa-star"></i></span>';
                        }
                    echo '</div>
                </div>';
        } 
        die;
    }
    /*------ Incentives End ------*/

    /*------- Daily Record Start --------*/
    public function daily_record(Request $request,$service_user_id,$label_id) {

        $data = $request->all();
        $label_type = EarningSchemeLabel::where('id',$label_id)->value('label_type');
        // echo "<pre>"; print_r($label_type); die;
        $earning_scheme_label_record_ids = EarningSchemeLabelRecord::select('id')
                                                                     ->where('earning_scheme_label_id',$label_id)
                                                                     ->where('deleted_at',null)
                                                                     ->where('status',1)
                                                                     ->get()->toArray();

        $earning_scheme_label_record_ids = array_map(function($v){ return $v['id']; }, $earning_scheme_label_record_ids);
        
        if($label_type == 'I'){

            $su_living_skills = EarningSchemeLabel::with('label_records.records_of_living_skill')
                                                        ->whereHas('label_records.records_of_living_skill',function($query) use ($service_user_id){
                                                                $query->where('service_user_id',$service_user_id);
                                                            })
                                                        ->where('id',$label_id);

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
                 $su_daily_record_query = EarningSchemeLabel::with('label_records.records_of_living_skill')
                                                        ->whereHas('label_records.records_of_living_skill',function($query) use ($search) {
                                                                $query->where('description','like','%'.$search.'%');
                                                            })
                                                        ->where('id',$label_id);
                // $su_living_skills = $su_living_skills->where('ls.description','like','%'.$search.'%');             //search by date or title
                // echo $search; die;
            }  

            $su_living_skills = $su_living_skills->paginate($limit);                      
            
            $page = 'service-users-earn-schm';
            return view('backEnd.serviceUser.earningScheme.living_skill', compact('page','limit', 'service_user_id','su_living_skills','search'));  
        }elseif($label_type == 'G'){
            $su_daily_record_query = EarningSchemeLabel::with('label_records.records_of_general_behaviour')
                                                        ->whereHas('label_records.records_of_general_behaviour',function($query) use ($service_user_id){
                                                                $query->where('service_user_id',$service_user_id);
                                                            })
                                                        ->where('id',$label_id);
        }elseif($label_type == 'E') {
            $su_edu_records = EarningSchemeLabel::with('label_records.records_of_education')
                                                        ->whereHas('label_records.records_of_education',function($query) use ($service_user_id){
                                                                $query->where('service_user_id',$service_user_id);
                                                            })
                                                        ->where('id',$label_id);
            // $this->education_record($data);
            // echo "<pre>"; print_r($su_edu_records); die;
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
                $su_daily_record_query = EarningSchemeLabel::with('label_records.records_of_general_behaviour')
                                                        ->whereHas('label_records.records_of_general_behaviour',function($query) use ($search) {
                                                                $query->where('description','like','%'.$search.'%');
                                                            })
                                                        ->where('id',$label_id);
                // $su_edu_records = $su_edu_records->where('er.description','like','%'.$search.'%');             //search by date or title
            }  

            $su_edu_records = $su_edu_records->paginate($limit);                      
            
            $page = 'service-users-earn-schm';
            return view('backEnd.serviceUser.earningScheme.education_record', compact('page','limit', 'service_user_id','su_edu_records','search')); 
        }
        
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
            $su_daily_record_query = EarningSchemeLabel::with('label_records.records_of_living_skill')
                                                        ->whereHas('label_records.records_of_living_skill',function($query) use ($search) {
                                                                $query->where('description','like','%'.$search.'%');
                                                            })
                                                        ->where('id',$label_id);
        }  

        $su_daily_record_query = $su_daily_record_query->paginate($limit);                      
        
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.daily_record', compact('page','limit', 'service_user_id','label_id','su_daily_record_query','search','label_type')); 
    }

    public function daily_record_view($daily_record_id = null,$label_type){

        // echo "<pre>"; print_r($label_type); die;
        // $label_type = 'I';
        if($label_type == 'I'){ /*echo "string"; die;*/
            $var = $this->living_skill_view($daily_record_id);
            return $var;
        }elseif($label_type == 'E'){
            $var = $this->education_record_view($daily_record_id);
            return $var;
        }else{
            $dr_info = ServiceUserDailyRecord::select('su_daily_record.*','dr.description')
                                            ->join('earning_scheme_label_records as dr','su_daily_record.daily_record_id','=','dr.id')
                                            ->where('su_daily_record.id',$daily_record_id)
                                            ->first();
        }
        // echo "<pre>"; print_r($dr_info); die;

        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.daily_record_form', compact('page','dr_info','search'));
    }
    /*------- Daily Record End --------*/


    /*------- Living Skill Start --------*/
    public function living_skill($service_user_id, Request $request) {

        $su_living_skills = ServiceUserLivingSkill::select('su_living_skill.*','ls.description')
                                    ->join('living_skill as ls','su_living_skill.living_skill_id','=','ls.id')
                                    ->where('ls.status','1')
                                    ->where('su_living_skill.is_deleted','0')
                                    ->where('su_living_skill.service_user_id',$service_user_id)
                                    ->orderBy('su_living_skill.id','desc')
                                    ->orderBy('su_living_skill.created_at','desc');
                                    // ->get()
                                    // ->toArray();
        // echo "<pre>"; print_r($su_daily_record_query); die;
        
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
            $su_living_skills = $su_living_skills->where('ls.description','like','%'.$search.'%');             //search by date or title
            // echo $search; die;
        }  

        $su_living_skills = $su_living_skills->paginate($limit);                      
        
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.living_skill', compact('page','limit', 'service_user_id','su_living_skills','search')); 
    }  

    function living_skill_view($living_skill_id) {

        $ls_info = ServiceUserLivingSkill::select('su_living_skill.*','eslr.description')
                            ->join('earning_scheme_label_records as eslr','su_living_skill.living_skill_id','=','eslr.id')
                            ->where('su_living_skill.id',$living_skill_id)
                            ->first();
        
        // echo "<pre>"; print_r($ls_info); die;
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.living_skill_form', compact('page','ls_info','search'));
    } 
    /*------- Living Skill End --------*/


    /*------- Education Records Start --------*/
    function education_record($service_user_id, Request $request) {   

        $su_edu_records = ServiceUserEducationRecord::select('su_education_record.*','er.description')
                                    ->join('education_record as er','su_education_record.education_record_id','=','er.id')
                                    ->where('er.status','1')
                                    ->where('su_education_record.is_deleted','0')
                                    ->where('su_education_record.service_user_id',$service_user_id)
                                    ->orderBy('su_education_record.id','desc')
                                    ->orderBy('su_education_record.created_at','desc');
                                    // ->get()
                                    // ->toArray();
        // echo "<pre>"; print_r($su_daily_record_query); die;
        
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
            $su_edu_records = $su_edu_records->where('er.description','like','%'.$search.'%');             //search by date or title
        }  

        $su_edu_records = $su_edu_records->paginate($limit);                      
        
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.education_record', compact('page','limit', 'service_user_id','su_edu_records','search')); 
    }

    function education_record_view($education_record_id = null) {

        $ed_info =  ServiceUserEducationRecord::select('su_education_record.*','eslr.description')
                                ->join('earning_scheme_label_records as eslr','su_education_record.education_record_id','=','eslr.id')
                                ->where('su_education_record.id',$education_record_id)
                                ->first();
        
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.education_record_form', compact('page','ed_info','search'));
    }
    /*------- Education Records End --------*/


    /*------- MFC Records --------*/
    public function mfc($service_user_id = null, Request $request) {

        $this_location_id  = DynamicFormLocation::getLocationIdByTag('mfc');

        $mfc_records       = DynamicForm::select('dynamic_form.id','dynamic_form.user_id','dynamic_form.title','dynamic_form.date','u.name')
                                    ->join('user as u','u.id','dynamic_form.user_id')
                                    ->where('dynamic_form.location_id',$this_location_id)
                                    ->where('dynamic_form.service_user_id',$service_user_id)
                                    ->where('dynamic_form.is_deleted','0')
                                    ->orderBy('dynamic_form.id','desc');
                                    // ->get()
                                    // ->toArray();

        
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
            $mfc_records = $mfc_records->where('dynamic_form.title','like','%'.$search.'%');            
        }  

        $mfc_records = $mfc_records->paginate($limit);                      
        
        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.mfcs', compact('page','limit', 'service_user_id','mfc_records','search'));   
    }

    public function mfc_view($d_mfc_id = null) {

        $result = DynamicForm::showFormWithValue($d_mfc_id, false);
        // echo "<pre>"; print_r($result); die;
        $service_user_id = $result['service_user_id'];
        $result = $result['form_data'];
        // echo $service_user_id; die;
        // return $result;

        $page = 'service-users-earn-schm';
        return view('backEnd.serviceUser.earningScheme.mfc_form', compact('result','page','service_user_id', 'd_mfc_id')); 
    }
    /*------- MFC Records End --------*/

    /*---------Add Label in service user-------------------*/
    public function add_earning_scheme_label(Request $request,$service_user_id,$earning_scheme_label_id){
        
        //echo "<pre>"; print_r($service_user_id); die;
        $label_id = ServiceUser::where('id',$service_user_id)->value('earning_scheme_label_id');
        
        if(!empty($label_id)){
            $label_ids = explode(',', $label_id);
            foreach($label_ids as $key => $value) {
                if($value == $earning_scheme_label_id){
                    return $res = 'success'; 
                }
            }
            $new_labels = $label_id.','.$earning_scheme_label_id;  
            $update = ServiceUser::where('id',$service_user_id)->update(['earning_scheme_label_id'=> $new_labels]);
            return $res = 'success';
        }else{ 
            $update = ServiceUser::where('id',$service_user_id)->update(['earning_scheme_label_id'=> $earning_scheme_label_id]);
            return $res = 'success';
        }
        return $res = 'fail';
    }

    public function delete_earning_scheme_label(Request $request,$service_user_id,$earning_scheme_label_id){

        $label_id = ServiceUser::where('id',$service_user_id)->value('earning_scheme_label_id');
        if(!empty($label_id)){
            $label_ids =  explode(',', $label_id);
            if (($key = array_search($earning_scheme_label_id, $label_ids)) !== false) {
                unset($label_ids[$key]);
            }
            // echo "<pre>"; print_r($label_ids); die;
            $new_label_ids = implode(',', $label_ids);

            // $new_label_ids = ltrim($new_label_ids, ',');
            //echo "<pre>"; print_r($new_label_ids); die;
            $update = ServiceUser::where('id',$service_user_id)->update(['earning_scheme_label_id'=> $new_label_ids]);
            if(!empty($update)){
                return $res = 'success';
            }else{
                return $res = 'fail';
            }
        }else{
            return $res = 'fail';
        }
    }
} 