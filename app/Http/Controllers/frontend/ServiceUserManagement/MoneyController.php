<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Redirect;
use App\Models\ServiceUserMoneyRequest;
use App\Models\ServiceUser;
use App\Models\ServiceUserMoney;
use App\Models\Home;
use App\Models\WeeklyAllowance;

class MoneyController extends Controller
{
    public function index($service_user_id){

        $user_money_req_list = ServiceUserMoneyRequest::where('service_user_id',$service_user_id)->orderBy('id','desc')->paginate(10);
        $req_money_list = json_decode(json_encode($user_money_req_list),true);
        foreach ($user_money_req_list as $money_list){

            if($money_list['status'] == '1'){
                $status = '<b><span class="pull-right red-clr">Rejected</span>';
            } else if($money_list['status'] == '2'){
                $status = '<b><span class="pull-right darkgreen-clr">Accepted</span>';
                // $status = 'Accepted';
            } else{
                $status = '<b><span class="pull-right orange-clr">Pending</span>';
                // $status = 'Pending';
            }

            echo '<a href="#" class="money_listing-li" rel="'.$money_list->id.'">'.date('d M Y',strtotime($money_list->updated_at)). ' |  <span class="p-l-10">Amount: ' .$money_list->amount.'</span> '.$status.' </b>
                 </a>';
        }
        echo $user_money_req_list->links();
        die;
    }

    public function view_detail($id){
        $detail = ServiceUserMoneyRequest::where('id',$id)->first();
        $su_name = ServiceUser::where('id',$detail['su_id'])->value('name');
        $status = $detail['status'];
        
        if($status == 0){
            $status = '<select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="2">Accept</option>
                            <option value="1">Reject</option> </select>';
        } elseif ($status == 1) {
            $status = '<select name="status" class="form-control" disabled>
                            <option value="">Select Status</option>
                            <option value="2">Accept</option>
                            <option value="1" selected>Reject</option> </select>';   
        } elseif($status == 2){
            $status = '<select name="status" class="form-control" disabled>
                            <option value="">Select Status</option>
                            <option value="2" selected>Accept</option>
                            <option value="1">Reject</option> </select>';   
        }
        
        /*$status = '<select name="status" class="form-control" disabled>
                            <option value="">Select Status</option>
                            <option value="2" '; if($status == '2'){ selected":"" .' >Accept</option>
                            <option value="1" '.($status == '1') ? "selected":"" .'>Reject</option> </select>';*/   
       
        if($detail['provider_comment'] != ""){
            $comment = '<textarea name="description" class="form-control detail-info-txt" rows="3" disabled>'.$detail['provider_comment'].'</textarea>';
        }else{
            $comment = '<textarea name="description" class="form-control detail-info-txt" rows="3"></textarea>';
        }
        return $response = array('name'=>$su_name,'amount'=>$detail['amount'],'desc'=>$detail['description'],'provider_comment'=>$comment,'id'=>$detail['id'],'status'=>$status);
    }

    public function update(Request $r){
        $data = $r->input();

        $money_request = ServiceUserMoneyRequest::where('id',$data['req_id'])->first();

        if(!empty($money_request)){

            $su_money = ServiceUserMoney::where('service_user_id',$money_request->service_user_id)->orderBy('id','desc')->first();

            if(!empty($su_money)){
                $balance_amount   = $su_money->balance;
                $requested_amount = $money_request->amount;
                $new_status       = $data['status'];

                if($new_status == 2){  //if accept status

                    if($requested_amount <= $balance_amount){

                        $money_request->provider_user_id = Auth::user()->id;                                        
                        $money_request->provider_comment = $data['description'];
                        $money_request->status           = $new_status;                                        
                        
                        if($money_request->save()){

                            if($money_request->status == 2){ 
                                //Add entry to su_money table.
                                $su_money                   = new ServiceUserMoney;
                                $new_balance                = $balance_amount - $requested_amount;
                                $su_money->balance          = $new_balance;
                                $su_money->service_user_id  = $money_request->service_user_id; 
                                //$su_money->user_id          = Auth::user()->id;
                                $su_money->description      = "Amount Given.";
                                $su_money->txn_type         = "W";
                                $su_money->txn_amount       = $requested_amount;
                                $su_money->su_money_request_id  = $money_request->id;
                                if($su_money->save()){ 
                                    return $resp = array('status'=>'ok');
                                }
                            }    
                        }
                    } else{
                        return $resp = array('status'=>'insufficient_balance');
                    }

                } else if($new_status == 1){ //if reject

                    $money_request->provider_user_id = Auth::user()->id;                                        
                    $money_request->provider_comment = $data['description'];
                    $money_request->status           = $data['status'];                                        
                    
                    if($money_request->save()){
                        return $resp = array('status'=>'ok');
                    }

                } else{}
            }

        }
        return 'err';
    }
    
