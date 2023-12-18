<?php
namespace App\Http\Controllers\backEnd\homeManage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Policies, App\UserAcceptedPolicy, App\User;  
use DB; 

class PoliciesController extends Controller { 
    
    public function index(Request $request) { 

        // echo "1"; die;
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {

            $policy_list = Policies::where('home_id', $home_id)->where('is_deleted','0')->select('id','home_id','user_id','file','created_at','updated_at')->orderBy('id','desc'); //->get()->toArray();
            // echo "<pre>"; print_r($policy_list); die; 
 
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
                $search       = trim($request->search);
                $policy_list    = $policy_list->where('file','like','%'.$search.'%');
            }

            $policy_list = $policy_list->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }  

        $page = 'policies';
        return view('backEnd.homeManage.Policies.policies', compact('policy_list','page','limit','search'));
    }

    public function add(Request $request) {

    	$home_id = Session::get('scitsAdminSession')->home_id;

    	if($request->isMethod('post')) {

    		$data = $request->input();
            // echo "<pre>"; //print_r($data)"<br>";
            // print_r($_FILES);
            // die;
    		/*if(!empty($_FILES['image']['name']))
            {
                $tmp_image  =   $_FILES['image']['tmp_name'];
                $image_info =   pathinfo($_FILES['image']['name']);
                $ext        =   strtolower($image_info['extension']);
                $new_name   =   time().'.'.$ext; 
               
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                {
                    $destination = base_path().MoodImgBasePath; 
                    if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        $mood_add->image = $new_name;
                }
            }

    		if($mood_add->save()) {
    			return redirect('/admin/moods')->with('success','Mood added successfully.');
    		} else {
    			return redirect('/admin/moods')->with('error','Error occurred, Try after sometime.');
    		}
            $data = $request->all();

            if(!empty($_FILES['files']['name'])) {*/

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
    	}
        $page = 'policies';
        return view('backEnd.homeManage.Policies.policies_form', compact('page'));
    }

  /*  public function edit(Request $request, $mood_id) {

    	$home_id = Session::get('scitsAdminSession')->home_id;

    	if($request->isMethod('post')) {
    		$data = $request->input();
    		$mood = Mood::find($mood_id);
    		if(!empty($mood)) {
    			//comparing home_id
                $m_home_id = Mood::where('id',$mood_id)->value('home_id');
                if($home_id != $m_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                $mood_old_image = $mood->image;
                $mood->name     = $data['name'];
                $mood->status   = $data['status'];

                if(!empty($_FILES['image']['name'])) {
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                    {
                        $destination=   base_path().MoodImgBasePath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        {
                            if(!empty($mood_old_image)){
                                if(file_exists($destination.'/'.$mood_old_image))
                                {
                                    unlink($destination.'/'.$mood_old_image);
                                }
                            }
                            $mood->image = $new_name;
                        }
                    }
                }
                if($mood->save()) {
                   return redirect('admin/moods')->with('success','Mood Updated successfully.'); 
               } else {
                    return redirect('admin/moods')->with('error','Mood could not be Updated.'); 
               } 
    		}
    		else {
                    return redirect('admin/')->with('error','Sorry, User does not exists');
            }
    	}

    	$mood_info = Mood::where('id', $mood_id)
    					->where('is_deleted','0')
    					->first();

    	if(!empty($mood_info)) {
    		if($mood_info->home_id != $home_id) {
    			return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
    		}
    	} else {
    			return redirect('admin/')->with('error','Sorry, Mood does not exists');
    	}

    	$page = 'mood_title';
    	return view('backEnd.homeManage.mood_form', compact('mood_info','page'));	

    }*/

    public function delete($policy_id) {  

        if(!empty($policy_id)) {

            $policy = Policies::where('id', $policy_id)->first();

            $policy_home_id = $policy->home_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            //compare with home_id
            if($home_id != $policy_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $updated = Policies::where('home_id', $home_id)->where('id', $policy_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','Policy deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
                return redirect('admin/')->with('error','Sorry, Mood does not exist'); 
            }
    }

    public function policy_accepted_staff($policy_id = null, Request $request) {

        $accepted_policy = UserAcceptedPolicy::select('user_accepted_policy.id','user_accepted_policy.updated_at','u.id','u.name')
                                                ->where('policy_id', $policy_id)
                                                ->join('user as u', 'u.id', 'user_accepted_policy.user_id');

                                                                                                                                                                                

        $search = '';

        if(isset($request->limit)) {
            //echo $request->limit; die;
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else {
            if(Session::has('page_record_limit')) {

                $limit = Session::get('page_record_limit');
            } else {
                $limit = 25;
            }
        }
        if(isset($request->search)) {
            $search          = trim($request->search);
            $accepted_policy = $accepted_policy->where('u.name','like','%'.$search.'%');
        }

        $staff_list = $accepted_policy->paginate($limit);

        $page = 'policies';
        return view('backEnd.homeManage.Policies.staff_accepted_policy', compact('staff_list','page','limit','search','policy_id'));
    }

    public function to_agree_policy($policy_id = null) {

        $home_id = Session::get('scitsAdminSession')->home_id;

        // $policy_query = Policies::select('polices.id','polices.file','user_accepted_policy.id as user_accepted_id')
        //                         ->where('polices.home_id',$home_id)
        //                         ->where('polices.is_deleted',0)
        //                         ->leftJoin('user_accepted_policy', function($join)
        //                             {
        //                                 $join->on('user_accepted_policy.policy_id','=','polices.id');
        //                                 $join->on('user_accepted_policy.user_id','=',DB::raw(Auth::user()->id));
        //                                 $join->on('user_accepted_policy.created_at','>','polices.updated_at');
        //                             })
        //                         ->orderBy('polices.id','desc'); 

        $agree_policy = UserAcceptedPolicy::where('policy_id',$policy_id)->get()->toArray();
        echo "<pre>"; print_r($agree_policy); die;

        $users = User::select('user.id','user.name')
                        ->where('is_deleted','0')
                        ->where('home_id', $home_id)
                        ->get()
                        ->toArray();
        echo "<pre>"; print_r($users); die;
        if(!empty($users)) {

        }
    }

}