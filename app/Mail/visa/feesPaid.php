<?php

namespace App\Mail\visa;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class feesPaid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public $student_detail;
     public function __construct($student_detail)
     {
         $this->student_detail = $student_detail;
     }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Visa Fees Payment Confirmation- applycourses.com")
                    ->markdown('emails.visa.feesPaid');
    }
}
