<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserEducationRecord extends Model
{
    protected $table = 'su_education_record';
    
    public function education_record()
    {
        return $this->hasOne('App\EducationRecord','id','education_record_id');
    }
}