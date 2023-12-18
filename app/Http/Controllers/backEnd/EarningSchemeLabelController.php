<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\EarningScheme, App\Incentive, App\Country, App\State, App\City,App\EarningSchemeLabel;  
use DB; 
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EarningSchemeLabelController extends Controller {

    public function index(Request $request){   

        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        // echo "<pre>"; print_r($home_id); die;

        $earning_scheme_query = DB::table('earning_scheme_label')
                                    ->select('id','icon','name','label_type')
                                    ->where('deleted_at',null)
                                    ->where('home_id',$home_id);
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else {
            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            }   else  {
                $limit = 25;
            }
        }
        if(isset($request->search)) {
            $search               = trim($request->search);
            $earning_scheme_query = $earning_scheme_query->where('name','like','%'.$search.'%');
        }

        $earning_scheme_results = $earning_scheme_query->orderBy('name','asc')->paginate($limit);
        
        $page = 'earning_scheme_label';
        return view('backEnd.earning_scheme_label', compact('page','limit','search','earning_scheme_results')); 
    }     

    public function add(Request $request) { 	

        $home_id = Session::get('scitsAdminSession')->home_id;
        if($request->isMethod('post')){
            $label             = new EarningSchemeLabel;
            $label->name       = $request->name;
            $label->home_id    = $home_id;
            $label->icon       = $request->icon;
            $label->label_type = $request->label_type;
            if($label->save()){
                return redirect('admin/earning-scheme-labels')->with('success', 'Label added successfully.');
            } 
            else {
                return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
            }
        }

        $page = 'earning_scheme_label';
        return view('backEnd.earning_label_form', compact('page'));
    }

    public function edit(Request $request, $label_id) { 

        $home_id = Session::get('scitsAdminSession')->home_id;	
        if($request->isMethod('post')) {
            
            $label   = EarningSchemeLabel::find($label_id);
            if(!empty($label)) {
                $ea_home_id = EarningSchemeLabel::where('id',$label_id)->value('home_id');
                if($home_id != $ea_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                $label->name       = $request->name;
                $label->icon       = $request->icon;
                $label->label_type = $request->label_type;

                if($label->save()) {
                   return redirect('admin/earning-scheme-labels')->with('success','Earning Scheme Label Updated.'); 
                }  else {
                   return redirect()->back()->with('error','Earning Scheme could not be Updated Successfully.'); 
                }  
            }
        }

        $earning_info = DB::table('earning_scheme_label')
                                ->where('id', $label_id)
                                ->first();

        $page = 'earning_scheme_label';
        return view('backEnd/earning_label_form', compact('earning_info','page'));
    }

    public function delete($label_id){
        
        if(!empty($label_id)) {
            $label_delete =  EarningSchemeLabel::where('id', $label_id)->update(['deleted_at'=>Carbon::now()]);
            if(!empty($label_delete)){      
                return redirect('admin/earning-scheme-labels')->with('success','Label deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
        }else{
            return redirect('admin/')->with('error','Sorry, Earning Scheme does not exists'); 
        }
    }
}