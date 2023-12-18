<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\ManagementSection;
class AccessRight extends Model
{
    protected $table = 'access_right';

    public static function accessRightList(){

    	//getting management headings and module headings
        //$access_rights = ManagementSection::with('moduleList')->has('moduleList')->get()->toArray();
       $access_rights = ManagementSection::with('moduleList')->get()->toArray();
        //get modules heading
        foreach($access_rights as $key1 => $value){

            foreach($value['module_list'] as $key2 => $module){
            
                $sub_modules_rights = AccessRight::where('module_code',$module['module_code'])
                                    ->where('main_route_id',0)
                                    ->orderBy('submodule_name','asc')
                                    ->get()
                                    ->toArray();
                $access_rights[$key1]['module_list'][$key2]['sub_modules'] = $sub_modules_rights;
            }
        }
       	
       	return $access_rights;
	  	//echo '<pre>'; print_r($access_rights); die;
    } 

    public static function dashboardAccessRightList(){

        $dashboard_rights = AccessRight::where('module_code','DASH')
                        ->where('main_route_id','0')
                        ->orderBy('module_name','asc')
                        ->get()
                        ->toArray();
        //echo '<pre>'; print_r($dashboard_rights); die;
        return $dashboard_rights;
    } 

    public static function getAccessRightString($data = array()){
        
        $access_str = '';    
        if(isset($data['access_id'])){

            foreach($data['access_id'] as $value){
                
                //getting the related routes of the main route
                $more_routes = AccessRight::select('id')->where('main_route_id',$value)->get()->toArray();

                if(!empty($more_routes)){
                    $more_routes = array_map(function($right){ return $right['id']; },$more_routes);
                    $more_routes_str = implode(',',$more_routes);

                    if(empty($access_str)){
                        $access_str = $value.','.$more_routes_str;
                    } else{
                        $access_str .= ','.$value.','.$more_routes_str;
                    }

                } else{

                    if(empty($access_str)){
                        $access_str = $value;
                    } else{
                        $access_str .= ','.$value;                            
                    }
                }
            }

            $access_arr = explode(',',$access_str);
            sort($access_arr);
            $access_str = implode(',',$access_arr);

        }
        return $access_str;
    }

}