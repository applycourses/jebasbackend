<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaSetting extends Model
{
    protected $connection = 'frontend';
    protected $fillable = ['student_id', 'visa_id', 'category', 'attachment'];
    protected $casts = [
        'visa_forms' => 'array',
        'documents' => 'array',
    ];
}
