<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Student, App\DailyRecord;  
use DB; 
use App\Admin;

class DailyRecordController extends Controller
{
	public function index(Request $request)
  {     
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {

          $records_query = DB::table('daily_record')->where('is_deleted','0')->where('home_id',$home_id)->select('id','description', 'status');
          $search = '';
          if(isset($request->limit))
          {
              $limit = $request->limit;
              Session::put('page_record_limit',$limit);
          } 
          else{
              if(Session::has('page_record_limit')){
                  $limit = Session::get('page_record_limit');
              } else{
                  $limit = 25;
              }
          }
          if(isset($request->search))
          {
              $search = trim($request->search);
              $records_query = $records_query->where('description','like','%'.$search.'%');
          }

          $records = $records_query->orderBy('description','asc')->paginate($limit);

        } else {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $page = 'daily_records';
        return view('backEnd/daily_records', compact('page', 'limit', 'records', 'search')); //records.blade.php
  }
  
    public function add(Request $request) { 
        if($request->isMethod('post')) {
          $home_id = Session::get('scitsAdminSession')->home_id; 

          $record              = new DailyRecord;
          $record->home_id     = $home_id;
          $record->description = $request->description;
          //$record->score       = $request->score;
          $record->status      = $request->status;
              

          if($record->save()) {
            return redirect('admin/daily-record')->with('success', 'Daily Record added successfully.');
          }  else {
            return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
          }
        }
        $page = 'daily_records';
        return view('backEnd.daily_record_form', compact('page'));
    }
	
  	public function edit(Request $request, $record_id) { 

          $admin = Session::get('scitsAdminSession');
          $home_id = $admin->home_id; 

          if($request->isMethod('post')) {
              $record               = DailyRecord::find($record_id);
              if(!empty($record)) {

                 //comparing home_id
                $u_home_id = DailyRecord::where('id',$record_id)->value('home_id');
                if($home_id != $u_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }

                  $record->description  = $request->description;
                  //$record->score        = $request->score;
                  $record->status       = $request->status;

                  if($record->save()) {
                     return redirect('admin/daily-record')->with('success','Daily Record Updated successfully.'); 
                  } else {
                   return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
                  }
              } else {
                    return redirect('admin/')->with('error','Sorry, DailyRecord does not exists');
              }  
          }

          $record_info = DB::table('daily_record')
                      ->where('id', $record_id)
                      ->first();
            if(!empty($record_info)) {
                if($record_info->home_id != $home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
            } else {
                    return redirect('admin/')->with('error','Sorry, DailyRecord does not exists');
            }

          $page = 'daily_records';
          return view('backEnd/daily_record_form', compact('record_info','page'));
      }

    public function delete($record_id) {   
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($record_id)) {
           $record_delete =  DB::table('daily_record')->where('id',$record_id)->where('home_id', $home_id)->update(['is_deleted'=>'1']);
           if($record_delete) { 
              return redirect()->back()->with('success','Record deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
        } else {
                return redirect('admin/')->with('admin/','Record does not exists.'); 
        }
    }

}