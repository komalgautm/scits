<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TCPDF;
use App\Models\ServiceUserReport;
use App\Models\ServiceUserCareTeam;
use App\Models\CareTeam;
use App\Models\ServiceUser;
use App\Models\ServiceUserLivingSkill;
use App\Models\DynamicForm;
use App\Models\DynamicFormBuilder;
use App\Models\ServiceUserEducationRecord;
use App\Models\ServiceUserDailyRecord;
use App\Models\ServiceUserHealthRecord;
use DB,Auth, Response;

class ReportController extends Controller
{
    public function index(Request $request){
// echo 1;die;
        // echo $pagination;
        $service_user_id = base64_decode($request->key);
        //Calender Events Added
        $data['totaleventsadded'] = DB::table('su_calendar_event')->where('service_user_id',$service_user_id)->where('is_deleted',0)->count();
        //pollice called
        $data['totalpolicecall'] = DB::table('log_book')
                            ->join('su_log_book','log_book.id','=','su_log_book.log_book_id')
                            ->where('su_log_book.service_user_id',$service_user_id)
                            ->where('log_book.category_id','1')
                            ->count();
        //appointments
        $data['totalappointments'] = DB::table('log_book')
                            ->join('su_log_book','log_book.id','=','su_log_book.log_book_id')
                            ->where('su_log_book.service_user_id',$service_user_id)
                            ->where('log_book.category_id','13')
                            ->count();
        //building left
        $data['missingserviceuser'] = DB::table('su_afc')->where('service_user_id',$service_user_id)->where('afc_status',0)->count();
        //current year month list
        $month = [];

        for ($m=1; $m<=12; $m++) {
            $month[] = date('m', mktime(0,0,0,$m, 1, date('Y')));
        }
        
        $currentyear = date('Y');
        $policecallpermonth=array();
        foreach($month as $mpvalue){
            $totalpolicecallmonth = DB::table('log_book')
                            ->join('su_log_book','log_book.id','=','su_log_book.log_book_id')
                            ->where('su_log_book.service_user_id',$service_user_id)
                            ->where('log_book.category_id','13')
                            ->whereMonth('log_book.created_at',$mpvalue)
                            ->whereYear('log_book.created_at',$currentyear)
                            ->count();
            array_push($policecallpermonth,$totalpolicecallmonth);
        }
        //print_r(implode(",",$policecallpermonth));
        //die;
        $data['policecallpermonths'] = implode(",",$policecallpermonth);
        //appointments
        $appointmentpermonth=array();
        foreach($month as $mpvalues){
            $totalappointmentmonth = DB::table('log_book')
                            ->join('su_log_book','log_book.id','=','su_log_book.log_book_id')
                            ->where('su_log_book.service_user_id',$service_user_id)
                            ->where('log_book.category_id','1')
                            ->whereMonth('log_book.created_at',$mpvalues)
                            ->whereYear('log_book.created_at',$currentyear)
                            ->count();
            array_push($appointmentpermonth,$totalappointmentmonth);
        }
        //print_r(implode(",",$policecallpermonth));
        //die;
        $data['appointmentpermonths'] = implode(",",$appointmentpermonth);
        $data['service_user_id']=$service_user_id;
        return view('frontEnd.serviceUserManagement.report',$data);
    }
}
