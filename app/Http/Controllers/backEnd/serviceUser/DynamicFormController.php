<?php

namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceUser, App\DynamicFormLocation, App\DynamicForm ;
use Session;

class DynamicFormController extends Controller
{
    public function index(Request $request, $service_user_id)	{
        // echo "1"; die;
    	$home_id = Session::get('scitsAdminSession')->home_id;
    	$su_home_id = ServiceUser::where('id', $service_user_id)->value('home_id');
    	if($home_id != $su_home_id) {

    		return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
    	}

        $su_dynamic_form = DynamicForm::where('dynamic_form.is_deleted', '0')
                                    //->where('dynamic_form.home_id', $home_id)
                                    ->where('dynamic_form.service_user_id', $service_user_id)
                                    ->select('dynamic_form.*', 'dynamic_form_location.id as location_id', 'dynamic_form_location.name as location_name')
                                    ->join('dynamic_form_location', 'dynamic_form_location.id', 'dynamic_form.location_id')
                                    ->orderBy('dynamic_form.id', 'desc');
                                    // ->get()->toArray();

        //echo "<pre>"; print_r($su_dynamic_form); die;
    								
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
            else {

                $limit = 10;
            }
        }
        if(isset($request->search))
        {
            $search   = trim($request->search);
            $su_dynamic_form = $su_dynamic_form->where('dynamic_form.title','like','%'.$search.'%');
            
        }

        $su_dynamic_form = $su_dynamic_form->paginate($limit);

    	$page = 'su-dynamic-form';
    	return view('backEnd.serviceUser.dynamicForm.dynamic_forms', compact('page', 'limit', 'search', 'su_dynamic_form', 'service_user_id'));
    }

    public function view(Request $request, $d_form_id) {
        // echo $d_form_id; die;
        $result = DynamicForm::showFormWithValue($d_form_id, true);
        // echo "<pre>"; print_r($result); die;
        $service_user_id = $result['service_user_id'];
        $result = $result['form_data'];
        // echo $service_user_id; die;
        // return $result;

        $page = 'su-dynamic-form';
        return view('backEnd.serviceUser.dynamicForm.dynamic_form', compact('result','page','service_user_id', 'd_form_id'));       
    }

    public function edit(Request $request) {

        // echo "<pre>"; print_r($request->input()); die;
        $data = $request->input();
        $service_user_id = $data['service_user_id'];
        /* if(isset($data['formdata'])){
                   $data['formdata'] = array_values($data['formdata']);
                } else{
                   return redirect()->back()->with('error','No input field added in the form.');
                }
        */
        $d_form_id = $data['d_form_id'];
        
        if(!empty($d_form_id)) {
            $form                   = DynamicForm::find($d_form_id); 
            if(!empty($form)) {
                $form->title        = $data['title'];
                $form->date         = date('Y-m-d',strtotime($data['date']));
                $form->details      = $data['details'];
                $form->pattern_data = json_encode($data['formdata']);
                if($form->save()) {
                   return redirect('admin/service-user/dynamic-forms/'.$service_user_id)->with('success','Form updated successfully.'); 
                }  else {
                   return redirect()->back()->with('error','Some error occurred. Please try after sometime.'); 
                } 
            }
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
    }

    public function delete($d_form_id = null) {  
        
        if(!empty($d_form_id)) {

            $su_dynamic_form =   DynamicForm::where('id', $d_form_id)->first();

            if(!empty($su_dynamic_form)) {

                $su_home_id = ServiceUser::where('id', $su_dynamic_form->service_user_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $su_home_id) {

                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
                DynamicForm::where('id', $d_form_id)->update(['is_deleted'=>'1']);
                return redirect()->back()->with('success','Dynamic Form deleted Successfully.'); 
            } else {
                return redirect('admin/')->with('error','Sorry, Dynamic Form does not exist'); 
            }
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }
    }

}