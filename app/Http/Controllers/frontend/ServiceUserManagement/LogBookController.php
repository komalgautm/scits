<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Notification;
use Exception;
use DB, Auth;
use PDF;
use Carbon\Carbon;
use App\Models\LogBook;
use App\Models\ServiceUser;
use App\Models\ServiceUserLogBook;
use App\Models\User;
use App\Models\HandoverLogBook;
use App\Models\ServiceUserReport;
use App\Models\ServiceUserCareTeam;
use App\Models\CareTeam;
use App\Models\CategoryFrontEnd;

class LogBookController extends Controller
{
    public function add(Request $request) {       
        // echo "<pre>";print_r($request->all());die;
        // if($request->isMethod('post'))
        // {
            //sourabh geo location
            $ip = '49.35.41.195'; //For static IP address get
            //$ip = request()->ip(); //Dynamic IP address get
            
            // $current_location = \Location::get($ip); hide by Ram 15/12/2023
            $url="http://www.geoplugin.net/json.gp?ip=$ip"; 

            $get=file_get_contents($url);
            $current_location = json_decode($get);
            // echo"<pre>";print_r($current_location);die;
            //sourabh geo location
            $data = $request->all();
            // echo"<pre>";print_r($data);die;
            //print_r($data['log_image']);
            /*sourabh image upload*/
            if($request->hasFile('log_image')){
                //echo "string";
                $log_image = time().'.'.request()->log_image->getClientOriginalExtension();
                request()->log_image->move('upload/events/',$log_image);
            }else{
                //echo "false";
                $log_image = '';
            }
            // echo $data['service_user_id'];
            // die;
            /*sourabh*/
            // echo "<pre>"; print_r($data); die;

            /*$su_home_id = ServiceUser::where('id',$data['service_user_id'])->value('home_id');
            if(Auth::user()->home_id != $su_home_id){
                echo '0'; die; 
            }*/
            $home_ids = Auth::user()->home_id;
            

            $searchString = ',';
                //$homde_id = 1,2
            if(strpos(@$home_ids, $searchString) !== false ) {
                $home_id =  explode(',', @$home_ids);
                $login_home_id = @$home_id[0];
            }else{
                $login_home_id = @$home_ids;
            }

            // echo"<pre>";print_r($login_home_id);die;
            $latest_date    = LogBook::select('log_book.*')
                            ->orderBy('date','desc')->take(1)->value('date');

            $latest_date    = date('Y-m-d H:i:s', strtotime($latest_date));
            $given_date    = date('Y-m-d H:i:s', strtotime($data['log_date']));
            $latest_date_without_time    = date('Y-m-d', strtotime($latest_date));
            $given_date_without_time    = date('Y-m-d', strtotime($given_date));
            $current_date_without_time    = date('Y-m-d');


            // $latest_date_value = $latest_date->value('date');

            $log_book_record          = new LogBook;
            // echo "<pre>"; print_r($log_book_record); die;

            $category_icon = CategoryFrontEnd::where('id',$data['category'])->value('icon');
            $category_name = CategoryFrontEnd::where('id',$data['category'])->value('name');
            
            $log_book_record->title   = $data['log_title'];
            $log_book_record->category_id = $data['category'];
            $log_book_record->category_name   = $category_name;
            $log_book_record->category_icon   = $category_icon;
            $log_book_record->date    = date('Y-m-d H:i:s', strtotime($data['log_date']));
            $log_book_record->details = $data['log_detail'];
            $log_book_record->home_id = $login_home_id;
            $log_book_record->user_id = Auth::user()->id;
            $log_book_record->image_name = $log_image;
            // hide by Ram 15/12/2023
            // $log_book_record->latitude = $current_location->latitude;
            // $log_book_record->longitude = $current_location->longitude;
            $log_book_record->latitude = $current_location->geoplugin_latitude;
            $log_book_record->longitude = $current_location->geoplugin_longitude;
            
            // Log::info($current_date_without_time);
            // Log::info($latest_date_without_time);
            // Log::info('*******');
            
            // Log::info($given_date);
            // Log::info($latest_date);
            // Log::info('*******');
            if($given_date < $latest_date)
            {
                $log_book_record->is_late = true;
            } else if($current_date_without_time > $latest_date_without_time && $given_date_without_time < $current_date_without_time) {
                
                $log_book_record->is_late = true;
            }
            $log_book_record->save();
            if($log_book_record->save()) {
                
                
                $su_log_book_record                     =   new ServiceUserLogBook;
                $su_log_book_record->service_user_id    =   $data['service_user_id'];
                $su_log_book_record->log_book_id        =   $log_book_record->id;
                $su_log_book_record->user_id            =   Auth::user()->id;
                //$su_log_book_record->category_id        =   $data['category_id'];
                if($given_date < $latest_date)
                {
                    $su_log_book_record->is_late = true;
                    Log::info("Send notification for late entry ");
                    $this->sendNotification($log_book_record, $su_log_book_record);
                    if($su_log_book_record->save()) {
                        $result['response'] = true;
                    }
                    else {
                        $result['response'] = false;
                    }
                }
                else{
                    if($su_log_book_record->save()) {
                        $result['response'] = true;
                        // echo "1";
                    }
                    else {
                        // echo 13;die;
                        $result['response'] = false;
                        // echo "2";
                    }
                }
                // if($su_log_book_record->save()) {
                //     if(strtotime($log_book_record->date) < strtotime('now')) {
                //         Log::info("Send notification for late entry ");
                //         $this->sendNotification($log_book_record, $su_log_book_record);
                //     }
                //     $result['response'] = true;
                // }  else {
                //     $result['response'] = false;  
                // }
            }   
            else {
                // echo 2;die;
                
                $result['response'] = false;
                // echo "2";
            }
                // if($log_book_record->save()){

                //saving notification start

                /*$notification                  = new Notification;
                $notification->service_user_id = $data['service_user_id'];
                $notification->event_id        = $records->id;
                $notification->event_type      = 'SU_DR';
                $notification->event_action    = 'ADD';      
                $notification->home_id         = Auth::user()->home_id;
                $notification->user_id         = Auth::user()->id;        
                $notification->save();*/

                //saving notification end

                /*$res = $this->index();
                echo $res; die;*/ 

                /*return redirect()->back()->with('success','Request submitted successfully.');

            }
            else { 
                return redirect()->back()->with('error',COMMON_ERROR);
            }*/
            return $result;
        // }
    }

