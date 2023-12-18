<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRota extends Model
{
    protected $table = 'staff_rota';

    public static function timeFormat($time){
    	
    	if($time > 12){
    		$time 	= $time - 12;
    		$period = 'pm';
    	} else{
    		$period = 'am';
    	}

    	if( (strlen($time)) == 1) {
    		$time = '0'.$time;
    	}
    	$time = $time.$period;
    	return $time;
    }
}
