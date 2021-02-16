<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EnquiryReply;

class EnquiryReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct(EnquiryReply $enquiry)
    {
        $this->data = $enquiry;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@applycourses.com','Applycourse')
                    ->subject('Enquiry Ref No '.$this->data->enquiry_no .'- applycourses.com')
                    ->markdown('emails.enquiry.enquiryReply');


    }
}
