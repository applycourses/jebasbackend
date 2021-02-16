<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminEmailLog extends Model
{
   protected $fillable = [ 'subject', 'body', 'student_id', 'user','email','paths'];
   protected $casts = [
        'user'  => 'array',
        'paths' => 'array'
    ];
  
}
