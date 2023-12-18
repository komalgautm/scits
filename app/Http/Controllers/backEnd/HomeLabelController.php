<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Label, App\HomeLabel;
use Session,DB;

class HomeLabelController extends Controller
{
	public function index(Request $request)
    {   
        $home_id = Session::get('scitsAdminSession')->home_id;
       	
        if(empty($home_id)) {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $labels = Label::with('renamed')->orderBy('name','asc')->get()->toArray();

        $limit = 10;
       	$search  = 10;
       	
        $page = 'label';
        return view('backEnd/label/labels', compact('page','limit','labels','search')); 
    }

    public function view($label_tag = null){


    	$home_id = Session::get('scitsAdminSession')->home_id;

        $label = Label::with('renamed')->where('tag', $label_tag)->first();

        if(!empty($label)) {
            $label = $label->toArray();
        }

        $page = 'label';
        return view('backEnd/label/label_form', compact('page','label'));    
    }

    public function edit(Request $request){

    	$data = $request->input();
    	if(!empty($data)){

            $home_id    = Session::get('scitsAdminSession')->home_id;
    		$label_id   = $data['label_id'];
            $label_name = $data['label_name'];
    		$label_icon = $data['label_icon'];
	    	
	    	$label = HomeLabel::where('label_id',$label_id)->where('home_id',$home_id)->first();
	    	
	    	if(!empty($label)){
	    		$label->name     = $label_name;
                $label->icon     = $label_icon;

	    	} else{

	    		$label           = new HomeLabel;
                $label->name     = $label_name;
	    		$label->icon     = $data['label_icon'];
	    		$label->label_id = $label_id;
	    		$label->home_id  = $home_id;
	    	}

	    	if($label->save()){
	    		return redirect('/admin/labels')->with('success','Label successfully updated.');
	    	} else{
	    		return redirect('/admin/labels')->with('error',COMMON_ERROR);
	    	}
    	}
    }
}

/*$labels_query = Label::select('id','label','tag')->where('home_id',$home_id);
		$search = '';
        
        if(isset($request->limit))
        {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } 
        else
        {
            if(Session::has('page_record_limit'))
            {
                $limit = Session::get('page_record_limit');
            } 
            else
            {
                $limit = 25;
            }
        }
        if(isset($request->search))
        {
            $search         = trim($request->search);
            $labels_query     = $labels_query->where('label','like','%'.$search.'%');
        }
        $labels = $labels_query->paginate($limit);*/

       	//echo '<pre>'; print_r($labels); die;