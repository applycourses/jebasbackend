<?php

namespace App;


use App\Mail\password\verify;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Mail;


class EmailVerification extends Model
{
    protected  $user;
    protected $connection = 'stu';
    protected $table="email_tokens";
    protected $fillable = ['student_id','email_id','token'];

    protected  $time_difference = 60000;
    protected  $token;

    public  function send(){
        $this->user = Auth::user();
        $success = $this->insert();
        return true;
    }

    private function insert(){
        $this->token = $this->generate_token();
        EmailVerification::where('email_id',$this->user->email)->delete();
        $response    = EmailVerification::create(['student_id' => $this->user->id ,'email_id' => $this->user->email,'token' => $this->token]);
        //$this->send_email();
    }
    private function send_email(){
        $data     = ['fname' => $this->user->fname ,'token' => $this->token ];
        $response =  Mail::to($this->user->email)->send(new verify($data));

    }
    public  function generate_token(){
        return str_random(64);
    }

    private function timeDifference(){

    }

}
