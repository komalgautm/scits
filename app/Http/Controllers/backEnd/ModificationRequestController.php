<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ModifyRequest;  
use DB; 
use App\Admin;

class ModificationRequestController extends Controller
{
	public function index(Request $request)
    {     
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $modification_requests = ModifyRequest::select('modify_request.action','modify_request.content','modify_request.solved','modify_request.id', 'user.id as user_id', 'user.name as admin_name')
                                                ->join('user', 'user.id', 'modify_request.user_id')
                                                ->where('modify_request.is_deleted','0')
                                                ->where('modify_request.home_id',$home_id);
        
        // echo "<pre>"; print_r($modification_requests); die;

        $search = '';

        if(isset($request->limit))  {

            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else  {
            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else {
                $limit = 25;
            }
        }
        if(isset($request->search)) {
            $search = trim($request->search);
            $modification_requests = $modification_requests->where('content','like','%'.$search.'%');
        }

        $modification_requests = $modification_requests->orderBy('id','desc')->paginate($limit);

        $page = 'modification-request';
        return view('backEnd.modification_request', compact('page', 'limit', 'modification_requests', 'search'));
    }
	
  	public function edit(Request $request, $request_id) { 

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        if($request->isMethod('post'))  {

            $modification_request = ModifyRequest::find($request_id);
            if(!empty($modification_request)) {

                $u_home_id = ModifyRequest::where('id',$request_id)->value('home_id');
                if($home_id != $u_home_id)  {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
                $modification_request->solved = $request->solved;

                if($modification_request->save()) {
                    return redirect('admin/modification-requests')->with('success','Request Updated successfully.'); 
                } else  {
                    return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
                }
            } 
        else    {
            return redirect('admin/')->with('error','Sorry, Request does not exists');
        }  
    }
            $modification_request = DB::table('modify_request')
                                      ->where('id', $request_id)
                                      ->first();
            if(!empty($modification_request)) {
                if($modification_request->home_id != $home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
            } else {
                    return redirect('admin/')->with('error','Sorry, Request does not exist');
            }

          $page = 'modification-request';
          return view('backEnd/modification_request_form', compact('modification_request','page'));
      }

    public function delete($request_id) {   
          
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($request_id)) {

            $request_delete = ModifyRequest::where('id',$request_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);
            if(!empty($request_delete)) { 
                return redirect()->back()->with('success','Request deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error', UNAUTHORIZE_ERR); 
            }
        } else {
                return redirect('admin/')->with('admin/','Request does not exist.'); 
        }
    }
}