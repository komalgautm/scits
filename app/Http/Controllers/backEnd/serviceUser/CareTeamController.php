<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\CareTeam, App\CareTeamJobTitle, App\User;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class CareTeamController extends Controller { 
    
    public function team_list(Request $request, $service_user_id) { 

        //comparing su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id    = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            $care_team_query = CareTeam::where('service_user_id',$service_user_id)
                                    ->select('su_care_team.id','su_care_team.image','su_care_team.name','su_care_team.phone_no','jt.title as job_title')
                                    ->leftJoin('care_team_job_title as jt','su_care_team.job_title_id','jt.id')
                                    ->where('su_care_team.is_deleted','0');

            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {
                if(Session::has('page_record_limit')) {
                    $limit = Session::get('page_record_limit');
                } else {
                    $limit = 25;
                }
            }
            if(isset($request->search)) {
                $search         = trim($request->search);
                $care_team_query     = $care_team_query->where('su_care_team.name','like','%'.$search.'%');
            }

            $care_team = $care_team_query->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }    
        //echo '<pre>'; print_r($care_team); die;
        $page = 'care_team';
        return view('backEnd.serviceUser.careTeam.careteam', compact('page', 'limit','care_team', 'search', 'service_user_id'));
    }

    public function add(Request $request, $service_user_id) {   

        
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id    = Session::get('scitsAdminSession')->home_id;

        $users      = User::select('id','name','email','image','phone_no')
                        ->where('home_id', $home_id)
                        ->where('is_deleted','0')
                        ->get()
                        ->toArray();
       
        if($request->isMethod('post')) {   

            //comparing su home_id
            // $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            
            // echo "<pre>"; print_r($request->input()); 
            // print_r($_FILES); 
            // die;

            
            if($home_id == $su_home_id) {

                $team                      =  new CareTeam;
                $team->service_user_id     =  $service_user_id;
                $team->name                =  $request->name;
                $team->job_title_id        =  $request->job_title_id;
                $team->phone_no            =  $request->phone_no;
                $team->email               =  $request->email;
                $team->address             =  $request->address;
                $team->home_id             =  $su_home_id;
               
                // if(!empty($_FILES['image']['name'])) {
                //     $tmp_image  =   $_FILES['image']['tmp_name'];
                //     $image_info =   pathinfo($_FILES['image']['name']);
                //     $ext        =   strtolower($image_info['extension']);
                //     $new_name   =   time().'.'.$ext; 
                   
                //     if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                //     {
                //         $destination = base_path().careTeamPath; 
                //         if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                //         {
                //             $team->image = $new_name;
                //         }
                //     }
                // }

                // if(!isset($team->image)) {
                //     $team->image = '';
                // }

                if(!empty($_FILES['image']['name'])) {   
                    
                    // $member_old_image =  $member->image;
                    $tmp_image  =  $_FILES['image']['tmp_name'];

                    $image_info =  pathinfo($_FILES['image']['name']);
                    $ext        =  strtolower($image_info['extension']);
                    $new_name   =  time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                        $destination =   base_path().careTeamPath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name)) {
                            $team->image = $new_name;
                        }
                    }

                } else {
                    
                    $staff_image = $request->staff_image_name;
                    
                    $team->image = $staff_image;

                    $user_img = userProfileImagePath.'/'.$staff_image;
                    // $ctm_img  = '/home/mercury/public_html/scits/public/images/careTeam/'.$staff_image;
                    $ctm_img  = '/var/www/html/public/images/careTeam/'.$staff_image;
                    // echo $ctm_img; die;
                    // $ctm_img  = careTeam;
                    // echo $user_img."<br>".$ctm_img; die;
                    copy($user_img,$ctm_img);
                        
                }

                if(!isset($team->image)) {
                    $team->image = '';
                }      

                if($team->save()){           
                        return redirect('admin/service-user/careteam/'.$service_user_id)->with('success', 'Care Team Member added successfully.');
                }else {
                       return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
                }
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        
        $care_team_job_title = CareTeamJobTitle::where('home_id', $su_home_id)
                                                ->where('is_deleted', '0')
                                                ->select('id','title')
                                                ->get();
        $page = 'care_team';
        return view('backEnd.serviceUser.careTeam.care_team_form', compact('page','service_user_id','care_team_job_title','users'));
    }

    public function edit(Request $request, $team_member_id) {     
        
        $member             = CareTeam::find($team_member_id);

        if(!empty($member)) {

            $service_user_id    = $member->service_user_id;
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            if($home_id != $su_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            $care_team_job_title = CareTeamJobTitle::where('home_id', $su_home_id)->where('is_deleted', '0')->select('id','title')->get();

            if($request->isMethod('post'))
            {   
                
                $member->name                =  $request->name;
                $member->job_title_id        =  $request->job_title_id;
                $member->phone_no            =  $request->phone_no;
                $member->email               =  $request->email;
                $member->address             =  $request->address;
                
                if(!empty($_FILES['image']['name']))
                {
                    $member_old_image            =  $member->image;
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                    {
                        $destination=   base_path().careTeamPath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        {
                            if(!empty($member_old_image)){
                                if(file_exists($destination.'/'.$member_old_image))
                                {
                                    unlink($destination.'/'.$member_old_image);
                                }
                            }
                            $member->image = $new_name;
                        }
                    }
                }

                if($member->save()) {   
                   return redirect('admin/service-user/careteam/'.$service_user_id)->with('success','Care Team Member has been updated successfully.'); 
                }  else   {
                   return redirect()->back()->with('error','Care Team Member could not be Updated.'); 
                }  
            }
        }
        $member = CareTeam::where('id', $team_member_id)->first();

        if(!empty($member)) {
            //compare with su home_id
            $su_home_id = ServiceUser::where('id',$member->service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            if($home_id != $su_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else {
            return redirect('admin/')->with('error','Sorry, Team Member does not exists');
        }

        $page = 'care_team';
        return view('backEnd.serviceUser.careTeam.care_team_form', compact('member','page','service_user_id','team_member_id','care_team_job_title'));
    }

    public function delete($care_team_id) {  
        
        if(!empty($care_team_id)) {

            $careteam =   CareTeam::where('id', $care_team_id)->first();

            if(!empty($careteam)) {

                $su_home_id = ServiceUser::where('id',$careteam->service_user_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
                CareTeam::where('id', $care_team_id)->update(['is_deleted'=>'1']);
                return redirect()->back()->with('success','Team Member deleted Successfully.'); 
            } else {
                    return redirect('admin/')->with('error','Sorry, Team Member does not exists'); 
            }
        }
    }


}