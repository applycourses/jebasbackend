<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected  $connection ='frontend';
    protected $fillable =  ['row_id', 'type', 'title', 'description', 'image', 'keywords'];
}
