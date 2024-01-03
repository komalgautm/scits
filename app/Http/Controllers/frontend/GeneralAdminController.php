<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth;
use App\Models\ServiceUser;
use App\Models\User;
use App\Models\HomeLabel;
use App\Models\Home;

class GeneralAdminController extends Controller
{
    public function index()
    {
        //$labels = HomeLabel::getLabels();
        $home_id = Auth::user()->home_id;
        // $users = User::select('id','name')->where('home_id',$home_id)->where('is_deleted','0')->get()->toArray();
        $data['users'] = User::select('id','name')->where('home_id',$home_id)->where('is_deleted','0')->get();
        // $service_users = ServiceUser::select('id','name','image')->where('home_id',$home_id)->where('is_deleted','0')->get()->toArray();
        $data['service_users'] = ServiceUser::select('id','name','image')->where('home_id',$home_id)->where('is_deleted','0')->get();
        $data['guide_tag'] = 'general_admin';
      
        $data['home'] = Home::where('id',Auth::user()->home_id)->select('weekly_allowance')->first();
        
        return view('frontEnd.generalAdmin.index',$data);
    }
}
