<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faqs extends Model
{
  protected $fillable = ['category', 'question', 'answer']; 
}
