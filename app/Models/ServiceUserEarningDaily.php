<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserEarningDaily extends Model
{
    protected $table = 'su_earning_daily';

    public $timestamps = false;
}