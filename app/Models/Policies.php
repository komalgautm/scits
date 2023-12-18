<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
	protected $table = "polices";

	/*public function accept_policy(){
		return $this->hasOne('App\UserAcceptedPolicy','policy_id','id');
	}*/
}