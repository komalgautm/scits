<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\EarningScheme, App\Incentive;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;


class IncentiveController extends Controller
{ 
    public function incentive(Request $request, $earning_category_id)
    {   
        $earn_home_id = EarningScheme::where('id',$earning_category_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;

        if($home_id == $earn_home_id) {

            $incentive_query = Incentive::where('earning_category_id',$earning_category_id)->where('is_deleted','0')->select('id','earning_category_id','name','status','stars');
            $search = '';
            
            // dd($request->Session()->all());
            if(isset($request->limit)) {
                
                $limit = $request->limit;

                Session::put('page_record_limit',$limit);
            }  else  {

                if(Session::has('page_record_limit')) {
                    $limit = Session::get('page_record_limit');
                } 
                else {
                    $limit = 25;
                }
            } if(isset($request->search))
            {
                $search         = trim($request->search);
                $incentives     = $incentive_query->where('name','like','%'.$search.'%');
            }

            $incentives = $incentive_query->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
        
        $page = 'incentive_earning_scheme';
        return view('backEnd.incentive_earning_scheme', compact('page', 'limit', 'search', 'incentives','earning_category_id')); //users.blade.php
    }

    public function add(Request $request, $earning_category_id)
    { 	
        if($request->isMethod('post')) {   
            $earn_home_id = EarningScheme::where('id',$earning_category_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;

            if($home_id == $earn_home_id) {

                $incentive                      = new Incentive;
                $incentive->earning_category_id = $earning_category_id;
                $incentive->name                = $request->name;
                $incentive->stars               = $request->stars;
                $incentive->details             = $request->details;
                $incentive->url     	        = $request->url;
                $incentive->status              = $request->status;
                
                if($incentive->save()) {   
                        return redirect('admin/earning-scheme/incentive/'.$earning_category_id)->with('success', 'Incentive added successfully.');
                        // return redirect()->back()->with('success', 'Incentive added successfully.');
                    }  else  {
                         return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                    }
            } else {
                     return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        $page = 'incentive_earning_scheme';
        return view('backEnd.incentive_earning_scheme_form', compact('page','earning_category_id'));
    }

    public function edit(Request $request, $incentive_id) { 	
        
        $incentive              = Incentive::find($incentive_id);
            if(!empty($incentive)) {

                $earning_category_id    = $incentive->earning_category_id;
                
                //comparing  home_id
                $su_home_id = EarningScheme::where('id',$earning_category_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                if($request->isMethod('post')) {   

                    $incentive->name     = $request->name;
                    $incentive->stars    = $request->stars;
                    $incentive->details  = $request->details;
                    $incentive->url      = $request->url;
                    $incentive->status   = $request->status;

                   if($incentive->save())   {   
                       return redirect('admin/earning-scheme/incentive/'.$earning_category_id)->with('success','Incentive has been updated successfully.'); 
                   }  else  {
                       return redirect()->back()->with('error','Incentive could not be Updated.'); 
                   }  
                }
            }

        $incentives   = DB::table('incentive')
                            ->where('id', $incentive_id)
                            //->where('earning_category_id', $earning_category_id)
                            ->first();
    
        if(!empty($incentives)) { 
            $earn_home_id = EarningScheme::where('id',$incentives->earning_category_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            if($home_id != $earn_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else {
            return redirect('admin/')->with('error','Sorry, Incentive does not exists');
        }
        
        $page = 'incentive_earning_scheme';
        return view('backEnd.incentive_earning_scheme_form', compact('incentives','page','earning_category_id'));
        

    }

    public function delete($incentive_id) {  
       
        if(!empty($incentive_id)) {
        $incentive =  DB::table('incentive')->where('id', $incentive_id)->first();
            if(!empty($incentive)) {

            $e_home_id = EarningScheme::where('id',$incentive->earning_category_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            //compare with su home_id
            if($home_id != $e_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }

            DB::table('incentive')->where('id', $incentive_id)->update(['is_deleted'=>'1']);
            return redirect()->back()->with('success','Incentive deleted Successfully.'); 
            } 
        }  else {
                return redirect('admin/')->with('error','Sorry, Incentive does not exists'); 
        }
    }
}