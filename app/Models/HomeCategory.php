<?php 
namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class HomeCategory extends Model
{
	protected $table = 'home_category';

	//////////// Testing Purpose Function() //////////

	public static function getCategorys($home_id = null){
		
		//$categorys_info = Category::select('id','name','icon','tag')->get()->toArray();
		$categorys_info = Category::select('category.id','name','icon','tag','ffi.icon_code', 'color')
                    		->leftJoin('fa_fa_icon as ffi','ffi.icon_class','like','category.icon')
                    		->get()
                    		->toArray();
        // echo '<pre>'; print_r($categorys_info); die;
		$categorys = array();
		
		foreach($categorys_info as $value){
			
            // echo '<pre>'; print_r($value['id']);  
			$home_category = HomeCategory::select('home_category.id','home_category.name','home_category.icon')
			                        ->leftJoin('fa_fa_icon as ffi','ffi.icon_class','=','home_category.icon')
			                        ->where('home_category.home_id',$home_id)
			                        ->where('home_category.category_id',$value['id'])->first();
            // echo '<pre>'; print_r($home_category);  
			/*For Tile Name*/
			if(!empty($home_category['name'])) {

				$value['category'] = $home_category['name'];
				// $value['icon']  = $home_category['icon'];
			} else {

				$value['category'] = $value['name'];
				// $value['icon']  = $value['icon'];
			}

			/*For Tile Icon*/
			if(!empty($home_category['icon'])) {

				$value['icon']      = $home_category['icon'];
				$value['icon_code'] = !empty($home_category['icon_code'])? $home_category['icon_code'] : '';
				
				// $value['icon']  = $home_category['icon'];
			} else {

				$value['icon']      = $value['icon'];
				$value['icon_code'] = !empty($value['icon_code'])? $value['icon_code'] : '';
				// $value['icon']  = $value['icon'];
			}

			$categorys[$value['tag']]['category'] = $value['category'];
			$categorys[$value['tag']]['icon']  = $value['icon'];
			$categorys[$value['tag']]['icon_code']  = !empty($value['icon_code'])? $value['icon_code'] : '';
		} //die;
		return $categorys;
	}

/*	public static function getCategorysName($home_id = null){
		
		$categorys_info = Category::select('id','name','tag')->get()->toArray();
		$categorys = array();
		
		foreach($categorys_info as $value){

			$category_name = HomeCategory::where('home_id',$home_id)->where('category_id',$value['id'])->value('name');

			if(!empty($category_name)) {
				$value['category'] = $category_name;
			} else{
				$value['category'] = $value['name'];
			}

			$categorys[$value['tag']] = $value['category'];
		}
		return $categorys;
	}*/

	/*public static function getCategorys($home_id = null){
		
		$categorys_info = Category::select('id','name','tag')->get()->toArray();
		$categorys = array();
		
		foreach($categorys_info as $value){

			$category_name = HomeCategory::where('home_id',$home_id)->where('category_id',$value['id'])->value('name');

			if(!empty($category_name)) {
				$value['category'] = $category_name;
			} else{
				$value['category'] = $value['name'];
			}

			$categorys[$value['tag']] = $value['category'];
		}
		return $categorys;
	}*/
	
	///////////************* Mohit Sir function()******************/////////////
	/*public static function getCategorys($home_id = null){
		
		$categorys_info = Category::select('id','name','tag')->get()->toArray();
		$categorys = array();
		
		foreach($categorys_info as $value){

			$home_category = HomeCategory::select('id','name')->where('home_id',$home_id)->where('category_id',$value['id'])->first();


			if(!empty($home_category)) {

				$value['category'] = $home_category['name'];
				$value['icon']  = $home_category['icon'];
			} else{

				$value['category'] = $value['name'];
				$value['icon']  = $value['icon'];
			}

			$categorys[$value['tag']]['category'] = $value['category'];
			$categorys[$value['tag']]['icon']  = $value['icon'];
		}

		return $categorys;
	}*/

	

	public static function getCategorybyTag($category_tag = null) {

		$categorys_info = Category::select('id','name','tag')->where('tag',$category_tag)->first();

		if(!empty($categorys_info)) {

			$category_name = HomeCategory::where('home_id', Auth::user()->home_id)->where('category_id',$categorys_info->id)->value('name');

			//set by default value of category if it is not yet set by admin for that home. i.e. if no entry found for this in table.
			if(empty($category_name)) {
				$category_name = $categorys_info->name;
			}

			return $category_name;
		}
	}

	
}