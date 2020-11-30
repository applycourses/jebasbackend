<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaStatus extends Model
{
    protected $connection = "stu";
    protected $fillable = ['student_id', 'visa_id', 'category', 'attachment', 'remarks'];
    protected $casts = [
        'attachment' => 'array',
    ];
}
