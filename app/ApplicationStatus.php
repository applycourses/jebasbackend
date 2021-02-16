<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected  $connection = 'stu';
    protected  $fillable =  ['application_id','status','application_status_document','remarks'];
}
