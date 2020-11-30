<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryProfileImage extends Model
{
    protected $connection = "frontend";
 protected  $fillable = ['country_profile_id', 'image_name', 'content', 'source', 'image'];
}
