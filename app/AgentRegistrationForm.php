<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentRegistrationForm extends Model
{
    protected $connection = 'agent';
    protected $table = 'students_registration_forms';
    protected $fillable = ['student_id', 'step1', 'step2', 'step3', 'status', 'step1_completed_at', 'step2_completed_at', 'step3_completed_at', 'save_log'];
    protected $dates = ['dob'];
    public function country(){
    	return $this->belongsTo('App\Country');
    }

}
