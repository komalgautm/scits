<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\ServiceUserCareHistory, App\ServiceUserCareHistoryFile;  
use DB; 
use Hash;

class CareHistoryController extends Controller
{
    public function index(Request $request, $service_user_id)
    {   
        //compare with su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            $su_care_history_query = ServiceUserCareHistory::where('service_user_id', $service_user_id)->where('is_deleted','0')->select('id','title', 'date');
            
            $search = '';

            if(isset($request->limit))
            {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else{

                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 25;
                }
            }

            if(isset($request->search))
            {
                $search = trim($request->search);
                $su_care_history_query = $su_care_history_query->where('title','like','%'.$search.'%');             //search by date or title
            }

            $su_care_history_results = $su_care_history_query->paginate(25);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
        //$users = DB::table('user')->select('id','name','user_name', 'email', 'access_level')->paginate(25);
        $page = 'service-users-care-history';
        return view('backEnd.serviceUser.careHistory.care_history', compact('page','limit', 'service_user_id','su_care_history_results','search')); 
    }

    public function add(Request $request, $service_user_id)
    {   
        if($request->isMethod('post'))
        { 
            $data = $request->input();

            //compare with su home_id
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;

            if($home_id == $su_home_id) {
                
                $date = date('Y-m-d',strtotime($data['date']));

                $su_care_history                    =  new ServiceUserCareHistory;
                $su_care_history->date              =  $date;
                $su_care_history->title             =  $request->title;
                $su_care_history->service_user_id   =  $service_user_id;
                $su_care_history->home_id           =  $su_home_id;
                $su_care_history->description       =  $request->description;
                
                if($su_care_history->save()) {

                        if(!empty($_FILES['files']['name'])) {
                            //echo '<pre>'; print_r($_FILES); die;
                            foreach($_FILES['files']['name'] as $key => $value){
                                //echo '<pre>'; print_r($value); die;
                                if(!empty($value)) {
                                    
                                    $tmp_file   =   $_FILES['files']['tmp_name'][$key];
                                    $image_info =   pathinfo($_FILES['files']['name'][$key]);
                                    
                                    //$file_name  =   substr($image_info['filename'],0,100);
                                    $file_name  =   $image_info['filename'];
                                    
                                    $ext        =   strtolower($image_info['extension']);
                                    $new_name   =   $file_name.'.'.$ext;

                                    $allowed_ext = array('jpg','jpeg','png','pdf','doc','docx','wps');
                                    if(in_array($ext,$allowed_ext)){

                                        $file_dest = base_path().suCareHistoryFileBasePath; 
                                    
                                        //if(!is_dir($file_dest)) { //check if file directory not exits then create it
                                         //   mkdir($file_dest);
                                        //} else { //if directory exits check if any file with same name exists
                                            
                                          //  $i = 1;
                                           // while(file_exists($file_dest.'/'.$new_name)){ 
                                             //   $i++;
                                                $new_name = $file_name.'.'.$ext;                                
                                           // }
                                        //}
                                        
                                        if(move_uploaded_file($tmp_file, $file_dest.'/'.$new_name)) {

                                            $file                       = new ServiceUserCareHistoryFile;
                                            $file->su_care_history_id   = $su_care_history->id;
                                            $file->file                 = $new_name;
                                            $file->save();
                                        }
                                    } 
                                }
                            }
                        }

                        return redirect('admin/service-users/care-history/'.$service_user_id)->with('success', 'New Care Timeline added successfully.');
                    }  else  {
                        return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                    }
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        $page = 'service-users-care-history';
        return view('backEnd.serviceUser.careHistory.care_history_form', compact('page', 'service_user_id'));
    }
            
    public function edit(Request $request, $su_care_history_id) {   
       
        $su_care_history    =  ServiceUserCareHistory::find($su_care_history_id);
        if(!empty($su_care_history)) {
            $service_user_id    = $su_care_history->service_user_id;

             //comparing su home_id
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            if($home_id != $su_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }

            if($request->isMethod('post'))
            {   
                $data = $request->input();

                $date = date('Y-m-d',strtotime($data['date']));
                $su_care_history->title            =  $data['title'];
                $su_care_history->date             =  $date;
                $su_care_history->description       = $request['description'];
        
               if($su_care_history->save()) {

                    if(!empty($_FILES['files']['name'])) {
                        //echo '<pre>'; print_r($_FILES); die;
                        foreach($_FILES['files']['name'] as $key => $value){
                            //echo '<pre>'; print_r($value); die;
                            if(!empty($value)) {
                                
                                $tmp_file   =   $_FILES['files']['tmp_name'][$key];
                                $image_info =   pathinfo($_FILES['files']['name'][$key]);
                                
                                //$file_name  =   substr($image_info['filename'],0,100);
                                $file_name  =   $image_info['filename'];
                                
                                $ext        =   strtolower($image_info['extension']);
                                $new_name   =   $file_name.'.'.$ext;

                                $allowed_ext = array('jpg','jpeg','png','pdf','doc','docx','wps');
                                if(in_array($ext,$allowed_ext)){

                                    $file_dest = base_path().suCareHistoryFileBasePath; 
                                
                                    $new_name = $file_name.'.'.$ext;                                
                                    if(move_uploaded_file($tmp_file, $file_dest.'/'.$new_name)) {

                                        $file                       = new ServiceUserCareHistoryFile;
                                        $file->su_care_history_id   = $su_care_history->id;
                                        $file->file                 = $new_name;
                                        $file->save();
                                    }
                                } 
                            }
                        }
                    }

                   return redirect('admin/service-users/care-history/'.$service_user_id)->with('success','Care Timeline Updated Successfully.'); 
                } else {
                   return redirect()->back()->with('error','Care Timeline could not be Updated Successfully.'); 
                }  
            }
        } else {
                return redirect('admin/')->with('error','Sorry, Care Timeline does not exists');
        }

        $su_care_history = DB::table('su_care_history')
                    ->where('id', $su_care_history_id)
                    ->first();

        if(!empty($su_care_history)) {
            //compare with su home_id
            $su_home_id = ServiceUser::where('id',$su_care_history->service_user_id)->value('home_id');
            $home_id    = Session::get('scitsAdminSession')->home_id;
            if($home_id != $su_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
        } else {
            return redirect('admin/')->with('error','Sorry, Care Timeline does not exists');
        }

        $page = 'service-users-care-history';
        return view('backEnd.serviceUser.careHistory.care_history_form', compact('su_care_history','page','service_user_id'));
    }
        
    public function delete($su_care_history_id)
    {   
       if(!empty($su_care_history_id))
       {
           $su_care_history =  ServiceUserCareHistory::where('id', $su_care_history_id)->first();
           
           if(!empty($su_care_history)) {
                $su_home_id = ServiceUser::where('id',$su_care_history->service_user_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                ServiceUserCareHistory::where('id', $su_care_history_id)->update(['is_deleted'=>'1']);
                return redirect()->back()->with('success','A care history deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error','Sorry, Team Member does not exists'); 
            }
        }
    }

    public function delete_hist_file($su_care_history_id = null) {

        $del = ServiceUserCareHistoryFile::where('id', $su_care_history_id)->delete();
        if($del) {
            return redirect()->back()->with('success', 'Care History file deleted successfully.');
        } else {
            return redirect()->back()->with('success', COMMON_ERROR);
        }
    }

}
