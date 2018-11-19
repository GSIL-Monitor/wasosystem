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


    //销售退货  //功能完成
    public static function sell_return($data)
    {
        \DB::transaction(function () use ($data) {
            $WarehouseOutManagement = WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagement->update(['associated_disposal' => true]);
            $data['location'] = '库存';
            BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location'] = '库存';
                BarcodeAssociated::create($bad);
            }

            $supplier_managements = SupplierManagement::findOrFail($data['supplier_managements_id']);
            $supplier_managements->increment('sales_return_count');//添加销售退货数量
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment($data['product_colour']);
            self::replace_code($WarehouseOutManagement->codes,$data['product_good_id'],$data['code'],$data['code'].'(已退货)');
        });
    }
    //借转销售  //功能完成
    public static function borrow_to_sales($data)
    {
        \DB::transaction(function () use ($data) {
            $WarehouseOutManagement = WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagement->update(['associated_disposal' => true]);
            $data['location']='客户';
            BarcodeAssociated::create($data);
        });
    }
   //借出换回  //功能完成
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

    //返厂在途  //功能完成
    public static function returned_to_the_factory($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
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
    //进货退货
    public static function stock_returns($data)
    {

        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
            $procurement_plans = ProcurementPlan::findOrFail($barcode_associated->procurement_plans_id);
            $old_code = $procurement_plans->code;
            $index = collect($old_code)->search($data['code']);//查找到条码对应的键
            if(!$index){
                $index = collect($old_code)->search($data['code'].'.');//如果没有找到这个条码 可能条码后面有一个“.”
            }
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
    //删除替换条码
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
    //报损
    public static function breakage($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
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
    //型号更换 完成
    public static function models_to_replace($data, $barcode_associated)
    {
        \DB::transaction(function () use ($data, $barcode_associated) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
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
    //返厂返回
    public static function factory_return($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
            $code=$data['code'];
            $two_code=$data['two_code'];
            $bad=$data;
           $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('return_factory');
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->increment($data['product_colour']);
            $data['description']='换出!';
            $data['location']='供货商';
           BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='库存';
                if(!empty($data['two_code'])){
                    $bad['description']='换进!';
                    $bad['two_code']=$code;
                    $bad['code'] = $two_code;
                    BarcodeAssociated::create($bad);
                    //self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }else{
                    BarcodeAssociated::create($bad);
                }
            }else{
                if(!empty($data['two_code'])){
                    $data['description']='换进!';
                    $data['two_code']=$code;
                    $data['code'] = $two_code;
                    $data['location']='库存';
                    BarcodeAssociated::create($data);
                 //   self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }
            }
        });
  }
  //质保返回
    public static function quality_return($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
            $code=$data['code'];
            $two_code=$data['two_code'];
            $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('return_factory');
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->increment('proxies');
            $data['description']='换出!';
            $data['location']='供货商';
            BarcodeAssociated::create($data);
            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='代管';
                if(!empty($data['two_code'])){
                    $bad['description']='换进!';
                    $bad['two_code']=$code;
                    $bad['code'] = $two_code;
                    BarcodeAssociated::create($bad);
                 //   self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }else{
                    BarcodeAssociated::create($bad);
                }
            }else{
                if(!empty($data['two_code'])){
                    $data['description']='换进!';
                    $data['two_code']=$code;
                    $data['code'] = $two_code;
                    $data['location']='代管';
                    BarcodeAssociated::create($data);
                 //   self::replace_code($barcode_associated->warehouse_out_management->codes,$barcode_associated->product_good_id,$code,$two_code);
                }
            }
        });
    }
//质保取走
    public static function quality_take_away($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
            $barcode_associated->update(['associated_disposal' => false]);
            InventoryManagement::whereProductGoodId($barcode_associated->product_good_id)->decrement('proxies');
            $data['location']='客户';
            BarcodeAssociated::create($data);
        });
    }
