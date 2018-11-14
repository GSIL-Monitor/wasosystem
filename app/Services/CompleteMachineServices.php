<?php

namespace App\Services;

use App\Events\OrderSend;
use App\Models\CompleteMachine;
use App\Models\DemandManagement;
use App\Models\Integration;
use App\Models\Order;
use App\Models\ProductGood;
use App\Presenters\ProductGoodParamenterPresenter;

class CompleteMachineServices
{
    public $presenter;
    public function __construct(ProductGoodParamenterPresenter $presenter)
    {
        $this->presenter=$presenter;
    }
    public function get_user_product()
    {
        return user()->user_product()->whereType('complete_machine')->oldest('product_number')->get();
    }
    public function get_user_product_parameters($good)
    {
        $goods = [];
        foreach ($good as $item) {
            $goods[$item->id] = ['product_good_id' => $item->pivot->product_good_id,'product_good_num' => $item->pivot->product_good_num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[user()->grades->identifying], 'product_good_raid' => $item->pivot->product_good_raid, 'type' => 'complete_machine'];//将物料产品打包到二维数组
        }
        return $goods;
    }
    public function set_user_product($good)
    {
        $data=$this->get_user_product_parameters($good);
       return user()->user_product()->attach($data);
    }

    public function checkCpu($good,$data)
    {
        if($good->product_id == 12){
            $product_goods=$this->get_user_product();
            foreach ($product_goods as $item){
                if(str_contains($item->product_id,[14,22])){
                    user()->user_product()->updateExistingPivot($item->id,['product_good_num'=>$data['product_good_num']]);
                }
            }
        }
    }
    public function add_or_delete_user_product()
    {

        $num=request()->input('num');
        $raid=request()->input('product_good_raid');
        $old_id=request()->input('id') ?? 0;
        $user_product_id=request()->input('user_product_id');
        $good=ProductGood::with('product')->whereId(request()->input('product_good_id'))->firstOrFail();
        $data=['product_good_id' => $good->id,'product_good_num' =>$num, 'product_number' => $good->product->bianhao, 'product_good_price' => $good->price[user()->grades->identifying], 'product_good_raid' =>$raid, 'type' => 'complete_machine'];//将物料产品打包到二维数组
        $goods[$good->id] = $data;
        if(request()->input('type') == 'edit'){
            if($good->id != $old_id){
                $this->checkCpu($good,$data);
                user()->user_product()->whereId($user_product_id)->updateExistingPivot($old_id, $data);
            }else{
                $this->checkCpu($good,$data);
                user()->user_product()->updateExistingPivot($good->id, $data);

            }
        }
        if (request()->input('type') == 'delete') {
            user()->user_product()->detach($good->id);

        }
        if(request()->input('type') == 'add'){
            $gd=user()->user_product()->where('product_good_id',$good->id)->first();
            if(empty($gd)){
                user()->user_product()->attach($goods);
            }else{
                $data['product_good_num']=$gd->pivot->product_good_num + $num;
               user()->user_product()->updateExistingPivot($good->id, $data);
            }
        }
        return  $this->presenter->get_goods($this->get_user_product());
    }
    //初始化数据
    public function initial_data(){
        $product_goods=collect($this->initial_order_aterial_data());//获取初始化订单物料
        $total_prices=$product_goods['price'];//获取总价格
        $data['product_goods']=$product_goods;
        $data['user_id']=user()->id;
        $data['serial_number']='SN'.date('YmdHis',time());
        $data['machine_model']=request()->input('machine_model');
        $data['code']=request()->input('code');
        $data['unit_price']=$total_prices;
        $data['total_prices']=$total_prices;
        $data['price_spread']=request()->input('price_spread');
        $data['num']=1;
        $data['order_type']=request()->input('order_type');;
        $data['order_status']='intention_to_order';
        $data['message_status']='intention_to_order';
        $data['payment_status']='pay_first';
        $data['service_status']=0;
        $data['invoice_type']='vat_special_invoice';
        $data['parcel_count']=1;
        $data['urgent']=false;
        $data['flow_pic']=false;
        $data['in_common_use']=false;
        $data['market']=user()->admins->account;
        $data['pic']=[];
        return collect($data);
    }
    //初始化订饭物料数据
    public function initial_order_aterial_data()
    {
        $goods = [];
        $num=0;
        $price=0;
        $grade=user()->grades->identifying;
        foreach ($this->get_user_product() as $item) {
            $num=$item->pivot->product_good_num;
            $goods[$item->id] = ['product_good_num' =>$num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid];//将物料产品打包到二维数组
            $price+=$num * $item->price[$grade];
        }
        $goods['price']=$price;
        return $goods;
    }
    //删除对应的产品
    public function deleteAll()
    {
        user()->user_product()->detach();
    }
    public function initial_demand()
    {
        //创建需求
        $demand['visitor_details_id']=user()->visitor_details->id;
        $demand['user_id']=user()->id;
        $demand['demand_number']='XQ'.date('YmdHis',time());
        $demand['demand_status']='demand_consult';
        $demand['customer_status']='initial_contact';
        $demand['admin']=user()->admins->id;
        $demand['send']=false;
        $demand['analog_data']=false;
        return $demand;
    }

