<?php
namespace App\Http\Controllers\backEnd\superAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUserMigration, App\Home, App\ServiceUser;  
use DB; 
//use Illuminate\Support\Facades\Mail;

class MigrationController extends Controller
{
    public function index(Request $request){
        
        $migrations_query = ServiceUserMigration::select('su_migration.*','h.title as new_home_name','su.name as su_name','hp.title as pre_home_name')
                    ->join('home as h','h.id','=','su_migration.new_home_id')
                    ->join('service_user as su','su.id','=','su_migration.service_user_id')
                    ->join('home as hp','hp.id','=','su_migration.previous_home_id');

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
        
        $page = 'supr_migrations';
        //echo '<pre>'; print_r($migrations); die;
        return view('backEnd.superAdmin.migration.migrations', compact('page','migrations','search','limit'));
    }

    public function view($migration_id = null){
        $migration = ServiceUserMigration::select('su_migration.*','su.name as su_name','ph.title as pre_home_name','nh.title as new_home_name','pa.company as pre_company','na.company as new_company')
                            ->join('service_user as su','su.id','=','su_migration.service_user_id')
                            ->join('home as ph','ph.id','=','su_migration.previous_home_id')
                            ->join('home as nh','nh.id','=','su_migration.new_home_id')
                            ->join('admin as na','na.id','=','nh.admin_id')
                            ->join('admin as pa','pa.id','=','ph.admin_id')
                            ->where('su_migration.id',$migration_id)
                            ->first();

        $page = 'supr_migrations';
     
        return view('backEnd.superAdmin.migration.migration_form', compact('page','migration'));
    }   

    public function update(Request $request){

        $super_admin = Session::get('scitsAdminSession')->access_type; 
        
        if($super_admin == 'S'){
        
            $data = $request->input();
            //echo '<pre>'; print_r($data); die;
            
            $migration = ServiceUserMigration::where('id',$data['migration_id'])->first();
            
            if(!empty($migration)){

                $new_home_id = $migration->new_home_id;
                $service_user_id = $migration->service_user_id;
                $new_status = $data['new_status'];

                //if status is accepted update the service user home id and then the migration request
                if($new_status == 'A'){

                    $service_user = ServiceUser::where('id',$service_user_id)->first();            
                    $service_user->Home_id = $new_home_id;

                    if($service_user->save()){
                        $migration->status = $new_status;
                        $migration->reply = $data['reply'];
                    
                        if($migration->save()){
                            $update = 'Y';
                        } else{
                            $update = 'N';
                        }
                    }

                } else{
                    $migration->status = $new_status;
                    $migration->reply = $data['reply'];

                    if($migration->save()){
                        $update = 'Y';
                    } else{
                        $update = 'N';
                    }
                }

                if($update == 'Y'){
                    return redirect('/super-admin/migrations')->with('success','Migration request updated successfully.');
                } else{
                    return redirect()->back()->with('error',COMMON_ERROR);            
                }
            }
        } else {
            return redirect('/super-admin/migrations')->with('error',COMMON_ERROR);
        }

    }

}