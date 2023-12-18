<?php 
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\ServiceUserExternalService, App\User;
use DB; 

class ExternalServiceController extends Controller
{
    public function index(Request $request, $service_user_id) {

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        if(!empty($home_id)) {

            $su_ext_service_query = DB::table('su_external_service')
                                            ->where('service_user_id', $service_user_id)
                                            ->where('is_deleted', 0)
                                            ->where('home_id',$home_id);
                                             
            $search = '';
            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {

                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 20;
                }
            }
            if(isset($request->search))
            {
                $search      = trim($request->search);
                $su_ext_service_query = $su_ext_service_query->where('company_name','like','%'.$search.'%');
            }

            /*if($limit == 'all') {
                $users = $users_query->get();
            } else{
                $users = $users_query->paginate($limit);
            }*/

            $su_ext_service = $su_ext_service_query->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $page = 'external-service';

       	return view('backEnd.serviceUser.externalService.external_service', compact('page','limit','su_ext_service','service_user_id','search')); 
    }

    public function add(Request $request, $service_user_id) {

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        if($request->isMethod('post')) {
            
            $data = $request->input();
            $su_home_id = DB::table('service_user')->where('id',$service_user_id)->value('home_id'); 
            if($home_id == $su_home_id)  {

                $su_ext_service = new ServiceUserExternalService;
                $su_ext_service->home_id            = $home_id;
                $su_ext_service->service_user_id    = $service_user_id;
                $su_ext_service->company_name       = $data['company_name'];
                $su_ext_service->contact_name       = $data['contact_name'];
                $su_ext_service->email              = $data['email'];
                $su_ext_service->phone_no           = $data['phone_no'];

                if($su_ext_service->save()) {

                    return redirect('admin/service-user/external-service/'.$service_user_id)->with('success', 'Service added successfully');
                }  else {
                    
                    return redirect()->back()->with('error', 'Some Error Occured while saving Service, Try Again later');
                }
            } else {

                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        $page = 'external-service';
        return view('backEnd.serviceUser.externalService.external_service_form', compact('page','service_user_id'));
    }
            
    public function edit(Request $request, $ext_service_id) {   
            
        if(!Session::has('scitsAdminSession')) {   
            return redirect('admin/login');
        }

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id; 

        $su_ext_service = ServiceUserExternalService::find($ext_service_id);
        if(!empty($su_ext_service)) {

            $service_user_id = $su_ext_service->service_user_id;
            if(!empty($service_user_id)) {

                $su_home_id = ServiceUser::where('is_deleted',0)->where('id', $service_user_id)->value('home_id');
                if(!empty($su_home_id)) {

                    if($su_home_id == $home_id) {

                        if($request->isMethod('post')) {

                            $data = $request->input();
                            
                            $su_ext_service->home_id         = $home_id;
                            $su_ext_service->service_user_id = $service_user_id;
                            $su_ext_service->company_name    = $data['company_name'];
                            $su_ext_service->contact_name    = $data['contact_name'];
                            $su_ext_service->email           = $data['email'];
                            $su_ext_service->phone_no        = $data['phone_no'];

                            if($su_ext_service->save()) {

                                return redirect('admin/service-user/external-service/'.$service_user_id)->with('success','Service updated successfully');
                            } else {
                                
                                return redirect()->back()->with('error', 'Some error occured while updating Service');
                            }
                        }
                        $su_ext_service = ServiceUserExternalService::where('is_deleted', 0)
                                                                    ->where('home_id', $home_id)
                                                                    ->where('id', $ext_service_id)
                                                                    ->first();
                        $page = 'external-service';
                        return view('backEnd.serviceUser.externalService.external_service_form',compact('page','su_ext_service','service_user_id'));

                    } else {
                        return  redirect('admin/')->with('error', UNAUTHORIZE_ERR);
                    }
                } else {
                    
                    return redirect()->back()->with('error', COMMON_ERROR);
                }
            } else {
                     
                return redirect()->back()->with('error', COMMON_ERROR);
            }  

        } else {
            return redirect()->back()->with('error', COMMON_ERROR);
        }
    }

    public function delete($ext_service_id) {   

        $admin = Session::get('scitsAdminSession');
        $home_id = $admin->home_id;

	    if(!empty($ext_service_id)) {
            $updated = ServiceUserExternalService::where('id', $ext_service_id)->where('home_id', $home_id)->update(['is_deleted' => '1']);

            if($updated) { 

                return redirect()->back()->with('success','Service deleted Successfully.'); 
            } else {
                
                return redirect()->back()->with('error', 'Some error occured while deleting Service'); 
            }
        } else {
            return redirect()->back()->with('error','Sorry, Service does not exist'); 
        }
    }
}