<?php

namespace App\Presenters;
use App\Models\Admin;
use Collective\Html\FormBuilder;

class DemandManagementParamenter
{
    //订单
    public function orderList($demand_management)
    {
        $orders=$demand_management->demand_management_order;
        $html='';
        foreach ($orders as $item){
            $new=$item->serial_number;
            if($item->created_at == $item->updated_at){
                $new='<span class="redWord new">'.$item->serial_number.'</span> <i class="newOrder"></i>';
            }
            $html.="<a class='changeWeb' data_url='".route('admin.orders.edit',$item->id)."' >".$new."</a><br/>";
        }
        return $html;
    }
    //订单里最大金额
    public function orderMaxPrice($demand_management)
    {
        $max_prices=$demand_management->demand_management_order->max('total_prices');
        return $max_prices ?? 0;
    }
    //订单里成交金额
    public function account_paid($demand_management)
    {
        $orders=$demand_management->demand_management_order/*()->wherePaymentStatus('account_paid')->sum('total_prices')*/;
        $sum_prices=$orders->sum(function ($item){
            if($item->payment_status == 'account_paid'){
                return $item->total_prices;
            }
      });
        return $sum_prices ?? 0;
    }
    //订单里成交金额
    public function sum_prices($demand_management)
    {
        $orders=$demand_management->demand_management_order/*()->wherePaymentStatus('account_paid')->sum('total_prices')*/;
        $sum_prices=$orders->sum(function ($item){
            if($item->payment_status == 'account_paid'){
                return $item->total_prices;
            }
        });
        return $sum_prices ?? 0;
    }
    //客户需求
    public function customer_demand($demand_management)
    {
        $demands=$demand_management->demand_management_filtrate->implode('name','|');
        $explain=$demand_management->explain ?$demand_management->explain.'|':'';
        return $explain.$demands ?? '';
    }
    //筛选答案
    public function filtrateList($demand_management_filtrate)
    {
        $arr=[];
        foreach ($demand_management_filtrate as $key=>$category) {
                $nextSiblings=$category->getSiblings()->pluck('name','id');

                if($nextSiblings->isNotEmpty()){ //判断是否有兄弟数据  获取所有兄弟数据  添加自己进数组
                    $nextSiblings->prepend($category->name, $category->id);
                    $arr[$category->id]=$nextSiblings->prepend('请选择一项', 0);
                }else{
                        // 添加自己进数组
                    $arr[$category->id]=collect([0=>'请选择一项',$category->id=>$category->name]);
                }
        }
        return $arr;
    }
    //获取协同人员名称
    public function assistant($demand_management)
    {
        if($demand_management->assistant){
            return Admin::whereIn('id',$demand_management->assistant)->get()->implode('name',',');
        }
    }
}