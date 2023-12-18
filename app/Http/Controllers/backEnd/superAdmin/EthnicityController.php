<?php
namespace App\Http\Controllers\backEnd\superAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use DB;
use App\Ethnicity; 

class EthnicityController extends Controller
{
    public function index(Request $request) {	
        // echo "1"; die;
        $ethnicity = Ethnicity::select('id','name','created_at')->where('is_deleted','O');
        $search = '';

        if(isset($request->limit))
        {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else{

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }
        if(isset($request->search))
        {
            $search      = trim($request->search);
            $ethnicity  = $ethnicity ->where('name','like','%'.$search.'%');
        }

        $ethnicity = $ethnicity->paginate($limit);

        $page = 'ethnicity';

       	return view('backEnd/superAdmin/ethnicity/ethnicities', compact('page','limit','ethnicity','search'));
    }

    public function add(Request $request) { 
      	
        if($request->isMethod('post')) {

    	    $social_app          = new Ethnicity;
            $social_app->name    = $request->name;
                
    		if($social_app->save()) {
    			return redirect('super-admin/ethnicities')->with('success', 'Ethnicity added successfully.');
    		} else {
    			 return redirect()->back()->with('error', 'Some error occurred. Please try after sometime.');
    		}
    	}
        $page = 'ethnicity';
        return view('backEnd/superAdmin/ethnicity/ethnicity_form', compact('page'));
    }
   			
   	public function edit(Request $request, $ethnicity_id) { 
       
       if($request->isMethod('post')){
            $ethnicity               = Ethnicity::find($ethnicity_id);
            $ethnicity->name         = $request->name;
            if($ethnicity->save()){
               return redirect('super-admin/ethnicities')->with('success','Ethnicity Updated successfully.'); 
            } else {
               return redirect()->back()->with('error','Ethnicity could not be Updated.'); 
            }  
        }

       	$ethnicity = DB::table('ethnicity')
                        ->where('id', $ethnicity_id)
                        ->first();
        $page = 'ethnicity';
        return view('backEnd/superAdmin/ethnicity/ethnicity_form', compact('ethnicity','page'));
    }

    public function delete($ethnicity_id) {
	    if(!empty($ethnicity_id)) {    

            $updated = DB::table('ethnicity')->where('id', $ethnicity_id)->update(['is_deleted' => '1']);

            if($updated){
                return redirect('super-admin/ethnicities')->with('success','Ethnicity deleted Successfully.'); 
            } else{
                return redirect('super-admin/ethnicities')->with('error','Ethnicity could not be deleted.'); 
            }
        } else {
                return redirect()->back()->with('error',COMMON_ERROR); 
        }
    }

    // public function check_user_email_exists(Request $request)
    // {

    //     $count = DB::table('user')->where('email',$request->email)->count();
    //     if($count > 0)
    //     {
    //         echo '{"valid":false}';die;
    //     }    
    //     else
    //     {
    //         echo '{"valid":true}';die;
    //     }    
    // }
   
    // public function check_user_edit_email_exists(Request $request)
    // {
    //     $count = DB::table('user')->where('email',$request->email)->count();
    //     if($count > 1)
    //     {
    //         echo '{"valid":false}';die;
    //     }    
    //     else
    //     {
    //         echo '{"valid":true}';die;
    //     }    
    // }

   





    
}