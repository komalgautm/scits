<?php

namespace App\Http\Controllers\frontEnd\PersonalManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Auth;
use App\Models\PettyCash;

class PettyCashController1 extends Controller
{
     public function index()
    {   
        //echo '<pre>'; print_r($_GET); die;
        //in search 
        $home_id = Auth::user()->home_id;
        $petty_reports = PettyCash::where('home_id', $home_id)->where('txn_type','D');
        //echo "<pre>"; print_r($petty_reports); die;

        $today = date('Y-m-d 00:0:00');
        
        $pagination  = '';
        if(isset($_GET['search'])) { 
            //echo 'sandeep';
            //echo '<pre>'; print_r($_GET); die;
            $expnse_rep_srch_type = $_GET['petty_srch_type'];
            
            if($expnse_rep_srch_type == 'expnse_title'){

                $petty_reports = $petty_reports->where('petty_cash.title','like','%'.$_GET['petty_title_search'].'%');

            } else{

                $search_date = date('Y-m-d',strtotime($_GET['petty_date_srch'])).' 00:00:00';
                $search_date_next = date('Y-m-d',strtotime('+1 day', strtotime($_GET['petty_date_srch']))).' 00:00:00';

                $petty_reports = $petty_reports->where('petty_cash.created_at','>',$search_date)
                                                   ->where('petty_cash.created_at','<',$search_date_next);

            }
        }
        
        $petty_reports  = $petty_reports->orderBy('petty_cash.id','desc')
                                            ->orderBy('petty_cash.created_at','desc');
                                            //->paginate(50);
        
        if(isset($_GET['search'])) {

            $petty_reports = $petty_reports->get();
        }   
        else {
                $petty_reports = $petty_reports->paginate(5);

                if($petty_reports->links() != '')  {
                    $pagination .= '</div><div class="petty_reports m-l-15 position-botm">';
                    $pagination .= $petty_reports->links();
                    $pagination .= '</div>';
            }
        }
        
        if(!$petty_reports->isEmpty()){
            $pre_date = date('y-m-d',strtotime($petty_reports['0']->created_at));
        }
            
        
        foreach ($petty_reports as $key => $value) {
            // echo "<pre>"; print_r($expense_reports); die;
            $check = (!empty($value->details)) ? '<i class="fa fa-check"></i>' : '';
            
            $first = 0;

            if(isset($_GET['logged']) ||  isset($_GET['petty_title_search']) ){ 
                /*$record_date = date('Y-m-d',strtotime($value->created_at));

                if($record_date != $pre_date){
                    $pre_date = $record_date; 
               
                    echo '</div>
                    <div class="daily-rcd-head">
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
                    <div class="daily-rcd-content">';
                }
                else{}*/
            } 

            echo '
                <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15 record_row">
                    <div class="form-group col-md-11 col-sm-11 col-xs-12 r-p-0 pull-center">
                        <div class="input-group popovr">
                            <input type="text" name="edit_su_record_desc[]"  style="text-align: center" class="form-control cus-control edit_record_desc_'.$value->id.' edit_rcrd"  disabled  value="'.$value->title.' on '.date('d M Y',strtotime($value->created_at)).'
                                " />';
                             
                            if(!empty($value->details)){
                                echo '<div class="input-plus color-green"> <i class="fa fa-plus"></i> </div>';
                            }
                              echo '<input type="hidden" name="edit_su_record_id[]" value="'.$value->id.'" disabled="disabled" class="edit_record_id_'.$value->id.'" />
                                <span class="input-group-addon cus-inpt-grp-addon clr-blue settings">
                                <i class="fa fa-cog"></i>
                                <div class="pop-notifbox">
                                    <ul class="pop-notification" type="none"> 
                                        <li> <a href="#" petty_rep_id="'.$value->id.'" class="view-expnse-rep"> <span> <i class="fa fa-eye"></i> </span> View </a> </li>
                                       
                                       
                                        <li> <a href="#" petty_rep_id="'.$value->id.'" class="petty-detail"> <span class="color-red"> <i class="fa fa-plus color-green"></i> </span> Details </a> </li>
                                    </ul>
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="input-plusbox form-group col-xs-11 p-0 detail" style="display:none">
                        <label class="cus-label color-themecolor"> Details: </label>
                        <div class="cus-input p-r-10">
                            <div class="input-group">
                                <textarea rows="5" name="edit_su_record_detail[]" disabled class="form-control tick_text txtarea edit_detail_'.$value->id.' edit_rcrd " value="">'.$value->details.'</textarea>
                                <span class="input-group-addon cus-inpt-grp-addon color-grey settings tick_show">'.$check.'</span>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        }
        
        echo $pagination;
    }

    

    //petty cash
   public function add_petty_cash(Request $request){

        // echo "<pre>"; print_r($request->input()); die;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $balance = PettyCash::orderBy('id','desc')->value('balance');
          
            $petty_cash_report     = new PettyCash;

            $transaction_amount    = $data['amount'];
            
            $new_balance = $balance + $transaction_amount;
           

            $petty_cash_report->home_id    = Auth::user()->home_id;
            $petty_cash_report->user_id    = Auth::user()->id;
            $petty_cash_report->title      = "Cash Added";
            $petty_cash_report->details    = $data['detail'];
            $petty_cash_report->txn_type   = 'D';
            $petty_cash_report->txn_amount = (float)$data['amount'];
            $petty_cash_report->balance    = (float)$new_balance;
            $petty_cash_report->receipt    = "";
            

            if($petty_cash_report->save()){
                echo 'true';  //return redirect()->back()->with('success','Petty Cash added successfully.');
            }
            else { 
                echo 'false';  //return redirect()->back()->with('error',COMMON_ERROR);
            }
        
            die;
        } else {
            echo 'false'; die;
        }
    
    }

    public function get_petty_balance()
    {
        $home_id = Auth::user()->home_id;

        $balance = PettyCash::where('home_id',$home_id)->orderBy('id','desc')->value('balance');
        
        $balance = (float)$balance;
        if(!empty($balance)){

            echo $balance; die;
        }else{
            echo "false"; die;
        }
       


    }
     
    public function view($petty_rep_id=null) 
    {
        $user_id = Auth::user()->id;
        $home_id = Auth::user()->home_id;

        $petty_cash_report = PettyCash::where('home_id', $home_id)->where('user_id', $user_id)->where('id', $petty_rep_id)->first();

        if($petty_cash_report->home_id != $home_id ){

            $result['response'] = 'AUTH_ERR';
        }

        if($petty_cash_report->user_id != $user_id ) {

            $result['response'] = 'AUTH_ERR';   
        }

        echo '<div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Title: </label>
                <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" class="form-control expnse-fields" placeholder="" name="petty_title" value="'.$petty_cash_report->title.'" disabled/>
                </div>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Details: </label>
                <div class="col-md-10 col-sm-10 col-xs-10">
                        <textarea  class="form-control expnse-fields detail-info-txt" rows="3" name="petty_detail" disabled>'.$petty_cash_report->details.'</textarea>
                </div>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Amount: </label>
                <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="petty_amount" type="text" disabled class="form-control expnse-fields" placeholder="" value="'.$petty_cash_report->txn_amount.'"/>
                </div>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Date: </label>
                <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="petty_date" type="text" disabled class="form-control " placeholder="" value="'.$petty_cash_report->updated_at.'"/>
                </div>
            </div>

            <div class="form-group modal-footer m-t-0 modal-bttm">
                <button class="btn btn-default" type="button" id="petty_cancel" data-dismiss="modal" aria-hidden="true"> Cancel </button>

                
            </div>';
    }

}
