<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUserMigration, App\Home, App\ServiceUser, App\Admin;  
use DB; 
//use Illuminate\Support\Facades\Mail;

class MigrationController extends Controller
{
    public function index(Request $request, $service_user_id = null){
        
        /*$migrations = ServiceUserMigration::select('su_migration.*','su.name as su_name','ph.title as pre_home_name','nh.title as new_home_name','pa.company as pre_company','na.company as new_company')
                            ->where('service_user_id',$service_user_id)
                            ->join('service_user as su','su.id','=','su_migration.service_user_id')
                            ->join('home as ph','ph.id','=','su_migration.previous_home_id')
                            ->join('home as nh','nh.id','=','su_migration.new_home_id')
                            ->join('admin as na','na.id','=','nh.admin_id')
                            ->join('admin as pa','pa.id','=','ph.admin_id')
                            ->get()->toArray();*/

        $migrations_query = ServiceUserMigration::select('su_migration.*','su.name as su_name','ph.title as pre_home_name','nh.title as new_home_name','pa.company as pre_company','na.company as new_company')
                            ->where('service_user_id',$service_user_id)
                            ->join('service_user as su','su.id','=','su_migration.service_user_id')
                            ->join('home as ph','ph.id','=','su_migration.previous_home_id')
                            ->join('home as nh','nh.id','=','su_migration.new_home_id')
                            ->join('admin as na','na.id','=','nh.admin_id')
                            ->join('admin as pa','pa.id','=','ph.admin_id');

        $search = '';
        
        if(isset($request->limit)) {

            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else {

            if(Session::has('page_record_limit')) {

                $limit = Session::get('page_record_limit');
            } 
            else {
                $limit = 25;
            }
        }
        if(isset($request->search)) {
            $search           = trim($request->search);
            $migrations_query = $migrations_query->where('su.name','like','%'.$search.'%');
        }

        $migrations = $migrations_query->orderBy('su_migration.id','desc')->paginate($limit);

        $page = 'su_migration_form';
        //echo '<pre>'; print_r($migrations); die;
        return view('backEnd.serviceUser.migration.migrations', compact('page','migrations','service_user_id','limit'));
    }

    public function show_form(Request $request, $service_user_id = null){

        $admin = Session::get('scitsAdminSession');
        
        $home_name = Home::where('id',$admin->home_id)->value('title');
    
        $companies = Admin::select('id','company')
                            ->where('access_type','O')           //not super admin
                            ->where('is_deleted','0')           //not deleted
                            //->where('id','!=',$admin->home_id) //don't show current home
                            ->orderBy('company','asc')
                            ->get()
                            ->toArray();
        //echo '<pre>'; print_r($companies); die;
        
        $pre_company_name = ServiceUser::
                                // select('id','name')
                                join('home as h','h.id','service_user.home_id')
                                ->join('admin as a','a.id','h.admin_id')
                                ->where('service_user.id',$service_user_id)
                                ->value('company');
        
        $page = 'su_migration_form';

        return view('backEnd.serviceUser.migration.migration_form', compact('page','home_name','service_user_id','companies','pre_company_name'));
    }

    public function save_request(Request $request){
        $data = $request->input();
        //echo '<pre>'; print_r($data); die;
        $service_user_id = $data['service_user_id']; 
        $su_home_id = ServiceUser::where('id',$data['service_user_id'])->value('home_id');

        //check if the service user has already any request sent for migration
        $already_request = ServiceUserMigration::where('service_user_id',$data['service_user_id'])->orderBy('id','desc')->first();
        //echo '<pre>'; print_r($already_request); die;

        if(!empty($already_request)){
            $status = $already_request->status;
            if($status == 'P'){
                return redirect('/admin/service-users/migrations/'.$service_user_id)->with('error','Migration request already sent.');
            } else if($status == 'A'){

                if($su_home_id == $data['new_home_id']){ //if user is currenlty on same home
                    return redirect('/admin/service-users/migrations/'.$service_user_id)->with('error','Migration request already accepted.');
                }
            }      
        }

        /*
        A new request can only be created, if its already exist, and status of already existing request is canceled by admin itself or by super admin.
        
        All possible cases in detail
            if it is already requested then no new entry        0 P = pending
            if it is cancel by admin itself then add entry      1 C = canceled by admin
            if it is accepted by super admin then no entry      2 A = accepted by super admin
            if it is rejected by super admin then add entry     3 R = rejected by super admin
        */

        $migration                    = new ServiceUserMigration;
        $migration->service_user_id   = $data['service_user_id'];
        $migration->previous_home_id  = $su_home_id;
        $migration->new_home_id       = $data['new_home_id'];
        $migration->reason            = $data['reason'];
        $migration->status            = 'P';

        if($migration->save()){
            return redirect('/admin/service-users/migrations/'.$service_user_id)->with('success','Migration request sent successfully.');
        } else{
            return redirect()->back()->with('error',COMMON_ERROR);
        }
    }

    public function view($migration_id = null){

        $migration = ServiceUserMigration::select('su_migration.*','su.name as su_name','ph.title as pre_home_name','nh.title as new_home_name','pa.company as pre_company','na.company as new_company')
                    ->where('su_migration.id',$migration_id)
                    ->join('service_user as su','su.id','=','su_migration.service_user_id')
                    ->join('home as ph','ph.id','=','su_migration.previous_home_id')
                    ->join('home as nh','nh.id','=','su_migration.new_home_id')
                    ->join('admin as na','na.id','=','nh.admin_id')
                    ->join('admin as pa','pa.id','=','ph.admin_id')
                    ->first();
        $migration = json_decode(json_encode($migration),false);

        //echo '<pre>'; print_r($migration); die;

        /*$migration = ServiceUserMigration::select('su_migration.*','h.title as new_home_name','su.name as su_name','hp.title as pre_home_name')
                    ->where('su_migration.id',$migration_id)
                    ->join('home as h','h.id','=','su_migration.new_home_id')
                    ->join('home as h','h.id','=','su_migration.new_home_id')
                    ->join('service_user as su','su.id','=','su_migration.service_user_id')
                    ->join('home as hp','hp.id','=','su_migration.previous_home_id')
                    ->first();*/

        $service_user_id = $migration->service_user_id;
        //echo '<pre>'; print_r($new_homes); die;

        $page = 'su_migration_form';

        return view('backEnd.serviceUser.migration.migration_form', compact('page','service_user_id','migration'));
    }  

    public function cancel_request($migration_id = null){

        $migration = ServiceUserMigration::where('id',$migration_id)->first();
        if(!empty($migration)){

            //checking home id of admin to make sure that admin can only cancel its own home's yp's migration requests.
            $service_user_id = $migration->service_user_id;
            $home_id = Session::get('scitsAdminSession')->home_id;
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            
            if($home_id != $su_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }

            $migration->status = 'C';
            if($migration->save()){
                return redirect('/admin/service-users/migrations/'.$service_user_id)->with('success','Migration request cancelled successfully.');
            } else{
                return redirect()->back()->with('error',COMMON_ERROR);
            }

        }
    } 

    public function get_homes(Request $request, $admin_id=null)
    {  
        $current_home_id = Session::get('scitsAdminSession')->home_id;
        $homes = Home::select('id','title')
                        //->where('id','!=',$current_home_id)
                        ->where('admin_id',$admin_id)
                        ->where('is_deleted','0')
                        ->get()
                        ->toArray();

        if(!empty($homes)){
            foreach($homes as $home)   {
                $disabled = ($home['id'] == $current_home_id) ? 'disabled' : '';
                echo '<option value="'.$home['id'].'"  '.$disabled.' >'.ucfirst($home['title']).'</option>';
            }    
        } else {
            echo '';  
        }
        die;
    }
}