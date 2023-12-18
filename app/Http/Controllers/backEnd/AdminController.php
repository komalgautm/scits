<?php
namespace App\Http\Controllers\backEnd;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use DB,Auth; 
use App\Models\Admin, App\Models\Home, App\Models\User, App\Models\ServiceUser, App\Models\AccessLevel, App\Models\SupportTicket, App\Models\Notification;
use App\Models\ModifyRequest,App\Models\ServiceUserMFC,App\Models\StaffTraining,App\Models\ServiceUserRisk,App\Models\ServiceUserCalendarEvent;
use App\Models\PettyCash,App\Models\ServiceUserPlacementPlan,App\Models\ServiceUserCareCenter,App\Models\ServiceUserNeedAssistance,App\Models\OfficeMessage;
use App\Models\CompanyCharges,App\Models\CompanyPayment, App\Models\States;

class AdminController extends Controller
{
	public function login(Request $request)
	{
		if($request->isMethod('post')) 
		{
			$data = $request->input();
			$company_name = $data['company_name'];

			if($company_name == 'scits super admin')  {

				$admin = Admin::select('admin.*')
								->where('user_name',$data['username'])
								->where('password',md5($data['password']))
								->where('access_type','S')
								->where('is_deleted','0')
								->first();
				
				if(!empty($admin))	{	
					$admin->home_id = 0;	
					Session::put('scitsAdminSession', $admin); 
					return redirect('admin/welcome');
				} else {	
					return redirect()->back()->with('error', 'Credentials does not match, please check and try again.');
				}
			}else{
 
				$admin = Admin::select('admin.*')
									->where('user_name',$data['username'])
									->where('password',md5($data['password']))
									->where('is_deleted','0')
									->first();
				//Agent login 19 sep------------------------------------------------		
				$agent_info 	= User::select('id','name','home_id','admn_id','user_type','image','login_date','login_home_id')
									->where('user_name',$data['username'])
									->where('is_deleted','0')
									->first();

				$user_type  = (isset($agent_info->user_type) ? $agent_info->user_type : '');

				if($user_type == 'A'){
					$admin = Admin::select('admin.*')
									->where('id',$agent_info->admn_id)
									->where('is_deleted','0')
									->first();	
					$admin_id           = $admin->id;
					$admin_user_name    = $admin->user_name;				
					$admin_company_name = $admin->company;				
				}
				// Agent login 19 sep end-------------------------------------------------------

				if(!empty($admin)){

					$access_type = $admin->access_type;

					if($access_type == 'O'){ //owner

						$admin = Admin::select('admin.*','home.id as home_id')
											->join('home','home.admin_id','admin.id')
											->where('user_name',$request->username)
											->where('password',md5($data['password']))
											->where('company',$request->company_name)
											->where('home.title',$request->home)
											->where('admin.is_deleted','0')
											->first();

						//**********Agent Login 20 Sept 2018****************************//
						if($user_type == 'A'){ 

							$admin = Admin::select('admin.*','home.id as home_id')
											->join('home','home.admin_id','admin.id')
											->where('user_name',$admin_user_name)
											->where('company',$admin_company_name)
											->where('admin.id',$admin_id)
											->where('admin.is_deleted','0')
											->first();		
						}
					 	//**********Agent Login 20 Sept 2018****************************//

					} else if($access_type == 'A'){ //normal admin i.e. home admin
					
						$admin = Admin::select('admin.*')
											->join('home','home.id','admin.home_id')
											->where('user_name',$data['username'])
											->where('password',md5($data['password']))
											->where('admin.is_deleted','0')
											->where('home.title',$request->home)							
											->first();
    			    }	else{
						$admin = array();						
					}			
				}
				if(!empty($admin)) {
					
					//if admin is of type super admin or owner then do not need to select home because there will be a welcome page.
					//but if user is of admin i.e. homeadmin then set home id and not show welcome page.
					//Home id will be equal to  
					
					Session::put('scitsAdminSession', $admin); 
					Session::put('scitsAgentSession', $agent_info);
					if($access_type == 'O'){ //owner
						return redirect('admin/welcome');
					} else if($access_type == 'A'){
						return redirect('admin/dashboard');
					}

					return redirect('admin/dashboard'); 
				}else{

					return redirect()->back()->with('error', 'Credentials does not match, please check it and try again.');
					//username & password combination is incorrect
				}
			}
		}
		
		if(Session::has('scitsAdminSession'))
	    {  
            return redirect('/admin');
        }
		return view('backEnd.login');
	}

	public function logout(){
		if(!Session::has('scitsAdminSession'))
	    {  
            return redirect('admin/login');
        }
	    Session::forget('scitsAdminSession');
	    if(Session::has('scitsAgentSession')){
		    Session::forget('scitsAgentSession');
	    }
        return redirect('admin/login')->with('flash_message_success', 'Logged out successfully.');    
    }

    public function dashboard(Request $request)
    {	
       	$page = 'dashboard';  
      	$home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
       		return redirect('admin/welcome')->with('error',NO_HOME_ERR);
        }

