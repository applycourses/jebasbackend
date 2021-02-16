<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestFreeInfoReply extends Model
{
   protected $connection ='stu';
   protected $table= 'request_free_info_conversations';
   protected $fillable = [ 'student_id', 'university_id', 'course_id', 'enquiry_no', 'message', 'ip', 'status', 'admin'];

   public static function student_name($student_id){
       return StudentList::where('id',$student_id)->first()->name;
   }
}
