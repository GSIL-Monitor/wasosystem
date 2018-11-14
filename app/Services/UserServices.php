<?php

namespace App\Services;
use App\Events\OrderSend;
use App\Models\DemandManagement;
use App\Models\Order;
use App\Models\ProductGood;

class UserServices
{
    public static function member_center_parts($status='member_center_parts')
    {
        return user()->user_product()->whereType($status)->oldest('product_number')->get();
    }
    public static function delete_member_center_parts($status='member_center_parts')
    {
        $ids=self::member_center_parts($status='member_center_parts')->pluck('id');
        return user()->user_product()->detach($ids);
    }
    public static  function get_product()
    {
        $data=request()->except('_token');
        $good=ProductGood::findOrFail($data['product_good_id']);
        $data['product_number']=$good->product->bianhao;
        $data['product_good_price']= $good->price[user()->grade];
        $data['type']= 'member_center_parts';
        return $data;
    }
    //添加物料
    public function add_user_parts($status='member_center_parts'){
        \DB::transaction(function () use ($status){
            $user_product=self::member_center_parts($status);
            $data=self::get_product();
            $where_product=$user_product->firstWhere('id',$data['product_good_id']);
            if(!empty($where_product)){
              $product_good_num=$where_product->pivot->product_good_num + 1;
              user()->user_product()->updateExistingPivot($where_product->pivot->product_good_id,['product_good_num'=>$product_good_num]);
            }else{
             user()->user_product()->attach($data['product_good_id'],$data);
            }
        });
    }
    //初始化订单数据
    public static  function initial_order_data(){
        $order=request()->all();
        $order['user_id']=user()->id;
        $order['serial_number']='SN'.date('YmdHis',time());
        $order['unit_price']= $order['total_prices'];
        $order['num']=1;
        $order['order_status']='intention_to_order';
        $order['message_status']='intention_to_order';
        $order['payment_status']='pay_first';
        $order['service_status']=0;
        $order['code']=$order['code'];
        $order['invoice_type']=$order['invoice_type'];
        $order['parcel_count']=1;
        $order['urgent']=false;
        $order['flow_pic']=false;
        $order['in_common_use']=false;
        $order['market']=user()->admins->account;
        $order['pic']=[];
        return $order;
    }
    //初始化需求数据
    public static  function initial_demand_data(){
        $demand['user_id']=user()->id;
        $demand['demand_number']='XQ'.date('YmdHis',time());
        $demand['visitor_details_id']= user()->visitor_details->id;
        $demand['demand_status']='demand_consult';
        $demand['customer_status']='initial_contact';
        $demand['admin']=user()->administrator;
        $demand['analog_data']=false;
        $demand['send']=false;
        return $demand;
    }
    //获取订单物料所需参数
    public static function GetOrderMaterialParameters($status)
    {
        $good_nums=request()->input('good_list');
        $goods = [];
        foreach (self::member_center_parts($status) as $item) {
            $goods[$item->pivot->product_good_id] = ['product_good_num' =>$good_nums[$item->id], 'product_number' => $item->pivot->product_number, 'product_good_price' =>$item->pivot->product_good_price, 'product_good_raid' => $item->pivot->product_good_raid];//将物料产品打包到二维数组
        }
        return $goods;
    }
    //创建需求跟订单
    public function create_demand_order(){
        \DB::transaction(function (){
            $demand=DemandManagement::create(self::initial_demand_data());
            $order=Order::create(self::initial_order_data());
            $order->order_product_goods()->sync(self::GetOrderMaterialParameters('member_center_parts'));
            $demand->demand_management_order()->sync($order->id);
            self::delete_member_center_parts('member_center_parts');
            event(new OrderSend($order)); //发送钉钉前台下单
        });
    }



}

?>