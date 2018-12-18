<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\WarehouseOutManagement;

class WarehouseOutManagementServices
{
    //检查是否物料不一样
    public function checkProduct($warehouse_out_management)
    {
        \DB::transaction(function () use ($warehouse_out_management) {
            $codes = $warehouse_out_management->codes;
            $order_product_goods = $warehouse_out_management->order->order_product_goods ?? '';
            if ($order_product_goods) {
                //查找在条码库中有的产品 和没有的产品
                list($already_exists, $no_exists) = $order_product_goods->partition(function ($item) use ($codes) {
                    return $codes->firstWhere('product_good_id', $item->id);
                });//
                //查找没有的产品条码
                list($code_exists, $code_no_exists) = $codes->partition(function ($item) use ($order_product_goods) {
                    return $order_product_goods->firstWhere('id', $item->product_good_id);
                });

                if (empty($already_exists)) { //如果没有条码 就把订单库中的产品添加到条码库
                    $already_exists = $order_product_goods;
                }
                foreach ($already_exists as $product_good) {
                    $code = $warehouse_out_management->codes->firstWhere('product_good_id', $product_good->id);
                    if (!empty($code) && $product_good->pivot->product_good_num != $code->product_good_num) {
                        $codes = [];//如果订单中的产品数量有变化  根据产品产品数量调整条码
                        for ($i = 0; $i < $product_good->pivot->product_good_num; $i++) {
                            $codes[$i] = $code->code[$i] ?? '';
                        }
                        $code->update([
                            'product_good_num' => $product_good->pivot->product_good_num,
                            'code' => $codes
                        ]);
                    }
                }
                if (!empty($no_exists)) {
                    $data = []; //如果订单中新添加了产品 那么对应添加到条码库
                    foreach ($no_exists as $key => $product_good) {
                        $data[$key]['product_good_num'] = $product_good->pivot->product_good_num;
                        $data[$key]['product_good_number'] = $product_good->product->bianhao;
                        $data[$key]['product_good_id'] = $product_good->id;
                        $code = [];
                        for ($i = 0; $i < $product_good->pivot->product_good_num; $i++) {
                            $code[$i] = '';
                        }
                        $data[$key]['code'] = $code;
                    }
                    $warehouse_out_management->codes()->createMany($data);
                }
                if (!empty($code_no_exists)) {
                    //如果订单删除了产品  那么条码库中也要对应删除
                    foreach ($code_no_exists as $item) {
                        $item->delete();
                    }
                }
            }
        });


    }

    public function out($warehouse_out_management, $request)
    {
        $data = $request->all();
        $data['code'] = json_decode($data['code'], true);
//        if ($data['out_number'] == $data['finish_out_number']) {
//            $data['out_status'] = 'finish';
//        } else {
//            $data['out_status'] = 'unfinished';
//        }

        \DB::transaction(function () use ($warehouse_out_management, $data) {
            if ($warehouse_out_management) {
                $warehouse_out_management->update($data);
                foreach ($warehouse_out_management->codes as $item) {
                    $item->update($data['code'][$item->product_good_id]);
                }

            } else {
                $warehouse_out_management = WarehouseOutManagement::create($data);
                $warehouse_out_management->codes()->createMany($data['code']);
            }
            if ($warehouse_out_management->out_status == 'finish') {
                foreach ($warehouse_out_management->codes as $item) {
                    $item->inventory()->decrement('new', $item->product_good_num);
                }
            }
        });
    }

    //获取参数
    public function get_inventory_machine($warehouse_out_management)
    {

        $warehouse_outs = $warehouse_out_management->with('order')->whereUserId(994)->whereOutStatus('unfinished')->get();
        $model = [];
        foreach ($warehouse_outs as $item) {
            $model[] = $item->order->machine_model;
        }
        return implode(' ', $model);
    }

    //选用配置
    public function set_inventory_machine($warehouse_out_management, $request)
    {

        \DB::transaction(function () use ($warehouse_out_management, $request) {
            $order_id = $request->input('order_id');
            $order = Order::findOrFail($order_id);
            $data = ['user_id' => $order->user_id, 'order_id' => $order->id, "serial_number" => $order->serial_number, 'admin' => admin()->id];
            $warehouse_out_management->update($data);
        });
    }

}

?>