<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarningSchemeLabel extends Model
{
    protected $table = 'earning_scheme_label';   

	    public function label_records(){

	  		return $this->hasMany('App\EarningSchemeLabelRecord','earning_scheme_label_id','id')->where('deleted_at',null);
	    } 
}
