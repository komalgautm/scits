<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\DailyRecord, App\DailyRecordScore;  
use DB; 
use App\Admin;

class DailyRecordScoreController extends DailyRecordController
{
	public function index(Request $request)
  {     
        /*$home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {*/

        $dr_scores_query = DB::table('daily_record_score');
          
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
              $dr_scores_query = $dr_scores_query->where('title','like','%'.$search.'%');
          }

          $dr_scores = $dr_scores_query->paginate($limit);

        /*} else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }*/

        $page = 'daily-record-scores';
        return view('backEnd.daily_record_scores', compact('page', 'limit', 'dr_scores', 'search')); //records.blade.php
  }
  
    /*public function add(Request $request) { 
        
        if($request->isMethod('post')) {
          $home_id = Session::get('scitsAdminSession')->home_id; 

          $record              = new DailyRecord;
          $record->home_id     = $home_id;
          $record->description = $request->description;
          //$record->score       = $request->score;
          $record->status      = $request->status;
              

          if($record->save()) {
            return redirect('admin/daily-record')->with('success', 'Daily Record added successfully.');
            // return redirect()->back()->with('success', 'Record added successfully.');
          }  else {
            return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
          }
        }
        $page = 'daily_records';
        return view('backEnd.daily_record_form', compact('page'));
    }*/
	
  	public function edit(Request $request, $dr_score_id) { 

          if($request->isMethod('post')) {
              
              $dr_score               = DailyRecordScore::find($dr_score_id);
              if(!empty($dr_score)) {

               
                  $dr_score->title       = $request->title;

                  if($dr_score->save()) {
                    return redirect('admin/daily-record-scores')->with('success','Daily Record Score Updated successfully.'); 
                  } else {
                   return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
                  }
              } else {

                    return redirect('admin/')->with('error','Sorry, Daily Record Score does not exist');
              }  
          } 
          // echo 2; die;
          $dr_score = DB::table('daily_record_score')
                            ->where('id', $dr_score_id)
                            ->first();
          
          // echo "<pre>"; print_r($dr_score); die;

          /*if(!empty($dr_score)) {
              
              if($dr_score->home_id != $home_id) {
                  return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
              } else {
                  return redirect('admin/')->with('error','Sorry, Record Score does not exists');
          }*/

          $page = 'daily-record-scores';
          return view('backEnd.daily_record_score_form', compact('dr_score','page'));
      }

    /*public function delete($dr_score_id) {   
        
        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

        if(!empty($dr_score_id)) {
           $record_delete =  DB::table('daily_record')->where('id',$dr_score_id)->where('home_id', $home_id)->delete();
           if(!empty($record_delete)) { 
                   // return redirect('admin/')->with('error','Sorry, User does not exists');
                return redirect()->back()->with('success','Record deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
            // return redirect('admin/daily-record')->with('success','Record deleted Successfully.'); 
            //return redirect()->back()->with('success','Record deleted Successfully.'); 
        } else {
                return redirect('admin/')->with('admin/','Record does not exists.'); 
        }
    }*/

}