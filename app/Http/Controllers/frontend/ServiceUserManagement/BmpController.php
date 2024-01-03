<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Auth;
use App\Models\ServiceUser;
use App\Models\FormBuilder;
use App\Models\ServiceUserBmp;
use App\Models\Notification;
use App\Models\DynamicFormBuilder;
use App\Models\DynamicForm;
use App\Models\DynamicFormLocation;

class BmpController extends Controller
{
     public function index($service_user_id = null)
    {

        $su_home_id = ServiceUser::where('id', $service_user_id)->value('home_id');

        if (Auth::user()->home_id != $su_home_id) {
            die;
        }

        $home_id = Auth::user()->home_id;

        //in search case editing start for plan,details and review
        if (isset($_POST)) {
            $data = $_POST;
        }

        if (isset($data['su_bmp_id'])) {
            $su_bmp_ids = $data['su_bmp_id'];
            if (!empty($su_bmp_ids)) {
                foreach ($su_bmp_ids as $key => $record_id) {
                    $record = DynamicForm::find($record_id);
                    $su_home_id = ServiceUser::where('id', $record->service_user_id)->value('home_id');
                    if (Auth::user()->home_id == $su_home_id) {
                        $record->details = $data['edit_bmp_details'][$key];
                        //$record->plan    = $data['edit_bmp_plan'][$key];
                        //$record->review  = $data['edit_bmp_review'][$key];
                        $record->save();
                    }
                }
            }
        }
        //in search case editing end

        $this_location_id = DynamicFormLocation::getLocationIdByTag('bmp');

        //$form_bildr_ids_data = DynamicFormBuilder::select('id')->whereRaw('FIND_IN_SET(?,location_ids)',$this_location_id)->get()->toArray();
        //$form_bildr_ids = array_map(function($v) { return $v['id']; }, $form_bildr_ids_data);
        $bmp_record     = DynamicForm::where('location_id', $this_location_id)
            //whereIn('form_builder_id',$form_bildr_ids)
            ->where('service_user_id', $service_user_id)
            ->where('is_deleted', '0')
            ->orderBy('id', 'desc');

        /*$bmp_record = ServiceUserBmp::where('is_deleted','0')
                                    ->where('service_user_id', $service_user_id)
                                    ->where('home_id', $home_id)
                                    ->orderBy('id','desc');*/
        //->get();

        $pagination = '';

        if (isset($_GET['search'])) {
            if (!empty($_GET['search'])) {

                if ($_GET['searchType'] ==  1) {
                    $bmp_form = $bmp_record->where('title', 'like', '%' . $_GET['search'] . '%')->get();
                }

                if ($_GET['searchType'] ==  2) {
                    $search_date = date('Y-m-d', strtotime($_GET['search'])) . ' 00:00:00';
                    $search_date_next = date('Y-m-d', strtotime('+1 day', strtotime($_GET['search']))) . ' 00:00:00';
                    $bmp_form = $bmp_record->where('created_at', '>', $search_date)->where('created_at', '<', $search_date_next)->get();
                }

                // $bmp_form = $bmp_record->where('title','like','%'.$_GET['search'].'%')->get();

                $tick_btn_class = "search-bmp-btn search-bmp-rmp-btn";
            }
        } else {
            $bmp_form = $bmp_record->paginate(50);
            if ($bmp_form->links() != '') {
                $pagination .= '<div class="m-l-15 position-botm">'; //bmp_paginate
                $pagination .= $bmp_form->links();
                $pagination .= '</div>';
            }

            $tick_btn_class = "sbt-edit-bmp-record submit-edit-logged-record";
        }

        foreach ($bmp_form as $key => $value) {


            $details_check = (!empty($value->details)) ? '<i class="fa fa-check"></i>' : '';
            //$plan_check    = (!empty($value->plan)) ? '<i class="fa fa-check"></i>' : '';
            //$review_check  = (!empty($value->review)) ? '<i class ="fa fa-check"></i>' : '';
            if ($value->date == '') {
                $date = '';
            } else {
                $date = date('d-m-Y', strtotime($value->date));
            }

            if ((!empty($date)) || (!empty($value->time))) {
                $start_brct = '(';
                $end_brct = ')';
            } else {
                $start_brct = '';
                $end_brct = '';
            }

            echo '<div class="col-md-12 col-sm-12 col-xs-12 cog-panel rows">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <!-- <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"></label> -->
                            <div class="col-md-12 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="hidden" name="su_bmp_id[]" value="' . $value->id . '" disabled="disabled" class="edit_bmp_id_' . $value->id . '">
                                    <input type="text" class="form-control" name="bmp_title_name" disabled value="' . $value->title . ' ' . $start_brct . $date . ' ' . $value->time . $end_brct . '" maxlength="255"/>
                                     
                                    <div class="input-plus color-green"> <i class="fa fa-plus"></i> 
                                    </div>   
                                    <span class="input-group-addon cus-inpt-grp-addon clr-blue settings" onclick="open_bmp_setting()">
                                        <i class="fa fa-cog"></i>
                                        <div class="pop-notifbox">
                                            <ul class="pop-notification" type="none">
                                                <li> <a href="#" data-dismiss="modal" aria-hidden="true" class="dyn-form-view-data" id="' . $value->id . '"> <span> <i class="fa fa-eye"></i> </span> View</a> </li>
                                                <li> <a href="#" class="edit_bmp_details" su_bmp_id=' . $value->id . '> <span> <i class="fa fa-pencil"></i> </span> Edit </a> </li> 
                                                <li> <a href="#" class="dyn_form_del_btn" id="' . $value->id . '"> <span class="color-red"> <i class="fa fa-exclamation-circle"></i> </span> Remove </a> </li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Details textarea -->
                        <div class="col-xs-12 input-plusbox form-group p-0 detail">
                            <label class="col-sm-1 col-xs-12 color-themecolor r-p-0"> Details: </label>
                            <div class="col-sm-11 r-p-0">
                                <div class="input-group">
                                    <textarea class="form-control tick_text edit_rcrd txtarea edit_bmp_details_' . $value->id . '" name="edit_bmp_details[]" disabled rows="5" value="" maxlength="1000s">' . $value->details . '</textarea>
                                    <div class="input-group-addon cus-inpt-grp-addon sbt_tick_area"">
                                        <div class="tick_show sbt_btn_tick_div ' . $tick_btn_class . '">' . $details_check . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  ';
        }
        echo $pagination;
    }


