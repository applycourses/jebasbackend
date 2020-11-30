<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLogs extends Model
{
    protected $fillable = ['student_id', 'activity', 'user'];
    protected $casts = [
       'user' => 'array',
    ];
}
