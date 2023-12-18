<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserLivingSkill extends Model
{
    protected $table = 'su_living_skill';

    public function living_skill()
    {
        return $this->hasOne('App\LivingSkill','id','living_skill_id');
    }
    
}