<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Admin, App\ServiceUserIncidentReport, App\FormDefault, App\FormBuilder, App\ServiceUser;  
use DB; 

class IncidentReportController  extends Controller
{
	public function index(Request $request, $service_user_id)
	{    
		//comparing su home_id
		$su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
		$home_id = Session::get('scitsAdminSession')->home_id;
		if($home_id != $su_home_id) {
			return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
		}
		$su_incident_reports = ServiceUserIncidentReport::where('is_deleted','0')
														->where('service_user_id', $service_user_id)
														->where('home_id',$home_id)
														->select('id','service_user_id','title', 'formdata');
														
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
			$su_incident_reports = $su_incident_reports->where('title','like','%'.$search.'%');
		}

		$su_incident_reports = $su_incident_reports->paginate($limit);

		$page = 'incident-report';
		return view('backEnd.serviceUser.incidentReport.incident_report', compact('page', 'limit','service_user_id', 'su_incident_reports', 'search')); //records.blade.php
	}

    public function add(Request $request, $service_user_id) {

        $form = FormBuilder::showFormAdmin('incident_report');

            $response = $form['response'];

            if($response == true){
                $form_pattern['incident_report'] = $form['pattern']; 
            } else{
                $form_pattern['incident_report'] = '';
            }

		if($request->isMethod('post')) {

        	$data = $request->input();
			/*if(isset($data['formdata'])){
                $data['formdata'] = array_values($data['formdata']);
            } else{
                return redirect()->back()->with('error','No input field added in the form.'); 
            }*/

			$home_id = Session::get('scitsAdminSession')->home_id; 
			
			$incident_report         	  = new ServiceUserIncidentReport;
			$incident_report->home_id     = $home_id;
			$incident_report->title 	  = $data['title'];
			$incident_report->service_user_id = $service_user_id;
			$incident_report->formdata	  = json_encode($data['formdata']);


			if($incident_report->save()) {
				return redirect('admin/service-user/incident-reports/'.$service_user_id)->with('success', 'Report added successfully.');
			}  else {
				return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
			}
        }
        $page = 'incident-report';
        return view('backEnd.serviceUser.incidentReport.incident_report_form', compact('page', 'service_user_id', 'form_pattern'));
    }

  	public function edit(Request $request, $inc_rep_id) { 

		$admin = Session::get('scitsAdminSession');
		$home_id = $admin->home_id; 

		if($request->isMethod('post')) {

			$data = $request->input();
			
			$edit_incident_report  = ServiceUserIncidentReport::find($inc_rep_id);
			$service_user_id	   = $edit_incident_report->service_user_id;	
			if(!empty($inc_rep_id)) {
				//comparing home_id
				$u_home_id = ServiceUserIncidentReport::where('id',$inc_rep_id)->value('home_id');
				if($home_id != $u_home_id) {
				    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
				}

				$edit_incident_report->title    = $data['title'];
				$edit_incident_report->formdata = json_encode($data['formdata']);

				if($edit_incident_report->save()) {
					return redirect('admin/service-user/incident-reports/'.$service_user_id)->with('success','Report updated successfully.'); 
				} else {
					return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
				}
			} else {
			return redirect('admin/')->with('error','Sorry, Report does not exist');
			}  
		}

		$incident_report = ServiceUserIncidentReport::where('id', $inc_rep_id)->first();
		$service_user_id	 = $incident_report->service_user_id;
		// echo($service_user_id); die;
		if(!empty($incident_report)) {
		    if($incident_report->home_id != $home_id) {

		        return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
		    }
		    else{
		    	$inc_rep_formdata = $incident_report->formdata;
		    	$inc_rep_form 	  = FormBuilder::showFormWithValueAdmin('incident_report', $inc_rep_formdata, true);

		    	if(!empty($inc_rep_form))	{
		    		// $inc_rep_form = $inc_rep_form['pattern'];
		    		$form_pattern['incident_report'] = $inc_rep_form['pattern'];
		    	} else {
					$form_pattern['incident_report'] = '';		    		
		    	}
		    }
		} else {
			return redirect('admin/')->with('error','Sorry, Report does not exist');
		}

		$page = 'incident-report';
		return view('backEnd.serviceUser.incidentReport.incident_report_form', compact('incident_report','service_user_id','form_pattern','page'));
	}

    public function delete($inc_rep_id) {

    	// echo "<pre>"; print_r($inc_rep_id); die;
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($inc_rep_id)) {

            $report_delete =  ServiceUserIncidentReport::where('id',$inc_rep_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);
            if(!empty($report_delete)) { 
                return redirect()->back()->with('success','Report deleted Successfully.'); 
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