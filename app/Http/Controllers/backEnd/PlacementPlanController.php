<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\PlacementPlan;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class PlacementPlanController extends Controller
{
    public function index(Request $request)
    {	
        $today = date('Y-m-d');
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        $targets = PlacementPlan::select('id','task', 'date', 'description','status')->where('home_id',$home_id);
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
        if(isset($request->search))
        {
            $search      = trim($request->search);
            $targets = $targets->where('task','like','%'.$search.'%');
        }

        /*if($limit == 'all') {
            $active_targets = $active_targets->get();
        } else{
            $active_targets = $active_targets->paginate($limit);
        }*/

        $targets = $targets->paginate($limit);

        // $active_targets = PlacementPlan::select('id','task', 'date', 'description')->paginate($limit);
        $page = 'placement_plan';
        return view('backEnd/placement_plan', compact('page','limit','search','targets','today')); //users.blade.php
       	// return view('backEnd/placement_plans', compact('page','limit','active_targets','search')); //users.blade.php
    }

    public function add(Request $request)
    { 
      	if($request->isMethod('post'))
    	{
            $today = date('Y-m-d');
            $admin = Session::get('scitsAdminSession');
            $home_id = $admin->home_id; 
            $date = date('Y-m-d',strtotime($request->date));

    	    $target               = new PlacementPlan;
            $target->home_id      = $home_id;
            $target->task         = $request->task;
            $target->date         = $date;
            $target->description  = $request->description;
            $target->status       = $request->status;
            
    		if($target->save())
                {
        			return redirect('admin/placement-plan')->with('success', 'Target added successfully.');
        		} 
            else
                {
        			 return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
        		}
    	}
        $page = 'placement-plan';
        return view('backEnd.placement_plan_form', compact('page', 'today'));
    }
   			
   	public function edit(Request $request, $target_id)
    { 
        if(!Session::has('scitsAdminSession'))
        {   
            return redirect('admin/login');
        }
        $today = date('Y-m-d');
        $date = date('Y-m-d',strtotime($request->date));
        if($request->isMethod('post'))
        {
            $target                 = PlacementPlan::find($target_id);

            $target->task           = $request->task;
            $target->date           = $date;
            $target->description    = $request->description;
            $target->status         = $request->status;
           
            if($target->save())
            {
                return redirect('admin/placement-plan')->with('success','Target Updated successfully.'); 
            } 
           else
           {
               return redirect()->back()->with('error','Target could not be Updated.'); 
           }  
       }

        $target = PlacementPlan::where('id', $target_id)->first();
        $page = 'placement-plan';
        return view('backEnd/placement_plan_form', compact('target','page','today'));
    }

    public function delete($target_id)
    {
	   if(!empty($target_id))
        {
            PlacementPlan::where('id', $target_id)->delete();
            return redirect()->back()->with('success','Target deleted successfully.'); 
        }
    }
}