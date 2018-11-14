<?php

namespace App\Services;

use App\Models\FundsManagement;
use App\Models\MemberStatus;
use App\Models\Order;

class FundsManagementServices
{

    public function get_debit_users()
    {

        $debit_users = Order::whereIn('payment_status', ['pay_first', 'pay_on_delivery', 'taobao_pay', 'payment_days_user', 'payment_days_user', 'pay_in_advance'])
            ->where('order_status', '<>', 'intention_to_order')->get()->implode('user_id', ',');

        return explode(',', $debit_users);
    }

    //计算站内可用资金
    public function Internal_funds($financial_details)
    {
        $arr['pay']=0;
        $arr['deposit']=0;
        foreach ($financial_details as $item){
            if ($item->type == 'pay' || $item->type == 'down_payment') {
                $arr['pay']+= $item->price;
            }
            if ($item->type == 'deposit') {
                $arr['deposit']+= $item->price;
            }
        }

        return $arr['deposit'] - $arr['pay'];
    }
    //存入
    public function deposit($request)
    {
        $data=$request->all();
        $data['type']='deposit';
        $data['operate']=auth('admin')->user()->account;
        FundsManagement::create($data);
    }
        //支付订单 或这定金
    public function pay($request)
    {
        $data=$request->all();
        $data['operate']=auth('admin')->user()->account;

        \DB::transaction(function () use ($request,$data){
            if($request->get('type') == 'pay' ){
                $data['comment']='用于支付【'.implode(',',$data['serial_number']).'】的货款！';
                $payment_status='account_paid';
            }else{
                $data['comment']='用于支付【'.implode(',',$data['serial_number']).'】的定金！';
                $payment_status='pay_in_advance';
            }
            Order::whereIn('serial_number',$request->get('serial_number'))->update(['payment_status'=>$payment_status]);
            FundsManagement::create($data);

        });

    }
//获取参数
    public
    function getParameters($parts = '')
    {

        $status = MemberStatus::all();
        $i = 1;
        foreach ($status as $item) {
            $arr[$item->type][$item->identifying] = $item->name;
            if ($item->type == 'order_type') {
                $arr['order_type_code'][$item->identifying] = $i++;
            }
        }
        return $arr;
    }
}

?>