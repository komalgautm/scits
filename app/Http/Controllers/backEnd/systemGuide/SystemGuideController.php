<?php
namespace App\Http\Controllers\backEnd\systemGuide;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\SystemGuide;  
use DB; 
use App\Admin;

class SystemGuideController extends Controller
{
	public function index(Request $request, $sys_guide_category_id=null)
    {    
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(!empty($home_id)) {

            // $records_query = DB::table('daily_record')->where('is_deleted','0')->where('home_id',$home_id)->select('id','description', 'status');
        /*$sys_guide_query = DB::table('system_guide as sg')
                                ->where('sg.is_deleted','0')
                                ->join('system_guide_category as sg_ctgry', 'sg_ctgry.id', 'sg_ctgry_id')
                                ->select('sg.id','sg.system_guide_category_id as sg_ctgry_id','sg.question','sg.answer')
                                ->where('sg_ctgry_id', $category_id)
                                ->get();*/
        $sys_guide_query = DB::table('system_guide as sg')
                                ->where('sg.is_deleted','0')
                                ->select('sg.id','sg.system_guide_category_id','sg.question','sg.answer', 'sg_ctgry.category_name')
                                ->join('system_guide_category as sg_ctgry', 'sg_ctgry.id', 'sg.system_guide_category_id')
                                ->where('sg.system_guide_category_id', $sys_guide_category_id);

                                
            // echo "<pre>"; print_r($sys_guide_query); die;
            /*(
                [id] => 1
                [system_guide_category_id] => 1
                [question] => Question1
                [answer] => Answer1
            )*/
            $search = '';

            if(isset($request->limit))
            {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {
                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 25;
                }
            }
            if(isset($request->search))
            {
                $search = trim($request->search);
                $sys_guide_query = $sys_guide_query->where('question','like','%'.$search.'%');
            }

            $sys_guide = $sys_guide_query->paginate($limit);

        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $page = 'system-guide';
        return view('backEnd/systemGuide/system_guide', compact('page', 'limit', 'sys_guide','sys_guide_category_id','search')); //records.blade.php
    }
  
    public function add(Request $request, $sys_guide_category_id=null) {

        $home_id = Session::get('scitsAdminSession')->home_id;

        if(!empty($home_id)) {

            if($request->isMethod('post')) {

                $system_guide                           = new SystemGuide;
                $system_guide->system_guide_category_id = $sys_guide_category_id;
                $system_guide->question                 = $request->question;
                $system_guide->answer                   = $request->answer;
                
                if($system_guide->save()) {
                    return redirect('admin/system-guide/view/'.$sys_guide_category_id)->with('success', 'New Question added successfully.');
                } else {
                    return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                }
            }
            $page = 'system-guide';
            return view('backEnd.systemGuide.system_guide_form', compact('page', 'sys_guide_category_id'));
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
    }
	
  	public function edit(Request $request, $sys_guide_id) { 

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 
        /*(
            [id] => 1
            [system_guide_category_id] => 1
            [question] => Question1
            [answer] => Answer1
            [is_deleted] => 0
            [created_at] => 0000-00-00 00:00:00
            [updated_at] => 0000-00-00 00:00:00
        )*/
        if(!empty($home_id)) {
            if($request->isMethod('post')) {
                
                $system_guide  = SystemGuide::find($sys_guide_id);
                $sys_guide_category_id = $system_guide->system_guide_category_id;
                if(!empty($system_guide)) {

                    $system_guide->question  = $request->question;
                    $system_guide->answer    = $request->answer;

                    if($system_guide->save()) {
                        return redirect('admin/system-guide/view/'.$sys_guide_category_id)->with('success','System Guide Updated successfully.'); 
                    } else {
                        return redirect()->back()->with('error','Some Error Occured, System Guide could not be saved.'); 
                    }
                } else {
                    return redirect('admin/')->with('error','Sorry, System Guide does not exist');
                }  
            }
        }
        $system_guide = DB::table('system_guide')
                          ->where('id', $sys_guide_id)
                          ->first();
        $sys_guide_category_id = $system_guide->system_guide_category_id;

        $page = 'system-guide';
        return view('backEnd.systemGuide.system_guide_form', compact('system_guide','page', 'sys_guide_category_id'));
    }

    public function delete($sys_guide_id) {  

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($sys_guide_id)) {
           
           $updated =  DB::table('system_guide')->where('id',$sys_guide_id)->update(['is_deleted'=>1]);
           if($updated) { 
                   // return redirect('admin/')->with('error','Sorry, User does not exists');
                return redirect()->back()->with('success','System Guide deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error', 'Error Occured', 'System Guide could not be deleted'); 
            }
            // return redirect('admin/daily-record')->with('success','Record deleted Successfully.'); 
            //return redirect()->back()->with('success','Record deleted Successfully.'); 
        } else {
            return redirect('admin/')->with('error', 'System Guide does not exist.'); 
        }
    }

}