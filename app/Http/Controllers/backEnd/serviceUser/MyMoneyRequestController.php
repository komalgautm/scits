<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\ServiceUserMoneyRequest, App\ServiceUserMoney, App\User;  
use DB; 
use Hash;

class MyMoneyRequestController extends Controller
{   

    public function index(Request $request, $service_user_id) {   
        
        //compare with su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            $su_money_req_query = ServiceUserMoneyRequest::where('su_money_request.service_user_id', $service_user_id)
                                                    ->select('su_money_request.id','su_money_request.amount','su_money_request.description','su_money_request.status','su_money_request.provider_user_id')
                                                    ->orderBy('id','desc');

            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {

                if(Session::has('page_record_limit')){
                    $limit = Session::get('page_record_limit');
                } else{
                    $limit = 25;
                }
            }

            if(isset($request->search))
            {
                $search = trim($request->search);
                $su_money_req = $su_money_req_query->where('txn_amount','like','%'.$search.'%');             //search by date or title
            }
            $su_money_req = $su_money_req_query->paginate(25);
        
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
        
        $my_money = $this->my_money($service_user_id);

        $page = 'service-user-my-money-request';
        return view('backEnd.serviceUser.myMoneyRequest.my_money_request', compact('page','limit', 'service_user_id','su_money_req','search','my_money')); 
    }
            

    public function view($money_request_id = null) {

        $home_id = Session::get('scitsAdminSession')->home_id;

        $su_money_req = ServiceUserMoneyRequest::select('su_money_request.id','su_money_request.service_user_id','su_money_request.amount','su_money_request.description','su_money_request.provider_comment','su_money_request.status','su_money_request.provider_user_id') //,'u.name'
                                                    ->where('su_money_request.id', $money_request_id)
                                                    //->join('user as u', 'u.id','su_money_request.provider_user_id')
                                                    ->first();
        // echo "<pre>"; print_r($su_money_req); die;

        $users = User::select('id','name')
                        ->where('is_deleted','0')
                        ->where('home_id',$home_id)
                        ->get();
                                                
        $page = 'service-user-my-money-request';
        return view('backEnd.serviceUser.myMoneyRequest.my_money_request_form', compact('page','su_money_req','users')); 

    }

    function my_money($service_user_id = null) {

        $my_money = array();

        $my_money['balance'] = ServiceUserMoney::where('service_user_id',$service_user_id)
                                                ->orderBy('id','desc')
                                                ->value('balance');

        $accept = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)->where('status','2')->orderBy('id','desc')->get()->toArray();

        $my_money['accepted']['request'] = count($accept);
        $my_money['accepted']['amount']  = 0;
        
        foreach ($accept as $key => $value) {
            $my_money['accepted']['amount'] += $value['amount']; 
        }

        $pending = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)->where('status','0')->orderBy('id','desc')->get()->toArray();

        $my_money['pending']['request'] = count($pending);
        $my_money['pending']['amount']  = 0;
        
        foreach ($pending as $key => $value) {
            $my_money['pending']['amount'] += $value['amount'];
        }

        $reject = ServiceUserMoneyRequest::where('service_user_id', $service_user_id)
                                            ->where('status','1')
                                            ->orderBy('id','desc')
                                            ->get()->toArray();

        $my_money['reject']['request'] = count($reject);
        $my_money['reject']['amount']  = 0;
        foreach ($reject as $key => $value) {
            $my_money['reject']['amount'] += $value['amount'];
         } 

        return $my_money;

    }

}