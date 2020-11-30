<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryReply extends Model
{  
    protected $fillable = ['reply', 'enquiry_id', 'user_id', 'user_name', 'enquiry_no','name']; 
    
}