//代管转入库
    public static function escrow_to_storage($data)
    {
        \DB::transaction(function () use ($data) {
            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
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
    //测试品返还
    public static function test_return($data)
    {
        \DB::transaction(function () use ($data) {
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
//测试品转采购
    public static function test_to_procurement($data)
    {

        \DB::transaction(function () use ($data) {
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


//质保更换
    public static function warranty_replacement($data)
    {

        \DB::transaction(function () use ($data) {
            $WarehouseOutManagements=WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagements->update(['associated_disposal' => false]);
            $code=$data['code'];
            $two_code=$data['two_code'];
            $twoCodes=$data;
            if(!empty($two_code)) {
                $new_code_product_colour = BarcodeAssociated::where(function ($query) use ($two_code) {
                    $query->orWhere('code', $two_code)
                        ->orWhere('two_code',$two_code);
                })->first();
                if (empty($new_code_product_colour)) {
                    $new_code_product_colour = ProcurementPlan::where('code','like',"%$two_code%")->latest()->first();
                }
                if(!empty($data['two_code'])){
                    $twoCodes['description']='换出!';
                    $twoCodes['two_code']=$code;
                    $twoCodes['code'] = $two_code;
                    $twoCodes['location']='客户';
                    $twoCodes['product_colour']=$new_code_product_colour->product_colour;
                    BarcodeAssociated::create($twoCodes);
                    self::replace_code($WarehouseOutManagements->codes,$data['product_good_id'],$code,$code.'(换入)'.'=>'.$two_code.'(换出)');
                }
                InventoryManagement::whereProductGoodId($data['product_good_id'])->decrement($new_code_product_colour->product_colour);

            }
            $data['description']='换进!';
            $data['location']='库存';
            BarcodeAssociated::create($data);
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment($data['product_colour']);

            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad=$data;
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='库存';
                if(!empty($data['two_code'])){
                    $bad['description']='换进!';
                    BarcodeAssociated::create($bad);

                }else{
                    BarcodeAssociated::create($bad);
                }
            }
        });
    }
    //质保受理
    public static function quality_acceptance($data)
    {

        \DB::transaction(function () use ($data) {
            $data['location']='代管';
            BarcodeAssociated::create($data);
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment('proxies');
        });
    }
//借转更换
    public static function loan_out_to_replace($data)
    {

        \DB::transaction(function () use ($data) {
            $WarehouseOutManagements=WarehouseOutManagement::findOrFail($data['warehouse_out_management_id']);
            $WarehouseOutManagements->update(['associated_disposal' => false]);
            $code=$data['code'];
            $two_code=$data['two_code'];
            $twoCodes=$data;
            if(!empty($two_code)) {
                    $twoCode=WarehouseOutManagement::whereHas('codes',function ($query) use($two_code){
                        $query->where('code','like',"%$two_code%");
                    })->first();
                    $twoCode->update(['associated_disposal' => true]);
                    $twoCodes['description']='换出!';
                    $twoCodes['two_code']=$code;
                    $twoCodes['code'] = $two_code;
                    $twoCodes['location']='客户';
                    BarcodeAssociated::create($twoCodes);
                self::replace_code($WarehouseOutManagements->codes,$data['product_good_id'],$code,$code.'(换入)'.'=>'.$two_code.'(换出)');
            }
            $data['description']='换进!';
            $data['location']='库存';
            BarcodeAssociated::create($data);
            InventoryManagement::whereProductGoodId($data['product_good_id'])->increment($data['product_colour']);

            if (isset($data['product_colour']) && $data['product_colour'] == 'bad') {
                $bad=$data;
                $bad['associated_disposal'] = true;
                $bad['current_state'] = 'bad';
                $bad['location']='库存';
                if(!empty($data['two_code'])){
                    $bad['description']='换进!';
                    BarcodeAssociated::create($bad);

                }else{
                    BarcodeAssociated::create($bad);
                }
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