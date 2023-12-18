<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Models\Admin, App\Models\Home, App\Models\CompanyCharges, App\Models\CompanyPayment;
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function welcome(Request $request)
    {  
        $admin_id    = Session::get('scitsAdminSession')->id;
        $access_type = Session::get('scitsAdminSession')->access_type;
        
        if($access_type == 'A'){ //Home admin have only one home so he can not view welcome page
            return redirect()->back()->with('error',UNAUTHORIZE_ERR);
        }
        //echo '<pre>'; print_r(Session::get('scitsAdminSession')); die;

        if($request->isMethod('post')){
            
            $admin_info             = Session::get('scitsAdminSession');
            $admin_info->home_id    = $request->home;
            // $selected_home_id       = Session::get('scitsAdminSession')->home_id; 
            // $selected_company_id    = Home::where('id',$selected_home_id)->value('admin_id');
            // $admin_info->company_id = $selected_company_id;
            Session::put('scitsAdminSession', $admin_info); 
            return redirect('admin/dashboard');
        }

        $selected_home_id = Session::get('scitsAdminSession')->home_id; 
        $selected_company_id = Home::where('id',$selected_home_id)->value('admin_id');
        // $admin_info->company_id = $selected_company_id;
        //echo $selected_company_id; die;

        if($access_type == 'O'){ //if admin is owner of company (normal admin) 1.e. system admin
            
            //show only owner company 
            $companies = Admin::select('id', 'company')->where('access_type','O')->where('is_deleted','0')->where('id',$admin_id)->get()->toArray();
            //show homes of that company only 
            $homes     = Home::select('id','title')->where('admin_id',$admin_id)->where('is_deleted','0')->get()->toArray();


            //Chose Package 
            $company_charges    = CompanyCharges::select('company_charges.*')
                                                ->get()->toArray();
           

            $company_package    = CompanyPayment::select('company_payment.admin_id','company_payment.homes_added','company_payment.expiry_date','company_charges.home_range','company_charges.package_type','company_payment.free_trial_done','company_payment.status')
                                            ->join('company_charges','company_charges.id','company_payment.company_charges_id')
                                            ->where('company_payment.admin_id',$admin_id)
                                            ->first();
        }else{ //for super admin

            //show all companies
            $companies = Admin::select('id', 'company')->where('access_type','O')->where('is_deleted','0')->get()->toArray();

            if($selected_home_id == 0){ //initial super admin case when no home is selected
                $homes = array();
            } else{ //when home has been already selected
                $homes         = Home::select('id','title')->where('admin_id',$selected_company_id)
                                        ->where('is_deleted','0')->get()->toArray();
            }
            $company_charges    = CompanyCharges::select('company_charges.*')
                                                ->get()->toArray();
           

            $company_package    = CompanyPayment::select('company_payment.admin_id','company_payment.homes_added','company_payment.expiry_date','company_charges.home_range','company_charges.package_type','company_payment.free_trial_done','company_payment.status')
                                            ->join('company_charges','company_charges.id','company_payment.company_charges_id')
                                            ->where('company_payment.admin_id',$selected_company_id)
                                            ->first();
        }
        
        $page = 'welcome'; 
        return view('backEnd.welcome',compact('page','homes','companies','selected_home_id','selected_company_id','company_charges','company_package'));
    }

    public function get_homes(Request $request, $company_name=null)
    {   
        $admin_id = Admin::where('company','like',$company_name)->where('is_deleted','0')->value('id');
        $homes = Home::select('id','title')->where('admin_id',$admin_id)->where('is_deleted','0')->get()->toArray();
        // echo "<pre>"; print_r($homes); die;
        
        if(!empty($homes)) {
            foreach($homes as $home)   {
                echo '<option value="'.$home['title'].'">'.ucfirst($home['title']).'</option>';
            }    
        } else   {
            echo '';  
        }
        die;
    }

    public function welcome_get_homes($company_name=null)
    {  
        $admin_id = Admin::where('company','like',$company_name)->value('id');
        
        $homes = Home::select('id','title')->where('admin_id',$admin_id)->where('is_deleted','0')->get()->toArray();

        if(!empty($homes)){
            foreach($homes as $home)   {
                echo '<option value="'.$home['id'].'">'.ucfirst($home['title']).'</option>';
            }    
        } else {
            echo '';  
        }
        die;
    }
}

