<?php
namespace App\Http\Controllers\backEnd\systemGuide;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use DB; 
use App\Admin;

class SystemGuideCategoryController extends Controller
{
	public function index(Request $request)
    {    
        $home_id = Session::get('scitsAdminSession')->home_id;
        
        if(!empty($home_id)) {

            // $records_query = DB::table('daily_record')->where('is_deleted','0')->where('home_id',$home_id)->select('id','description', 'status');
            $sys_guide_ctgrys = DB::table('system_guide_category')->where('is_deleted','0')->select('id','category_name');

            $search = '';

            if(isset($request->limit))
            {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } 
            else{
                if(Session::has('page_record_limit')){
                  $limit = Session::get('page_record_limit');
                } else{
                  $limit = 25;
                }
            }
            if(isset($request->search))
            {
                $search = trim($request->search);
                $sys_guide_ctgrys = $sys_guide_ctgrys->where('category_name','like','%'.$search.'%');
            }

            $sys_guide_ctgrys = $sys_guide_ctgrys->orderBy('category_name','asc')->paginate($limit);

        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $page = 'system-guide';
        return view('backEnd/systemGuide/system_guide_category', compact('page', 'limit', 'sys_guide_ctgrys', 'search')); //records.blade.php
    }
}