<?php

namespace App\Http\Controllers\backEnd\myProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin, App\Models\Home,App\Models\User;
use Session, Hash;
use DB, Auth;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $agent_id = '';
        if(Session::has('scitsAgentSession')){
            $agent_id = Session::get('scitsAgentSession')->id;
        }
        $admin_id = Session::get('scitsAdminSession')->id;
        //echo "<pre>"; print_r($agent_id); die;

        if(!empty($agent_id)){
            $profile  = DB::table('user')->select('id', 'name', 'user_name', 'email', 'company_id', 'image', 'home_id')
                        ->where('is_deleted',0)
                        ->where('id', $agent_id)
                        ->first();
        }elseif(!empty($admin_id)){
            $profile  = DB::table('admin')->select('id', 'name', 'user_name', 'email', 'company', 'image', 'home_id','access_type')
                            ->where('is_deleted',0)
                            ->where('id', $admin_id)
                            ->first();
        }
        // echo "<pre>"; print_r($profile);
        $company = '';
        $home    = '';
        $access_type = (isset($profile->access_type) ? $profile->access_type : ''); 
        if($access_type == 'A'){
            
            $home     = Home::select('admin_id','title')->where('id',$profile->home_id)->first();
            $company  = Admin::where('id',$home->admin_id)->value('company');
            $home     = $home->title;

        }else if($access_type == 'O') {
            $company = $profile->company;
        }else{
            if(Session::has('scitsAdminSession')){
                $company = Session::get('scitsAdminSession')->company;
            }
        } 

        $page = 'dashboard';
        return view('backEnd.MyProfile.my_profile', compact('profile', 'page','company','home'));
    }

    public function edit(Request $request)
    {
        if(Session::has('scitsAgentSession')){ 
            $agent_id = Session::get('scitsAgentSession')->id;
            if(!empty($agent_id)){
                //if($request->isMethod('post')){

                $profile            = User::find($agent_id);
                $profile->name      = $request->name; 
                $profile->email     = $request->email; 
                $agent_old_image    = $profile->image; 

                if(!empty($_FILES['image']['name'])){

                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')    {

                        $destination =   base_path().userProfileImageBasePath; 
                        
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))  {

                            if(!empty($agent_old_image)){
                                if(file_exists($destination.'/'.$agent_old_image))  {

                                    unlink($destination.'/'.$agent_old_image);
                                }
                            }
                            $profile->image = $new_name;
                        }
                    }
                }

                if($profile->save()) {
                                       
                    //updating agent session
                    $agent_info        = Session::get('scitsAgentSession');
                    $agent_info->name  = $request->name;     
                    $agent_info->email = $request->email;
                    $agent_info->image = $profile->image;
                    Session::put('scitsAgentSession', $agent_info);

                    return redirect('admin/dashboard')->with('success, Profile editted successfully');
                }else{
                    return redirect()->back()->with('error, Some error occured');
                }
                //}
            }
        }

        $admin_id = Session::get('scitsAdminSession')->id;
        if($request->isMethod('post')) {

            $profile  = Admin::find($admin_id);
            $profile->name      = $request->name; 
            $profile->email     = $request->email; 
            // $profile->company   = $request->company; 
            $admin_old_image    = $profile->image;

            if(!empty($_FILES['image']['name'])){

                $tmp_image  =   $_FILES['image']['tmp_name'];
                $image_info =   pathinfo($_FILES['image']['name']);
                $ext        =   strtolower($image_info['extension']);
                $new_name   =   time().'.'.$ext; 
               
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')    {

                    $destination =   base_path().adminbasePath; 
                    
                    if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))  {

                        if(!empty($admin_old_image)){
                            if(file_exists($destination.'/'.$admin_old_image))  {

                                unlink($destination.'/'.$admin_old_image);
                            }
                        }
                        $profile->image = $new_name;
                    }
                }
            }
            if($profile->save()) {
                
                //updating admin session
                $admin = Session::get('scitsAdminSession');
                $admin->name    = $profile->name;     
                $admin->email   = $profile->email;
                $admin->company = $profile->company;
                $admin->image   = $profile->image;
                Session::put('scitsAdminSession', $admin);

                return redirect('admin/dashboard')->with('success, Profile editted successfully');
            } else {
                return redirect()->back()->with('error, Some error occured');
            }
    	}
    }

    public function change_password(Request $request) 
    {
        $data = $request->input();

        $agent_id = '';
        if(Session::has('scitsAgentSession')){
            $agent_id = Session::get('scitsAgentSession')->id;
        }
        $agent_info = User::where('id',$agent_id)->select('id','password','email')->first();

        $system_admin_id = Session::get('scitsAdminSession')->id;
        $admin = Admin::where('id', $system_admin_id)->select('id', 'password')->first();

        if(!empty($agent_info)){ 
            
            $old_password = $agent_info->password; 
            if(Hash::check($data['current_password'],$old_password)){ 
                //password Verification
                if($data['new_password'] == $data['confirm_password']) {
                    if($request->isMethod('post')) {
                        // $admin = Admin::find($system_admin_id);
                        $agent_info->password = Hash::make($data['new_password']);

                        if($agent_info->save()) {
                            return redirect()->back()->with('success', "New password saved successfully.");
                        } else {
                            return redirect()->back()->with('error', COMMON_ERROR);
                        }
                    }
                } else {
                    return redirect()->back()->with('error', "Password didn't matched.");
                }
            }else{
                return redirect()->back()->with('error', "Current Password entered not correct.");
            }
        }elseif(!empty($admin)) { 
            //Old Password Check with entered password
            if(!empty($admin)) {

                $old_password = $admin->password; 
                if(md5($data['current_password']) == $old_password) {
                    //password Verification
                    if($data['new_password'] == $data['confirm_password']) {

                        if($request->isMethod('post')) {

                            $admin->password = md5($data['new_password']);

                            if($admin->save()) {
                                return redirect()->back()->with('success', "New password saved successfully.");
                            } else {
                                return redirect()->back()->with('error', COMMON_ERROR);
                            }
                        }
                    } else {

                        return redirect()->back()->with('error', "Password didn't matched.");
                    }
                } else  {
                    
                    return redirect()->back()->with('error', "Current Password entered not correct.");
                }
            } else {
                return redirect()->back()->with('error', 'Admin not found');
            }
        }
    }

    /*public function check_admin_username(Request $request) {
    
        $data = $request->input();
        $user_name = '';

        if(is_array($data)) {

            $user_name_arr = array_values($data);
            $user_name = $user_name_arr[0];
        }

        $response = Home::userNameUnique($user_name, 'admin');

        if($response){
            echo '{"valid": true}';
        } else{
            echo '{"valid": false}'; 
        }
        die;
    }*/
}
