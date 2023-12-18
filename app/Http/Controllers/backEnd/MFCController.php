<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Admin, App\MFC;  
use DB; 

class MFCController extends Controller
{
	public function index(Request $request)
	{    
		$home_id = Session::get('scitsAdminSession')->home_id;

		if(empty($home_id)) {
			return redirect('admin/')->with('error',NO_HOME_ERR);
		}

		$mfc_records = MFC::where('is_deleted','0')->where('home_id',$home_id)->select('id', 'description', 'status');
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
			$mfc_records = $mfc_records->where('description','like','%'.$search.'%');
		}

		$mfc_records = $mfc_records->paginate($limit);

		$page = 'mfc';
		return view('backEnd.mfc', compact('page', 'limit', 'mfc_records', 'search')); //records.blade.php
	}

    public function add(Request $request) { 
        if($request->isMethod('post')) {

			$home_id = Session::get('scitsAdminSession')->home_id; 
			$mfc_record              = new MFC;
			$mfc_record->home_id     = $home_id;
			$mfc_record->description = $request->description;
			$mfc_record->status      = $request->status;
			  
			if($mfc_record->save()) {
			return redirect('admin/mfc-records')->with('success', 'Record added successfully.');
			}  else {
			return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
			}
        }
        $page = 'mfc';
        return view('backEnd.mfc_form', compact('page'));
    }
	
  	public function edit(Request $request, $mfc_id) { 

		$admin = Session::get('scitsAdminSession');
		$home_id = $admin->home_id; 

		if($request->isMethod('post')) {
			$mfc_record               = MFC::find($mfc_id);
			if(!empty($mfc_id)) {

				//comparing home_id
				$u_home_id = MFC::where('id',$mfc_id)->value('home_id');
				if($home_id != $u_home_id) {
				    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
				}

				$mfc_record->description  = $request->description;
				$mfc_record->status       = $request->status;

				if($mfc_record->save()) {
					return redirect('admin/mfc-records')->with('success','Record updated successfully.'); 
				} else {
					return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
				}
			} else {
			return redirect('admin/')->with('error','Sorry, Record does not exist');
			}  
		}

		$mfc_records = DB::table('mfc')
						->where('id', $mfc_id)
						->first();
		if(!empty($mfc_records)) {
		    if($mfc_records->home_id != $home_id) {

		        return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
		    }
		} else {
			return redirect('admin/')->with('error','Sorry, Record does not exist');
		}

		$page = 'mfc';
		return view('backEnd.mfc_form', compact('mfc_records','page'));
	}

    public function delete($mfc_id) {   
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($mfc_id)) {
            $record_delete =  DB::table('mfc')->where('id',$mfc_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);

            if(!empty($record_delete)) { 
                return redirect()->back()->with('success','Record deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
            // return redirect('admin/daily-record')->with('success','Record deleted Successfully.'); 
            // return redirect()->back()->with('success','Record deleted Successfully.'); 
        } else {
                return redirect('admin/')->with('admin/','Record does not exist.'); 
        }
    }
}