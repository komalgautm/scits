<?php
namespace App\Http\Controllers\backEnd\homeManage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\CareTeam, App\CareTeamJobTitle;  
use DB; 

class CareTeamJobTitleController extends Controller { 
    
    public function index(Request $request) { 

        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {

            $care_team_job_titles = CareTeamJobTitle::where('home_id', $home_id)->where('is_deleted','0')->select('id','home_id','title','is_deleted');
            $search = '';

            if(isset($request->limit))
            {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } 
            else
            {
                if(Session::has('page_record_limit')) {

                    $limit = Session::get('page_record_limit');
                } 
                else {
                    $limit = 25;
                }
            }
            if(isset($request->search))
            {
                $search                  = trim($request->search);
                $care_team_job_titles    = $care_team_job_titles->where('title','like','%'.$search.'%');
            }

            $care_team_job_titles = $care_team_job_titles->orderBy('title','asc')->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }    
        
        $page = 'care_team_job_title';
        return view('backEnd.homeManage.careteam_job_title', compact('page', 'limit','care_team_job_titles', 'search')); //users.blade.php
    }

    public function add(Request $request) {     

        // $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');

        $home_id = Session::get('scitsAdminSession')->home_id;
        $care_team_job_title = CareTeamJobTitle::where('home_id', $home_id)->select('id','title')->get();

        if($request->isMethod('post')) {   

            $job_title           =  new CareTeamJobTitle;
            $job_title->home_id  =  $home_id;
            $job_title->title    =  $request->title;
           
            if($job_title->save())  {           
                return redirect('/admin/care-team-job-titles')->with('success', 'Job Title added successfully.');
            }else {
                return redirect()->back()->with('error', 'Error occurred, Try after sometime.');
            }
        }
        $page = 'care_team_job_title';
        return view('backEnd.homeManage.careteam_job_title_form', compact('page', 'care_team_job_title'));
    }

    public function edit(Request $request, $job_title_id) { 	  
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        $job_title  = CareTeamJobTitle::find($job_title_id);

            if($request->isMethod('post'))
            {   
                $job_title->title  =  $request->title;
                
                if($job_title->save()) {   
                   
                   return redirect('/admin/care-team-job-titles')->with('success','Job Title updated successfully.'); 
                }  else   {
                   
                   return redirect()->back()->with('error', 'Error occurred, Try after sometime.'); 
                }  
            }

        if(!empty($job_title)) {

            $job_title_home_id = $job_title->home_id;

            if($home_id != $job_title_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else {
            return redirect('admin/')->with('error','Sorry, Job Title does not exist');
        }

        $page = 'care_team_job_title';
        return view('backEnd.homeManage.careteam_job_title_form', compact('job_title', 'page'));
    }

    public function delete($job_title_id) {  
        
        if(!empty($job_title_id)) {

            $job_title = CareTeamJobTitle::where('id', $job_title_id)->first();

            $job_title_home_id = $job_title->home_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            //compare with su home_id
            if($home_id != $job_title_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $updated = CareTeamJobTitle::where('home_id', $home_id)->where('id', $job_title_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','Job Title deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
                    return redirect('admin/')->with('error','Sorry, Job Title does not exist'); 
            }
    }
}