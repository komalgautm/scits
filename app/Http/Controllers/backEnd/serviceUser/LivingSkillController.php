<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceUserLivingSkill;
use DB, Session;

class LivingSkillController extends Controller
{
    public function index($service_user_id, Request $request) {   

        $su_living_skills = ServiceUserLivingSkill::select('su_living_skill.*','ls.description')
                                    ->join('living_skill as ls','su_living_skill.living_skill_id','=','ls.id')
                                    ->where('ls.status','1')
                                    ->where('su_living_skill.is_deleted','0')
                                    ->where('su_living_skill.service_user_id',$service_user_id)
                                    ->orderBy('su_living_skill.id','desc')
                                    ->orderBy('su_living_skill.created_at','desc');
                                    // ->get()->toArray();
        // echo "<pre>"; print_r($su_living_skills); die;
        
        $search = '';

        if(isset($request->limit)) {

            $limit = $request->limit;
            Session::put('page_record_limit',$limit);

        } else {

            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else {
                $limit = 10;
            }
        }    

        if(isset($request->search)) {
            
            $search = trim($request->search);
            // echo $search; die;
            $su_living_skills = $su_living_skills->where('ls.description','like','%'.$search.'%');             //search by date or title
        }  

        $su_living_skills = $su_living_skills->paginate($limit);                      
        
        $page = 'service-users-living-skill';

        return view('backEnd.serviceUser.livingSkill.living_skills', compact('page','limit', 'service_user_id','su_living_skills','search')); 
    }

    public function view($su_living_skill_id = null) {
        
        $skill_info = ServiceUserLivingSkill::select('su_living_skill.*','ls.description')
                                    ->join('living_skill as ls','su_living_skill.living_skill_id','=','ls.id')
                                    ->where('su_living_skill.id', $su_living_skill_id)
                                    ->first();

        // echo "<pre>"; print_r($skill_info); die;

         $page = 'service-users-living-skill';
         return view('backEnd.serviceUser.livingSkill.living_skill_form', compact('page','skill_info'));

    }

}