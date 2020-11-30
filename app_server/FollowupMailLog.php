<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowupMailLog extends Model
{
    protected $connection = 'stu';
    protected $table= 'followup_logs';
}
