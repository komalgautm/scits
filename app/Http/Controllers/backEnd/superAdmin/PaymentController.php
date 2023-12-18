<?php
namespace App\Http\Controllers\backEnd\superAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\Home, App\CompanyCharges, App\CompanyPayment, App\Admin, App\CompanyPaymentInformation,App\AdminCardDetail;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($system_admin_id, $amount, $company_charges_id, $expiry_date, $package_duration) { 

        $username   = env('EMAIL');
        $password   = env('PASSWORD');
        $signature  = env('SIGNATURE');
        // echo $username.'<br>'; //die;
        // echo $password; die;
        $admin_card_details = AdminCardDetail::select('id','admin_id','card_holder_name','card_number','mm_yy','cvv')
                                            ->where('admin_id',$system_admin_id)
                                            ->orderBy('id','desc')
                                            ->first();
        // echo "<pre>"; print_r($admin_card_details); die;
        if(!empty($admin_card_details)){
            $card_holder_name   = $admin_card_details->card_holder_name;
            $card_number        = $admin_card_details->card_number;
            $expire_date        = $admin_card_details->mm_yy;
            $cvv                = $admin_card_details->cvv;
            // $f_name             = $admin_card_details->first_name;
            // $l_name             = $admin_card_details->last_name;
            // $street             = $admin_card_details->street;
            // $city_name          = $admin_card_details->city_name;
            // $state_code         = $admin_card_details->state_code;
            // $zip_code           = $admin_card_details->zip_code;

            $expdate = explode('/', $expire_date);
            $month = $expdate['0'];
            $year = '20'.$expdate['1'];

            $payment_params = [ 
                            "s" => '-s',
                            "insecure"  =>'--insecure',
                            "VERSION"   =>'56.0',
                            // "SIGNATURE" =>'Ao68DNqlX5gVaPZlGVYk.BmBnaqJAKRQa8wtH5yrtwKwLKkCuupfUpHQ',
                            "SIGNATURE" =>$signature,
                            // "USER"  =>'promatics.hashishgarg-facilitator_api1.gmail.com',
                            "USER"  =>$username,
                            // "PWD"   =>'4DMJ26SNXMD6RVCL',
                            "PWD"   =>$password,
                            "METHOD"=>'DoDirectPayment',
                            // "PAYMENTACTION"=> 'Sale',
                            "IPADDRESS" =>'192.168.1.12',
                            "AMT" =>$amount,
                            // "AMT" =>'5.50',
                            // "ACCT" =>'4032039967306335',
                            "ACCT" =>$card_number,
                            // "EXPDATE" =>'122022',
                            "EXPDATE" =>$month.''.$year,
                            // "CVV2" =>'123',
                            "CVV2" =>$cvv,
                            // "FIRSTNAME" =>$card_holder_name,
                            // "LASTNAME" =>$card_holder_name,
                            // "FIRSTNAME" =>'John',
                            // "FIRSTNAME" =>$f_name,
                            // "LASTNAME" =>'Smith',
                            // "LASTNAME" =>$l_name,
                            // "STREET" =>'1 Main St.',
                            // "STREET" =>$street,
                            // "CITY" =>'San Jose',
                            // "CITY" =>$city_name,
                            // "STATE" =>'CA',
                            // "STATE" =>$state_code,
                            // "ZIP" =>'95131',
                            // "ZIP" =>$zip_code,
                            "COUNTRYCODE" =>'GBP'
                        ];
            // echo "<pre>"; print_r($payment_params); die;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp/');
            // curl_setopt($curl, CURLOPT_URL, 'http://www.trip.ae/flights/meta/landing');
            // curl_setopt($curl, CURLOPT_USERPWD, CHECKR_API_KEY . ":");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payment_params));
            $httpResponse = curl_exec($curl);
            $test = array_values(explode("&",$httpResponse));
            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            //echo "status:" . $http_status . "\n" . $httpResponse; die;
            $response = json_decode($httpResponse);
            // echo "<pre>"; print_r($httpResponse); die;  

            if(!empty($test[0])){
                // echo "<pre>"; print_r($test); die;    
                $test_re                            = explode("=", $test[2]);
                $paid_amount                        = explode("=",@$test[5]);
                $sender_transaction_id              = explode("=",@$test[9]);
                
                
                $data['paid_amount']                = @$paid_amount[1];
                $data['receiver_email']             = @$receiver_email[1];
                $data['sender_transaction_id']      = @$sender_transaction_id[1];
                

                if($test_re[1]== "Success"){
                    
                    $paymentInfo                            = new CompanyPaymentInformation;
                    $paymentInfo->admin_id                  = $system_admin_id;
                    $paymentInfo->paid_amount               = $data['paid_amount'];
                    $paymentInfo->sender_transaction_id     = $data['sender_transaction_id'];
                    $paymentInfo->company_charges_id        = $company_charges_id;
                    $paymentInfo->expiry_date               = $expiry_date;
                    if($paymentInfo->save()){
                        //update status
                        $company_payment_dtl = CompanyPayment::where('admin_id',$system_admin_id)
                                                                ->first();

                        $package_info = CompanyCharges::where('id',$company_charges_id)
                                                        ->first();
                        if(!empty($company_payment_dtl)){
                            if(!empty($package_info)){
                                
                                
                                $company_payment_dtl->admin_id              = $system_admin_id;
                                $company_payment_dtl->company_charges_id    = $package_info->id;
                                $company_payment_dtl->package_duration      = $package_duration;
                                $company_payment_dtl->expiry_date           = $expiry_date;
                                $company_payment_dtl->status                = '1';
                                $company_payment_dtl->pay_key               = '';
                                if($company_payment_dtl->save()){
                                    return true;
                                    // return redirect()->back()->with('success','Your Payment paid successfully.');
                                }else{
                                    return false;
                                    // return redirect()->back()->with('error',COMMON_ERROR);
                                }
                            }else{
                                return false;                                
                               
                            }
                        }else{
                            if(!empty($package_info)){
                                $company_payment                        = new CompanyPayment;
                                $company_payment->admin_id              = $system_admin_id;
                                $company_payment->company_charges_id    = $package_info->id;
                                $company_payment->package_duration      = $package_duration;
                                $company_payment->homes_added           = '0';
                                $company_payment->expiry_date           = $expiry_date;
                                $company_payment->status                = '1';
                                $company_payment->pay_key               = '';
                                if($company_payment->save()){

                                    return true;
                                    // return redirect()->back()->with('success','Your Payment paid successfully.');
                                }else{
                                    return false;                                
                                    // return redirect()->back()->with('error',COMMON_ERROR);
                                }
                            }else{
                                return false;                                
                                // return redirect()->back()->with('error',COMMON_ERROR);
                            }
                        }                                   

                    } else {
                        return redirect('admin/dashboard')->with('error',COMMON_ERROR);
                    }
                } else {
                    return redirect('admin/dashboard')->with('error',COMMON_ERROR);
                }
            }
        }
    }

}
