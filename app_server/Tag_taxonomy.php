<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_taxonomy extends Model
{
    protected $connection = 'frontend';
    protected $fillable = ['tag', 'post_id'];
}
