<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Message;
class MessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message')->subject("网烁客服系统")->with([
            'productName'=>$this->message->product->name,
            'product_id'=>$this->message->product_id,
            'content'=>$this->message->content,
            'shaixuan_canshu'=>$this->message->shaixuan_canshu,
            'qq'=>$this->message->qq,
            'name'=>$this->message->name,
            'phone'=>$this->message->phone
        ]);
    }
}
