<?php 
namespace App;
use Auth, Session;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';

	public function renamed(){
	
		$home_id = Session::get('scitsAdminSession')->home_id;
		return $this->hasOne('App\HomeCategory','category_id','id')->where('home_id',$home_id);
	}
	
}