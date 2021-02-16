<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Frontend\Campus;
use Carbon\Carbon;
use Auth;


class CourseApplied extends Model
{
    protected $connection = 'stu';


    protected $fillable = ['course_id', 'student_id', 'university_id', 'campus', 'status', 'shortlisted', 'shortlisted_on', 'shortlisted_remarks', 'confirmed', 'confirmed_on', 'confirmed_remarks', 'document_verified', 'document_verified_on', 'document_verified_remarks', 'application_form', 'application_form_on', 'application_form_remarks', 'application_fee', 'application_fee_on', 'application_fee_remarks', 'moved_to_application', 'moved_to_application_on', 'moved_to_application_remarks', 'withdrawl_remarks', 'withdrawl_on'];

    public function course(){
    	return $this->belongsTo('App\Course');    	
    }   

    public function university(){
    	return $this->belongsTo('App\University');
    }
    public function campus(){
    	return $this->belongsTo('App\Frontend\Campus');
    }
    public function getCampusIdAttribute($value){
        return $value;
       // return Campus::find($value)->name;
    }

    public static function UniversityCourseName($applied_course_id){
        $data = Course::where('courses.id',$applied_course_id)
                    ->join('universities','courses.university_id','=','universities.id')
                    ->select('courses.campus_id','courses.university_id as uni_id','universities.name')
                    ->first();
        return $data;
    }

    public static function GenerateLog($data){
        $insert_data = [
            'category'       => 'course-list',
            'action_by_type' => 'admin',
            'action_on'      => Carbon::now()->format('Y-m-d'),
            'action_by'      => Auth::user()->id,
            'category_id'    => $data['category_id'],
            'action'         => $data['action']
        ];

        $response = Logs::create($insert_data);
        return ($response->id) ? true : false;
    }
    public static function university_name($id){
        $university_id    = CourseApplied::where('id',$id)->first()->university_id;
        $university_name  = University::where('id',$university_id)->first()->name;
        return $university_name;
    }
    public static function course_name($id){
        $course_id    = CourseApplied::where('id',$id)->first()->course_id;
        $course_name  = Course::where('id',$course_id)->first()->course_name;
        return $course_name;
    }
    public static function course_slug($id){
        $course    = CourseApplied::where('course_id',$id)->first();
        $course_id = $course->course_id;
        $course_name  = Course::where('id',$course_id)->first()->slugs;
        return $course_name;
    }
    public static function university_slug($id){
        $university      = CourseApplied::where('course_id',$id)->first();
        $university_id   = $university->university_id;
        $course_name     = University::where('id',$university_id)->first()->slugs;
        return $course_name;
    }
    public static function course_removed($id){
        $update_data = [
            'status'                       => 'removed',
            'shortlisted'                  => NULL,
            'shortlisted_on'               => NULL,
            'shortlisted_remarks'          => NULL,
            'withdrawl_remarks'            => NULL,
            'withdrawl_on'                 => NULL,
            'application_form'             => NULL,
            'application_form_on'          => NULL,
            'application_form_remarks'     => NULL,
            'document_verified'            => NULL,
            'document_verified_on'         => NULL,
            'document_verified_remarks'    => NULL,
            'application_fee'              => NULL,
            'application_fee_on'           => NULL,
            'application_fee_remarks'      => NULL,
            'moved_to_application'         => NULL,
            'moved_to_application_on'      => NULL,
            'moved_to_application_remarks' => NULL,
            'confirmed'                    => NULL,
            'confirmed_on'                 => NULL,
            'confirmed_remarks'            => NULL
        ];
        $response = CourseApplied::find($id)->update($update_data);
        $data['success'] = 1;
        $data['message'] = "Course has been removed!";
        echo json_encode($data);
    }
}
