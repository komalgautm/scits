<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\AccessRight;

class ManagementSection extends Model
{
    protected $table = 'management_section';

    public function moduleList(){
    	return $this->hasMany('App\AccessRight','management_section_id','id')->where('main_page','1')->where('disabled',0);
    }

}