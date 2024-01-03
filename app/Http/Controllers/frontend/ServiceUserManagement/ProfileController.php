<?php

namespace App\Http\Controllers\frontend\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Session,DB;
use App\Models\ServiceUser;
use App\Models\DynamicFormBuilder;
use App\Models\Notification;
use App\Models\HomeLabel;
use App\Models\CareTeamJobTitle;
use App\Models\ServiceUserCareCenter;
use App\Models\ServiceUserContacts;
use App\Models\SocialApp;
use App\Models\ServiceUserSocialApp;
use App\Models\ServiceUserMoney;
use App\Models\ServiceUserMoneyRequest;
use App\Models\User;
use App\Models\Risk;

class ProfileController extends Controller
{
    public function index(Request $request,$service_user_id)
    {
        // update notify
        $updatenotify = array('read_notify' => 1);
        DB::table('su_risk')->where('service_user_id', $service_user_id)->where('home_id', Auth::user()->home_id)->update($updatenotify);
        $risktable = DB::table('su_risk')->where('service_user_id', $service_user_id)->where('home_id', Auth::user()->home_id)->get();
        foreach ($risktable as $rval) {
            DB::table('risk')->where('id', $rval->risk_id)->update($updatenotify);
        }
        DB::table('su_afc')->where('service_user_id', $service_user_id)->update($updatenotify);
        // update notify
        $patient = DB::table('service_user')->where('id', $service_user_id)->where('is_deleted', '0')->first();

        if (isset($patient) && $patient !='') {


            $home_id = Auth::user()->home_id;
            $home_ids = explode(',', $home_id);
            //if($patient->home_id != $home_id){
            if (!in_array($patient->home_id, $home_ids)) {
                return redirect('/')->with('error', UNAUTHORIZE_ERR);
            }

            $data['risks'] = DB::table('risk')->select('id', 'description', 'icon', 'status')
                ->where('home_id', $home_id)
                ->where('is_deleted', '0')
                ->get();
            $data['daily_score']   = DB::table('daily_record_score')->get();
            $data['care_team'] = DB::table('su_care_team')->select('id', 'job_title_id', 'name', 'email', 'phone_no', 'image', 'address')->where('service_user_id', $service_user_id)->where('is_deleted', '0')->orderBy('id', 'desc')->get();

            $data['care_history'] = DB::table('su_care_history')->select('id', 'title', 'date', 'description')->where('service_user_id', $service_user_id)->where('is_deleted', '0')->orderBy('date', 'desc')->get();

            $data['file_category'] = DB::table('file_category')->select('id', 'name')->where('is_deleted', '0')->orderBy('name', 'asc')->get();

            //get coordnate for map
            $current_location = $patient->current_location;

            //removing new line
            $pattern = '/[^a-zA-Z0-9]/u';
            $current_location = preg_replace($pattern, ' ', (string) $current_location);
            $coordinates = ServiceUser::getLongLat($current_location);

            $data['latitude'] = (isset($coordinates['results']['0']['geometry']['location']['lat'])) ? $coordinates['results']['0']['geometry']['location']['lat'] : '';
            $data['longitude'] = (isset($coordinates['results']['0']['geometry']['location']['lng'])) ? $coordinates['results']['0']['geometry']['location']['lng'] : '';
            //get coordnate for map end

           

            //getting form patterns
            $form_pattern['bmp_rmp'] = '';
            $form_pattern['risk'] = '';
            $form_pattern['su_rmp'] = '';
            $form_pattern['su_bmp'] = '';
            $form_pattern['su_mfc'] = '';
            $form_pattern['incident_report'] = '';

            $data['service_users'] = ServiceUser::where('home_id', $home_id)->get();
            $data['dynamic_forms'] = DynamicFormBuilder::getFormList();

           
            $data['notifications'] = Notification::getSuNotification($service_user_id, '', '', 6, $home_id);

            $data['afc_status'] = ServiceUser::get_afc_status($service_user_id);

            $data['labels'] = HomeLabel::getLabels($home_id);

            
            
            $data['care_team_job_title'] = CareTeamJobTitle::where('is_deleted', '0')
                ->where('home_id', $home_id)
                ->get();
            $data['su_in_danger']        = ServiceUserCareCenter::where('service_user_id', $service_user_id)->where('care_type', 'D')->count();
            $data['su_req_cb']           = ServiceUserCareCenter::where('service_user_id', $service_user_id)->where('care_type', 'R')->count();
            $data['su_contact']          = ServiceUserContacts::where('service_user_id', $service_user_id)->where('is_deleted', '0')->get();

            $data['social_app']     = SocialApp::select('id', 'name', 'icon')->where('is_deleted', '0')->get();
            $su_social_app  = ServiceUserSocialApp::select('id', 'social_app_id', 'value')
                ->where('su_social_app.service_user_id', $service_user_id)
                ->get();
            $social_app_val = array();
            foreach ($su_social_app as $key => $value) {
                $social_app_val[$value['social_app_id']]['id']    = $value['id'];
                $social_app_val[$value['social_app_id']]['value'] = $value['value'];
                
            }
            
            //service user money
            $data['my_money'] = $this->my_money($service_user_id);
            // echo "<pre>"; print_r($my_money); die;
            $noti_data = array();
            if (Session::has('noti_data')) {
                $noti_data = Session::get('noti_data');
                Session::forget('noti_data');
            }

            $data['users']  = User::select('id', 'name', 'email', 'image', 'phone_no')
                ->where('home_id', $home_id)
                ->where('is_deleted', '0')
                ->get();
            $data['patient']=$patient;
            $data['service_user_id']=$service_user_id;
            $data['social_app_val']=$social_app_val;
            $data['noti_data']=$noti_data;
            $data['form_pattern'] = $form_pattern;
            return view('frontEnd.serviceUserManagement.profile',$data);
        } else {
            return view('frontEnd.error_404');
        }
    }

