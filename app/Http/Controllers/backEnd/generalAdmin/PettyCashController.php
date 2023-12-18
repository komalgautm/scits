<?php
namespace App\Http\Controllers\backEnd\generalAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\User, App\PettyCash;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class PettyCashController extends Controller
{
    public function index(Request $request) {	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $peety_cash_query = PettyCash::select('petty_cash.id','petty_cash.title','petty_cash.user_id','petty_cash.txn_type','petty_cash.txn_amount','petty_cash.created_at','u.name')
                                ->join('user as u', 'u.id','petty_cash.user_id')
                                //->where('petty_cash.is_deleted','0')
                                ->where('petty_cash.home_id',$home_id)
                                ->orderBy('petty_cash.id','desc');
        
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else {

            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search)) {
            $search      = trim($request->search);
            $peety_cash_query = $peety_cash_query->where('title','like','%'.$search.'%');
        }

        $peety_cash = $peety_cash_query->paginate($limit);

        $balance = PettyCash::where('home_id',$home_id)->orderBy('id','desc')->value('balance');
        
        $balance = (float)$balance;

        $page = 'petty_cash';
       	return view('backEnd/generalAdmin/PettyCash/petty_cash', compact('page','limit','peety_cash','search','balance'));
    }

    	
   	public function view($petty_id = null) { 

        $home_id = Session::get('scitsAdminSession')->home_id;
       	$petty_cash = PettyCash::where('id', $petty_id)
                                    ->first();

        // echo "<pre>"; print_r($petty_cash); die;



        $page = 'petty_cash';
        return view('backEnd/generalAdmin/PettyCash/petty_cash_form', compact('petty_cash','page'));
    }

  

}
