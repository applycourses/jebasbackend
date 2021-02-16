<?php

namespace App\Mail\application;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Refunded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
      public $student_details;
      public $course_details;
      public $university_details;
      public function __construct($student_details,$course_details,$university_details)
      {
          $this->university_details = $university_details;
          $this->student_details    = $student_details;
          $this->course_details     = $course_details;
      }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $course_name     = $this->course_details->name;
      $university_name = $this->university_details->name;

      return $this->subject("Tuition Fees Refund Confirmation  for $course_name at $university_name} - applycourses.com")
                  ->markdown('emails.application.Refunded');

    }
}