    public function edit(Request $request)
    {

        $data = $request->all();
        //echo '<pre>'; print_r($data); die;

        if (isset($data['su_bmp_id'])) {

            $su_bmp_ids = $data['su_bmp_id'];
            if (!empty($su_bmp_ids)) {
                foreach ($su_bmp_ids as $key => $record_id) {
                    //$record = ServiceUserBmp::find($record_id);
                    $record = DynamicForm::find($record_id);
                    $su_home_id = ServiceUser::where('id', $record->service_user_id)->value('home_id');
                    if (Auth::user()->home_id == $su_home_id) {
                        $record->details = $data['edit_bmp_details'][$key];
                        // $record->plan    = $data['edit_bmp_plan'][$key];
                        // $record->review  = $data['edit_bmp_review'][$key];
                        if ($record->save()) {

                            $notification                             = new Notification;
                            $notification->service_user_id            = $record->service_user_id;
                            $notification->event_id                   = $record->id;
                            $notification->notification_event_type_id = '8';
                            $notification->event_action               = 'EDIT';
                            $notification->home_id                    = Auth::user()->home_id;
                            $notification->user_id                    = Auth::user()->id;
                            $notification->save();
                        }
                    }
                }
            }
        }
        $service_user_id = $record->service_user_id;

        $res = $this->index($service_user_id);
        echo $res;
    }

    
}
