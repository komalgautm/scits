<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class ServiceUserNeedAssistance extends Authenticatable
{
    use Notifiable;
    protected $table = 'su_need_assistance';
}