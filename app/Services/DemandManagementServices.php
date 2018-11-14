<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\DemandManagement;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductGood;
use App\Models\User;
use App\Models\VisitorDetail;

class DemandManagementServices
{
    //获取订单物料所需参数
    public function GetOrderMaterialParameters($good, $grade,$cate)
    {
        $goods = [];
        foreach ($good as $item) {
            $goods[$item->id] = ['product_good_num' => $item->pivot->product_good_num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid, 'type' => $cate];//将物料产品打包到二维数组

        }
        return $goods;
    }
   //生成一个新订单  临时物料添加到订单物料
    public function temporary_material_add_to_order_material($request, $demand_management)
    {
        $cate=$request->get('order_type');
        $temporary_material=$this->getTemporaryProductGoods($cate); //获取临时物料
        if($temporary_material->isEmpty()){
            $temporary_material=$this->getTemporaryProductGoods('parts');//获取临时物料
        }
        \DB::transaction(function () use ($request, $demand_management,$temporary_material,$cate){
            $data=$this->GetTemporaryMaterialParameters($temporary_material,$demand_management->user->grade,$request->get('num')) ;//转换为二位数组参数
            $order_data=$this->initial_data($request, $demand_management,$temporary_material);
            $order=Order::create($order_data);

           $order->order_product_goods()->sync($data);//添加到订单库
           $this->deleteTemporaryProductGoods($this->TemporaryProductGoodAllRelatedIds($cate),$cate);//删除临时表对应的数据
           $demand_management->demand_management_order()->sync($order->id, false);
            $demand_management->update(['demand_status'=>'preliminary_scheme']);
        });

    }
      //会员添加需求
    public function userCreateVisitorDetailAndUsersAndDemandManagement($request)
    {
        //会员修改
        \DB::transaction(function () use ($request){
            $data=$request->all();
            $user=User::find($request->get('user_id'));
            $data['user_id']=$user->id;
            $data['valid']='yes';
            $data['admin']=auth('admin')->user()->account;
            if($request->has('visitor_details_id')){
                $visitor_detail=VisitorDetail::find($request->get('visitor_details_id'));//修改客情
            }else{
                $visitor_detail=VisitorDetail::create($data);//添加客情
                $user->visitor_details()->update($request->only(["nickname",
                    "industry",
                    "address",
                    "phone",
                    "email",
                    "wechat",
                    "qq"
                ]));//修改客情信息
            }
            $data['visitor_details_id']=$visitor_detail->id;
            $data['admin']=$user->administrator;
            $demand_management=DemandManagement::create($data);//添加需求
            $filtrate=array_only($request->all(),['filtrate']);
            $demand_management->demand_management_filtrate()->sync($filtrate['filtrate']);//添加筛选咨询
        });
    }
    //创建需求 会员  客情信息
    public function createVisitorDetailAndUsersAndDemandManagement($request)
    {
        //创建会员
        \DB::transaction(function () use ($request){
            $data=$request->all();
            $password=str_random(10);
            $data['password']=bcrypt($password);
            $data['clear_text']=encrypt($password);
            $user=User::create($data);
            $data['user_id']=$user->id;
            $data['valid']='yes';
            $data['admin']=auth('admin')->user()->account;
            $visitor_detail=VisitorDetail::create($data);//添加客情
            $data['visitor_details_id']=$visitor_detail->id;
            $data['admin']=$user->administrator;
            $demand_management=DemandManagement::create($data);//添加需求
            $filtrate=array_only($request->all(),['filtrate']);
            $demand_management->demand_management_filtrate()->sync($filtrate['filtrate']);//添加筛选咨询
        });
    }

    //初始化数据
    public function initial_data($request, $demand_management,$data){
        $total_prices=$this->getTemporaryProductGoodsPrices($data,$demand_management);//获取总价格
        $order['user_id']=$demand_management->user_id;
        $order['serial_number']='SN'.date('YmdHis',time());
        $order['machine_model']=$request->get('machine_model');
        $order['code']=$request->get('code');
        $order['unit_price']=$total_prices + $request->get('price_spread');
        $order['total_prices']=$total_prices + $request->get('price_spread');
        $order['price_spread']=$request->get('price_spread');
        $order['num']=1;
        $order['order_type']=$request->get('order_type');
        $order['order_status']='intention_to_order';
        $order['message_status']='intention_to_order';
        $order['payment_status']='pay_first';
        $order['service_status']=0;
        $order['invoice_type']='vat_special_invoice';
        $order['parcel_count']=1;
        $order['urgent']=false;
        $order['flow_pic']=false;
        $order['in_common_use']=false;
        $order['market']=$demand_management->user->admins->account;
        $order['pic']=[];
       return $order;
    }

