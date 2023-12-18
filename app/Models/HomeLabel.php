<?php 
namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class HomeLabel extends Model
{
	protected $table = 'home_label';

	//////////// Testing Purpose Function() //////////

	public static function getLabels($home_id = null){
		
		//$labels_info = Label::select('id','name','icon','tag')->get()->toArray();
		$labels_info = Label::select('label.id','name','icon','tag','ffi.icon_code')
                    		->leftJoin('fa_fa_icon as ffi','ffi.icon_class','like','label.icon')
                    		->get()
                    		->toArray();
        // echo '<pre>'; print_r($labels_info); die;
		$labels = array();
		
		foreach($labels_info as $value){
			
            // echo '<pre>'; print_r($value['id']);  
			$home_label = HomeLabel::select('home_label.id','home_label.name','home_label.icon')
			                        ->leftJoin('fa_fa_icon as ffi','ffi.icon_class','=','home_label.icon')
			                        ->where('home_label.home_id',$home_id)
			                        ->where('home_label.label_id',$value['id'])->first();
            // echo '<pre>'; print_r($home_label);  
			/*For Tile Name*/
			if(!empty($home_label['name'])) {

				$value['label'] = $home_label['name'];
				// $value['icon']  = $home_label['icon'];
			} else {

				$value['label'] = $value['name'];
				// $value['icon']  = $value['icon'];
			}

			/*For Tile Icon*/
			if(!empty($home_label['icon'])) {

				$value['icon']      = $home_label['icon'];
				$value['icon_code'] = !empty($home_label['icon_code'])? $home_label['icon_code'] : '';
				
				// $value['icon']  = $home_label['icon'];
			} else {

				$value['icon']      = $value['icon'];
				$value['icon_code'] = !empty($value['icon_code'])? $value['icon_code'] : '';
				// $value['icon']  = $value['icon'];
			}

			$labels[$value['tag']]['label'] = $value['label'];
			$labels[$value['tag']]['icon']  = $value['icon'];
			$labels[$value['tag']]['icon_code']  = !empty($value['icon_code'])? $value['icon_code'] : '';
		} //die;
		return $labels;
	}

/*	public static function getLabelsName($home_id = null){
		
		$labels_info = Label::select('id','name','tag')->get()->toArray();
		$labels = array();
		
		foreach($labels_info as $value){

			$label_name = HomeLabel::where('home_id',$home_id)->where('label_id',$value['id'])->value('name');

			if(!empty($label_name)) {
				$value['label'] = $label_name;
			} else{
				$value['label'] = $value['name'];
			}

			$labels[$value['tag']] = $value['label'];
		}
		return $labels;
	}*/

	/*public static function getLabels($home_id = null){
		
		$labels_info = Label::select('id','name','tag')->get()->toArray();
		$labels = array();
		
		foreach($labels_info as $value){

			$label_name = HomeLabel::where('home_id',$home_id)->where('label_id',$value['id'])->value('name');

			if(!empty($label_name)) {
				$value['label'] = $label_name;
			} else{
				$value['label'] = $value['name'];
			}

			$labels[$value['tag']] = $value['label'];
		}
		return $labels;
	}*/
	
	///////////************* Mohit Sir function()******************/////////////
	/*public static function getLabels($home_id = null){
		
		$labels_info = Label::select('id','name','tag')->get()->toArray();
		$labels = array();
		
		foreach($labels_info as $value){

			$home_label = HomeLabel::select('id','name')->where('home_id',$home_id)->where('label_id',$value['id'])->first();


			if(!empty($home_label)) {

				$value['label'] = $home_label['name'];
				$value['icon']  = $home_label['icon'];
			} else{

				$value['label'] = $value['name'];
				$value['icon']  = $value['icon'];
			}

			$labels[$value['tag']]['label'] = $value['label'];
			$labels[$value['tag']]['icon']  = $value['icon'];
		}

		return $labels;
	}*/

	

	public static function getLabelbyTag($label_tag = null) {

		$labels_info = Label::select('id','name','tag')->where('tag',$label_tag)->first();

		if(!empty($labels_info)) {

			$label_name = HomeLabel::where('home_id', Auth::user()->home_id)->where('label_id',$labels_info->id)->value('name');

			//set by default value of label if it is not yet set by admin for that home. i.e. if no entry found for this in table.
			if(empty($label_name)) {
				$label_name = $labels_info->name;
			}

			return $label_name;
		}
	}

	
}