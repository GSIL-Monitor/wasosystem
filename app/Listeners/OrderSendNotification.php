<?php

namespace App\Listeners;

use App\Events\OrderSend;
use App\Mail\OrderMail;
use App\Models\SendMessage;
use App\Services\MessageSendServices;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OrderSendNotification implements ShouldQueue
{
    protected $message_send;

    /**
     * OrderSendNotification constructor.
     * @param MessageSendServices $messageSendServices
     */
    public function __construct(MessageSendServices $messageSendServices)
    {
        $this->message_send = $messageSendServices;
    }

    /**
     * @param OrderSend $event
     */
    public function handle(OrderSend $event)
    {
        $this->new_order($event);
        $this->order_placing_orders($event);
        $this->order_acceptance($event);
        $this->in_transportation($event);
        $this->order_requirement_deterministic_status($event);

    }
    public function new_order($event)
    {
        if (!empty($event->order->message_status) && $event->order->message_status == 'intention_to_order') {
            ding()->with('registered_customer')->at(explode(',',$event->order->markets->phone))
                ->text('测试信息！！！！ 前台有新订单！请客服人员尽快受理！');
            $event->order->update(['message_status' => 'placing_orders']);
        }
    }
    public function order_placing_orders($event)
    {
        if (!empty($event->order->message_status) && $event->order->message_status == 'intention_to_order' && $event->order->order_status == 'placing_orders') {
            ding()->with('back_office')
                ->text('测试信息！！！！ 有新订单！序列号：' . $event->order->serial_number . '需要受理 ！收到信息后请尽快处理！');
            $event->order->update(['message_status' => 'placing_orders']);
        }
    }

    public function order_acceptance($event)
    {
        if (!empty($event->order->message_status) && $event->order->message_status == 'placing_orders' && $event->order->order_status == 'order_acceptance') {
            ding()->with('technical_section_collaboration')
                ->text('测试信息！！！！ 有新订单！序列号：' . $event->order->serial_number . '需要技术参与，请尽快配合安排！');
            $event->order->update(['message_status' => 'order_acceptance']);
        }
    }

    //在途运输
    public function in_transportation($event)
    {
        if (!empty($event->order->message_status) && $event->order->message_status == 'order_acceptance' && $event->order->order_status == 'in_transportation') {
            $messageStr=$this->check_message($event->order);
            switch ($event->order->user->message_type) {
                case 'email_receiving' : {
                    Mail::to("925239113@qq.com")->queue(new OrderMail($event->order));
                    break;
                }
                case 'phone_receiving' : {
                    $this->message_send->MessageSend(15208128210, $messageStr['phoneStr']);
                    break;
                }
                case 'no_receiving' : {
                    return;
                    break;
                }
                default : {
                    Mail::to("925239113@qq.com")->queue(new OrderMail($event->order));
                    $this->message_send->MessageSend(15208128210, $messageStr['phoneStr']);

                }
            }
            $this->add_message($event->order,$messageStr);
            $event->order->update(['message_status'=>'email_phone_send']);
        }
    }

    public function add_message($order,$messageStr)
    {
            $data['user_id']=$order->user->id;
        if(!empty($messageStr['phoneStr']) && !empty($order->user->phone)){
            $data['type']='phone';
            $data['content']=$messageStr['phoneStr'];
            SendMessage::create($data);
        }
        if(!empty($messageStr['emailStr']) && !empty($order->user->email)){
            $data['type']='email';
            $data['content']=$messageStr['emailStr'];
            SendMessage::create($data);
        }

    }
    public function check_message($order)
    {
        $last_login_time = $order->user->last_login_time;
        $created_at = $order->user->created_at;
        $username = $order->user->username;
        $logistics_info = $order->logistics_info;
        $password = decrypt($order->user->clear_text);
        $send_time =today()->format('Y 年 m 月 d 日');
        $serial_number = $order->serial_number;
        if ($last_login_time == $created_at || empty($last_login_time)) {
            $emailStr = "<div>欢迎新会员{$username}，您在网烁购买的产品(订单号：{$serial_number})已发货,物流信息:{$logistics_info}，您可在我司网站(www.waso.com.cn)查询购买记录及质保服务。账号:{$username}  初始密码:{$password}，谢谢惠顾!<br/>系统邮件无需回复。<br/>成都网烁信息科技有限公司<br/>{$send_time}</div>";
            $phoneStr = "欢迎新会员{$username}，您在网烁购买的产品(订单号：{$serial_number})已发货,物流信息:{$logistics_info}，您可在我司网站(www.waso.com.cn)查询购买记录及质保服务。账号:{$username}  初始密码:{$password}，谢谢惠顾!";
        } else {
            $emailStr = "<div>尊敬的客户：{$username }，您购买的产品(订单号：{$serial_number })已发货,物流信息：{$logistics_info },谢谢惠顾!</div>";
            $phoneStr = "尊敬的客户：{$username }，您购买的产品(订单号：{$serial_number })已发货,物流信息：{$logistics_info },谢谢惠顾!";
        }
        return compact('emailStr','phoneStr');
    }

    public function order_requirement_deterministic_status($event)
    {
        $order_demand_management = $event->order->order_demand_management->first();
        if ($order_demand_management) {
            $demand_management_order = $order_demand_management->demand_management_order;
            if ($demand_management_order->isNotEmpty()) {
                $intention_to_order = $demand_management_order->firstWhere('order_status', 'arrival _of_goods');
                if ($intention_to_order == null && $order_demand_management->demand_status == 'requirement_determination') {
                    $order_demand_management->update(['demand_status' => 'preliminary_scheme']);
                } else {
                    if ($intention_to_order != null) {
                        $order_demand_management->update(['demand_status' => 'requirement_determination']);
                    }
                }
            }
        }
    }
}
