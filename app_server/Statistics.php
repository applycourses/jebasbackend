<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
   protected $connection = 'frontend';
   protected $fillable = ['country', 'category','details','total','currency'];
}
