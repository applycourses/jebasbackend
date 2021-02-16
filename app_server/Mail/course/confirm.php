<?php

namespace App\Mail\course;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class confirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->from('noreply@applycourses.com','Applycourses')
                    ->subject('Course Confirmation for '.$this->data['course_name'].' at '.$this->data['univ_name'].' - applycourses.com')
                    ->markdown('emails.course.confirm');
    }
}
