<?php

namespace App\Mail\course;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class shortlist extends Mailable
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
    public function build()
    {
       // return $data;
        return $this->from('noreply@applycourses.com','Applycourse')
                    ->subject('Successfully Course Shortlisted for '.$this->data['course_name'].' at '.$this->data['univ_name'].' | Applycourses')
                    ->view('contents.mails.course.shortlist');
    }
}
