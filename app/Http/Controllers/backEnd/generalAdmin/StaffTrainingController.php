<?php
namespace App\Http\Controllers\backEnd\generalAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Models\User, App\Models\Training, App\Models\StaffTraining;  
use DB; 

class StaffTrainingController extends Controller
{
    public function index(Request $request) {	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }
        $training_query = Training::select('id','training_name','training_provider','training_month','training_year')
                                        ->where('is_deleted','0')
                                        ->where('home_id',$home_id)
                                        ->orderBy('id','desc');
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else {
            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search)) {
            $search      = trim($request->search);
            $training_query = $training_query->where('training_name','like','%'.$search.'%');
        }

        $training = $training_query->paginate($limit);

        $page = 'staff_training';
       	return view('backEnd/generalAdmin/StaffTraining/staff_training', compact('page','limit','training','search'));
    }

    	
   	public function view($training_id = null) { 

        $home_id  = Session::get('scitsAdminSession')->home_id;
       	$training = Training::where('id', $training_id)->first();
       
        $active_training    =   User::join('staff_training', 'staff_training.user_id', '=', 'user.id')
                                ->where('staff_training.training_id',$training_id)
                                ->where('staff_training.status',2)
                                ->select('user.name','staff_training.id')
                                ->get()->toArray();

        $completed_training =   User::join('staff_training', 'staff_training.user_id', '=', 'user.id')
                                ->where('staff_training.training_id',$training_id)
                                ->where('staff_training.status',1)
                                ->select('user.name','staff_training.id')
                                ->get()->toArray();
        // echo "<pre>"; print_r($completed_training); die;

        $not_completed_training = User::join('staff_training', 'staff_training.user_id', '=', 'user.id')
                                ->where('staff_training.training_id',$training_id)
                                ->where('staff_training.status',0)
                                ->select('user.name','staff_training.id')
                                ->get()->toArray();

        $page = 'staff_training';
        return view('backEnd/generalAdmin/StaffTraining/staff_training_form', compact('training','page','not_completed_training','active_training','completed_training'));
    }

  

}
