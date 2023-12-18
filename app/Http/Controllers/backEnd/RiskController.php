<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Risk, App\Country, App\State, App\City;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class RiskController extends Controller
{
    public function risk(Request $request)
    {   
        $home_id = Session::get('scitsAdminSession')->home_id;

        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $risk_query = DB::table('risk')->where('is_deleted','0')->select('id','description','icon','status')->where('home_id',$home_id);
        $search = '';
        
        if(isset($request->limit))
        {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else
        {
            if(Session::has('page_record_limit'))
            {
                $limit = Session::get('page_record_limit');
            } 
            else
            {
                $limit = 25;
            }
        }
        if(isset($request->search))
        {
            $search         = trim($request->search);
            $risk_query     = $risk_query->where('description','like','%'.$search.'%');
        }
        $risk = $risk_query->orderBy('description','asc')->paginate($limit);
        //$users = DB::table('user')->select('id','name','user_name', 'email', 'access_level')->paginate(25);
        $page = 'risks';
        return view('backEnd/risks', compact('page','limit','risk','search')); //users.blade.php
    }

    public function add(Request $request)
    { 
        if($request->isMethod('post'))
        {
            $home_id = Session::get('scitsAdminSession')->home_id;
            $risk                  = new Risk;
            $risk->description     = $request->description;
            $risk->home_id         = $home_id;
            $risk->icon            = $request->icon;
            $risk->status          = $request->status;
            
            if($risk->save())
                {
                    return redirect('admin/risk')->with('success', 'Risk added successfully.');
                } 
            else
                {
                     return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                }
        }
        $page = 'risks';
        return view('backEnd.risk_form', compact('page'));
    }

    public function edit(Request $request, $risk_id)  { 

        $home_id = Session::get('scitsAdminSession')->home_id;
        if($request->isMethod('post'))  {
            $risk                       = Risk::find($risk_id);
            if(!empty($risk)) {

                //comparing home_id
                $u_home_id = Risk::where('id',$risk_id)->value('home_id');
                if($home_id != $u_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                $risk->description          = $request->description;
                $risk->icon                 = $request->icon;
                $risk->status               = $request->status;

               if($risk->save())   {
                   return redirect('admin/risk')->with('success','Risk Updated successfully.'); 
               }   else {
                   return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
               }  
            } else {
                return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
            }

        }

        $risk_info   = DB::table('risk')
                    ->where('id', $risk_id)
                    ->first();

        if(!empty($risk_info)) {
            if($risk_info->home_id != $home_id) {
                return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
            }
        } else {
            return redirect('admin/')->with('error','Risk does not exists');
        }
        
        $page = 'risks';
        return view('backEnd/risk_form', compact('risk_info','page'));
    }

    public function delete($risk_id)
    {
        if(!empty($risk_id))   {    
            $home_id = Session::get('scitsAdminSession')->home_id;
            $risk_delete =   DB::table('risk')->where('id', $risk_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);

            if(!empty($risk_delete)) {
                return redirect('admin/risk')->with('success','Risk deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
           
        } else {
                return redirect('admin/')->with('admin/','Risk does not exists.'); 
        }
    }
}