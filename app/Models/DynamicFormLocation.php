<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DynamicFormLocation extends Model 
{
    protected $table = 'dynamic_form_location';  

    public static function getLocationIdByTag($tag = null){
 		$location_id = DynamicFormLocation::where('tag',$tag)->value('id');   	
 		return $location_id;
    }
}