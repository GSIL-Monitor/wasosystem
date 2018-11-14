<?php

namespace App\Mail;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $order;

    /**
     * OrderMail constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
     $order->load('user');
     $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order')->subject("网烁客服系统")->with([
            'logistics_info'=>$this->order->logistics_info,
            'serial_number'=>$this->order->serial_number,
            'username'=>$this->order->user->username,
            'password'=>decrypt($this->order->user->clear_text),
            'last_login_time'=>$this->order->user->last_login_time,
            'created_at'=>$this->order->user->created_at,
            'send_time'=>today()->format('Y 年 m 月 d 日')
        ]);
    }
}
