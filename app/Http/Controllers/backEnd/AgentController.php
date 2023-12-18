<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\User, App\Home, App\UserQualification, App\AccessLevel;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function agents(Request $request) {	 
        // echo "1"; die;
        // echo "<pre>"; print_r($request->input()); die;
        $admin                  = Session::get('scitsAdminSession');

        $home_id                = $admin->home_id; 
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        $access_type            = $admin->access_type;
        // $cmpny_id = $admin->compny_id; 
        
        // echo $access_type; die;
        $del_status = '0';
        if($request->user) { //for achive users
            $del_status = '1';
        }
               
        if(!empty($home_id)) {

            if($access_type == 'S'){
                $agents_query =  DB::table('user as u')
                                ->select('u.id','u.user_name as name', 'u.email', 'u.job_title', 'u.access_level')
                                ->where('u.is_deleted',$del_status)
                                ->where('u.admn_id',$selected_company_id)
                                ->where('u.user_type','A');
            }else{
                $agents_query =  DB::table('user as u')
                                ->select('u.id','u.user_name as name', 'u.email', 'u.job_title', 'u.access_level')
                                ->where('u.is_deleted',$del_status)
                                ->where('u.admn_id',$admin->id)
                                ->where('u.user_type','A');
    
            }

            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {

                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 20;
                }
            }
            if(isset($request->search))
            {
                $search      = trim($request->search);
                $agents_query = $agents_query->where('u.name','like','%'.$search.'%');
            }

            /*if($limit == 'all') {
                $users = $agents_query->get();
            } else{
                $users = $agents_query->paginate($limit);
            }*/

            $agents = $agents_query->paginate($limit);
            //echo '<pre>'; print_r($users); die;
        } else {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }
        
        $page = 'agents';

       	return view('backEnd/agents', compact('page','limit','agents','search','del_status')); //agents.blade.php
    }


    public function add(Request $request) { 

        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $home_id                = $admin->home_id; 
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');

        if($request->isMethod('post')) {
            // echo "<pre>"; print_r($request->input()); //die;
            
            $data = $request->input();
            $check_hm_id_exist = in_array($home_id, $data['home_id']);

            if(empty($check_hm_id_exist)){
                array_push($data['home_id'], $home_id);
            }
            $home_id = implode(',', $data['home_id']);
            // echo "<pre>"; print_r($home_id); die;
            // foreach ($data['home_id'] as $key => $value) {
                
            if(!empty($data['date_of_joining'])) {

                $date_of_joining = date('Y-m-d',strtotime($data['date_of_joining']));
            } else {

                $date_of_joining = null;
            }
            
            if(!empty($data['date_of_leaving'])) {

                $date_of_leaving = date('Y-m-d',strtotime($data['date_of_leaving']));
            } else {
                $date_of_leaving = null;   
            }
            
            
            $user                       = new User;
            $user->home_id              = $home_id;
            $user->name                 = $request->name;
            $user->user_name            = $request->user_name;
            $user->email                = $request->email;
            //$random_no                  = rand(111111,999999);
            $user->password             = '';
            //$user->password             = Hash::make($random_no);
            //$user->password           = Hash::make($request->password);
            $user->job_title            = $request->job_title;
            $user->access_level         = '';
            $user->description          = $request->description;
            $user->payroll              = $request->payroll;
            $user->holiday_entitlement  = $request->holiday_entitlement;
            $user->date_of_joining      = $date_of_joining;
            $user->date_of_leaving      = $date_of_leaving;
            $user->status               = $request->status;
            $user->phone_no             = $request->phone_no;
            $user->user_type            = 'A';
            if($access_type == 'S'){

                $user->admn_id          = $selected_company_id;
            }else{

                $user->admn_id          = $admin->id;
            }

            $user->current_location     = nl2br(trim($request->current_location));
            $user->personal_info        = nl2br(trim($request->personal_info));
            $user->banking_info         = nl2br(trim($request->banking_info));
            $user->qualification_info   = nl2br(trim($request->qualification_info));

            if(!empty($_FILES['image']['name']))
            {
                $tmp_image  =   $_FILES['image']['tmp_name'];
                $image_info =   pathinfo($_FILES['image']['name']);
                $ext        =   strtolower($image_info['extension']);
                $new_name   =   time().'.'.$ext; 
               
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                {
                    $destination = base_path().userProfileImageBasePath; 
                  
                    if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                    {
                        $user->image = $new_name;
                    }
                }
            }
            if(!isset($user->image)) {
                $user->image = '';
            }

            //if checkbox is checked
            // if(isset($data['assign_right_check'])) {
            //     //save access rights according to access level
            //     $access_level_info  = AccessLevel::select('id','access_rights')
            //                         ->where('home_id', $value)
            //                         ->where('id', $user->access_level)
            //                         ->first();

            //     if(!empty($access_level_info)){
            //         $user->access_rights = $access_level_info->access_rights;
            //     }
            // }
                // $user->save();
            // }
            if($user->save())
            {
                User::saveQualification($data,$user->id);
                return redirect('admin/agents')->with('success', 'Agent added successfully.');
            } 
            else
            {
                return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
            }
        }

        $access_levels  = AccessLevel::select('id','name')->where('home_id', $home_id)->get()->toArray();
        if($access_type == 'O'){//if admin is owner of company (normal admin) 1.e. system admin

            $access_homes   = Home::select('id','title','admin_id')->where('admin_id',$admin->id)->where('is_deleted','0')->get()->toArray();
        }else{
            if($selected_home_id == 0){ //initial super admin case when no home is selected
                $access_homes = array();
            } else{ //when home has been already selected
                $access_homes  = Home::select('id','title','admin_id')->where('admin_id',$selected_company_id)
                                        ->where('is_deleted','0')->get()->toArray();
            }
        }
        // echo "<pre>"; print_r($access_homes); die;  

        $page = 'agents';
        return view('backEnd.agent_form', compact('page','access_levels','access_homes'));
    }
            
    public function edit(Request $request, $agent_id) {   
        
        
        $del_status = '0';
        if($request->del_status) { //for achive users
            $del_status = $request->del_status;
        } 

        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $home_id                = $admin->home_id; 
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if(!Session::has('scitsAdminSession')) {   
            return redirect('admin/login');
        }
        
        $agent_info  = User::with('certificates')
                        ->where('id', $agent_id)
                        ->where('is_deleted', $del_status)
                        ->first();
        // echo "<pre>"; print_r($agent_info); die;
        if(!empty($agent_info)) { 
            if($access_type == 'S'){
                if($agent_info->admn_id != $selected_company_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
            }else{
                if($agent_info->admn_id != $admin->id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }    
            }
        } else {
            return redirect('admin/')->with('error','Sorry, User does not exists');
        }

        $access_levels  = AccessLevel::select('id','name')->where('home_id', $home_id)->get()->toArray();
        if($access_type == 'O'){//if admin is owner of company (normal admin) 1.e. system admin

            $access_homes   = Home::select('id','title','admin_id')->where('admin_id',$admin->id)->where('is_deleted','0')->get()->toArray();
        }else{
            if($selected_home_id == 0){ //initial super admin case when no home is selected
                $access_homes = array();
            } else{ //when home has been already selected
                $access_homes  = Home::select('id','title','admin_id')->where('admin_id',$selected_company_id)
                                        ->where('is_deleted','0')->get()->toArray();
            }
        }
        if($request->isMethod('post')) {
            
            $data = $request->input();

            $check_hm_id_exist = in_array($home_id, $data['home_id']);

            if(empty($check_hm_id_exist)){
                array_push($data['home_id'], $home_id);
            }
            $home_id = implode(',', $data['home_id']);

            $user = User::find($agent_id);
                       
            if(!empty($user)) {

                //comparing su home_id
                // $u_home_id = User::where('id',$agent_id)->value('home_id');
                // if($value != $u_home_id) {
                //     return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
                // }

                if(!empty($data['date_of_joining'])) {
                    
                    $date_of_joining = date('Y-m-d',strtotime($data['date_of_joining']));
                } else {
                    $date_of_joining = null;
                }
                
                if(!empty($data['date_of_leaving'])) {

                    $date_of_leaving = date('Y-m-d',strtotime($data['date_of_leaving']));
                } else {
                    $date_of_leaving = null;   
                }
                
                $user_old_image         = $user->image;
                $user->home_id          = $home_id;
                $user->name             = $request->name;
                //$user->user_name        = $request->user_name;
                $user->email            = $request->email;
                $user->job_title        = $request->job_title;
                $user->access_level     = '';
                $user->description      = $request->description;
                $user->payroll          = $request->payroll;
                $user->holiday_entitlement = $request->holiday_entitlement;
                $user->date_of_joining  = $date_of_joining;
                $user->date_of_leaving  = $date_of_leaving;
                $user->status           = $request->status;
                $user->phone_no         = $request->phone_no;

                $user->current_location     =  nl2br(trim($request->current_location));
                $user->personal_info        =  nl2br(trim($request->personal_info));
                $user->banking_info         =  nl2br(trim($request->banking_info));
                $user->qualification_info   =  nl2br(trim($request->qualification_info));
                /*if(!empty($request->password))
                {
                    $user->password   = Hash::make($request->password);
                }*/

                if(!empty($_FILES['image']['name'])) {
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                    {
                        $destination=   base_path().userProfileImageBasePath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        {
                            if(!empty($user_old_image)){
                                if(file_exists($destination.'/'.$user_old_image))
                                {
                                    unlink($destination.'/'.$user_old_image);
                                }
                            }
                            $user->image = $new_name;
                        }
                    }
                }
                

                if($user->save())
                {
                    User::saveQualification($data,$user->id);
                    return redirect('admin/agents')->with('success', 'Agent added successfully.');
                } 
                else
                {
                    return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                }
                // echo "1"; die;
            }
        }
        $page = 'agents';
        // return view('backEnd/agent_form', compact('agent_info','page','access_levels','del_status','get_home_ids','access_homes'));
        return view('backEnd/agent_form', compact('agent_info','page','access_levels','del_status','access_homes'));
    }

    public function delete($agent_id) {   

        
        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if($access_type == 'S'){

            $cmpny_id = $selected_company_id;
        }else{
            $cmpny_id = $admin->id;
        }

	    if(!empty($agent_id)) {
            $updated = DB::table('user')->where('id', $agent_id)->where('admn_id', $cmpny_id)->update(['is_deleted' => '1']);

            if(!empty($updated)) { 
                // return redirect('admin/')->with('error','Sorry, User does not exists');
                return redirect('admin/agents')->with('success','Agent deleted Successfully.'); 
            } else {
                return redirect('admin/agents')->with('error',UNAUTHORIZE_ERR); 
            }
        } else {
            return redirect('admin/agents')->with('error','Sorry, User does not exists'); 
        }
    }

    public function delete_certificates($id) {
        
        $del = UserQualification::where('id',$id)->update(['is_deleted'=>1]);
      
        if($del){
            echo 'true';    
        } else{
            echo 'false';
        } 
        die;
    }

    public function send_user_set_pass_link_mail(Request $request, $agent_id = NULL) {

        //compare home_id
        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if($access_type == 'S'){

            $cmpny_id = $selected_company_id;
        }else{
            $cmpny_id = $admin->id;
        }
        $compny_id = DB::table('user')
                        ->where('id', $agent_id)
                        ->where('is_deleted','0')
                        ->value('admn_id'); 
        if($compny_id != $cmpny_id) {
            return 'You are not authorized to send the credentials.';
        }
        
        // send credentials for user              
        $response = User::sendCredentials($agent_id);
            echo $response; die;
    }   

    public function check_username_exist(Request $request) {
    
        $data = $request->input();
        $user_name = '';
        if(is_array($data)) {
            $user_name_arr = array_values($data);
            $user_name = $user_name_arr[0];
        }

        $response = Home::userNameUnique($user_name);

        if($response){
            echo '{"valid": true}';
        } else{
            echo '{"valid": false}'; 
        }
        die;
    }

    // public function check_user_email_exists(Request $request)
    // {

    //     $count = DB::table('user')->where('email',$request->email)->count();
    //     if($count > 0)
    //     {
    //         echo '{"valid":false}';die;
    //     }    
    //     else
    //     {
    //         echo '{"valid":true}';die;
    //     }    
    // }
   
    // public function check_user_edit_email_exists(Request $request)
    // {
       
    //     $count = DB::table('user')->where('email',$request->email)->count();
    //     if($count > 1)
    //     {
    //         echo '{"valid":false}';die;
    //     }    
    //     else{
    //         echo '{"valid":true}';die;
    //     }    
    // }

    /*public function check_username_exist(Request $request) {
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        $count = DB::table('user')->where('user_name',$request->user_name)->where('home_id', $home_id)->count();

        if($count > 0) {
            echo '{"valid":false}'; die;  // for bootstap validations
            //echo json_encode(false);   // for jquery validations
        }    
        else  {
            echo '{"valid":true}'; die;  // for bootstap validations
            //echo json_encode(true);  //  for jquery validations
        }    
    }*/

    // public function check_edit_username_exists(Request $request){
    //     return 't';
    //     echo "1";
    //     die;
    //     $count = DB::table('user')->where('user_name',$request->user_name)->count();

    //     if($count > 0)
    //     {
    //         echo '{"valid":false}'; die;  // for bootstap validations
    //         //echo json_encode(false);   // for jquery validations
    //     }    
    //     else
    //     {
    //         echo '{"valid":true}'; die;  // for bootstap validations
    //         //echo json_encode(true);   //  for jquery validations
    //     }  

    // }
    
}

