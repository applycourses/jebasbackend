<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentApplication extends Model
{
    protected $connection = 'agent';
    protected $table = 'students_applications';
    protected  $fillable = ['student_id', 'course_applied_id', 'intake', 'status', 'tution_fee', 'acceptance'];

    public function course(){
        return $this->belongsTo('App\Course');
    }
    public function student(){
      return $this->belongsTo('App\StudentList');
    }
    public function university(){
        return $this->belongsTo('App\University');
    }
    public function additional_exam($id){
        return AdditionalExam::find($id)->name;
    }
    // public function getCourseIdAttribute($value){
    //        return Course::find($value)->name;
    // }
    // public function getUniversityIdAttribute($value){
    //     return $value;
    //     return University::find($value)->name;
    // }

    public static function  UpdateStatus($application_id,$status){
        $app = Application::find($application_id);
        $app->update(['status' => $status]);
    }
    public function course_applied(){
      return $this->belongsTo('App\CourseApplied');
    }
}
