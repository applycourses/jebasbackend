<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentApplicationStatusDocument extends Model
{
    protected $connection = 'agent';
    protected $fillable   = ['application_id', 'category', 'document_id', 'application_status_id'];
}
