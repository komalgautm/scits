<?php
namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\CompanyManagers, App\Home;

class ManagersController extends Controller
{
    public function index(Request $request){

    	
        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if($access_type == 'S'){
            $company_id = $selected_company_id;
        }else{
            $company_id = $admin->id;
        }
    	
    	$managers 	= CompanyManagers::select('id','name','contact_no','email','status')
										->where('company_id',$company_id)
										->where('is_deleted','0');
        $search = '';

        if(isset($request->limit))
        {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else{

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search)){
            $search     = trim($request->search);
            $managers   = $managers->where('name','like','%'.$search.'%');
        }

        $managers = $managers->paginate($limit);

    	$page = 'managers';
    	return view('backEnd.managers.index',compact('page','managers','search','limit'));
    }

    public function add(Request $request){

        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if($access_type == 'S'){
            $company_id = $selected_company_id;
        }else{
            $company_id = $admin->id;
        }

        if($request->isMethod('post')){

            $manager                = new CompanyManagers;
            $manager->company_id    = $company_id;
            $manager->name          = $request->name;
            $manager->email         = $request->email;
            $manager->contact_no    = $request->contact_no;
            $manager->address       = $request->address;

            if(!empty($_FILES['image']['name'])){

                $tmp_image  =   $_FILES['image']['tmp_name'];
                $image_info =   pathinfo($_FILES['image']['name']);
                $ext        =   strtolower($image_info['extension']);
                $new_name   =   time().'.'.$ext; 
               
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){

                    $destination = base_path().managerImageBasePath;

                    if(move_uploaded_file($tmp_image, $destination.'/'.$new_name)){
                        $manager->image = $new_name;
                    }
                }
            }
            if(!isset($manager->image)) {
                $manager->image = '';
            }

            if($manager->save()){
                return redirect('admin/managers')->with('success','Manager added successfully.');
            }else{
                return redirect('admin/managers')->with('error',COMMON_ERROR);
            }
        }

        $page = 'managers';
        return View('backEnd.managers.form',compact('page'));
    }

    public function edit(Request $request,$manager_id = Null){

        $manager = CompanyManagers::select('id','name','contact_no','email','address','image')
                                    ->where('id',$manager_id)
                                    ->first();

        if($request->isMethod('post')){
            // echo"<pre>"; print_r($request->input()); die;
            $update = CompanyManagers::find($manager_id);

            if(!empty($update)){
                $old_image          = $update->image;
                $update->name       = $request->name;
                $update->contact_no = $request->contact_no;
                $update->email      = $request->email;
                $update->address    = $request->address;
                
                if(!empty($_FILES['image']['name'])){
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')   {
                        $destination = base_path().managerImageBasePath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name)){
                            if(!empty($old_image)){ 
                                if(file_exists($destination.'/'.$old_image)){
                                    unlink($destination.'/'.$old_image);
                                }
                            }
                            $update->image = $new_name;
                        }
                    }
                }

                if($update->save()){
                    return redirect('admin/managers')->with('success','Record updated successfully.');
                }else{
                    return redirect('admin/managers')->with('error',COMMON_ERROR);
                }
            }else{
                return redirect('admin/managers')->with('error',COMMON_ERROR);
            }
        }
        $page = 'managers';
        return View('backEnd.managers.form',compact('page','manager'));
    }

    public function change_status(Request $request){

        $manager_id             = $request->manager_id;
        $admin                  = Session::get('scitsAdminSession');
        $access_type            = Session::get('scitsAdminSession')->access_type;
        $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
        if($access_type == 'S'){
            $company_id = $selected_company_id;
        }else{
            $company_id = $admin->id;
        }

        $count_active   = CompanyManagers::select('id','status')
                                        ->where('id','!=',$manager_id)
                                        ->where('company_id',$company_id)
                                        ->where('is_deleted','0')
                                        ->where('status','1')
                                        ->count();
        if($count_active > 0){
            return 'false';
        }else{
            $check_status = CompanyManagers::where('id',$manager_id)
                                            ->where('is_deleted','0')
                                            ->value('status');
            if($check_status == '1'){
                $change_status = CompanyManagers::where('id',$manager_id) // inactive the status
                                                ->update(['status'=>'0']);
                return '0';
            }elseif($check_status == '0'){

                $change_status = CompanyManagers::where('id',$manager_id) // active the status
                                                ->update(['status'=>'1']);
                return '1';
            }
        }
    }

    public function check_email_exists(Request $request){

      
        $email          = $request->email;
        $manager_id     = $request->manager_id;
        if(!empty($manager_id)){
            $email_exists   = CompanyManagers::where('email',$email)
                                            ->where('id','!=',$manager_id)
                                            ->count();
        }else{
            $email_exists   = CompanyManagers::where('email',$email)
                                            ->count();
        }
        
        if($email_exists > 0){
            $r['valid'] = false;
            echo json_encode($r);
        }else{
            $r['valid'] = true;
            echo json_encode($r);
        }
    }

    public function check_contact_no_exists(Request $request){

        $contact_no     = $request->contact_no;
        $manager_id     = $request->manager_id;

        if(!empty($manager_id)){
            $contact_exists   = CompanyManagers::where('contact_no',$contact_no)
                                            ->where('id','!=',$manager_id)
                                            ->count();
        }else{
            $contact_exists   = CompanyManagers::where('contact_no',$contact_no)
                                            ->count();
        }
        
        if($contact_exists > 0){
            $r['valid'] = false;
            echo json_encode($r);
        }else{
            $r['valid'] = true;
            echo json_encode($r);
        }
    }

    public function delete($manager_id){
        $manager_delete = CompanyManagers::where('id',$manager_id)
                                        ->update(['is_deleted'=>'1']);
        if($manager_delete){
            return redirect('admin/managers')->with('success','Record deleted successfully.');
        }else{
            return redirect('admin/managers')->with('error',COMMON_ERROR);
        }
    }
}
