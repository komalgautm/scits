<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\FileManager, App\ServiceUser, App\Policies;  
use DB; 

class FileManagerController extends Controller { 
    
    public function index(Request $request, $service_user_id) { 

        //comparing su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            $file_query = FileManager::where('service_user_id',$service_user_id)
                    ->select('su_file_manager.id','su_file_manager.file','su_file_manager.created_at','fc.name as category_name')
                    ->leftJoin('file_category as fc','su_file_manager.category_id','fc.id')
                    ->where('su_file_manager.is_deleted','0')
                    ->orderBy('su_file_manager.id','desc');
            // echo "<pre>"; print_r($file_query); die;

            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {
                if(Session::has('page_record_limit')) {
                    $limit = Session::get('page_record_limit');
                } else {
                    $limit = 25;
                }
            }
            if(isset($request->search)) {
                $search         = trim($request->search);
                $file_query     = $file_query->where('su_file_manager.file','like','%'.$search.'%');
            }

            $file_query = $file_query->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }    
        //echo '<pre>'; print_r($file_query); die;
        $page = 'file_manager';
        return view('backEnd.serviceUser.fileManager.file_manager', compact('page', 'limit','file_query', 'search', 'service_user_id'));
    }

    public function add(Request $request, $service_user_id) {
        // echo $service_user_id; die;
    	$home_id       = Session::get('scitsAdminSession')->home_id;
        $file_category = DB::table('file_category')->select('id','name')->where('is_deleted','0')->orderBy('name','asc')->get();
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data)."<br>".print_r($_FILES); //die;
            $service_user_id = $data['service_user_id'];
            if(!empty($_FILES['files']['name'])) {
                foreach ($_FILES['files']['name'] as $key => $value) {
                    //echo "<pre>"; print_r($value); die;
                    $tmp_file   =   $_FILES['files']['tmp_name'][$key];
                    $image_info =   pathinfo($_FILES['files']['name'][$key]);
                    //echo "<pre>"; print_r($image_info); die;
                    
                    //$file_name  =   substr($image_info['filename'],0,100);
                    $file_name  =   $image_info['filename'];
                    $ext        =   strtolower($image_info['extension']);
                    // echo "<pre>"; print_r($ext); die;
                    $new_name   =   $file_name.'.'.$ext;

                    $allowed_ext = array('jpg','jpeg','png','pdf','doc','docx','wps');
                    if(in_array($ext,$allowed_ext)){

                        $file_dest = base_path().ServiceUserFileBasePath.'/'.$service_user_id; 
                        // echo "<pre>"; print_r($file_dest); die;
                        if(!is_dir($file_dest)) { //check if file directory not exits then create it
                            mkdir($file_dest);
                        } else{ //if directory exits check if any file with same name exists
                            
                            $i = 1;
                            while(file_exists($file_dest.'/'.$new_name)){ 
                                $i++;
                                $new_name = $file_name.$i.'.'.$ext;                                
                            }
                        }
                        
                        if(move_uploaded_file($tmp_file, $file_dest.'/'.$new_name)) {

                            $file                  = new FileManager;
                            $file->service_user_id = $service_user_id;
                            $file->category_id     = $data['file_category_id'];
                            $file->file            = $new_name;
                            $file->home_id         = $home_id;
                            $file->save();
                        }
                    } 
                } 
                return redirect('admin/service-user/file-managers/'.$service_user_id)->with('success', 'Files added successfully.');
            } else {
                return redirect()->back()->with('error', UNAUTHORIZE_ERR);
            }
        }

    	/*if($request->isMethod('post')) {

    		$data = $request->input();

                foreach($_FILES['files']['name'] as $key => $value){

                    $tmp_file   =   $_FILES['files']['tmp_name'][$key];
                    $image_info =   pathinfo($_FILES['files']['name'][$key]);
                    
                    //$file_name  =   substr($image_info['filename'],0,100);
                    $file_name  =   $image_info['filename'];
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   $file_name.'.'.$ext;

                    $allowed_ext = array('jpg','jpeg','png','pdf','doc','docx','wps');
                    if(in_array($ext,$allowed_ext)){

                        $file_dest = base_path().PoliciesFileBasePath; 
                    
                        if(!is_dir($file_dest)) { //check if file directory not exits then create it
                            mkdir($file_dest);
                        } else { //if directory exits check if any file with same name exists
                            
                            $i = 1;
                            while(file_exists($file_dest.'/'.$new_name)){ 
                                $i++;
                                $new_name = $file_name.$i.'.'.$ext;                                
                            }
                        }
                        
                        if(move_uploaded_file($tmp_file, $file_dest.'/'.$new_name)) {

                            $file                  = new Policies;
                            $file->user_id         = 0;
                            $file->file            = $new_name;
                            $file->home_id         = $home_id;
                            $file->save();
                        }
                    } 
                }
                return redirect('admin/home/policies')->with('success','Policies files added successfully.');                       
    	}*/
        $page = 'file_manager';
        return view('backEnd.serviceUser.fileManager.file_manager_form', compact('page','service_user_id','file_category'));
    }

    public function delete($file_id) {  

        if(!empty($file_id)) {

            $file = FileManager::where('id', $file_id)->first();

            $file_home_id = $file->home_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            //compare with home_id
            if($home_id != $file_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $updated = FileManager::where('home_id', $home_id)->where('id', $file_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','File deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
                return redirect('admin/')->with('error','Sorry, File does not exist'); 
            }
    }

}