    public function log_handover_to_staff_user(Request $request) {  
            // echo "<pre>"; print_r($request->input()); die;

        if ($request->isMethod('post'))   {

            $home_ids = Auth::user()->home_id;
            $searchString = ',';
                //$homde_id = 1,2
            if(strpos(@$home_ids, $searchString) !== false ) {
                $home_id =  explode(',', @$home_ids);
                $login_home_id = @$home_id[0];
            }else{
                $login_home_id = @$home_ids;
            }

            $data = $request->all();
            $log_book_info = LogBook::where('id',$data['log_id'])
                                    ->where('is_deleted','0')
                                    ->first();

            if(!empty($log_book_info)){
                $handover_log = HandoverLogBook::where('log_book_id', $data['log_id'])
                                           ->where('assigned_staff_user_id', $data['staff_user_id'])
                                           ->where('service_user_id',$data['servc_use_id'])
                                           ->first();
            
                if(empty($handover_log)) {

                    $andover_log_record                             = new HandoverLogBook;
                    $andover_log_record->log_book_id                = $data['log_id'];
                    $andover_log_record->assigned_staff_user_id     = $data['staff_user_id'];
                    $andover_log_record->service_user_id            = $data['servc_use_id'];
                    $andover_log_record->user_id                    = Auth::user()->id;
                    $andover_log_record->home_id                    = $login_home_id;
                    $andover_log_record->title                      = $log_book_info->title;
                    $andover_log_record->details                    = !empty($log_book_info->details)? $log_book_info->details : '';
                    $andover_log_record->date                       = !empty($log_book_info->date)? $log_book_info->date : '';
                    //$su_log_record->category_id     = $data['category_id'];

                    // echo "<pre>"; print_r($su_log_yp); die;
                    if($andover_log_record->save())  {
                        $response = 1;
                        //$result['response'] = '1';
                    }   else   {
                        $response = 0;
                       //$result['response'] = '0';
                    }
                } else{
                    $response = 'already';
                   //$result['response'] = 'already_su_log_book';
                }
            }else{
                $response = 0;
               
            }
            
            echo $response; die;
        } 
        //return $result;
    }

     public function view($log_book_id = null) {

        $home_ids = Auth::user()->home_id;
        $searchString = ',';
            //$homde_id = 1,2
        if(strpos(@$home_ids, $searchString) !== false ) {
            $home_id =  explode(',', @$home_ids);
            $login_home_id = @$home_id[0];
        }else{
            $login_home_id = @$home_ids;
        }
        // $home_id = Auth::user()->home_id;
        //'su_lb.category_id', 'su_lb_ctgry.category_name'
        $su_log_book_record = LogBook::select('log_book.*', 'su_lb.service_user_id', 'su_lb.log_book_id','su_lb.user_id','u.name as staff_name')
                                        ->where('log_book.home_id', $login_home_id)
                                        // ->where('su_lb.service_user_id', $service_user_id)
                                        ->join('su_log_book as su_lb', 'su_lb.log_book_id', 'log_book.id')
                                        ->join('user as u','u.id','su_lb.user_id')
                                        //->join('su_log_book_category as su_lb_ctgry', 'su_lb_ctgry.id', 'su_lb.category_id')
                                        ->where('log_book.id', $log_book_id)
                                        ->first();
        // echo "<pre>"; print_r($su_log_book_record); die;
        if(!empty($su_log_book_record)) {

            $result['response'] = true;
            //$result['category_id'] = $su_log_book_record->category_id;
            $result['title']        = $su_log_book_record->title;
            $result['details']      = $su_log_book_record->details;
            $result['date']         = $su_log_book_record->date;
            $result['staff_name']   = $su_log_book_record->staff_name;
            
        }  
        else {
            $result['response'] = false;
        }

        return $result;
    }
}
