<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\LivingSkill;  
use DB; 

class LivingSkillController extends Controller {

    public function index(Request $request) {   
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }
        $living_skill = DB::table('living_skill')->select('id','description','status')->where('is_deleted','0')->where('home_id',$home_id);
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else {
            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            }   else  {
                $limit = 25;
            }
        }
        if(isset($request->search)) {
            $search         = trim($request->search);
            $living_skill   = $living_skill->where('description','like','%'.$search.'%');
        }

        $living_skill_results = $living_skill->orderBy('description','asc')->paginate($limit);
        
        $page = 'living_skill';
        return view('backEnd/living_skill', compact('page', 'limit', 'search', 'living_skill_results')); 
    }

    public function add(Request $request) { 	
        if($request->isMethod('post'))  {
            
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            $living_skill                  = new LivingSkill;
            $living_skill->home_id         = $home_id;
            $living_skill->description     = $request->description;
            $living_skill->status          = $request->status;
            
            if($living_skill->save()) {
                return redirect('admin/living-skill')->with('success', 'Living Skill added successfully.');
            } 
            else {
                return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
            }
        }
        $page = 'living_skill';
        return view('backEnd.living_skill_form', compact('page'));
    }

    public function edit(Request $request, $skill_id) { 	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($request->isMethod('post')) {
            $living_skill = LivingSkill::find($skill_id);
            if(!empty($living_skill)) {
                
                //comparing home_id
                $su_home_id = LivingSkill::where('id',$skill_id)->value('home_id');
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                $living_skill->description = $request->description;
                $living_skill->status      = $request->status;

                if($living_skill->save()) {
                   return redirect('admin/living-skill')->with('success','Living Skill Updated successfully.'); 
                }  else {
                   return redirect()->back()->with('error','Living Skill could not be Updated Successfully.'); 
                }  
            }
        }

        $living_skill_info   = DB::table('living_skill')
                                ->where('id', $skill_id)
                                ->first();

        if(!empty($living_skill_info)) {
            if($living_skill_info->home_id != $home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        } else {
                return redirect('admin/')->with('error','Sorry, Living Skill Scheme does not exists');
        }

        $page = 'living_skill';
        return view('backEnd/living_skill_form', compact('living_skill_info','page'));
    }

    public function delete($skill_id) {
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($skill_id)) {
            $skill_delete = DB::table('living_skill')->where('id',$skill_id)->where('home_id', $home_id)->update(['is_deleted' => '1']);

            if(!empty($skill_delete)) { 
                return redirect('admin/living-skill')->with('success','Living Skill deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
        } else {
                return redirect('admin/living-skill')->with('error','Sorry, Living Skill does not exists'); 
        }

    }

}