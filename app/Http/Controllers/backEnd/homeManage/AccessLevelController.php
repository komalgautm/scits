<?php
namespace App\Http\Controllers\backEnd\homeManage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\ManagementSection, App\User, App\AccessRight, App\AccessLevel;  

class AccessLevelController extends Controller
{
    public function index(Request $request) {

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        if(!empty($home_id)) {

             $access_levels_query = AccessLevel::select('id','name')->where('home_id',$home_id)->where('is_deleted','0');
             $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {

                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 25;
                }
            }
            if(isset($request->search))
            {
                $search      = trim($request->search);
                $access_levels_query = $access_levels_query->where('name','like','%'.$search.'%');
            }

            $access_levels = $access_levels_query->orderBy('name','asc')->paginate($limit);
        } else {
            
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $page = 'access_levels';

        return view('backEnd/homeManage/accessLevel/access_levels', compact('page','limit','access_levels','search')); 
    }

    public function view_rights($access_level_id = null) {	

        $admin_home_id = Session::get('scitsAdminSession')->home_id;

        //$access_level = AccessLevel::select('id','name')->where('id',$access_level_id)->first();
        
        // if(empty($access_level)){
        //     return view('frontEnd.error_404');
        // }

        $access_level_right = AccessLevel::select('access_rights','id','name')
                            //->where('access_level_id',$access_level_id)
                            ->where('id',$access_level_id)
                            ->where('home_id', $admin_home_id)
                            ->first();

        $available_rights = array();
        if(!empty($access_level_right)) {
            //get all the access rights of access_level
            $available_rights = explode(',', $access_level_right->access_rights);
        }

        $dashboard_rights = AccessRight::dashboardAccessRightList();
        $access_rights    = AccessRight::accessRightList();

        $page = 'access_levels';

       	return view('backEnd/homeManage/accessLevel/access_rights', compact('page','dashboard_rights','access_rights','available_rights','access_level_right'));
    }

    public function update_rights(Request $request){

        if($request->isMethod('post')) {
            $data = $request->input();
          //  echo "<pre>"; print_r($data); die;
            $admin_home_id = Session::get('scitsAdminSession')->home_id;
            
            $access_str    = AccessRight::getAccessRightString($data);

            $access_level_right = AccessLevel::select('name','id')
                    //->join('access_level','access_level.id','access_level_id')
                    //->where('access_level_id',$data['access_level_id'])
                    ->where('id',$data['access_level_id'])
                    ->where('home_id', $admin_home_id)
                    ->first();
            //echo "<pre>"; print_r($access_level_right); die;

            if(!empty($access_level_right)) {

                $access_level_right->access_rights = $access_str;
                
            } else {
                $access_level_right                  = new AccessLevel;
                $access_level_right->access_rights   = $access_str;
                $access_level_right->home_id         = $admin_home_id;
                //$access_level_right->access_level_id = $data['access_level_id'];
            }

            if($access_level_right->save()) {

                return redirect('admin/home/access-levels')->with("success","Access Rights updated successfully");
            } else{
                return redirect()->back()->with("error",COMMON_ERROR);
            }
       
        }
    }   


    public function add(Request $request) {     

        $home_id = Session::get('scitsAdminSession')->home_id;
      
        if($request->isMethod('post')) {   

            $access_name           =  new AccessLevel;
            $access_name->home_id  =  $home_id;
            $access_name->name     =  $request->name;
           
            if($access_name->save())  {           
                return redirect('/admin/home/access-levels')->with('success', 'Access Level name added successfully.');
            }else {
                return redirect()->back()->with('error', 'Error occurred, Try after sometime.');
            }
        }
        $page = 'access_levels';
        return view('backEnd.homeManage.accessLevel.access_level_name_form', compact('page'));
    }

    public function edit(Request $request, $access_level_right_id) {       
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        $access_name  = AccessLevel::find($access_level_right_id);

            if($request->isMethod('post'))
            {   
                $access_name->name  =  $request->name;
                
                if($access_name->save()) {   
                   
                   return redirect('/admin/home/access-levels')->with('success','Access Level name updated successfully.'); 
                }  else   {
                   
                   return redirect()->back()->with('error', 'Error occurred, Try after sometime.'); 
                }  
            }

        if(!empty($access_name)) {

            $access_name_home_id = $access_name->home_id;

            if($home_id != $access_name_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else {
            return redirect('admin/')->with('error','Sorry, Access Level does not exist');
        }

        $page = 'access_levels';
        return view('backEnd.homeManage.accessLevel.access_level_name_form', compact('access_name', 'page'));
    }

    public function delete($access_level_right_id) {  
        
        if(!empty($access_level_right_id)) {

            $job_title = AccessLevel::where('id', $access_level_right_id)->first();

            $job_title_home_id = $job_title->home_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            //compare with su home_id
            if($home_id != $job_title_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $updated = AccessLevel::where('home_id', $home_id)->where('id', $access_level_right_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','Access Level name deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
            return redirect('admin/')->with('error','Sorry, Job Title does not exist'); 
        }
    }


}