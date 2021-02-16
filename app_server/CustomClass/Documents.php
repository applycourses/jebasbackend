<?php
/**
 * Created by PhpStorm.
 * User: deepankar
 * Date: 7/11/17
 * Time: 2:40 PM
 */

namespace App\CustomClass;
use App\StudentList;
use App\Documents as DocumentsModel;

class Documents
{
    private $student_id;

    public function GetStudentDocuments($student_id){
       $data =  DocumentsModel::where('student_id',$student_id)->get();
       return $data;
    }
    public function document_link(){
    	return "Okay";
    }
}