<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\SupportTicketMessage;


class SupportTicket extends Model
{
    protected $table = 'support_ticket';

    //Relations for fetching   
    // public function supportTicketMessage(){
    // 	return $this->hasOne('App\SupportTicketMessage', 'ticket_id');
    // }
}