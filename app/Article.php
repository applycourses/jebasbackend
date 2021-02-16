<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $connection = 'frontend';
    protected $fillable   = ['name', 'image_title', 'image_path', 'description','url'];

}
