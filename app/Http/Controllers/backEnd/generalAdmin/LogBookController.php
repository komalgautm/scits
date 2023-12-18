<?php
namespace App\Http\Controllers\backEnd\generalAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\User, App\LogBook;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class LogBookController extends Controller
{
    public function index(Request $request) {	
        
        $home_id = Session::get('scitsAdminSession')->home_id;
        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $log_book_query = LogBook::select('id','title','date')
                                ->where('is_deleted','0')
                                ->where('home_id',$home_id)
                                ->orderBy('id','desc');
        
        $search = '';
        
        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else {
            //echo 'm'; die;
            if(Session::has('page_record_limit')) {
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search)) {
            $search      = trim($request->search);
            $log_book_query = $log_book_query->where('title','like','%'.$search.'%');
        }

        $log_book = $log_book_query->paginate($limit);

        $page = 'log_book';
       	return view('backEnd/generalAdmin/LogBook/log_book', compact('page','limit','log_book','search'));
    }

    	
   	public function view($log_book_id = null) { 

        $home_id  = Session::get('scitsAdminSession')->home_id;
       	$log_book = LogBook::where('id', $log_book_id)
                                    ->first();

        // echo "<pre>"; print_r($petty_cash); die;

        $page = 'log_book';
        return view('backEnd/generalAdmin/LogBook/log_book_form', compact('log_book','page'));
    }

  

}
