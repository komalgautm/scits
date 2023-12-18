<?php

namespace App\Http\Controllers\backEnd\serviceUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceUser, App\Mood, App\ServiceUserMood;
use Session;

class MoodController extends Controller
{
    public function index(Request $request, $service_user_id)	{

    	$home_id = Session::get('scitsAdminSession')->home_id;
    	$su_home_id = ServiceUser::where('id', $service_user_id)->value('home_id');
    	if($home_id != $su_home_id) {

    		return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
    	}

        $su_moods = ServiceUserMood::where('su_mood.is_deleted', '0')
                                    ->where('su_mood.home_id', $home_id)
                                    ->where('su_mood.service_user_id', $service_user_id)
                                    ->select('su_mood.*', 'mood.id as mood_id', 'mood.name', 'mood.image')
                                    ->join('mood', 'mood.id', 'su_mood.mood_id')
                                    ->orderBy('su_mood.id', 'desc');

    								
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

                $limit = 25;
            }
        }
        if(isset($request->search))
        {
            $search   = trim($request->search);
            $su_moods = $su_moods->where('mood.name','like','%'.$search.'%');
            
        }

        $su_moods = $su_moods->paginate($limit);

    	$page = 'moods';
    	return view('backEnd.serviceUser.moods.mood', compact('page', 'limit', 'search', 'su_moods', 'service_user_id'));
    }

    public function edit(Request $request, $su_mood_id) {

        if($request->isMethod('post'))
        {   
            $data = $request->all();
            $su_mood                = ServiceUserMood::find($su_mood_id);
            $service_user_id        = $su_mood->service_user_id;
            $su_mood->suggestions   = $request->suggestions;
            
            if($su_mood->save()) {

               return redirect('admin/service-user/moods/'.$service_user_id)->with('success','Suggestion added successfully.'); 
            }  else   {

               return redirect()->back()->with('error','Suggestion could not be added.'); 
            }  
        }
        
        $su_mood = ServiceUserMood::where('su_mood.id', $su_mood_id)
                                            ->join('mood', 'mood.id','su_mood.mood_id')
                                            ->select('su_mood.*', 'mood.id as mood_id', 'mood.name', 'mood.image')->first();

        
        if(!empty($su_mood)) {
            
            //compare with su home_id
            $su_home_id = ServiceUser::where('id', $su_mood->service_user_id)->value('home_id');
            $service_user_id = ServiceUser::where('id', $su_mood->service_user_id)->value('id');

            $home_id = Session::get('scitsAdminSession')->home_id;
            
            if($home_id != $su_home_id) {

                return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
            } 
            
        } else  {
            return redirect('admin/')->with('error','Sorry, Record does not exists');
        }
        $moods = Mood::where('is_deleted', '0')->where('home_id', $home_id)->select('id', 'name', 'image')->get();

        $page = 'moods';
        return view('backEnd.serviceUser.moods.mood_form', compact('su_mood', 'moods', 'page', 'service_user_id', 'su_mood_id'));
    }

    public function delete($su_mood_id) {  
        
        if(!empty($su_mood_id)) {

            $su_mood =   ServiceUserMood::where('id', $su_mood_id)->first();

            if(!empty($su_mood)) {

                $su_home_id = ServiceUser::where('id', $su_mood->service_user_id)->value('home_id');
                $home_id = Session::get('scitsAdminSession')->home_id;
                
                //compare with su home_id
                if($home_id != $su_home_id) {

                    return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
                }
                ServiceUserMood::where('id', $su_mood_id)->update(['is_deleted'=>'1']);
                return redirect()->back()->with('success','Mood deleted Successfully.'); 
            } else {

                return redirect('admin/')->with('error','Sorry, Mood does not exist'); 
            }
        }
    }
}