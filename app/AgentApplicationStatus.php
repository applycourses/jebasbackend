<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentApplicationStatus extends Model
{
    protected  $connection = 'agent';
    protected  $fillable =  ['application_id','status','application_status_document','remarks'];
}