    //获取订单物料所需参数
    public function GetTemporaryMaterialParameters($good, $grade,$order_num)
    {
        $goods = [];
        foreach ($good as $item) {
            $num=$item->pivot->product_good_num * $order_num;
            $goods[$item->id] = ['product_good_num' => $num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$grade], 'product_good_raid' => $item->pivot->product_good_raid];//将物料产品打包到二维数组
        }
        return $goods;
    }
    //获取临时物料全部ids
    public function TemporaryProductGoodAllRelatedIds($cate)
    {
        return auth('admin')->user()->temporary_product_goods()->whereType($cate)->allRelatedIds()->toArray();//输出关联的 产品id 数组
    }

    //添加物料到临时表
    public function AddTemporaryProductGood($ids)
    {
        if (auth('admin')->user()->temporary_product_goods->isEmpty()) { //判断是否为空
            return auth('admin')->user()->temporary_product_goods()->sync($ids, false);
        }
    }

    //获取产品
    public function get_product_good($request, $order)
    {

        $arr = $request->get('arr');
        $product_good = ProductGood::findOrFail($arr['product_good_id']);
        if ($product_good) {
            $data[$product_good->id] = [
                "product_good_num" => $arr['product_good_num'],
                "product_number" => $arr['product_good_number'] ?? $product_good->product->bianhao,
                "product_good_raid" => $arr['product_good_raid'] ?? '',
                "product_good_price" => $product_good->price[$order->user->grade],
                "type" => $request->get('cate'),
            ];
            if($product_good->product_id ==12){ //如果提交过来是cpu  那么就修改 内存和散热器的数量跟cpu 的数量一致
                $product_goods=auth('admin')->user()->temporary_product_goods;
                foreach ($product_goods as $item){
                    if(str_contains($item->product_id,[14,22])){
                        auth('admin')->user()->temporary_product_goods()->updateExistingPivot($item->id,['product_good_num'=>$arr['product_good_num']]);
                    }
                }
            }
            $this->deleteTemporaryProductGoods(array_wrap($request->get('old_id')),$request->get('cate'));
            $this->addTemporaryProductGoods($data);
        }
    }
        //
    public function getTemporaryProductGoodsPrices($productGoods,$demand_management)
    {
        $prices=$productGoods->sum(function ($item) use ($demand_management){
            return $item->price[$demand_management->user->grades->identifying] * $item->pivot->product_good_num;
        });
        return $prices;
    }

    //获取临时物料
    public function getTemporaryProductGoods($cate)
    {
        return auth('admin')->user()->temporary_product_goods()->whereType($cate)->oldest('product_number')->get();//获取临时表中的产品
    }

    //添加临时物料
    public function addTemporaryProductGoods($data)
    {
//        $good_id = $request->get('product_good_id');
//        $good_num = $request->get('product_good_num');
//        $good = ProductGood::findOrFail($good_id);//如果没有配件 则添加 如果选择了相同的配件  则以当前添加的数量为准  添加到配件临时表
        auth('admin')->user()->temporary_product_goods()->sync($data, false);
    }

    //删除临时物料
    public function deleteTemporaryProductGoods($goodIds,$cate)
    {
        auth('admin')->user()->temporary_product_goods()->whereType($cate)->detach($goodIds);//删除临时表中的产品
    }
    //判断产品类型
    public function check_product_type($cate)
    {
        switch ($cate){
            case 'waso_complete_machine':
                return CompleteMachineFrameworks::whereParentId(1)->whereCategory('framework')->oldest('order')->pluck('name','name as id');
                break;
            case 'designer_computer':
                return CompleteMachineFrameworks::whereParentId(2)->whereCategory('framework')->oldest('order')->pluck('name','name as id');
                break;
            default :
                return Product::oldest('bianhao')->pluck('title','id');

        }
    }

    //配置代码转换
    public function ConfigureCodeTransformation($code,$demand_management,$cate)
    {
        $code_lists=preg_split("/(?=[A-Z])/i", $code);
        $goods = [];
        $grade=$demand_management->user->grades->identifying;
        $code=$code_lists[0];
        foreach ($code_lists as $k => $v) {
            if ($v != '' && strlen($v) > 1) {
                $product_number = substr($v, 0, 1);
                //如果字符串长度为8 id则是4位数 截取字符串4位
                //如果字符串长度为7 id则是3位数 截取字符串3位
                $product_good_id=strlen($v)==7 ? floor(substr($v, 1, 3)) :floor(substr($v, 1, 4));
                $num = floor(substr($v, -3));
                $product_good=ProductGood::findOrFail($product_good_id);
                if($product_good){
                    $goods[$product_good->id] = ['product_good_num' =>$num, 'product_number' =>$product_number, 'product_good_price' => $product_good->price[$grade], 'product_good_raid' =>'', 'type' =>$cate];//将物料产品打包到二维数组
                }
            }
        }
        //将物料添加到临时物料表
        $this->addTemporaryProductGoods($goods);
       return $code ?? '';
    }
    //整机转换产品 添加到临时库
    public function CompleteMachineToTemporaryTable($request,$demand_management)
    {

        $complete_machine=CompleteMachine::findOrFail($request->get('complete_machine_id'));

        $grade=$demand_management->user->grades->identifying;
        $goods =$this->GetOrderMaterialParameters($complete_machine->complete_machine_product_goods,$grade,$request->get('cate'));
        //将物料添加到临时物料表
        $this->addTemporaryProductGoods($goods);
    }




    //获取参数

    public function getParameters()
    {
        $arr['admins']=Admin::pluck('name','id');
        $arr['products']=Product::oldest('bianhao')->pluck('title','id');
        $arr['source']=MemberStatus::whereType('source')->pluck('name','name as id');
        $arr['grades']=MemberStatus::whereType('grade')->pluck('name','identifying');
        $arr['tax_rate']=MemberStatus::whereType('tax_rate')->pluck('identifying','id');
        $arr['customer_status']=MemberStatus::whereType('customer_status')->pluck('name','identifying');
        $arr['order_type']=MemberStatus::whereType('order_type')->pluck('name','identifying');
        $arr['order_status']=MemberStatus::whereType('order_status')->pluck('name','identifying');
        $demand_status=MemberStatus::whereType('demand_status')->pluck('name','identifying as id');
        $demand_status->prepend('全部需求','all_demand');

        $arr['demand_status']=$demand_status->toArray();
        $arr['message_type']=config('status.userInfo');
        foreach (config('status.userIndustry') as $key=>$value){
            foreach ($value as $v){
                $arr['industry'][$key][$v]=$v;
            }
        }
        return $arr;
    }
}

?>