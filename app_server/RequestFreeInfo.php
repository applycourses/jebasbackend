<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentList;
use Auth;

class RequestFreeInfo extends Model
{
    protected $connection = 'stu';

    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'enquiry_no', 'status', 'ip', 'student_id', 'course_id', 'university_id'
    ];

    public function university(){
        return $this->belongsTo('App\University');
    }
    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function user(){
        return $this->belongsTo('App\User','student_id');
    }



}
