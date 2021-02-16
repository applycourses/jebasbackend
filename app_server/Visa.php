<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    protected $table      = "visas";
    protected $connection = "stu";
    protected $fillable   = [ 'course_applied_id', 'application_id', 'student_id', 'status', 'visa_fees', 'visa_discount_fees', 'visa_fees_status', 'dependents', 'processing_fees', 'processed_by', 'medical_test_status', 'medical_test_remarks', 'medical_test_documents', 'police_clearance_status', 'police_clearance_remarks', 'police_clearance_documents', 'sop_status', 'sop_remarks', 'sop_documents', 'withdrawn_status', 'withdrawn_type', 'withdrawn_reason'];

    protected $casts = [
        'dependents' => 'array',
    ];

    public function student(){
        return $this->belongsTo('App\StudentList');
    }

    public function course_applied(){
        return $this->belongsTo('App\CourseApplied');
    }
    public function visa(){
        return $this->hasMany('App\Visa','student_id','student_id');
    }

}