    public function update_home_weekly_allowance(Request $r) { //set weekly allowance value of this home
        $data = $r->input();
        $home_id = Auth::user()->home_id;
      
        $allowance = $data['allowance'];
        // echo "<pre>"; print_r($allowance); //die;
        foreach($allowance as $value){

            $service_user_id =  $value['service_user_id'];
            $status          =  (isset($value['status'])) ? 'A':'D';
            $allowance       =  WeeklyAllowance::where('service_user_id', $service_user_id)
                                                ->first();
            $amnt = preg_replace('/[^0-9]/', '', $value['amount']);
            // echo "<pre>"; print_r($amnt); die;
            $amount          = $amnt;

            if(!empty($allowance)) {
                
                if($amount == '') {
                    $amount = $allowance->amount;
                }
                $allowance->amount          = $amount;
                $allowance->status          = $status;
            } else{
                $allowance                  = new WeeklyAllowance; 
                $allowance->service_user_id = $service_user_id;
                $allowance->amount          = $amount;
                $allowance->status          = $status;
            }
            $allowance->save();
        }
        // return redirect('/general-admin')->with('success','Weekly Allowance has been updated successfully.');
        echo "done";
    }

    
    // public function update_home_weekly_allowance(Request $r) { //set weekly allowance value of this home
        
    //     $data      = $r->input();
    //     echo "<pre>"; print_r($data); die;
        
    //     $home_id   = Auth::user()->home_id;
      
    //     $allowance = $data['allowance'];
        
    //     foreach($allowance as $value) {

    //         $service_user_id = $value['service_user_id'];
    //         $amnt            = WeeklyAllowance::where('service_user_id', $service_user_id)->value('amount');
            
    //         if(isset($value['amount'])){
    //             $amount = $value['amount'];
    //         } else {
    //             $amount = $amnt;
    //         }
    //         // $amount          = !empty($value['amount'])? $value['amount'] : '';

    //         $status          = (isset($value['status'])) ? 'A':'D';
            
    //         $allowance       = WeeklyAllowance::where('service_user_id', $service_user_id)->first();
    //         // echo "<pre>"; print_r($allowance); die;
    //         if(!empty($allowance)) {

    //             $allowance->amount          = (isset($amount)) ? $amount : '0';
    //             $allowance->status          = $status;

    //         } else {
    //             // echo "2"; die;
    //             $allowance                  = new WeeklyAllowance; 
    //             $allowance->service_user_id = $service_user_id;
    //             $allowance->amount          = (isset($amount)) ? $amount : '0';
    //             $allowance->status          = $status;
    //         }
    //         $allowance->save();
    //         // echo "2"; die;
    //     }

    //     return redirect('/general-admin')->with('success','Weekly Allowance has been updated successfully.');

    //     /*-------- Logic --------*/
    //     // If the su is checked the weekly allowance money is allowed for yp, and in cronjob (weekly allowance ->for every week) amount is deposit in service_user_money
    // }

    public function add_shopping_bugdet(Request $request){
        
        $data      = $request->input();
        $allowance = $data['allowance'];

        if($request->isMethod('post')) {

            foreach ($allowance as $key => $value) {
                // echo "<pre>"; print_r($value); die;
                $value['amount'] = preg_replace('/[^0-9]/', '', $value['amount']);
                if (!empty($value['service_user_id']) && !empty($value['amount'])) {
    
                    $balance = ServiceUserMoney::where('service_user_id',$value['service_user_id'])
                                        ->orderBy('id','desc')
                                        ->value('balance');

                    $outstanding_balance = ServiceUserMoney::where('service_user_id',$value['service_user_id'])
                                                        ->orderBy('id','desc')
                                                        ->value('outstanding_balance');

                    if($balance == ""){

                        $balance = 0;
                    }
                    
                    if ($data['action']=='Add') {

                       $new_balance  = $balance + $value['amount'];
                    } else {

                       $new_balance  = $balance - $value['amount']; 
                    }
                    
                    $su_money                   = new ServiceUserMoney;
                    $su_money->service_user_id  = $value['service_user_id'];
                    $su_money->description      = $data['select_allowance'];

                    if ($data['action']=='Add') {

                        $su_money->txn_type     = 'D';
                    } else {

                        $su_money->txn_type     = 'W';
                    }
                    
                    $su_money->txn_amount       = $value['amount'];

                    if ($new_balance <= floatval(-0.01)) {
                        
                        $outstanding_balance           = $new_balance - $outstanding_balance;
                        $su_money->outstanding_balance = abs($outstanding_balance);
                        $su_money->balance             = 0;

                    } else if ($new_balance == 0) {

                        $outstanding_balance           = abs($outstanding_balance);
                        $su_money->outstanding_balance = 0;
                        $su_money->balance             = 0;
                    } else {

                       $outstanding_balance           = abs($outstanding_balance);
                       $su_money->balance             = $new_balance - $outstanding_balance;
                       $su_money->outstanding_balance = 0; 
                    }

                    if (!empty($outstanding_balance)) {

                        if (($outstanding_balance > 0)&&($data['action']=='Add')) {

                            if ($outstanding_balance > $new_balance) {

                                $outstanding_balance            =  abs($outstanding_balance);
                                $su_money->outstanding_debit    =  $value['amount'];
                                $outstanding_balance            =  $outstanding_balance - $new_balance;
                                $su_money->outstanding_balance  =  $outstanding_balance;
                                $su_money->balance              =  0;
                            } else {

                                $outstanding_balance           =  abs($outstanding_balance);
                                $su_money->outstanding_debit   =  $outstanding_balance;
                                $su_money->balance             =  $new_balance - $outstanding_balance;
                            }
                        }
                    }

                    $su_money->save();
                    // return redirect('/general-admin')->with('success','Shopping Budget has been added successfully.');
                } //else {
                    
                //     return redirect('/general-admin')->with('error','Please select service user and fill the amount field');
                // }
            }
            // return redirect('/general-admin')->with('success','Shopping Budget has been added successfully.');
            echo "done";
        }
                
    }
}