    public function save()
    {
       return \DB::transaction(function (){
            $product_goods = $this->initial_data()->get('product_goods');
            $data = $this->initial_data();
            $product_goods->pull('price');
            $data->pull('product_goods');
            $order=Order::create($data->all());
            $demand=DemandManagement::create($this->initial_demand());
            $order->order_product_goods()->attach($product_goods);
            $demand->demand_management_order()->attach($order->id);
            $this->deleteAll();
           event(new OrderSend($order)); //发送钉钉售后不受理
//            dump($product_goods->all(),$data->all(),$this->initial_demand());
            return $order->id;
        });
    }
    public function order_save($order)
    {
        return \DB::transaction(function () use($order){
            $product_goods = $this->initial_data()->get('product_goods');
            $data = $this->initial_data();
            $product_goods->pull('price');
            $data->pull('product_goods');
            $order->update(array_only($data->all(),['unit_price','total_prices','machine_model','code','num']));
            $order->order_product_goods()->sync($product_goods);
            $this->deleteAll();
            return $order->id;
        });
    }
    public function CommonEquipment_save($commonEquipment)
    {
        return \DB::transaction(function () use($commonEquipment){
            $product_goods = $this->initial_data()->get('product_goods');
            $data = $this->initial_data();
            $product_goods->pull('price');
            $data->pull('product_goods');
            $commonEquipment->update(array_only($data->all(),['unit_price','total_prices','machine_model','code','num']));
            $commonEquipment->common_equipment_product_goods()->sync($product_goods);
            $this->deleteAll();
            return $commonEquipment->id;
        });
    }
    public function presenterGoods($goods)
    {
       return  $this->presenter->get_goods($goods);
    }
    public function complete_machine()
    {

        return CompleteMachine::with('complete_machine_product_goods')->where([
            ['status->show', 1]
        ])->get();
    }

    public function solution()
    {
        return Integration::inRandomOrder()->take(5)->get();
    }

    public function siteSearchToCondition()
    {
        $arr = [];

        $filter = request()->input('filter');
        foreach ($filter as $key => $item) {
            foreach ($item as $key2 => $item2) {
                $arr[$key2] = $item2;
            }
        }
        return $arr;
    }

    public function siteSearch($array)
    {
        if(request()->has('filter') && !empty(request()->input('filter'))){
            $filters=$this->siteSearchToCondition();
            $filter_arr = $array->filter(function($item,$key) use($filters){
                if(array_has($filters,'类型')){
                    $type= in_array($filters['类型'],$item['application']);
                }
                if(array_has($filters,'价格')){
                    $prices=config('site.server_price')[$filters['价格']];
                    $server_price = $item->price[user()->grades->identifying ?? 'retail_price'];
                    $price=$server_price >= $prices[0] &&  $server_price <= $prices[1];
                }
                if(array_has($filters,'处理器')) {
                    $cpu = $item->complete_machine_product_goods->firstWhere('product_id',12);
                    if($cpu){
                        $cpus=$filters['处理器'] == $cpu->series_name;
                    }
                }
                if(array_has($filters,'内存类型')) {
                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',14);
                    if($memory){
                        $memorys=$filters['内存类型'] == $memory->details['lei_xing'];
                    }
                }
                if(array_has($filters,'内存容量')) {
                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',14);
                    if($memory){
                        $memory_rong_liang=$filters['内存容量'] == $memory->details['rong_liang'];
                    }
                }
                if(array_has($filters,'硬盘容量')) {
                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',15);
                    if($memory){
                        $hard_disk_rong_liang=$filters['硬盘容量'] == $memory->details['rong_liang'];
                    }
                }
                return   $type && $price && $cpus && $memorys && $memory_rong_liang && $hard_disk_rong_liang ;
            });

            return $filter_arr;
        }else{
            return $array;
        }
    }
//    public function siteSearch($array)
//    {
//        if(request()->has('filter') && !empty(request()->input('filter'))){
//           $filters=$this->siteSearchToCondition();
//            $filter_arr = $array->filter(function($item,$key) use($filters){
//                if(array_has($filters,'类型')){
//                    $type= in_array($filters['类型'],$item['application']);
//                }
//                if(array_has($filters,'价格')){
//                    $prices=config('site.server_price')[$filters['价格']];
//                    $server_price = $item->price[user()->grades->identifying ?? 'retail_price'];
//                    $price=$server_price >= $prices[0] &&  $server_price <= $prices[1];
//                }
//                if(array_has($filters,'处理器')) {
//                    $cpu = $item->complete_machine_product_goods->firstWhere('product_id',12);
//                    if($cpu){
//                        $cpus=$filters['处理器'] == $cpu->series_name;
//                    }
//                }
//                if(array_has($filters,'内存类型')) {
//                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',14);
//                    if($memory){
//                        $memorys=$filters['内存类型'] == $memory->details['lei_xing'];
//                    }
//                }
//                if(array_has($filters,'内存容量')) {
//                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',14);
//                    if($memory){
//                        $memory_rong_liang=$filters['内存容量'] == $memory->details['rong_liang'];
//                    }
//                }
//                if(array_has($filters,'硬盘容量')) {
//                    $memory= $item->complete_machine_product_goods->firstWhere('product_id',15);
//                    if($memory){
//                        $hard_disk_rong_liang=$filters['硬盘容量'] == $memory->details['rong_liang'];
//                    }
//                }
//                return   $type && $price && $cpus && $memorys && $memory_rong_liang && $hard_disk_rong_liang ;
//            });
//
//            return $filter_arr;
//        }else{
//            return $array;
//        }
//    }

}

?>