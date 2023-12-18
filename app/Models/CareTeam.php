<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class CareTeam extends Model
{
    protected $table = 'su_care_team';

    public function care_job_title()
    {
        return $this->hasOne('App\CareTeamJobTitle' , 'id','job_title_id');
    }

}