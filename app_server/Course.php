<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   protected $connection  = 'frontend';
   protected $fillable = ['name', 'study_level_id', 'subject_id', 'university_id', 'intake', 'fee', 'duration', 'type', 'description', 'eligibility', 'additional_exam', 'country', 'fee_type', 'tags', 'slugs', 'page_title', 'views', 'documents_id', 'language', 'campus_id'];
   public function university(){
   	return $this->belongsTo('App\University');
   }
   public function country(){
   	return $this->belongsTo('App\Country');
   }
   
}
