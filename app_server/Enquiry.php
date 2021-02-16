<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
     protected $connection = 'stu';
     protected $fillable = [
        'enquiry_no', 'name', 'email','contact','web_contact','date','country_from','willing_country','citizenship','status','study_level_id', 'query','type','student_id','skype','replies'
    ];
}
