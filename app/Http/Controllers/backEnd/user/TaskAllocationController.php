<?php
namespace App\Http\Controllers\backEnd\user;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\User, App\StaffTaskAllocation;  
use DB; 
use Hash;

class TaskAllocationController extends Controller
{
    public function index(Request $request, $user_id) {   
        //compare with su home_id
        $u_home_id = User::where('id',$user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $u_home_id) {
        // echo $u_home_id; die;
            $u_task = StaffTaskAllocation::where('staff_member_id', $user_id)->where('is_deleted','0')->select('id','title', 'details','staff_member_id','status');
            // echo "<pre>"; print_r($u_task); die;
            
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
                $u_task = $u_task->where('title','like','%'.$search.'%');             //search by date or title
            }

            $u_task_alloc = $u_task->paginate(25);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
        //$users = DB::table('user')->select('id','name','user_name', 'email', 'access_level')->paginate(25);
        $page = 'user-task';
        return view('backEnd.user.taskAllocation.task_allocations', compact('page','limit', 'user_id','u_task_alloc','search')); 
    }

    public function add(Request $request, $user_id) {   
        if($request->isMethod('post')) { 
            $data = $request->input();

            //compare with su home_id
            $u_home_id = User::where('id',$user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;

            if($home_id == $u_home_id) {
                $u_task_alloc                   =  new StaffTaskAllocation;
                $u_task_alloc->title            =  $data['title'];
                $u_task_alloc->staff_member_id  =  $user_id;
                $u_task_alloc->home_id          =  $home_id;
                $u_task_alloc->details          =  $data['detail'];
                $u_task_alloc->status           =  $data['status'];

                if($u_task_alloc->save()) {
                        // return redirect('admin/service-users/care-history/'.$service_user_id)->with('success', 'New Care Timeline added successfully.');
                        return redirect('admin/user/task-allocations/'.$user_id)->with('success', 'Task Allocation added successfully.');
                    }  else  {
                        return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                    }
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        $page = 'user-task';
        return view('backEnd.user.taskAllocation.task_allocation_form', compact('page', 'user_id'));
    }
            
    public function edit(Request $request, $u_task_alloc_id) {   
        $u_task_alloc    =  StaffTaskAllocation::find($u_task_alloc_id);
        if(!empty($u_task_alloc)) {
            $user_id    = $u_task_alloc->staff_member_id;

             //comparing u home_id
            $u_home_id = User::where('id',$user_id)->value('home_id');
            $home_id    = Session::get('scitsAdminSession')->home_id;
            if($home_id != $u_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }

            if($request->isMethod('post')) {   
                $data = $request->input();
                // echo "<pre>"; print_r($data); die;
                $u_task_alloc->title     =  $data['title'];
                $u_task_alloc->details   =  $data['detail'];
                $u_task_alloc->status    =  $data['status'];               
        
               if($u_task_alloc->save()) {
                   return redirect('admin/user/task-allocations/'.$user_id)->with('success','Task Allocation Updated Successfully.'); 
                } else
                {
                   return redirect()->back()->with('error','Task Allocation could not be Updated Successfully.'); 
                }  
            }
        } else {
                return redirect('admin/')->with('error','Sorry, Task Allocation does not exists');
        }

        $u_task_alloc = StaffTaskAllocation::where('id', $u_task_alloc_id)
                        ->first();

        if(!empty($u_task_alloc)) {
            //compare with su home_id
            $u_home_id = User::where('id',$u_task_alloc->staff_member_id)->value('home_id');
            $home_id    = Session::get('scitsAdminSession')->home_id;
            if($home_id != $u_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
        } else {
            return redirect('admin/')->with('error','Sorry, Task Allocation does not exists');
        }

        $page = 'user-task';
        return view('backEnd.user.taskAllocation.task_allocation_form', compact('u_task_alloc','page','user_id'));
    }
        
    public function delete($u_task_alloc_id)
    {   
       if(!empty($u_task_alloc_id))
       {
           $u_task_alloc =  StaffTaskAllocation::where('id', $u_task_alloc_id)->first();
           
            if(!empty($u_task_alloc)) {
                $u_home_id = User::where('id',$u_task_alloc->staff_member_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $u_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                StaffTaskAllocation::where('id', $u_task_alloc_id)->update(['is_deleted'=>'1']);
                return redirect()->back()->with('success','Task Allocation deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error','Sorry, Task Allocation does not exists'); 
            }
        }
    }
}