<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignApplication extends Model
{
    protected  $connection = 'stu';
    protected  $table = 'application_assigns';
    protected  $fillable = ['application_id', 'country', 'type', 'name', 'department', 'assigned_by', 'status'];
   

    public function country($id){
        return Country::find($id)->name;
    }
    public function get_name($type,$id){
        if($type == 'university'){
           return University::find($id)->name;
        }
    }
    public function get_department($type,$department){
        if($type == 'university'){
            return UniversityDepartment::find($department)->first()->name;
        }
    }

}
