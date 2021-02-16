<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DocumentCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    protected $connection = 'stu';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function document_name($id){
        return DocumentRequiredName::find($id)->name;
    }
    public function get_category_name($id){
        if($id)
            return DocumentCategory::find($id)->name;
        else
            return 'N.A';
    }
    public function get_course_name($id){
        if($id)
            return Course::find($id)->name;
        else
            return 'N.A';
    }
    public static function  DocumentName($id){
        return DocumentRequiredName::find($id)->name;
    }



}