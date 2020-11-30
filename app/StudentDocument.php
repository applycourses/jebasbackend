<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DocumentCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDocument extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected  $connection = 'stu';
   protected  $table = 'documents';
   protected  $fillable = ['student_id', 'category', 'course', 'student_reg_id', 'document_id', 'path', 'student', 'sub_agent_id', 'university_id', 'associate_agent_id', 'admin', 'agent', 'associate_agent', 'uploaded_by', 'uploaded_id'];

   public function category(){
       return $this->belongsTo('App\Category');
   }

   public function category_name($id){
//       return DocumentCategory::find($id)->name;

   }
   public function document(){
       return $this->belongsTo('App\Documents');
   }
   public function getDocumentIdAttribute($value){
       $data = DocumentRequiredName::where('id',$value)->first();
       return $data['name'];
   }
    public function getPathAttribute($value){
        return Storage::disk('s3')->url($value);
    }

}
