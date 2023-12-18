<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use ServiceUserSocialApp;
class SocialApp extends Model
{
    protected $table = 'social_app';

    public function value() {
    	return $this->hasOne('App\ServiceUserSocialApp','id','social_app_id');
    }
} 