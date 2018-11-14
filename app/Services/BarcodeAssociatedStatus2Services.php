<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\BarcodeAssociated;
use App\Models\InventoryManagement;
use App\Models\ProcurementPlan;
use App\Models\ProductGood;
use App\Models\SupplierManagement;
use App\Models\WarehouseOutManagement;
use Carbon\Carbon;

class BarcodeAssociatedStatusServices
{
    public static function borrow_to_sales($data)
    {
        \DB::transaction(function () use ($data) {
            $WarehouseOutManagement = WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagement->update(['associated_disposal' => true]);
            $data['location']='客户';
            BarcodeAssociated::create($data);
        });
    }

    public static function loan_out_return($data)
    {
        \DB::transaction(function () use ($data) {
            $data['location']='库存';
            $bad = $data;
            $WarehouseOutManagement = WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagement->update(['associated_disposal' => true]);
            BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                BarcodeAssociated::create($bad);
            }

            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment($data['product_colour']);
        });
    }

    public static function returned_to_the_factory($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $barcode_associated->update(['associated_disposal' => false]);
            $data['associated_disposal'] = true;
            $data['location']='供货商';
            BarcodeAssociated::create($data);
            $supplier_managements = SupplierManagement::findOrFail($barcode_associated->supplier_managements_id);
            $supplier_managements->increment('factory_return_count');//添加返厂数量
            InventoryManagement::whereProductGoodId($data['product_good_id'])->decrement('bad');
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment('return_factory');
        });
    }

    public static function stock_returns($data, $barcode_associated)
    {

        \DB::transaction(function () use ($data, $barcode_associated) {
            $procurement_plans = ProcurementPlan::findOrFail($barcode_associated->procurement_plans_id);
            $old_code = $procurement_plans->code;
            $index = collect($old_code)->search($data['code']);//查找到条码对应的键
            $new_code = array_except($old_code, $index);//删除对应的键值
            if (count($new_code) <= 0) {  //如果只有一个条码 则删除这条入库信息
                $procurement_plans->delete();
            } else {
                $procurement_plans->update(['code' => explode(',', implode(',', $new_code))]); //将条码从入库信息中删除
                $procurement_plans->decrement('procurement_number'); //减去采购数量
                $procurement_plans->decrement('finish_procurement_number');//减去已采购数量
            }
            self::check_warehouse_out($barcode_associated->warehouse_out_management_id,
                $barcode_associated->product_good_id,
                $data['code']);//删除出库信息中的条码
            $supplier_managements = SupplierManagement::findOrFail($barcode_associated->supplier_managements_id);
            $supplier_managements->increment('sales_return_count');//添加退货数量
            $barcode_associated->where('code', 'like', "%{$data['code']}%")->delete();//删除关联表中所有这个条码的所有信息
        });
    }

    public static function check_warehouse_out($warehouse_out_management_id, $product_good_id, $code)
    {
        $warehouse_out_managements = WarehouseOutManagement::findOrFail($warehouse_out_management_id);
        $search_code = $warehouse_out_managements->codes->firstWhere('product_good_id', $product_good_id);//查找对应的条码
        $index = collect($search_code->code)->search($code);//查找到条码对应的键
        $new_code = array_except($search_code->code, $index);//删除对应的键值
        if (count($new_code) <= 0) {  //如果只有一个条码 则删除这条入库信息
            $warehouse_out_managements->delete();
        } else {
            $search_code->update(['code' => explode(',', implode(',', $new_code))]);//更新删除后的条码信息
            $search_code->decrement('product_good_num');//减去条码的数量
            $warehouse_out_managements->decrement('out_number'); //减去采购数量
            $warehouse_out_managements->decrement('finish_out_number');//减去已采购数量
        }
    }

    public static function breakage($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            if ($barcode_associated->current_state == 'bad') {
                InventoryManagement::whereProductGoodId($data['product_good_id'])->decrement('bad');
            } else {
                InventoryManagement::whereProductGoodId($data['product_good_id'])->decrement('proxies');//代管数量
            }
            $barcode_associated->update(['associated_disposal' => false]);
            $data['location']='供货商';
            BarcodeAssociated::create($data);
        });
    }

    public static function models_to_replace($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement($barcode_associated->product_colour);
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment($barcode_associated->product_colour);
            $barcode_associated->update(['associated_disposal' => false]);
            $data['associated_disposal'] = true;
            $data['current_state'] = 'bad';
            $data['description']='型号更换';
            $data['location']='库存';
            BarcodeAssociated::create($data);
        });
    }

    public static function factory_return($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $code=$data['code'];
            $two_code=$data['two_code'];
            $bad=$data;
           $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('return_factory');
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->increment($data['product_colour']);
            $data['description']='换出';
            $data['location']='供货商';
           BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='库存';
                if(!empty($data['two_code'])){
                    $bad['description']='换入';
                    $bad['two_code']=$code;
                    $bad['code'] = $two_code;
                    BarcodeAssociated::create($bad);
                    self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }else{
                    BarcodeAssociated::create($bad);
                }
            }else{
                if(!empty($data['two_code'])){
                    $data['description']='换入';
                    $data['two_code']=$code;
                    $data['code'] = $two_code;
                    $data['location']='库存';
                    BarcodeAssociated::create($data);
                    self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }
            }
        });
  }
    public static function quality_return($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $code=$data['code'];
            $two_code=$data['two_code'];
            $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('return_factory');
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->increment('proxies');
            $data['description']='代管(换出)';
            $data['location']='供货商';
            BarcodeAssociated::create($data);
            if(!empty($data['two_code'])){
                $data['associated_disposal'] = true;
                $data['description']='代管(换入)';
                $data['two_code']=$code;
                $data['code'] = $two_code;
                $data['location']='库存';
                BarcodeAssociated::create($data);
                self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
            }
        });
    }

    public static function quality_take_away($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('proxies');
            $data['location']='客户';
            BarcodeAssociated::create($data);
        });
    }

    public static function escrow_to_storage($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $data['location']='库存';
            $bad=$data;
            $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('proxies');
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->increment($data['product_colour']);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                BarcodeAssociated::create($bad);
            }
            BarcodeAssociated::create($data);
        });
    }
    public static function test_return($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $procurement_plans=ProcurementPlan::findOrFail($data['procurement_plans_id']);
            $index = collect($procurement_plans->code)->search($data['code']);//查找到条码对应的键
            $new_code = array_except($procurement_plans->code, $index);//删除对应的键值
            if (count($new_code) <= 0) {  //如果只有一个条码 则删除这条入库信息
                $procurement_plans->delete();
            } else {
                $procurement_plans->update(['code' => explode(',', implode(',', $new_code))]);//更新删除后的条码信息
                $procurement_plans->decrement('procurement_number'); //减去采购数量
                $procurement_plans->decrement('finish_procurement_number');//减去已采购数量
            }
            InventoryManagement::whereProductGoodId($procurement_plans->product_good_id)->decrement('test');
            $data['location']='库存';
            BarcodeAssociated::create($data);
        });
    }

    public static function test_to_procurement($data, $barcode_associated)
    {

        \DB::transaction(function () use ($data, $barcode_associated) {
            $procurement_plans=ProcurementPlan::findOrFail($data['procurement_plans_id']);
            $datas=array_except($procurement_plans->toArray(),['id','serial_number','two_code']);
            $datas['procurement_type']='procurement';
            $datas['serial_number']='YG'.date('YmdHis',time());
            $datas['procurement_number']=1;
            $datas['finish_procurement_number']=1;
            $index = collect($procurement_plans->code)->search($data['code']);//查找到条码对应的键
            $new_code = array_except($procurement_plans->code, $index);//删除对应的键值
            if (count($new_code) <= 0) {  //如果只有一个条码 则删除这条入库信息
                $procurement_plans->delete();
            } else {
                $procurement_plans->update(['code' => explode(',', implode(',', $new_code))]);//更新删除后的条码信息
                $procurement_plans->decrement('procurement_number'); //减去采购数量
                $procurement_plans->decrement('finish_procurement_number');//减去已采购数量
            }

            InventoryManagement::whereProductGoodId($procurement_plans->product_good_id)->decrement('test');
            InventoryManagement::whereProductGoodId($procurement_plans->product_good_id)->increment('new');
            ProcurementPlan::create($datas);
            $data['location']='库存';
            BarcodeAssociated::create($data);
        });
    }

    //有新条码则更换订单的条码-》质保更换,借转更换
    public function replace_tms($upid,$tm,$newtm){
        //$oid=M('tout')->where(array('id'=>$upid))->getField('orderid');
        $where['tiaomas']=array('like',"%$tm%");
        $tiaoma=M('orders')->where($where)->field('orderid,tiaomas')->find();
        $new=str_replace($tm,$newtm,$tiaoma['tiaomas']);
        M('orders')->where(array('orderid'=>$tiaoma['orderid']))->setField('tiaomas',$new);
    }
    //质保列表->质保更换
    private function ZBGH()
    {
        $kc = D('Tkucun');
        $cpcs = I('post.cpcs', 0, 'intval');
        $gltm = I('post.gltm', '', 'trim');
        $upid = I('post.upid', 0, 'intval');
        $tiaoma = I('post.tiaoma', '', 'trim');
        $where['cplx'] = I('post.cplx', 0, 'intval');
        $where['cpgg'] = I('post.cpgg', 0, 'intval');
        if ($cpcs == 6) {
            $sta = 'xpsl';
        }
        if ($cpcs == 7) {
            $sta = 'lpsl';
        }
        if ($cpcs == 8) {
            $sta = 'hhsl';
            if (!empty($gltm)) {
                $data = $_POST;
                $_POST['tiaoma'] = $gltm;
                $_POST['gltm'] = $tiaoma;
                $data['addtime'] = time() + 10;
                $data['dangqianshijian'] = $cpcs;
                $data['xszt'] = 3;
                $data['userid'] = 0;
                $data['gid'] = $this->ghss();
                D('Tguanlian')->data($data)->add();
            } else {
                $data = $_POST;
                $data['addtime'] = time() + 10;
                $data['dangqianshijian'] = $cpcs;
                $data['xszt'] = 3;
                $data['userid'] = 0;
                $data['gid'] = $this->ghss();
                D('Tguanlian')->data($data)->add();
            }

        }
        //在库存表中成色库存加一
        $kc->where($where)->setInc($sta);
        if (!empty($gltm)) {
            $data1 = $_POST;
            $data1['tiaoma'] = $gltm;
            $data1['gltm'] = $tiaoma;
            $data1['addtime'] = time() + 10;
            $data1['xszt'] = 9;
            $data1['cpcs'] = 0;
            $data1['gid'] = 0;
            D('Tguanlian')->data($data1)->add();
            $cpcs = $this->where($where)->order('addtime desc')->limit(1)->getField('cpcs');//返回最后一条  查询是否是已经借出还回了
            if (empty($cpcs)) {//如果没有 那么就到入库表里面去查
                $cpcs = D('tin')->where($where)->getField('cpcs');
            }
            if ($cpcs == 6) {
                $cpcs = 'xpsl';
            }
            if ($cpcs == 7) {
                $cpcs = 'lpsl';
            }
            if ($cpcs == 8) {
                $cpcs = 'hhsl';
            }
            $kucun[] = $kc->where(array('cplx' => $where['cplx'], 'cpgg' => $where['cpgg']))->setDec($cpcs);
        }

        D('Tguanlian')->where(array('id' => $upid))->setField('xszt', 0);
        if (!empty($gltm)){
            $this->replace_tms($upid,$tiaoma,$gltm);
        }
    }

    public static function warranty_replacement($data, $barcode_associated)
    {

        \DB::transaction(function () use ($data, $barcode_associated) {
            $WarehouseOutManagements=WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $code=$data['code'];
            $two_code=$data['two_code'];
            $bad=$data;
            $data['description']='换出';
            $data['location']='客户';
            BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='库存';
                if(!empty($data['two_code'])){
                    $bad['description']='换入';
                    $bad['two_code']=$code;
                    $bad['code'] = $two_code;
                    BarcodeAssociated::create($bad);
                    self::replace_code($WarehouseOutManagements->codes,$data['product_good_id'],$code,$two_code);
                }else{
                    BarcodeAssociated::create($bad);
                }
            }else{
                if(!empty($data['two_code'])){
                    $data['description']='换入';
                    $data['two_code']=$code;
                    $data['code'] = $two_code;
                    $data['location']='库存';
                    BarcodeAssociated::create($data);
                    self::replace_code($WarehouseOutManagements->codes,$data['product_good_id'],$code,$two_code);
                }
            }
            if(!empty($data['two_code'])){
                InventoryManagement::whereProductGoodId($data['product_good_id'])->decrement($data['product_colour']);
            }
        });
    }
    //替换掉出库中对应的条码
    public static function replace_code($codes,$good_id,$old_code,$new_code)
    {

        $search_code =$codes->firstWhere('product_good_id', $good_id);//查找对应的条码

        $index = collect($search_code->code)->search($old_code);//查找到条码对应的键
        $new_codes = array_prepend(array_except($search_code->code, $index),$new_code);//替换对应的键值
        $search_code->update(['code' => explode(',', implode(',', $new_codes))]);//更新替换后的条码信息
     }
}
?>