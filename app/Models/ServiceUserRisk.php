<?php

namespace App\Models;
use DB, Auth;
use Illuminate\Database\Eloquent\Model;

class ServiceUserRisk extends Model
{
    protected $table = 'su_risk';

    public static function stickyNotifications(){

    	//pending_risk_forms notifications
        $su_risks_notifiy = DB::table('su_risk')
		                        ->select('su_risk.id','su_risk.rmp_id','su_risk.incident_report_id',
		                            'risk.description as risk_name','su.name as service_user_name','su_risk.service_user_id')
		                        //->where('su_risk.service_user_id',$service_user_id)
		                        ->join('risk', 'su_risk.risk_id','=', 'risk.id')   
		                        ->join('service_user as su', 'su.id','=', 'su_risk.service_user_id')   
		                        ->where('su.home_id', Auth::user()->home_id)
		                        ->where('su.is_deleted', '0')
		                        // ->where('su.rmp_id', null)
		                        // ->where('su.incident_report_id', null)
		                        ->orderBy('su_risk.id','desc')
		                        ->get();

		//echo '<pre>'; print_r($su_risks_notifiy); die;
	    return $su_risks_notifiy;
    }

    public static function riskNotifCount($service_user_id = null){

    	//pending_risk_forms notifications
        $su_risks_notifiy = ServiceUserRisk::select('su_risk.id','su_risk.rmp_id','su_risk.incident_report_id','su_risk.status')
		                        ->where('su_risk.service_user_id',$service_user_id)
		                        ->join('risk', 'su_risk.risk_id','=', 'risk.id')   
		                        ->join('service_user as su', 'su.id','=', 'su_risk.service_user_id')   
		                        ->where('su.home_id', Auth::user()->home_id)
		                        ->where('su.is_deleted', '0')
								->where('su_risk.read_notify', '0')
		                        // ->where('su.rmp_id', null)
		                        // ->where('su.incident_report_id', null)
		                        // ->orderBy('su_risk.id','desc')
		                        //->count();
		                        /*->orWhere([
		                        		['su_risk.rmp_id', '=', null],
		                        		['su_risk.incident_report_id', '=', null],		                        		
		                        	])*/
		                        ->get()->toArray();
		$count = 0;
		foreach($su_risks_notifiy as $value){
			// echo "<pre>"; print_r($value); die;
			// if($value['status'] == '2'){
			// 	$count++;
			
			// }
			// if($count == '0' && $value['status'] == '1'){
			// 	$count++;
			// }
			if( (empty($value['rmp_id'])) || (empty($value['incident_report_id'])) ){
				$count++;
			}

		}
		// echo $count; die;
	    return $count;
    }

/*    public static function stickyNotifications($service_user_id = null){

    	//pending_risk_forms notifications
        $su_risks_notifiy = DB::table('su_risk')
		                        ->select('su_risk.id','su_risk.rmp_id','su_risk.incident_report_id',
		                            'risk.description as risk_name')
		                        ->where('su_risk.service_user_id',$service_user_id)
		                        ->join('risk', 'su_risk.risk_id','=', 'risk.id')                                            
		                        //->leftJoin('su_rmp', 'su_risk.id', '=', 'su_rmp.su_risk_id')
		                        //->leftJoin('su_incident_report', 'su_risk.id', '=', 'su_incident_report.su_risk_id')
		                        ->orderBy('su_risk.id','desc')
		                        ->get();
	    return $su_risks_notifiy;
    }*/

}