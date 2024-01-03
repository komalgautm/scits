<?php 
namespace App\Models;
use Auth, Session;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
	protected $table = 'label';

	public function renamed(){
	
		$home_id = Session::get('scitsAdminSession')->home_id;
		return $this->hasOne('App\Models\HomeLabel','label_id','id')->where('home_id',$home_id);
	}
	
}