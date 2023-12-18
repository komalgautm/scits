<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\ServiceUserMoney;  
use DB; 
use Hash;

class MyMoneyHistoryController extends Controller
{
    public function index(Request $request, $service_user_id) {   
        
        //compare with su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            $su_my_money_query = ServiceUserMoney::where('su_money.service_user_id', $service_user_id)
                                                    ->select('su_money.id','su_money.txn_type', 'su_money.txn_amount','su_money.balance','su_money.created_at','su_money.description')
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
                $su_my_money_query = $su_my_money_query->where('txn_amount','like','%'.$search.'%');             //search by date or title
            }
            $su_my_money = $su_my_money_query->paginate(25);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
        
        $my_money_balance = ServiceUserMoney::where('service_user_id',$service_user_id)
                                                ->orderBy('id','desc')
                                                ->value('balance');

        $page = 'service-user-my-money-history';
        return view('backEnd.serviceUser.myMoneyHistory.my_money_history', compact('page','limit', 'service_user_id','su_my_money','search','my_money_balance')); 
    }
            
    // public function edit(Request $request, $su_care_history_id)
    // {   
    //     $su_care_history    =  ServiceUserMoney::find($su_care_history_id);
    //     if(!empty($su_care_history)) {
    //         $service_user_id    = $su_care_history->service_user_id;

    //          //comparing su home_id
    //         $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
    //         $home_id = Session::get('scitsAdminSession')->home_id;
    //         if($home_id != $su_home_id) {
    //             return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
    //         }

    //         if($request->isMethod('post'))
    //         {   
    //             $data = $request->input();

    //             $date = date('Y-m-d',strtotime($data['date']));
    //             $su_care_history->title            =  $data['title'];
    //             $su_care_history->date             =  $date;
                
        
    //            if($su_care_history->save())
    //             {
    //                return redirect('admin/service-users/care-history/'.$service_user_id)->with('success','Care Timeline Updated Successfully.'); 
    //             } 
    //            else
    //             {
    //                return redirect()->back()->with('error','Care Timeline could not be Updated Successfully.'); 
    //             }  
    //         }
    //     } else {
    //             return redirect('admin/')->with('error','Sorry, Care Timeline does not exists');
    //     }

    //     $su_care_history = DB::table('su_care_history')
    //                 ->where('id', $su_care_history_id)
    //                 ->first();

    //     if(!empty($su_care_history)) {
    //         //compare with su home_id
    //         $su_home_id = ServiceUser::where('id',$su_care_history->service_user_id)->value('home_id');
    //         $home_id    = Session::get('scitsAdminSession')->home_id;
    //         if($home_id != $su_home_id) { 
    //             return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
    //         } 
    //     } else {
    //         return redirect('admin/')->with('error','Sorry, Care Timeline does not exists');
    //     }

    //     $page = 'service-users-care-history';
    //     return view('backEnd.serviceUser.careHistory.care_history_form', compact('su_care_history','page','service_user_id'));
    // }
        
}