<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserEarningTarget extends Model
{
    protected $table = 'su_earning_target';

    public static function getEarningTarget($service_user_id = null){
        
        $su_earn_target = ServiceUserEarningTarget::where('service_user_id',$service_user_id)->orderBy('id','desc')->value('target');
        
        if(empty($su_earn_target)){
            //if no target is still set for yp then use default value 
            $su_earn_target = DEFAULT_SU_EARN_TARGET;
        }

        return $su_earn_target; 
    }
}