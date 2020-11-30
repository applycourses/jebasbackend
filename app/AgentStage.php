<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentStage extends Model
{
    protected $connection = 'agent';
    protected $fillable = ['student_id','stage_id'];
    protected $table = 'student_stages';

    public static function UpdateStage($id,$stage){
        $current_stage =  AgentStage::where('student_id',$id)->first()->stage;
        if($current_stage <  $stage){
            $current_stage = AgentStage::where('student_id',$id)->update(['stage_id' => $stage]);
        }
    }


}
