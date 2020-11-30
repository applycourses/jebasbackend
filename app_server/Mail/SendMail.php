<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\AdminEmailLog;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $path;
    public function __construct(AdminEmailLog $data,$path)
    {
        $this->data = $data;
        $this->path  = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->path);
        if(count($this->path) > 0){
          $message =  $this->subject($this->data->subject)->markdown('emails.send');
          for ($i=0; $i < count($this->path); $i++) {
            $message->attach(\Storage::disk('s3')->url($this->path[$i]));
          }
        }else{
            $message =  $this->subject($this->data->subject)->markdown('emails.send');
        }

        dd($message);



        return $message;
    }
}
