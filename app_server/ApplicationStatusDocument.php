<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatusDocument extends Model
{
    protected $connection = 'stu';
    protected $fillable   = ['application_id', 'category', 'document_id', 'application_status_id'];
}
