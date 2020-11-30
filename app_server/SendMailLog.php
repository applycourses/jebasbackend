<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMailLog extends Model
{
    protected $connection = 'frontend';
    protected $fillable = ['student_id', 'mail_name', 'mail_type'];
}
