<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ServiceUserCareHistoryFile extends Model {
    
    protected $table = 'su_care_history_file';
    
    public static function  su_history_files($su_care_history_id = null) {

    	$files = ServiceUserCareHistoryFile::select('id','file')
    										->where('su_care_history_id', $su_care_history_id)
    										->get()
    										->toArray();
    	// if(empty($files)) {
    	// 	$files = '';
    	// }
    	return json_encode($files);
    	// $file_name[] = '';
    	// foreach ($files as $key => $file) {
    	// 	$file_name[] = $file['file'];  
    	// }
    	// // echo "<pre>"; print_r($file_name); die;
    	// return $file_name;
    	// echo "<pre>"; print_r($files); die;
    }

}