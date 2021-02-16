<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CountryProfile extends Model
{
    protected $fillable   = ['country', 'fb_page','statistics', 'about', 'featuredImage', 'status', 'study_in_country', 'living_in_country', 'study_option', 'scholarship_money', 'international_student', 'education_system'];
    protected $connection = "frontend";
}