    function my_money($service_user_id = null)
    {

        $my_money = array();

        $my_money['balance'] = ServiceUserMoney::where('service_user_id', $service_user_id)
            ->orderBy('id', 'desc')
            ->value('balance');

        $accept = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)->where('status', '2')->orderBy('id', 'desc')->get()->toArray();

        $my_money['accepted']['request'] = count($accept);
        $my_money['accepted']['amount'] = 0;
        foreach ($accept as $key => $value) {
            $my_money['accepted']['amount'] += $value['amount'];
        }

        $pending = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)->where('status', '0')->orderBy('id', 'desc')->get()->toArray();

        $my_money['pending']['request'] = count($pending);
        $my_money['pending']['amount']  = 0;
        foreach ($pending as $key => $value) {
            $my_money['pending']['amount'] += $value['amount'];
        }

        $reject = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)->where('status', '1')->orderBy('id', 'desc')->get()->toArray();

        $my_money['reject']['request'] = count($reject);
        $my_money['reject']['amount']  = 0;
        foreach ($reject as $key => $value) {
            $my_money['reject']['amount'] += $value['amount'];
        }

        return $my_money;
    }

    public function edit_contact_info(Request $request)
    {
        // echo"<pre>";print_r($request->all());die;
        // if ($request->isMethod('post')) {
            $data = $request->all();

            $updated = ServiceUser::where('id', $data['service_user_id'])
                ->where('home_id', Auth::user()->home_id)
                ->update([
                    'phone_no' => $data['phone_no'],
                    'mobile' => $data['mobile'],
                    'email' => $data['email'],
                ]);
               
            if ($updated) {

                //saving social app info
                if (isset($data['social_app'])) {
                  
                    foreach ($data['social_app'] as $social_data) {
                        
                        // if (!empty($social_data['value'])) {
                        if (isset($social_data['value']) && $social_data['value'] !='') {
                            // echo 1;die;
                            $su_soc_app = ServiceUserSocialApp::where('id', $social_data['su_app_id'])->first();
                            // echo "<pre>";print_r($su_soc_app);die;
                            // print_r($su_soc_app);die;
                            //if its value is not already stored then save it as a new record
                            // if (empty($su_soc_app)) {
                            if ($su_soc_app =='') {
                                $su_soc_app                  = new ServiceUserSocialApp;
                                $su_soc_app->social_app_id   = $social_data['social_app_id'];
                                $su_soc_app->service_user_id = $data['service_user_id'];
                            }
                            $su_soc_app->value = $social_data['value'];
                            $su_soc_app->save();
                        } else {
                            $su_soc_app = ServiceUserSocialApp::where('id', $social_data['su_app_id'])->delete();
                        }
                    }
                }

                // return redirect()->back()->with('success', 'User Contact Info updated successfully.');
                
                        $result = ServiceUser::where('id', $data['service_user_id'])
                        ->where('home_id', Auth::user()->home_id)
                        ->first();
                                
                    $social_data = DB::table('su_social_app as ssa')
                        ->select('ssa.*', 'sa.id as social_app_id', 'sa.name', 'sa.icon', 'sa.is_deleted')
                        ->join('social_app as sa', 'ssa.social_app_id', '=', 'sa.id')
                        ->where('ssa.service_user_id', $data['service_user_id'])
                        ->where('sa.is_deleted', 0)
                        ->get();

                    $all_data = '';
                    foreach ($social_data as $key => $val) {
                        $all_data .= '<strong style="color:#3399CC; display:inline-block; margin-bottom: 10px;">
                            <a href="'.$val->value.'"><i class="'.$val->icon.'"></i></a></strong>';
                    }

                    $rec['phone'] = $result->phone_no;
                    $rec['mobile'] = $result->mobile;
                    $rec['email'] = $result->email;
                    $rec['all_data'] = $all_data;

                    echo json_encode($rec);

                // echo "<pre>";print_r($all_data);die;
                // echo "done";
            } else {
                // return redirect()->back()->with('error', 'User Contact Info could not be updated.');
                echo "error";
            }
        // }
    }

     public function edit_location_info(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        // if ($request->isMethod('post')) {
            $data = $request->all();
            // $data['current_location'] = trim($data['current_location']);
            // $current_location = str_replace("\n\r", '<br />', $data['current_location']);

            $updated = ServiceUser::where('id', $data['service_user_id'])
                ->where('home_id', Auth::user()->home_id)
                ->update([
                    //'current_location' => $current_location,
                    'current_location' => nl2br(trim($data['current_location'])),
                    'previous_location' => nl2br(trim($data['previous_location']))
                ]);

            if ($updated) {
                // return redirect()->back()->with('success', 'User location Info updated successfully.');
                $result=ServiceUser::where('id', $data['service_user_id'])
                ->where('home_id', Auth::user()->home_id)->first();
                // echo "<pre>";print_r($result);die;
                $rec['curr_loc']=$result->current_location;
                $rec['pre_loc']=$result->previous_location;
                echo json_encode($rec);
            } else {
                // return redirect()->back()->with('error', 'User location Info could not be updated,');
                echo "error";
            }
        // }
    }

     public function add_care_history(Request $request, $service_user_id)
    {
        // echo "<pre>";print_r($request->all());die;
        // if ($request->isMethod('post')) {
            $data = $request->all();

            $su_home_id     = ServiceUser::where('id', $service_user_id)->value('home_id');
            if ($su_home_id != Auth::user()->home_id) {
                // return redirect('/')->with('error', UNAUTHORIZE_ERR);
                echo "unauth";
            }

            $care                   = new ServiceUserCareHistory;
            $care->service_user_id  = $service_user_id;
            $care->title            = $data['title'];
            $care->date             = date('Y-m-d', strtotime($data['date']));
            $care->home_id          = $su_home_id;
            $care->description      = $data['description'];
            if ($care->save()) {

                if (!empty($_FILES['files']['name'])) {
                    //echo '<pre>'; print_r($_FILES); die;
                    foreach ($_FILES['files']['name'] as $key => $value) {
                        //echo '<pre>'; print_r($value); die;
                        if (!empty($value)) {

                            $tmp_file   =   $_FILES['files']['tmp_name'][$key];
                            $image_info =   pathinfo($_FILES['files']['name'][$key]);

                            //$file_name  =   substr($image_info['filename'],0,100);
                            $file_name  =   $image_info['filename'];

                            $ext        =   strtolower($image_info['extension']);
                            $new_name   =   $file_name . '.' . $ext;

                            $allowed_ext = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'wps');
                            if (in_array($ext, $allowed_ext)) {

                                $file_dest = base_path() . suCareHistoryFileBasePath;

                                //if(!is_dir($file_dest)) { //check if file directory not exits then create it
                                //   mkdir($file_dest);
                                //} else { //if directory exits check if any file with same name exists

                                //  $i = 1;
                                // while(file_exists($file_dest.'/'.$new_name)){ 
                                //   $i++;
                                $new_name = $file_name . '.' . $ext;
                                // }
                                //}

                                if (move_uploaded_file($tmp_file, $file_dest . '/' . $new_name)) {

                                    $file                       = new ServiceUserCareHistoryFile;
                                    $file->su_care_history_id   = $care->id;
                                    $file->file                 = $new_name;
                                    $file->save();
                                }
                            }
                        }
                    }
                }
                $care_history = DB::table('su_care_history')->select('id', 'title', 'date', 'description')->where('service_user_id', $service_user_id)->where('is_deleted', '0')->orderBy('date', 'desc')->get();
                // print_r(count($care_history));die;
                $i=1;
                $all_data='';
                foreach($care_history as $val)
                {
                    $su_h_file = ServiceUserCareHistoryFile::su_history_files($val->id);
                    
                    $all_data.='<div class="msg-time-chat"><div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <div class="first">'.date('d M Y', strtotime($val->date)).'</div>
                                <div class="second bg-timeline-'.$i.'">'.$val->title.'</div>
                                <span class="edit-icn"> 
                                    <a href="#" onclick="get_care_history_btn_val('.$val->id.')" class="care_history_edit_btn" care_history_id="'.$val->id.'" care_history_date="'.date('d-m-Y', strtotime($val->date)).'" care_history_desc="'.$val->description.'" care_history_file="'.$su_h_file.'"><i class="fa fa-pencil profile"></i></a>
                                </span>
                                <input type="hidden" id="care_history_id_'.$val->id.'" value="'.$val->id.'">
                                <input type="hidden" id="care_history_date_'.$val->id.'" value="'.date('d-m-Y', strtotime($val->date)).'">
                                <input type="hidden" id="care_history_desc_'.$val->id.'" value='.$val->description.'>
                                
                                <input type="hidden" id="care_history_file_' . $val->id . '" value="' . htmlspecialchars($su_h_file, ENT_QUOTES, 'UTF-8') . '">
                               
                                <input type="hidden" id="title_'.$val->id.'" value="'.$val->title.'">
                            </div>
                        </div></div>';
                        if ($i > 5) {
                            $i = 1;
                            break;
                        } else {
                            $i++;
                        }                        
                }
                
                echo $all_data;
                // return redirect()->back()->with('success', 'Care History added successfully.');
            }
        // }
    }

    public function edit_detail_info(Request $request)
    {

        // echo "<pre>";print_r($request->all());die;
        // if ($request->isMethod('post')) {
            $data = $request->all();

            $service_user_id = $data['service_user_id'];
            unset($data['service_user_id']);
            unset($data['_token']);

            foreach ($data as $key => $value) {
                $updated = ServiceUser::where('id', $service_user_id)
                    ->where('home_id', Auth::user()->home_id)
                    ->update([
                        // $key => nl2br(trim($value))           
                        $key => trim($value)
                    ]);
            }
            if ($updated) {
                $result=$updated = ServiceUser::where('id', $service_user_id)
                ->where('home_id', Auth::user()->home_id)->first();

                $all_data=' <h2 class="accordion-header active-header" id="ram1" onclick="ram(1)"> Personal Information <a href="javascript:void(0)" class="info-edit-btn" clmn-name="personal_info"><i class="fa fa-pencil profile" onclick="get_user_data(0,1)"></i></a></h2>
                <div class="accordion-content full-info persnl-detail" style="display: block;" id="personal_data">'.$result->personal_info.'</div>
                <h2 class="accordion-header inactive-header" id="ram2" onclick="ram(2)">Education history <a href="javascript:void(0)" class="info-edit-btn" clmn-name="education_history"><i class="fa fa-pencil profile" onclick="get_user_data(0,2)"></i></a></h2>
                <div class="accordion-content full-info" id="education_data">'.$result->education_history.'</div>
                <h2 class="accordion-header inactive-header" id="ram3" onclick="ram(3)">Bereavement issues <a href="javascript:void(0)" class="info-edit-btn" clmn-name="bereavement_issues"><i class="fa fa-pencil profile" onclick="get_user_data(0,3)"></i></a></h2>
                <div class="accordion-content full-info" id="bervement_data">'.$result->bereavement_issues.'</div>
                <h2 class="accordion-header inactive-header" id="ram4" onclick="ram(4)">Drug &amp; alcohol issues <a href="javascript:void(0)" class="info-edit-btn" clmn-name="drug_n_alcohol_issues"><i class="fa fa-pencil profile" onclick="get_user_data(0,4)"></i></a></h2>
                <div class="accordion-content full-info" id="drug_data">'.$result->drug_n_alcohol_issues.'</div>
                <h2 class="accordion-header inactive-header" id="ram5" onclick="ram(5)">Mental Health issue<a href="javascript:void(0)" class="info-edit-btn" clmn-name="mental_health_issues"><i class="fa fa-pencil profile" onclick="get_user_data(0,5)"></i></a></h2>
                <div class="accordion-content full-info" id="mental_data">'.$result->mental_health_issues.'</div>';               
                
                // return redirect()->back()->with('success', 'User Info updated successfully.');
                echo $all_data;
            } else {
                // return redirect()->back()->with('error', 'User Info could not be updated,');
                echo "error";
            }
        // }
    }

}
