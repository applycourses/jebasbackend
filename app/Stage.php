<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $connection = 'stu';
    protected $fillable = ['student_id','stage'];

    public static function UpdateStage($id,$stage){
        $current_stage =  Stage::where('student_id',$id)->first()->stage;
        if($current_stage <  $stage){
            $current_stage = Stage::where('student_id',$id)->update(['stage' => $stage]);
        }
    }


}
