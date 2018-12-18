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


//进货退货
    public static function stock_returns($data)
    {

//        \DB::transaction(function () use ($data) {
//            $barcode_associated=BarcodeAssociated::findOrFail($data['barcode_associated_id']);
//            $procurement_plans = ProcurementPlan::findOrFail($barcode_associated->procurement_plans_id);
//            $old_code = $procurement_plans->code;
//            $index = collect($old_code)->search($data['code']);//查找到条码对应的键
//            if(!$index){
//                $index = collect($old_code)->search($data['code'].'.');//如果没有找到这个条码 可能条码后面有一个“.”
//            }
//            $new_code = array_except($old_code, $index);//删除对应的键值
//
//            if (count($new_code) <= 0) {  //如果只有一个条码 则删除这条入库信息
//                $procurement_plans->delete();
//            } else {
//                $procurement_plans->update(['code' => explode(',', implode(',', $new_code))]); //将条码从入库信息中删除
//                $procurement_plans->decrement('procurement_number'); //减去采购数量
//                $procurement_plans->decrement('finish_procurement_number');//减去已采购数量
//            }
//            self::check_warehouse_out($barcode_associated->warehouse_out_management_id,
//                $barcode_associated->product_good_id,
//                $data['code']);//删除出库信息中的条码
//            $supplier_managements = SupplierManagement::findOrFail($barcode_associated->supplier_managements_id);
//            $supplier_managements->increment('sales_return_count');//添加退货数量
//            $barcode_associated->where('code', 'like', "%{$data['code']}%")->delete();//删除关联表中所有这个条码的所有信息
//        });
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