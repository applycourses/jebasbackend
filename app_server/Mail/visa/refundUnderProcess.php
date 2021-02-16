<?php

namespace App\Mail\visa;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class refundUnderProcess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $student_detail;
     public $university_detail;
     public $course_detail;
      public function __construct($student_detail,$university_detail,$course_detail)
      {
          $this->student_detail    = $student_detail;
          $this->university_detail =$university_detail;
            $this->course_detail   =$course_detail;
      }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tuition Fees Refund Under Process for '.  $this->course_detail->name .' at '.  $this->university_detail->name .'- applycourses.com')
                    ->markdown('emails.visa.refundUnderProcess');
    }
}
