<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_taxonomy extends Model
{
    protected $connection = 'frontend';
    protected $fillable = ['category', 'post_id' ];
}
