<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\EarningScheme, App\Incentive, App\Country, App\State, App\City;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;


class EarningSchemeController extends Controller {

    public function earning_scheme(Request $request) {   
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $earning_scheme_query = DB::table('earning_scheme_category')->select('id','icon', 'title','status')->where('home_id',$home_id);
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
            $search         = trim($request->search);
            $earning_scheme_query     = $earning_scheme_query->where('title','like','%'.$search.'%');
        }

        $earning_scheme_results = $earning_scheme_query->orderBy('title','asc')->paginate($limit);
        
        $page = 'earning_scheme';
        return view('backEnd.earning_scheme', compact('page', 'limit', 'search', 'earning_scheme_results')); //users.blade.php
    }

    public function add(Request $request) { 	
        if($request->isMethod('post'))  {
            
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            $earning                  = new EarningScheme;
            $earning->home_id         = $home_id;
            $earning->title     	  = $request->title;
            $earning->icon            = $request->icon;
            $earning->status          = $request->status;
            
            if($earning->save()) {
                    return redirect('admin/earning-scheme')->with('success', 'Earning Scheme added successfully.');
            } 
            else {
                     return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
            }
        }
        $page = 'earning_scheme';
        return view('backEnd.earning_scheme_form', compact('page'));
    }

    public function edit(Request $request, $earning_id) { 	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($request->isMethod('post')) {
            $earning = EarningScheme::find($earning_id);
            if(!empty($earning)) {
                
                //comparing home_id
                $su_home_id = EarningScheme::where('id',$earning_id)->value('home_id');
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                $earning->title          	   = $request->title;
                $earning->icon                 = $request->icon;
                $earning->status               = $request->status;

                if($earning->save()) {
                   return redirect('admin/earning-scheme')->with('success','Earning Scheme Updated.'); 
                }  else {
                   return redirect()->back()->with('error','Earning Scheme could not be Updated Successfully.'); 
                }  
            }
        }

        $earning_info   = DB::table('earning_scheme_category')
                                ->where('id', $earning_id)
                                ->first();

        if(!empty($earning_info)) {
            if($earning_info->home_id != $home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }  else {
                return redirect('admin/')->with('error','Sorry, Earning Scheme does not exists');
        }

        $page = 'earning_scheme';
        return view('backEnd/earning_scheme_form', compact('earning_info','page'));
    }

    public function delete($earning_id) {
        
        if(!empty($earning_id)) {
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            $earn_delete =  EarningScheme::where('id', $earning_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);
            if(!empty($earn_delete))  {      
                Incentive::where('earning_category_id', $earning_id)->delete();
                return redirect('admin/earning-scheme')->with('success','Earning Scheme deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
        } else {
                return redirect('admin/')->with('error','Sorry, Earning Scheme does not exists'); 
        }
    }

}