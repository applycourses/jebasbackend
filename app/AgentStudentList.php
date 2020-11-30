<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AgentStudentList extends Model
{
     protected $connection = 'agent';
     protected $table = 'students';
     protected $fillable = [
         'student_id', 'name', 'email', 'secondary_email', 'password', 'fname', 'lname', 'dob', 'phone', 'country', 'state', 'citizenship', 'gender', 'subscribe', 'confirm', 'skype', 'facebook', 'twitter', 'instagram', 'linkedin', 'whatsapp', 'viber', 'wechat', 'line', 'hangout'];

    public function setdobAttribute($value)
    {
        $dob = Carbon::parse($value);
        $dob = $dob->format('Y-m-d');
        $this->attributes['dob'] = $dob;
    }
  
    public function getdobAttribute($value)
    {
    	$dob = Carbon::parse($value);
        return $dob->format('d-m-Y');
    }

    public function country(){
    	return $this->belongsTo('App\Country');
    }
      public function state(){

        return $this->belongsTo('App\State');
    }
    public function citizenship($id){
        return Country::find($id)->name;
    }

    public static function get_student_id_from_application_id($application_id){
       $student_id = AgentApplication::find($application_id)->student_id;
       $user     = AgentStudentList::find($student_id);
       return $user;
    }
    //$type student_id || application_id || course_applied_id
    //$id is numeric
    public static function current_stage($type,$id){
        if($type == 'student_id'){
            
        }
        if($type == 'application_id'){
            $student_id = Application::find($id)->student_id;
            $user       = StudentList::find($student_id);
            return Stage::where('student_id',$user->id)->first()->stage;
        }
        if($type == 'course_applied_id'){

        }
    }

}
