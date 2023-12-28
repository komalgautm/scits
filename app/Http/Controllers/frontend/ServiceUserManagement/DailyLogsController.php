<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use DB,Auth;
use App\Models\ServiceUser;
use App\Models\User;
use App\Models\ServiceUserLogBook;
use App\Models\CategoryFrontEnd;
use App\Models\LogBookComment;

class DailyLogsController extends Controller
{
    public function index(Request $request)
    {
        // echo "string";
        // die();
        if(isset($_GET['key'])){
            $service_user_id =$_GET['key'];
        }else{
            $service_user_id ="";
        }
       

        $data = $request->input();
        // echo"<pre>";print_r(count($data));die;
        $home_id = Auth::user()->home_id;
        $user_id = Auth::user()->id;
        $today = date('Y-m-d 00:0:00');
        $service_users = ServiceUser::select('id','name')
                            ->where('home_id',$home_id)
                            ->where('is_deleted','0')
                            ->get();
        //staff_member
        $staff_members  =   User::where('is_deleted','0')
                                ->where('home_id', Auth::user()->home_id)
                                ->get();
        //$service_user_id ="";
        if($service_user_id!=''){
           //print_r($data);
           // die();
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            $service_user_name = ServiceUser::where('id',$service_user_id)->value('name');
            // if($su_home_id != $home_id){
            //     return redirect()->back()->with("error",UNAUTHORIZE_ERR);
            // }

            $su_logs = ServiceUserLogBook::select('su_log_book.log_book_id')
                                        // ->where('su_log_book.user_id',$user_id)
                                        ->where('su_log_book.service_user_id', $service_user_id)->get();

             if($request->filter=='1'){

             
                // if(!empty($data)){
                if(count($data)>0){
                    $log_book_records = DB::table('log_book')
                                    ->select('log_book.*', 'user.name as staff_name','category.color as category_color')
                                    ->whereIn('log_book.id',$su_logs)
                                    ->join('user', 'log_book.user_id', '=', 'user.id')
                                    ->join('category', 'log_book.category_id', '=', 'category.id')
                                    ->orderBy('date','desc');
            // $log_book_records = LogBook::select('log_book.*')
            //                         ->orderBy('date','desc');

            // Log::info("Logs.");
            // Log::info($log_book_records);

            if(isset($request->category_id) && $request->category_id!= 'NaN'){
                $log_book_records = $log_book_records->where('log_book.category_id', $request->category_id);
                // Log::info("Category Logs.");
                // Log::info($log_book_records->get()->toArray());
            }


            if(isset($request->start_date) && $request->start_date!='null') {
                $log_book_records = $log_book_records->whereDate('log_book.date', '>=', $request->start_date);
                // Log::info("Start Date Logs.");
                // Log::info($log_book_records->get()->toArray());
            }
            if(isset($request->end_date) && $request->end_date!='null') {
                $log_book_records = $log_book_records->whereDate('log_book.date', '<=', $request->end_date);       
                // Log::info("End Date Logs.");
                // Log::info($log_book_records->get()->toArray());
            }

            // $log_book_records = $log_book_records->get()->toArray();
            $log_book_records = $log_book_records->get();
            $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
            
            foreach ($log_book_records as &$key )
            {
                $key['date'] = date("d-m-Y H:i", strtotime($key['date']));
                $comments = LogBookComment::where('log_book_id',$key['id'])->get();
                $key = Arr::add($key, 'comments', $comments->count());
                if($key['is_late']) {
                    $given_date_without_time    = date('Y-m-d', strtotime($key['date']));
                    $created_at_without_time    = date('Y-m-d', strtotime($key['created_at']));
                    if($given_date_without_time == $created_at_without_time) {
                        $key = Arr::add($key, 'late_time_text', date('H:i', strtotime($key['created_at'])));
                        $key = Arr::add($key, 'late_date_text', date('d-m-Y', strtotime($key['created_at'])));
                    }
                }
            }
            $categorys = CategoryFrontEnd::select('category.*')->orderBy('name','asc')->get();
           

            // return compact('log_book_records', 'categorys');
                    
                }
            }
     
            Log::info($su_logs);
            $today = date('Y-m-d');                
            $log_book_records = DB::table('log_book')
                                        ->select('log_book.*', 'user.name as staff_name','category.color as category_color')
                                        ->whereIn('log_book.id',$su_logs)
                                        ->whereDate('log_book.date', '=', $today)
                                        ->join('user', 'log_book.user_id', '=', 'user.id')
                                        ->join('category', 'log_book.category_id', '=', 'category.id')
                                        ->orderBy('date','desc')->get();

            $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
            // $log_book_records = LogBook::select('log_book.*')
            //                             ->whereIn('log_book.id',$su_logs)
            //                             ->whereDate('log_book.date', '=', $today)
            //                             ->orderBy('date','desc')->get()->toArray();

            foreach ($log_book_records as &$key )
            {
                $key['created_at'] = date("d-m-Y H:i", strtotime($key['created_at']));
                $comments = LogBookComment::where('log_book_id',$key['id'])->get();
                $key = Arr::add($key, 'comments', $comments->count());
                if($key['is_late']) {
                    $given_date_without_time    = date('Y-m-d', strtotime($key['date']));
                    $created_at_without_time    = date('Y-m-d', strtotime($key['created_at']));
                    if($given_date_without_time == $created_at_without_time) {
                        $key = Arr::add($key, 'late_time_text', date('H:i', strtotime($key['created_at'])));
                        $key = Arr::add($key, 'late_date_text', date('d-m-Y', strtotime($key['created_at'])));
                    }
                }
            }

            $categorys = CategoryFrontEnd::select('category.*')->orderBy('name','asc')->get();
            /**
             * Removing Attendance Category
             */
            foreach($categorys as $k => $val) {
                if($val['name'] == "Attendance") {
                    unset($categorys[$k]);
                }
            }

        }else{
            $su_home_id = ServiceUser::value('home_id');
            $service_user_name = ServiceUser::value('name');
            // if($su_home_id != $home_id){
            //     return redirect()->back()->with("error",UNAUTHORIZE_ERR);
            // }

            $su_logs = ServiceUserLogBook::select('su_log_book.log_book_id')->get();

            if($request->filter=='1'){
            // if(!empty($data)){
            if(count($data)>0){
                //sourabh staff member and service user filter
                if($request->service_user=='' && $request->staff_member==''){
                    $service_userss = ServiceUser::select('id')
                            ->where('home_id',$home_id)
                            ->where('is_deleted','0')
                            ->get();
                    $su_logss = ServiceUserLogBook::select('su_log_book.log_book_id')
                            // ->where('su_log_book.user_id',$user_id)
                            ->whereIn('su_log_book.service_user_id', $service_userss)->get();

                }else if($request->service_user!='' && $request->staff_member==''){
                    $su_logss = ServiceUserLogBook::select('su_log_book.log_book_id')
                        // ->where('su_log_book.user_id',$user_id)
                        ->where('su_log_book.service_user_id', $request->service_user)->get();
                }else if($request->service_user=='' && $request->staff_member!=''){

                    $su_logss = ServiceUserLogBook::select('su_log_book.log_book_id')
                        ->where('su_log_book.user_id',$request->staff_member)->get();

                }else if($request->service_user!='' && $request->staff_member!=''){
                    $su_logss = ServiceUserLogBook::select('su_log_book.log_book_id')->where('su_log_book.user_id',$request->staff_member)->where('su_log_book.service_user_id', $request->service_user)->get();
                }           
                
                
                $log_book_records = DB::table('log_book')
                                    ->select('log_book.*', 'user.name as staff_name','category.color as category_color')
                                    ->whereIn('log_book.id',$su_logss)
                                    ->join('user', 'log_book.user_id', '=', 'user.id')
                                    ->join('category', 'log_book.category_id', '=', 'category.id')
                                    ->orderBy('date','desc');
            // $log_book_records = LogBook::select('log_book.*')
            //                         ->orderBy('date','desc');

            // Log::info("Logs.");
            // Log::info($log_book_records);

            if(isset($request->category_id) && $request->category_id!= 'NaN'){
                $log_book_records = $log_book_records->where('log_book.category_id', $request->category_id);
                // Log::info("Category Logs.");
                // Log::info($log_book_records->get()->toArray());
            }


            if(isset($request->start_date) && $request->start_date!='null') {
                $log_book_records = $log_book_records->whereDate('log_book.date', '>=', $request->start_date);
                // Log::info("Start Date Logs.");
                // Log::info($log_book_records->get()->toArray());
            }
            if(isset($request->end_date) && $request->end_date!='null') {
                $log_book_records = $log_book_records->whereDate('log_book.date', '<=', $request->end_date);       
                // Log::info("End Date Logs.");
                // Log::info($log_book_records->get()->toArray());
            }
            //sourabh
            if(isset($request->keyword) && $request->keyword!='null') {
                $log_book_records = $log_book_records->where('log_book.details', 'like', '%'.$request->keyword.'%');       
                // Log::info("End Date Logs.");
                // Log::info($log_book_records->get()->toArray());
            }
            

            // $log_book_records = $log_book_records->get()->toArray();
            $log_book_records = $log_book_records->get();
            $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
            
            foreach ($log_book_records as &$key )
            {
                $key['date'] = date("d-m-Y H:i", strtotime($key['date']));
                $comments = LogBookComment::where('log_book_id',$key['id'])->get();
                $key = Arr::add($key, 'comments', $comments->count());
                if($key['is_late']) {
                    $given_date_without_time    = date('Y-m-d', strtotime($key['date']));
                    $created_at_without_time    = date('Y-m-d', strtotime($key['created_at']));
                    if($given_date_without_time == $created_at_without_time) {
                        $key = Arr::add($key, 'late_time_text', date('H:i', strtotime($key['created_at'])));
                        $key = Arr::add($key, 'late_date_text', date('d-m-Y', strtotime($key['created_at'])));
                    }
                }
            }

            $categorys = CategoryFrontEnd::select('category.*')->orderBy('name','asc')->get()->toArray();
            
            // return compact('log_book_records', 'categorys');
                
            }
        }
     
            Log::info($su_logs);
            $today = date('Y-m-d');                
            $log_book_records = DB::table('log_book')
                                        ->select('log_book.*', 'user.name as staff_name','category.color as category_color')
                                        ->whereIn('log_book.id',$su_logs)
                                        ->whereDate('log_book.date', '=', $today)
                                        ->join('user', 'log_book.user_id', '=', 'user.id')
                                        ->join('category', 'log_book.category_id', '=', 'category.id')
                                        ->orderBy('date','desc')->get();

            $log_book_records = collect($log_book_records)->map(function($x){ return (array) $x; })->toArray();
            // $log_book_records = LogBook::select('log_book.*')
            //                             ->whereIn('log_book.id',$su_logs)
            //                             ->whereDate('log_book.date', '=', $today)
            //                             ->orderBy('date','desc')->get()->toArray();

            foreach ($log_book_records as &$key )
            {
                $key['created_at'] = date("d-m-Y H:i", strtotime($key['created_at']));
                $comments = LogBookComment::where('log_book_id',$key['id'])->get();
                $key = Arr::add($key, 'comments', $comments->count());
                //$key['comments']=$comments->count();
                if($key['is_late']) {
                    $given_date_without_time    = date('Y-m-d', strtotime($key['date']));
                    $created_at_without_time    = date('Y-m-d', strtotime($key['created_at']));
                    if($given_date_without_time == $created_at_without_time) {
                        $key = Arr::add($key, 'late_time_text', date('H:i', strtotime($key['created_at'])));
                        $key = Arr::add($key, 'late_date_text', date('d-m-Y', strtotime($key['created_at'])));
                       // $key['late_time_text']=date('H:i', strtotime($key['created_at']));
                        //$key['late_date_text']=date('d-m-Y', strtotime($key['created_at']));
                    }
                }
            }

            $categorys = CategoryFrontEnd::select('category.*')->orderBy('name','asc')->get();
            /**
             * Removing Attendance Category
             */
            foreach($categorys as $k => $val) {
                if($val['name'] == "Attendance") {
                    unset($categorys[$k]);
                }
            }
        }
        
        
        
        // echo "<pre>";print_r($user_id);die;
        $data['user_id']=$user_id;
        $data['service_user_id']=$service_user_id;
        $data['service_user_name']=$service_user_name;
        $data['home_id']=$home_id;
        $data['su_home_id']=$su_home_id;
        $data['log_book_records']=$log_book_records;
        $data['su_logs']=$su_logs;
        $data['categorys']=$categorys;
        $data['service_users']=$service_users;
        $data['staff_members']=$staff_members;
        
        return view('frontEnd.serviceUserManagement.daily_log',$data);
    }

    function daily_logs_filterData(Request $request){
        return "1";


    }
}
