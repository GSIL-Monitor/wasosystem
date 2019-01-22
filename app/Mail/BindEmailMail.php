<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BindEmailMail
{
    use Queueable, SerializesModels;

    /**
     * BindEmailMail constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $code =rand(100000,999999);
        cache(['email_code' => $code], config('app.expiresAt'));
        return $this->view('emails.bind_email')->subject("网烁客服系统")->with([
            'code'=>$code
        ]);;
    }
}
