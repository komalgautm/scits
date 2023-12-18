<?php
namespace App\Http\Controllers\backEnd\homeManage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Mood;  
use DB; 

class MoodController extends Controller { 
    
    public function index(Request $request) { 

        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {

            $mood_list = Mood::where('home_id', $home_id)->where('is_deleted','0')->select('id','name','image','status');
 
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
                $mood_list    = $mood_list->where('name','like','%'.$search.'%');
            }

            $mood_list = $mood_list->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }  

        $page = 'mood_title';
        return view('backEnd.homeManage.mood', compact('mood_list','page','limit','search'));
    }

    public function add(Request $request) {

    	$home_id = Session::get('scitsAdminSession')->home_id;

    	if($request->isMethod('post')) {

    		$data = $request->input();

    		$mood_add  = new Mood;
    		$mood_add->home_id = $home_id;
    		$mood_add->name    = $data['name'];
    		$mood_add->status  = $data['status'];
 
    		if(!empty($_FILES['image']['name']))
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

    	}
        $page = 'mood_title';
        return view('backEnd.homeManage.mood_form', compact('page'));
    }

    public function edit(Request $request, $mood_id) {

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

    }

    public function delete($mood_id) {  
        
        if(!empty($mood_id)) {

            $mood = Mood::where('id', $mood_id)->first();

            $mood_home_id = $mood->home_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            //compare with home_id
            if($home_id != $mood_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $updated = Mood::where('home_id', $home_id)->where('id', $mood_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','Mood deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
                return redirect('admin/')->with('error','Sorry, Mood does not exist'); 
            }
    }

}