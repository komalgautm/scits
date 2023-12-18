<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contact_us";
    protected $fillable = ['user_name','subject','email','message'];
}