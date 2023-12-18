<?php

namespace App;
use DB, Auth;
use Illuminate\Database\Eloquent\Model;

class WeeklyAllowance extends Model
{
    protected $table = 'weekly_allowance';

    public static function getAllowanceInfo($service_user_id = null) {

    	$home_id = Auth::user()->home_id;
    	$weekly_allowance = WeeklyAllowance::select('weekly_allowance.amount','weekly_allowance.status')
    							->join('service_user as su','su.id','=','weekly_allowance.service_user_id')
                                ->where('su.home_id','=',$home_id)
                                ->where('weekly_allowance.service_user_id','=',$service_user_id)
                                ->first();
		
		if(!empty($weekly_allowance)){
			$weekly_allowance = $weekly_allowance->toArray();
		} else{
			$weekly_allowance['amount'] = '0';
			$weekly_allowance['status'] = 'D';
		}                       
        return $weekly_allowance;
    }
    

}