<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberCenterController extends Controller
{

    public function index()
    {
        $orders=user()->orders;
        $debt_price=$orders->filter(function ($item, $key) {
            return $item->order_status != 'intention_to_order' &&
                   $item->payment_status != 'account_paid';
        })->sum('total_prices');
        $intention_to_order_count=$orders->filter(function ($item){
            return $item->order_status == 'intention_to_order';
        })->sum('num');
        $placing_orders_count=$orders->filter(function ($item){
            return $item->order_status == 'placing_orders';
        })->sum('num');
        $order_acceptance_count=$orders->filter(function ($item){
            return $item->order_status == 'order_acceptance';
        })->sum('num');
        $in_transportation_count=$orders->filter(function ($item){
            return $item->order_status == 'in_transportation';
        })->sum('num');
        $arrival_of_goods_count=$orders->filter(function ($item){
            return $item->order_status == 'arrival_of_goods';
        })->sum('num');
//        $user_notifications=UserNotification::latest()->get();
//        $user_notifications=$user_notifications->filter(function ($item){
//            $grade=user()->grades->identifying;
//            return in_array('all',$item->to_user) || in_array($grade,$item->to_user) || in_array(user()->id,$item->to_user);
//        });
//        $user_notification_ids=$user_notifications->pluck('id');
//        $count=user()->notification()->whereIn('notification_id',$user_notification_ids)->whereState(false)->count();
//        $expiresAt = now()->addMinutes(10);
//        cache()->put('user_notifications',$user_notifications,$expiresAt);
//        cache()->put('user_notification_count',$count,$expiresAt);
        return view('member_centers.index',compact('debt_price','orders','intention_to_order_count','placing_orders_count','order_acceptance_count','in_transportation_count','arrival_of_goods_count'));
    }
}
