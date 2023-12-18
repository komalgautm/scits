<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarningSchemeLabelRecord extends Model
{
  protected $table = 'earning_scheme_label_records';   

	public function records_of_living_skill(){

		return $this->hasMany('App\ServiceUserLivingSkill','living_skill_id','id')
					->where('su_living_skill.is_deleted','0')
					->orderBy('su_living_skill.created_at','desc')
					->orderBy('su_living_skill.id','desc');
	}

    public function records_of_general_behaviour(){

  		return $this->hasMany('App\ServiceUserDailyRecord','daily_record_id','id')
  					->where('su_daily_record.is_deleted','0')
					->orderBy('su_daily_record.created_at','desc')
					->orderBy('su_daily_record.id','desc');
    }

    public function records_of_education(){

  		return $this->hasMany('App\ServiceUserEducationRecord','education_record_id','id')
  					->where('su_education_record.is_deleted','0')
					->orderBy('su_education_record.created_at','desc')
					->orderBy('su_education_record.id','desc');
    }
}