       	//count records
		$staff_count   = User::where('is_deleted','0')->where('home_id', $home_id)->count();
		$yp_count      = ServiceUser::where('home_id', $home_id)->where('is_deleted','0')->count();
		$acs_lvl_count = AccessLevel::where('home_id', $home_id)->where('is_deleted','0')->count();
		$ticket_count  = SupportTicket::where('home_id', $home_id)->where('is_deleted','0')->count(); 
		$selected_month = $request->select_month;
			if (isset($selected_month)) {

				$current_date   = date('Y-m-d');
				$previous_date  = date('Y-m-d', strtotime("-$selected_month days"));
			} else {
				$current_date   = date('Y-m-d');
				$previous_date  = '';
			}	
			$m_f_c_count   = ServiceUserMFC::where('home_id',$home_id)
			                               ->where('is_deleted','0')
			                               ->whereBetween('created_at',[$previous_date, $current_date])
			                               ->count();

			$staff_training_count = StaffTraining::select('staff_training.status')
												->where('t.home_id',$home_id)
												->where('t.is_deleted','0')
												->whereBetween('t.created_at',[$previous_date, $current_date])
												->join('training as t','t.id','staff_training.training_id')
												->count();

			$no_risk          = ServiceUserRisk::where('home_id',$home_id)
							                    ->where('status','0')
							                    ->whereBetween('created_at',[$previous_date, $current_date])
							                    ->count();

			$historic_risk    = ServiceUserRisk::where('home_id',$home_id)
							                    ->where('status','1')
							                    ->whereBetween('created_at',[$previous_date, $current_date])
							                    ->count();

			$live_risk        = ServiceUserRisk::where('home_id',$home_id)
							                    ->where('status','2')
							                    ->whereBetween('created_at',[$previous_date, $current_date])
							                    ->count();
		
			$calender      	  = ServiceUserCalendarEvent::where('home_id', $home_id)
													->whereBetween('created_at',[$previous_date, $current_date])
													->count();

			$petty_cash       = PettyCash::where('home_id',$home_id)
										->where('txn_type','W')
										->whereBetween('created_at',[$previous_date, $current_date])
										->sum('txn_amount');

			$completed_task   = ServiceUserPlacementPlan::where('home_id',$home_id)
														->where('status','1')
														->whereBetween('created_at',[$previous_date, $current_date])
														->count();

			$su_in_danger = ServiceUserCareCenter::join('service_user as su','su.id','su_care_center.service_user_id')
												->where('su.home_id', $home_id)
												->where('care_type','D')
												->whereBetween('su_care_center.created_at',[$previous_date, $current_date])
												->count();

    		$su_req_cb    = ServiceUserCareCenter::join('service_user as su','su.id','su_care_center.service_user_id')
												->where('su.home_id', $home_id)
												->where('care_type','R')
												->whereBetween('su_care_center.created_at',[$previous_date, $current_date])
												->count();

			$need_assitance = ServiceUserNeedAssistance::where('home_id', $home_id)
													->whereBetween('created_at',[$previous_date, $current_date])
			                                        ->count();		

			$off_mesg       = OfficeMessage::where('home_id', $home_id)
			                                ->where('order','0')
			                                ->whereBetween('created_at',[$previous_date, $current_date])
			                                ->count();
		$count = array();
		$count['staff']  = $staff_count;
		$count['yp']     = $yp_count;
		$count['access'] = $acs_lvl_count;
		$count['ticket'] = $ticket_count;
		$count['MFC']    		 = $m_f_c_count;
		$count['staff_training'] = $staff_training_count;
		$count['no_risk']        = $no_risk;
		$count['historic_risk']  = $historic_risk;
		$count['live_risk']      = $live_risk;
		$count['calender'] 		 = $calender;
		$count['petty_cash'] 	 = $petty_cash;
		$count['completed_task'] = $completed_task;
		$count['danger']         = $su_in_danger;
		$count['request']        = $su_req_cb;
		$count['need_assistane'] = $need_assitance;
		$count['message']        = $off_mesg; 		

		//Notifications
		$start_date = date('Y-m-d', strtotime('-7 days'));
		$end_date   = date('Y-m-d');
	
		$notifications = Notification::getsuNotification('',$start_date,$end_date,'',$home_id);

		//Modification Request
		$request =  $modification_requests = ModifyRequest::select('modify_request.*','modify_request.id', 'user.id as user_id', 'user.name as admin_name')
                                                ->join('user', 'user.id', 'modify_request.user_id')
                                                ->where('modify_request.is_deleted','0')
                                                ->where('modify_request.home_id',$home_id)
                                                ->get()
                                                ->toArray();
        //Chose Package 
        $company_charges    = CompanyCharges::select('company_charges.*')
                                            ->get()->toArray();
        $selected_home_id 	= Session::get('scitsAdminSession')->home_id; 
        $system_admin_id 	= Home::where('id',$selected_home_id)->value('admin_id');

        $company_package    = CompanyPayment::select('company_payment.admin_id','company_payment.homes_added','company_payment.expiry_date','company_charges.home_range','company_charges.package_type','company_payment.free_trial_done','company_payment.status')
                                            ->join('company_charges','company_charges.id','company_payment.company_charges_id')
                                            ->where('company_payment.admin_id',$system_admin_id)
                                            ->first();
        $states = States::get()->toArray();

		
        $admin_id = DB::table('home')->where('id', $home_id)->value('admin_id');
        $image_id = DB::table('admin')->where('id', $admin_id)->value('image');
		Session::put('image_id', $image_id);
	    return view('backEnd.dashboard',compact('page','count','notifications','request','selected_month','company_charges','company_package','current_date','states')); //dashboard.blade.php
    }
}
