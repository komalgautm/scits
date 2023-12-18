<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\CareTeam, App\CareTeamJobTitle, App\ServiceUserContacts;  
use DB; 
use Hash;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller { 
    
    public function team_list(Request $request, $service_user_id) { 

        //comparing su home_id
        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($home_id == $su_home_id) {
            //'jt.title as job_title's
            $contacts_query = DB::table('su_contacts')
                    ->select('su_contacts.id','su_contacts.image','su_contacts.name','su_contacts.phone_no','su_contacts.job_title_id')
                    //->leftJoin('care_team_job_title as jt','su_contacts.job_title_id','jt.id')
                    ->where('su_contacts.service_user_id',$service_user_id)
                    ->where('su_contacts.is_deleted','0');

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
                $contacts_query     = $contacts_query->where('su_contacts.name','like','%'.$search.'%');
            }

            $care_team = $contacts_query->paginate($limit);
        } else {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }    
        //echo '<pre>'; print_r($care_team); die;
        $page = 'care_team';
        return view('backEnd.serviceUser.contacts.contacts', compact('page', 'limit','care_team', 'search', 'service_user_id'));
    }

    public function add(Request $request, $service_user_id) {   

        $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');

        if($request->isMethod('post')) {   

            //comparing su home_id
            // $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            
            $home_id = Session::get('scitsAdminSession')->home_id;
            if($home_id == $su_home_id) {

                $new_contact                      =  new ServiceUserContacts;
                $new_contact->service_user_id     =  $service_user_id;
                $new_contact->name                =  $request->name;
                $new_contact->job_title_id        =  $request->job_title_id;
                $new_contact->phone_no            =  $request->phone_no;
                $new_contact->email               =  $request->email;
                $new_contact->address             =  $request->address;
                $new_contact->home_id             =  $su_home_id;
               
                if(!empty($_FILES['image']['name'])) {
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                    {
                        $destination = base_path().contactsBasePath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        {
                            $new_contact->image = $new_name;
                        }
                    }
                }
                if(!isset($new_contact->image)) {
                    $new_contact->image = '';
                }
              
                if($new_contact->save()){           
                        return redirect('admin/service-users/contacts/'.$service_user_id)->with('success', 'Contact added successfully.');
                }else {
                       return redirect()->back()->with('error', 'Some error occurred. Please try again after sometime.');
                }
            } else {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
        }
        //$care_team_job_title = CareTeamJobTitle::where('home_id', $su_home_id)->where('is_deleted', '0')->select('id','title')->get();
        $page = 'care_team';
        return view('backEnd.serviceUser.contacts.contacts_form', compact('page','service_user_id'));
    }



    public function edit(Request $request, $contact_id) {     
        
        $contact             = ServiceUserContacts::find($contact_id);

        //echo "<pre>"; print_r($contact); die;
        if(!empty($contact)) {

            $service_user_id    = $contact->service_user_id;
            $su_home_id = ServiceUser::where('id',$service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            
            if($home_id != $su_home_id) {
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            }
            
            //$care_team_job_title = CareTeamJobTitle::where('home_id', $su_home_id)->where('is_deleted', '0')->select('id','title')->get();

            if($request->isMethod('post'))
            {   
                $contact->name                =  $request->name;
                $contact->job_title_id        =  $request->job_title_id;
                $contact->phone_no            =  $request->phone_no;
                $contact->email               =  $request->email;
                $contact->address             =  $request->address;
                
                if(!empty($_FILES['image']['name']))
                {
                    $member_old_image            =  $contact->image;
                    $tmp_image  =   $_FILES['image']['tmp_name'];
                    $image_info =   pathinfo($_FILES['image']['name']);
                    $ext        =   strtolower($image_info['extension']);
                    $new_name   =   time().'.'.$ext; 
                   
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                    {
                        $destination=   base_path().contactsBasePath; 
                        if(move_uploaded_file($tmp_image, $destination.'/'.$new_name))
                        {
                            if(!empty($member_old_image)){
                                if(file_exists($destination.'/'.$member_old_image))
                                {
                                    unlink($destination.'/'.$member_old_image);
                                }
                            }
                            $contact->image = $new_name;
                        }
                    }
                }

                if($contact->save()) {   
                   return redirect('admin/service-users/contacts/'.$service_user_id)->with('success','Contact has been updated successfully.'); 
                }  else   {
                   return redirect()->back()->with('error','Contact could not be Updated.'); 
                }  
            }
        }
        $contact = ServiceUserContacts::where('id', $contact_id)->first();

        if(!empty($contact)) {
            //compare with su home_id
            $su_home_id = ServiceUser::where('id',$contact->service_user_id)->value('home_id');
            $home_id = Session::get('scitsAdminSession')->home_id;
            if($home_id != $su_home_id) { 
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else {
            return redirect('admin/service-users')->with('error','Sorry, Contact does not exists');
        }

        $page = 'care_team';
        return view('backEnd.serviceUser.contacts.contacts_form', compact('contact','page','service_user_id','contact_id','care_team_job_title'));

    }

    public function delete($contact_id) {  
       // echo $contact_id; die;
        if(!empty($contact_id)) {

            $contct_id =   ServiceUserContacts::where('id', $contact_id)->first();
            //echo "<pre>"; print_r($contct_id); die;
         //   if(!empty($contact_id)) {

                $su_home_id = ServiceUser::where('id',$contct_id->service_user_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $su_home_id) {
                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
                $update = ServiceUserContacts::where('id', $contact_id)->update(['is_deleted'=>'1']);
                 //echo "<pre>"; print_r($update); die;
                if($update) {
                    return redirect()->back()->with('success','Contact has been deleted Successfully.'); 
                } else {
                    return redirect()->back()->with('error','Contact cannot be deleted .');
                }
            } else {
                    return redirect('admin/service-users')->with('error','Sorry, Contact does not exists'); 
            }
        
    }
}