<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\HandoverLogBook;

class HandoverController extends Controller
{
    public function index(Request $request){
        // echo "<pre>"; print_r($request->input()); die;
        if($request->isMethod('post')){
            // echo "<pre>"; print_r($request->service_usr_id); 
            // echo "<pre>"; print_r(Auth::user()->home_id); die; 
            $handover_log_book_record = HandoverLogBook::select('handover_log_book.*','u.name as staff_name','au.name as assigned_staff_name')
                                                    // ->where('service_user_id',$request->service_usr_id)
                                                    ->where('handover_log_book.home_id',Auth::user()->home_id)
                                                    ->leftjoin('user as u','u.id','handover_log_book.user_id')
                                                    ->leftjoin('user as au','au.id','handover_log_book.assigned_staff_user_id')
                                                    ->orderBy('handover_log_book.id','desc');//->get();
            // echo "<pre>"; print_r($handover_log_book_record); die;
            
                $today = date('Y-m-d 00:0:00');
        
                $pagination  = '';
                if(isset($_GET['search'])) {

                    // echo "<pre>"; print_r($_GET['search']); die;
                    $log_book_search_type = $_GET['log_book_search_type'];
                    
                    if($log_book_search_type == 'log_title'){

                        $handover_log_book_record = $handover_log_book_record->where('title','like','%'.$_GET['search'].'%');

                    } else{

                        $search_date = date('Y-m-d',strtotime($_GET['log_book_date_search'])).' 00:00:00';
                        $search_date_next = date('Y-m-d',strtotime('+1 day', strtotime($_GET['log_book_date_search']))).' 00:00:00';

                        $handover_log_book_record = $handover_log_book_record->where('date','>',$search_date)
                                                             ->where('date','<',$search_date_next);
                    }
                }

                $handover_log_book_record  = $handover_log_book_record->orderBy('id','desc')
                                                      ->orderBy('date','desc');
                                                      //->paginate(50);
                
                if(isset($_GET['search'])) {

                    $handover_log_book_record = $handover_log_book_record->get();
                }   
                else {
                    $handover_log_book_record = $handover_log_book_record->paginate(50);

                    if($handover_log_book_record->links() != '')  {
                        $pagination .= '</div><div class="log_records_paginate m-l-15 position-botm">';
                        $pagination .= $handover_log_book_record->links();
                        $pagination .= '</div>';
                    }
                }
                
                if(!$handover_log_book_record->isEmpty()){
                    $pre_date = date('y-m-d',strtotime($handover_log_book_record['0']->date));
                }
                foreach ($handover_log_book_record as $key => $value) {

                    $check = (!empty($value->details)) ? '<i class="fa fa-check"></i>' : '';
                    
                    $first = 0;
                    $record_time = date('h:i a',strtotime($value->date));
                    $created_time = date('h:i a', strtotime($value->created_at));
                    $rec_time = $record_time.' ('. $created_time. ')';
                    // $url = url('handover/daily/log/edit');
                    //if(!isset($_GET['logged']) ||  isset($_GET['search']) ){ 
                        $record_date = date('Y-m-d',strtotime($value->date));

                        if($record_date != $pre_date){
                            $pre_date = $record_date; 
                            
                            echo '</div>
                            <div class="hndovr-daily-rcd-head">
                                <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a  class="date-tab">
                                            <span class="pull-left">
                                                '.date('d F Y',strtotime($record_date)).'
                                            </span>
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="hndovr-daily-rcd-content" style="display: none;">';
                        }
                        else{}
                    //} 

                    echo '
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                            <div class="form-group col-md-11 col-sm-11 col-xs-12 r-p-0 pull-center">
                                
                                <div class="input-group popovr">
                                    <input type="text" name="edit_su_record_desc[]"  class="form-control cus-control edit_record_desc_'.$value->id.' edit_rcrd"  disabled  value="'.ucfirst($value->title).' | '.$rec_time.'" />';
                                     
                                    // if(!empty($value->details)){
                                        echo '<div class="input-plus color-green"> <i class="fa fa-plus"></i> </div>';
                                    // }
                                      echo '<input type="hidden" name="edit_su_record_id[]" value="'.$value->id.'" disabled="disabled" class="edit_record_id_'.$value->id.'" />
                                        
                                </div>
                            </div>
                            <form id="edit-hndovr-daily-logged-form'.$value->id.'" method="post">
                            <div class="input-plusbox form-group col-xs-11 p-0 detail">
                                <label class="cus-label color-themecolor"> Details: </label>
                                <div class="cus-input p-r-10">
                                    <div class="input-group">
                                        <textarea rows="5" name="detail" class="form-control tick_text txtarea edit_detail_'.$value->id.' edit_rcrd " value="">'.$value->details.'</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-plusbox form-group col-xs-11 p-0 detail">
                                <label class="cus-label color-themecolor"> Notes: </label>
                                <div class="cus-input p-r-10">
                                    <div class="input-group">
                                        <textarea rows="5" name="notes" class="form-control tick_text txtarea edit_detail_'.$value->id.' edit_rcrd " >'.$value->notes.'</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="input-plusbox form-group col-xs-11 p-0 detail" >
                                <label class="cus-label color-themecolor"> Staff created: </label>
                                <div class="cus-input p-r-10">
                                    <div class="input-group">
                                      <input type="text" value="'.ucfirst($value->staff_name).'" disabled="" class="form-control ">
                                    </div>
                                </div>
                            </div>
                            <div class="input-plusbox form-group col-xs-11 p-0 detail">
                                <label class="cus-label color-themecolor">Handover Staff Name: </label>
                                <div class="cus-input p-r-10">
                                    <div class="input-group">
                                      <input type="text" value="'.ucfirst($value->assigned_staff_name).'" disabled="" class="form-control ">
                                    </div>
                                </div>
                            </div>
                            <div class="input-plusbox form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 detail pull-right">
                                <div class="cus-input p-r-10 pull-right">
                                    <div class="input-group pull-right">
                                      <button class="btn btn-default pull-right sbmt_btn" handover_log_book_id="'.$value->id.'">Submit</button>
                                    </div>
                                </div>
                            </div> 
                            
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="handover_log_book_id" value="'.$value->id.'">
                            </form>
                        </div>
                        ';
                        
                }
                echo $pagination;
            //}
            //}
        }
    }

    public function handover_log_edit(Request $request){
        // echo "<pre>"; print_r($request->input()); die;
        if($request->isMethod('post')){
            $edit_handover_log_detail = HandoverLogBook::where('id',$request->handover_log_book_id)
                                                        ->update(['details'=> $request->detail,
                                                                    'notes'=> $request->notes
                                                            ]);
            if($edit_handover_log_detail) {
                echo "1";
            }else{
                echo "2";
            }
        }
    }
}
