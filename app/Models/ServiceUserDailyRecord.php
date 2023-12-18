<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserDailyRecord extends Model
{
    protected $table = 'su_daily_record';
    
    public function daily_record()
    {
        return $this->hasOne('App\DailyRecord','id','daily_record_id');
    }
}