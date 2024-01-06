<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,DB;
use App\Models\HomeLabel;
use App\Models\ServiceUser;

class ServiceUserManagementController extends Controller
{
    public function service_users(Request $request)
    {
        $home_id  = Auth::user()->home_id;
        $data['patients'] = DB::table('service_user')->where('home_id',$home_id)->where('is_deleted','0')->get();
        // echo "<pre>";print_r($data['patients']);die;
        $data['labels']   = HomeLabel::getLabels($home_id);

        //living skill option
        $data['living_skill_options'] = DB::table('living_skill')
                                    ->where('home_id',$home_id)
                                    ->where('status','1')
                                    ->where('is_deleted','0')
                                    ->orderBy('id','desc')
                                    ->get();

        $data['education_record_options'] = DB::table('education_record')
                                    ->select('id','description')
                                    ->where('home_id', $home_id)
                                    ->where('status','1')
                                    ->where('is_deleted','0')
                                    ->orderBy('id','desc')
                                    ->get();
        $data['mfc_options'] = DB::table('mfc')
                        ->select('id','description')
                        ->where('home_id', $home_id)
                        ->where('status','1')
                        ->where('is_deleted','0')
                        ->orderBy('id','desc')
                        ->get();
        
        $data['daily_score']   = DB::table('daily_record_score')->get();

        //service_users list for bmp-rmp
        $data['service_users'] = ServiceUser::select('id','name')
                            ->where('home_id',$home_id)
                            ->where('status','1')
                            ->where('is_deleted','0')
                            ->get();
        
                            $data['guide_tag'] = 'su_mngmt';
        return view('frontEnd.serviceUserManagement.index',$data);
    }
}
