<?php

namespace App\Mail\course;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class application extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@applycourse.in','Applycourse Notification')
                    ->subject('Application verified for '.$this->data['course_name'].' at '.$this->data['university_name'].'- applycourses.com')
                    ->view('contents.mails.course.application');
    }
}
