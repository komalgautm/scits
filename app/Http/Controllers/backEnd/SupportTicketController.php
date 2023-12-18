<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session; 
use App\ServiceUser, App\SupportTicket, App\SupportTicketMessage;  
use DB; 
use Hash;

class SupportTicketController extends Controller
{
    public function index(Request $request) {     
        
        $home_id = Session::get('scitsAdminSession')->home_id;

        if(empty($home_id)) {
            return redirect('admin/')->with('error',NO_HOME_ERR);
        }

        $support_ticket_query = SupportTicket::select('id','title','status')->where('is_deleted','0')->where('home_id',$home_id);

        $search = '';

        if(isset($request->limit))
        {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        }else{

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 25;
            }
        }

        if(isset($request->search))
        {
            $search = trim($request->search);
            $support_ticket_query = $support_ticket_query->where('title','like','%'.$search.'%');    //search by title
        }

        $support_tickets = $support_ticket_query->orderBy('id','desc')->paginate(25);

        $page='support_ticket';
        return view('backEnd.support_tickets', compact('page','limit', 'home_id','support_tickets','search')); 
    }

    // public function add(Request $request)
    // {   
    //     if($request->isMethod('post'))
    //     { 
    //         $data = $request->input();
    //         $support_ticket                    =  new SupportTicket;
    //         $support_ticket->title             =  $request->title;
    //         $support_ticket->status            =  $request->status;
    //         $support_ticket->save();

    //         $support_ticket_message              = new SupportTicketMessage;
    //         $support_ticket_message->ticket_id   = $ticket_id;
    //         $support_ticket_message->sender_type = 1;
    //         $support_ticket_message->message     = $request->message;

    //         $support_ticket_message->save();
                
    //         return redirect('admin/support-ticket/')->with('success', 'New Support Ticket added successfully.');
           
    //     }
    //     // $page='support_ticket';
    //     return view('backEnd.support_ticket_form', compact('page'));
    // }
            
    // public function edit(Request $request, $support_ticket_id, $support_tickets_message_id=null)
    // {   
    //     $support_tickets    =  SupportTicket::find($support_ticket_id);
    //     $service_user_id    = $support_tickets->service_user_id;

    //     $support_tickets_message    =  SupportTicketMessage::find($support_ticket_id);
    //     // $service_user_id    =  $support_tickets_message->service_user_id;
    //     //$support_tickets_message->service_user_id   =  $service_user_id; 

    //     if($request->isMethod('post'))
    //     {   
    //         $data = $request->input();

    //         $support_tickets->title            =  $data['title'];
    //         $support_tickets->status           =  $data['status'];    
            
    //        if($support_tickets->save())
    //         {
    //            return redirect('admin/users/support-tickets/'.$service_user_id)->with('success','Support Ticket Updated Successfully.'); 
    //         } 
    //        else
    //         {
    //            return redirect()->back()->with('error','Support Ticket could not be Updated Successfully.'); 
    //         }  
    //     }

    //     $support_tickets = DB::table('support_ticket')
    //                 ->where('id', $support_ticket_id)
    //                 ->first();
    //     $support_tickets_message = DB::table('support_ticket_message')
    //                 ->where('id', $support_tickets_message_id)
    //                 ->first();


    //     $page = 'support_tickets';
    //     return view('backEnd.support_tickets_form', compact('support_tickets','page','service_user_id', 'support_ticket_message'));
    // }
        
    public function delete($support_ticket_id) {   

       if(!empty($support_ticket_id))
        {   
            $home_id = Session::get('scitsAdminSession')->home_id;
            $updated = SupportTicket::where('id', $support_ticket_id)->where('home_id', $home_id)->update(['is_deleted' => '1']);
            //return redirect()->back()->with('success','Support Ticket deleted Successfully.'); 
            if($updated){
                return redirect()->back()->with('success','Support Ticket deleted Successfully.'); 
            } else{
                return redirect('admin/')->with('error',UNAUTHORIZE_ERR); 
            }
        } else {
                return redirect('admin/')->with('error','Support Ticket does not exists.'); 
        }
    }

    public function view_ticket(Request $request, $ticket_id) {   
        
        $tkt_home_id = SupportTicket::where('id',$ticket_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;

        if($tkt_home_id == $home_id) {
            $tickets_chat = SupportTicketMessage::where('ticket_id', $ticket_id)->get()->toArray();
            //$last_ticket_chat = SupportTicketMessage::where('ticket_id', $ticket_id)->orderBy('id','desc')->value('id'); 
            // echo "<pre>";
            // print_r($tickets_chat);
            // die;      
        } else {
            return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
        }
        $page="support_ticket";
        return view('backEnd/support_ticket_view', compact('page','tickets_chat'));
    }

    public function add_ticket_mesg(Request $request) {
        
        if($request->isMethod('post')){
            $data = $request->all();

            $home_id = Session::get('scitsAdminSession')->home_id;
            $support_ticket = SupportTicket::where('id',$data['ticket_id'])->where('home_id', $home_id)->first();
            if(!empty($support_ticket)) {
                $ticket_mseg                = new SupportTicketMessage;
                $ticket_mseg->ticket_id     = $data['ticket_id'];
                $ticket_mseg->sender_type   = 1;
                $ticket_mseg->message       = $data['chat_input'];

                if($ticket_mseg->save()){
                    
                    $resp = $this->show_msg($request,$ticket_mseg->ticket_id);
                    echo $resp; die;
                }
                else{
                    echo '0';
                }
            } else {
                //echo UNAUTHORIZE_ERR;
                return 'You are not authorized to send the message.';
                //return redirect('admin/')->with('error', UNAUTHORIZE_ERR);
            }
            die;
        }
    }

    public function show_msg(Request $request, $ticket_id) { 

        $tkt_home_id = SupportTicket::where('id',$ticket_id)->value('home_id');
        $home_id = Session::get('scitsAdminSession')->home_id;
        if($tkt_home_id == $home_id) {
            $tickets_chat = SupportTicketMessage::where('ticket_id', $ticket_id)->get()->toArray();
            //$last_ticket_chat = SupportTicketMessage::where('ticket_id', $ticket_id)->order('id','desc')->value('id');
            echo '<div class="chat-conversation">
                     <ul class="conversation-list">';

            foreach ($tickets_chat as $key => $value) {
                if($value['sender_type'] == 1){
                    $admin_class = 'even';
                }
                else{
                     $admin_class = 'odd';
                }

            echo '<li class="clearfix '.$admin_class.'">
                    <div class="conversation-text">
                        <div class="ctext-wrap">
                          <p>'.$value['message'].'
                            <i>'.date('g:i a d-M-Y',strtotime($value['created_at'])).'</i>
                          </p>    
                        </div>  
                    </div>
                </li>';
            }
            echo '</ul></div>';
            
        } 
    }
}