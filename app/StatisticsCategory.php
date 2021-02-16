<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticsCategory extends Model
{
    protected $connection = 'frontend';
    protected $fillable = ['name'];
}
