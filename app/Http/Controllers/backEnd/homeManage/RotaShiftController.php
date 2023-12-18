<?php
namespace App\Http\Controllers\backEnd\homeManage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
// use App\ManagementSection, App\User, App\AccessRight, App\AccessLevel, App\AccessLevelRight;
use App\RotaShift, App\Home;  
// use App\RotaShiftType, App\RotaShiftTime;  
use DB; 

class RotaShiftController extends Controller
{
    public function index(Request $request) {

        $admin = Session::get('scitsAdminSession');
        // dd($admin);
        $home_id = $admin->home_id; 
        // echo $home_id; die;

        $rota_time_format = Home::where('id', $home_id)->value('rota_time_format');
        // echo $rota_time_format; die;

        if(!empty($home_id)) {

            // $rota_shifts = DB::table('rota_shift_type as rs_type')->select('rs_type.id','rs_type.name', 'rs_time.start_time','rs_time.home_id', 'rs_time.shift_type_id', 'rs_time.end_time')
            //                                                             ->join('rota_shift_time as rs_time', 'rs_time.shift_type_id', 'rs_type.id' )
            //                                                             ->where('rs_time.home_id', $home_id);
            // $rota_shifts = RotaShiftType::select('id as type_id','name','tag');
            $rota_shift_query = RotaShift::where('home_id', $home_id)
                                            ->where('is_deleted', 0)
                                            ->select('id','home_id','name','start_time','end_time');
                        
            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {

                if(Session::has('page_record_limit')) {
                    $limit = Session::get('page_record_limit');
                } else {
                    $limit = 20;
                }
            }
            if(isset($request->search))
            {
                $search      = trim($request->search);
                $rota_shift_query = $rota_shift_query->where('name','like','%'.$search.'%');
            }

            $rota_shifts = $rota_shift_query->orderBy('name','asc')->paginate($limit);

            // echo '<pre>'; print_r($shift_types);    
            /*foreach($shift_types as $key => $shift_type){

                $shift_time = DB::table('rota_shift_time')->select('start_time','end_time')->where('shift_type_id',$shift_type->type_id)
                                    ->where('home_id',$home_id)
                                    ->first();
                if(!empty($shift_time)) {
                    $shift_types[$key]->start_time = $shift_time->start_time;
                    $shift_types[$key]->end_time   = $shift_time->end_time;
                } else {
                    $shift_types[$key]->start_time = '';
                    $shift_types[$key]->end_time   = '';
                }
            }*/
            //echo '<pre>'; print_r($shift_types); die;

        } else { 
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $page = 'rota_shift';

        return view('backEnd/homeManage/RotaShift/rota_shift', compact('page','limit','rota_shifts','search','rota_time_format')); 
    }

    public function add(Request $request)   {
        
        $data = $request->input();
        $home_id = Session::get('scitsAdminSession')->home_id;
        $rota_time_format = Home::where('id', $home_id)->value('rota_time_format');
        if(!empty($home_id)) {
            /*(
                [name] => Afternoon
                [start_time] => 12
                [end_time] => 18
                [_token] => wgAEy4SDXFtE7LrUpTKLCqOR62DxNMD0Tf8L8EV9
                [id] => 
                [submit1] => 
            )*/
            if($request->isMethod('post')) {
                
                $shift_plan                      = new RotaShift;
                $shift_plan->home_id             = $home_id;
                $shift_plan->name                = $data['name'];
                $shift_plan->start_time          = $data['start_time'];
                $shift_plan->end_time            = $data['end_time'];
                $shift_plan->rota_shift_color_id = $data['shift_color_id'];

                if($shift_plan->save()) {

                    return redirect('admin/home/rota-shift')->with('success', 'Shift Plan added successfully');
                } else {

                    return redirect('admin/home/rota-shift')->with('error', 'Some Error Occured, Shift Plan not saved.');
                }
            }

            $page = 'rota_shift';
            return view('backEnd/homeManage/RotaShift/rota_shift_form', compact('page','rota_time_format'));
        } else {
            return redirect()->back()->with('error', 'Some Error Occured, Try again later');
        }
    }
    
    public function edit(Request $request, $shift_id) {

        $home_id = Session::get('scitsAdminSession')->home_id;
        $rota_time_format = Home::where('id', $home_id)->value('rota_time_format');
        if(!empty($home_id)) {

            if($request->isMethod('post')) {

                $shift_plan = RotaShift::find($shift_id);
                if(!empty($shift_plan)) {

                    if($shift_plan->home_id == $home_id) {
                        
                        $shift_plan->name                = $request->name;
                        $shift_plan->start_time          = $request->start_time;
                        $shift_plan->end_time            = $request->end_time;
                        $shift_plan->rota_shift_color_id = $request->shift_color_id;

                        if($shift_plan->save()) {

                            return redirect('admin/home/rota-shift')->with('success', 'Shift Plan updated successfully');
                        } else {
                            
                            return redirect()->back()->with('error', 'Some Error Occured, Shift Plan has not been updated.');
                        }
                    } else {
                        return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
                    }
                } else {
                    return redirect('admin/')->with('error', 'No Shift Plan found');
                } 
            }

            $shift_plan = RotaShift::select('rota_shift.*','s_color.color')
                                    ->leftJoin('rota_shift_color as s_color','s_color.id','=','rota_shift.rota_shift_color_id')
                                    ->where('rota_shift.home_id', $home_id)
                                    ->where('rota_shift.id', $shift_id)
                                    ->first();

           // echo '<pre>';print_r($shift_plan); die;

            $page = 'rota_shift';
            return view('backEnd/homeManage/RotaShift/rota_shift_form', compact('page', 'shift_plan','rota_time_format'));
        } else {
            return redirect()->back()->with('error', COMMON_ERROR);
        }
    }

    public function delete($shift_id) {

        $home_id = Session::get('scitsAdminSession')->home_id;
        if(!empty($home_id)) {

            if(!empty($shift_id)) {

                $updated = RotaShift::where('home_id', $home_id)->where('id', $shift_id)->update(['is_deleted' => '1']);

                if(!empty($updated)) { 

                    return redirect('admin/home/rota-shift')->with('success','Shift Plan deleted Successfully.'); 
                } else {
                    return redirect('admin/home/rota-shift')->with('error',UNAUTHORIZE_ERR); 
                }
            } else {
                return redirect('admin/')->with('error', 'No Shift Plan found');
            }
        } else {
            return redirect()->back()->with('error', COMMON_ERROR);
        }
    }
    
    /*public function view($shift_id) {
        
        $admin_home_id  = Session::get('scitsAdminSession')->home_id;
        $shift_type     = RotaShiftType::select('id','name')->where('id',$shift_id)->first();
        $shift_home_id  = RotaShiftTime::where('shift_type_id', $shift_id)->value('home_id');

        if(empty($shift_type))  {

            return view('frontEnd.error_404');
            //return redirect()->back()->with("error",COMMON_ERROR);
        }

        // if($admin_home_id != $shift_home_id){
        //     return redirect('admin/')->with('error', UNAUTHORIZE_ERR); 
        // }

        $rota_shifts = RotaShiftType::select('id as type_id','name','tag')->where('id', $shift_id)->first();
        //echo "<pre>"; print_r($rota_shifts); die; 

        $shift_plan = DB::table('rota_shift_type as rs_type')->select('rs_type.id', 'rs_type.name', 'rs_time.home_id', 'rs_time.shift_type_id', 'rs_time.start_time','rs_time.end_time')
                            ->join('rota_shift_time as rs_time', 'rs_time.shift_type_id', 'rs_type.id')
                            ->where('rs_time.home_id', $admin_home_id)
                            ->where('rs_time.shift_type_id', $shift_id)->first();


        $page = "rota_shift";
       // $shift_type_id = $shift_plan->shift_type_id;

        return view('backEnd/homeManage/RotaShift/rota_shift_form', compact('page','shift_plan','shift_type_id','rota_shifts'));
    }*/
    /*public function edit(Request $request) {   
       
        $admin_home_id = Session::get('scitsAdminSession')->home_id;

        $shift_type_id = $request->shift_id;
        if($request->isMethod('post')) {
            
            $shift_plan             = RotaShiftTime::find($shift_type_id);
            if(!empty($shift_plan)) {

                $rota_home_id           = $shift_plan->home_id;
                if($admin_home_id != $rota_home_id) {
                    return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
                }
                $shift_plan->start_time = $request->start_time;
                $shift_plan->end_time   = $request->end_time;
                
                if($shift_plan->save()) {
                    return redirect('admin/home/rota-shift')->with('success', 'Shift time updated successfully');
                } else {
                    return false;
                }
            } else {
                $shift                = new RotaShiftTime;
                $shift->home_id       = $admin_home_id;
                $shift->shift_type_id = $request->shift_type_id;
                $shift->start_time    = $request->start_time;
                $shift->end_time      = $request->end_time;
                if($shift->save()) {
                    return redirect('admin/home/rota-shift')->with('success', 'Shift time added successfully');
                } else {
                    return redirect('admin/home/rota-shift')->with('error', COMMON_ERROR);
                }
            }
        }
    }*/

    // public function view_rights($access_level_id = null)
    // {	
    //     $admin_home_id = Session::get('scitsAdminSession')->home_id;

    //     $access_level = AccessLevel::select('id','name')->where('id',$access_level_id)->first();
        
    //     if(empty($access_level)){
    //         return view('frontEnd.error_404');
    //         //return redirect()->back()->with("error",COMMON_ERROR);
    //     }

    //     $access_level_right = AccessLevelRight::select('access_rights')
    //                         ->where('access_level_id',$access_level_id)
    //                         ->where('home_id', $admin_home_id)
    //                         ->first();

    //     $available_rights = array();
    //     if(!empty($access_level_right)) {
    //         //get all the access rights of access_level
    //         $available_rights = explode(',', $access_level_right->access_rights);
    //     }

    //     $dashboard_rights = AccessRight::dashboardAccessRightList();
    //     $access_rights    = AccessRight::accessRightList();

    //     $page = 'access_levels';

    //    	return view('backEnd/homeManage/accessLevel/access_rights', compact('page','access_level','dashboard_rights','access_rights','available_rights'));
    // }

    // public function update_rights(Request $request){

    //     if($request->isMethod('post')) {
    //         $data = $request->input();
            
    //         $admin_home_id = Session::get('scitsAdminSession')->home_id;
            
    //         $access_str    = AccessRight::getAccessRightString($data);

    //         $access_level_right = AccessLevelRight::select('access_level.id','access_level_right.access_rights','access_level.name')
    //                 ->join('access_level','access_level.id','access_level_right.access_level_id')
    //                 ->where('access_level_right.access_level_id',$data['access_level_id'])
    //                 ->where('access_level_right.home_id', $admin_home_id)
    //                 ->first();

    //         if(!empty($access_level_right)) {

    //             $access_level_right->access_rights = $access_str;
                
    //         } else {
    //             $access_level_right                  = new AccessLevelRight;
    //             $access_level_right->access_rights   = $access_str;
    //             $access_level_right->home_id         = $admin_home_id;
    //             $access_level_right->access_level_id = $data['access_level_id'];
    //         }

    //         if($access_level_right->save()) {

    //             return redirect('admin/home/access-levels')->with("success","Access Rights updated successfully");
    //         } else{
    //             return redirect()->back()->with("error",COMMON_ERROR);
    //         }
       
    //     }
    // }   

}