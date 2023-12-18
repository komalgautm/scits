<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\EducationRecord;  
use DB; 
use App\Admin;

class EducationTrainingController extends Controller
{
	public function index(Request $request)
	{    
		$home_id = Session::get('scitsAdminSession')->home_id;

		if(!empty($home_id)) {

			$edu_tr_rcrds = EducationRecord::where('is_deleted','0')->where('home_id',$home_id)->select('id', 'description', 'status');

			$search = '';
			if(isset($request->limit))  {

				$limit = $request->limit;
				Session::put('page_record_limit',$limit);
			} 
			else {
				if(Session::has('page_record_limit')) {
				  	$limit = Session::get('page_record_limit');
				} else  {
				  	$limit = 25;
				}
			}
			if(isset($request->search))	{

				$search = trim($request->search);
				$edu_tr_rcrds = $edu_tr_rcrds->where('description','like','%'.$search.'%');
			}

			$edu_tr_rcrds = $edu_tr_rcrds->orderBy('description','asc')->paginate($limit);
		} else {
			return redirect('admin/')->with('error',NO_HOME_ERR);
		}

		$page = 'education-training';
		return view('backEnd.education_trainings', compact('page', 'limit', 'edu_tr_rcrds', 'search')); //records.blade.php
	}
  
    public function add(Request $request) { 
        if($request->isMethod('post')) {

			$home_id = Session::get('scitsAdminSession')->home_id; 
			$edu_tr_rcrd              = new EducationRecord;
			$edu_tr_rcrd->home_id     = $home_id;
			$edu_tr_rcrd->description = $request->description;
			$edu_tr_rcrd->status      = $request->status;
			  
			if($edu_tr_rcrd->save()) {
			return redirect('admin/education-trainings')->with('success', 'Record added successfully.');
			}  else {
			return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
			}
        }
        $page = 'education-training';
        return view('backEnd.education_training_form', compact('page'));
    }
	
  	public function edit(Request $request, $edu_tr_id) { 

		$admin = Session::get('scitsAdminSession');
		$home_id = $admin->home_id; 

		if($request->isMethod('post')) {
			$edu_tr_rcrd               = EducationRecord::find($edu_tr_id);
			if(!empty($edu_tr_rcrd)) {

				//comparing home_id
				$u_home_id = EducationRecord::where('id',$edu_tr_id)->value('home_id');
				if($home_id != $u_home_id) {
				    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
				}

				$edu_tr_rcrd->description  = $request->description;
				$edu_tr_rcrd->status       = $request->status;

				if($edu_tr_rcrd->save()) {
					return redirect('admin/education-trainings')->with('success','Record Updated successfully.'); 
				} else {
					return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
				}
			} else {
			return redirect('admin/')->with('error','Sorry, Record does not exists');
			}  
		}

		$edu_tr_rcrds = DB::table('education_record')
						->where('id', $edu_tr_id)
						->first();
		if(!empty($edu_tr_rcrds)) {
		    if($edu_tr_rcrds->home_id != $home_id) {
		        return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
		    }
		} else {
			return redirect('admin/')->with('error','Sorry, Record does not exists');
		}

		$page = 'education-training';
		return view('backEnd.education_training_form', compact('edu_tr_rcrds','page'));
	}

    public function delete($edu_tr_id) {   
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($edu_tr_id)) {
            $record_delete =  DB::table('education_record')->where('id',$edu_tr_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);
            if(!empty($record_delete)) { 
                return redirect()->back()->with('success','Record deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
            // return redirect('admin/daily-record')->with('success','Record deleted Successfully.'); 
            // return redirect()->back()->with('success','Record deleted Successfully.'); 
        } else {
                return redirect('admin/')->with('admin/','Record does not exists.'); 
        }
    }
}