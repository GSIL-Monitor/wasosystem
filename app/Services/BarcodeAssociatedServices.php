<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\BarcodeAssociated;
use App\Models\ProcurementPlan;
use App\Models\ProductGood;
use App\Models\WarehouseOutManagement;

class BarcodeAssociatedServices
{

    public function search($keyword)
    {
        $arr=collect([]);
        $barcode_associateds=collect([]);
        if($keyword){
            $ProcurementPlan=ProcurementPlan::with('supplier_managements','products','product_goods')
                 ->where(function ($query) use ($keyword) {
                $query->orWhere('code', 'like', '%' .$keyword . '%')
                      ->orWhere('two_code', 'like', '%' . $keyword . '%');
            })->get();
            $WarehouseOutManagement=WarehouseOutManagement::with('user')->whereHas('codes',function ($query) use($keyword){
                $query->where('code','like',"%{$keyword}%");
            })->get();
            $BarcodeAssociated=BarcodeAssociated::with('supplier_managements','user','product_good','product_good.product')
                ->whereCode($keyword)->get();
            if($ProcurementPlan->isNotEmpty()){
                $arr=$arr->merge($ProcurementPlan);
            }
            if($WarehouseOutManagement->isNotEmpty()){
                $arr=$arr->merge($WarehouseOutManagement);
            }
            if($BarcodeAssociated->isNotEmpty()){
                $arr=$arr->merge($BarcodeAssociated);
            }
            $sorted = $arr->sortBy('updated_at');
            $barcode_associateds=collect($sorted->values()->all());
        }
        return $barcode_associateds;
    }

    public function check_select($last)
    {
        $select=[];
        $status=$last->current_state ?? $last->procurement_type ?? $last->out_type;
        $description=$last->description ?? '';
        $status=$status.$description;
        switch($status){
            case in_array($status,['procurement' , 'test_to_procurement' , 'sell_return'
                ,'loan_out_return','factory_return','loan_out_to_replace' ,'escrow_to_storage'
                , 'warranty_replacement换进!' , 'models_to_replace'])
            :{
                $select=array_only(config('status.barcode_associateds_type'),['bad','models_to_replace']);
                break;
            }
            case 'bad' :{
                if(auth('admin')->user()->can('show stock_returns')){
                    $select=array_only(config('status.barcode_associateds_type'),['returned_to_the_factory','breakage','stock_returns','models_to_replace']);
                }else{
                    $select=array_only(config('status.barcode_associateds_type'),['returned_to_the_factory']);
                }
                break;
            }
            case in_array($status,['sell' , 'warranty_replacement换出!' , 'loan_out_to_replace'
                ,'quality_take_away','borrow_to_sales']):{
                $select=array_only(config('status.barcode_associateds_type'),['sell_return','warranty_replacement','quality_acceptance','loan_out_to_replace']);
                break;
            }
            case 'quality_acceptance' :{
                $select=array_only(config('status.barcode_associateds_type'),['warranty_returned_to_the_factory','quality_take_away']);
                break;
            }
            case 'loan_out' :{
                $select=array_only(config('status.barcode_associateds_type'),['loan_out_return','borrow_to_sales']);
                break;
            }
            case 'returned_to_the_factory' || 'warranty_returned_to_the_factory' :{
                $select=array_only(config('status.barcode_associateds_type'),['factory_return','quality_return']);
                break;
            }
            case 'quality_return' :{
                $select=array_only(config('status.barcode_associateds_type'),['breakage','quality_take_away','escrow_to_storage']);
                break;
            }
            case 'test' :{
                $select=array_only(config('status.barcode_associateds_type'),['test_return','test_to_procurement']);
                break;
            }
        }
//        if($last->description == '换进!' ){
//            $select=array_only(config('status.barcode_associateds_type'),['breakage','quality_take_away','escrow_to_storage']);
//        }
        return $select;
    }
    public function loan_out($status)
    {
        $barcode_associateds = WarehouseOutManagement::with('user', 'user.admins', 'order.markets', 'admins', 'codes', 'codes.product_good', 'codes.product_good.product')->whereOutType($status)->whereAssociatedDisposal(false)->latest('updated_at')->get();
        $arr = [];
        $admin = Admin::pluck('name', 'id');
        foreach ($barcode_associateds as $item) {
            foreach ($item->codes as $codes) {
                foreach ($codes->code as $code) {
                    $arr[$code] = [
                        'code' => $code,
                        'product_good_id' => $codes->product_good->id,
                        'product_good_name' => $codes->product_good->name,
                        'product_good_type' => $codes->product_good->product->title,
                        'barcode_associateds' => $item,
                        'admin' => $admin,
                    ];
                }
            }
        }
        return $arr;
    }

    public function barcode_associateds($status)
    {
        $barcode_associateds = BarcodeAssociated::with('user', 'user.admins', 'order', 'order.markets', 'admins', 'procurement_plans.admins', 'supplier_managements', 'product_good', 'product_good.product')->whereCurrentState($status)->whereAssociatedDisposal(true)->latest('updated_at')->get();

        return $barcode_associateds;
    }

    public function returned_to_the_factory_and_warranty_returned_to_the_factory($status)
    {
        $barcode_associateds = BarcodeAssociated::with('user', 'order', 'order.markets', 'admins', 'procurement_plans.admins', 'supplier_managements', 'product_good', 'product_good.product')->whereIn('current_state', ['returned_to_the_factory', 'warranty_returned_to_the_factory'])->whereAssociatedDisposal(true)->whereDescription('换进!')->latest('updated_at')->get();

        return $barcode_associateds;
    }

    public function test($status)
    {
        $barcode_associateds = ProcurementPlan::with('supplier_managements', 'product_goods', 'products')->whereProcurementType($status)->whereProcurementStatus("finish")->latest('updated_at')->get();
        $arr = [];
        $admins = Admin::pluck('name', 'id');
        foreach ($barcode_associateds as $item) {
            foreach ($item->code as $code) {
                if ($code)
                    $arr[$code] = [
                        'code' => $code,
                        'product_good_id' => $item->product_goods->id,
                        'product_good_name' => $item->product_goods->name,
                        'product_good_type' => $item->products->title,
                        'barcode_associateds' => $item,
                        'admin' => $admins[$item->admin],
                        'purchase' => $admins[$item->purchase]
                    ];
            }
        }
        return $arr;
    }

    /*******************info***********************/
    public function loan_out_info($status, $request)
    {
        $id = $request->input('id');
        $product_id = $request->input('product_good_id');
        $code = $request->input('code');
        $arr = [];
        $arr['admin'] = Admin::get();
        $arr['warehouse_out_management'] = WarehouseOutManagement::with('user', 'admins', 'order', 'order.markets')->findOrFail($id);
        $arr['product_good'] = ProductGood::with('product')->findOrFail($product_id);
        $arr['procurement_plan'] = ProcurementPlan::with('supplier_managements')->where('code', 'like', "%$code%")->first();
        $arr['code'] = $code;
        $arr['status'] = $status;

        return $arr;
    }

    public function barcode_associated_info($status, $request)
    {
        $id = $request->input('id');
        $product_id = $request->input('product_good_id');
        $code = $request->input('code');
        $arr = [];
        $arr['admin'] = Admin::get();
        $arr['warehouse_out_management'] = WarehouseOutManagement::with('user', 'admins', 'order', 'order.markets')
                            ->whereHas('codes',function($query) use($code){
                                $query->where('code', 'like', "%$code%");
                            })->first();

        $arr['product_good'] = ProductGood::with('product')->findOrFail($product_id);
        $arr['procurement_plan'] = ProcurementPlan::with('supplier_managements')->where('code', 'like', "%$code%")->first();
        if($request->category == 'BarcodeAssociated'){
            $arr['barcode_associated'] = BarcodeAssociated::with('user', 'order', 'warehouse_out_management', 'order.markets', 'admins', 'procurement_plans', 'supplier_managements', 'product_good', 'product_good.product')->find($id);
        }
       if(empty($arr['warehouse_out_management'])){
           $arr['warehouse_out_management']=$arr['barcode_associated']->warehouse_out_management ?? '';
           $arr['user']=$arr['barcode_associated']->warehouse_out_management->user ?? '';
           $arr['order']=$arr['barcode_associated']->warehouse_out_management->order ?? '';
       }else{
           $arr['user']=$arr['warehouse_out_management']->user;
           $arr['order']=$arr['warehouse_out_management']->order;
       }
        if(empty($arr['product_good'])){
            $arr['product_good']=$arr['barcode_associated']->product_good;
        }
        if(empty($arr['procurement_plan'])) {
            $arr['procurement_plan'] = $arr['barcode_associated']->procurement_plans;
        }
        if(empty($arr['procurement_plan']->supplier_managements)) {
            $arr['supplier_managements'] = $arr['barcode_associated']->procurement_plan->supplier_managements;
        }else{
            $arr['supplier_managements'] = $arr['procurement_plan']->supplier_managements;
        }

        $arr['code'] = $code;
        $arr['status'] = $status;
//dd($arr,$request->all());
        return $arr;
    }

    public function test_info($status, $request)
    {
        $id = $request->input('id');
        $code = $request->input('code');
        $arr = [];
        $arr['admin'] = Admin::get();
        $arr['procurement_plan'] = ProcurementPlan::with('supplier_managements', 'admins', 'products', 'product_goods')->findOrFail($id);
        $arr['code'] = $code;
        $arr['status'] = $status;
        //   dump($arr);
        return $arr;
    }
    public function barcode_associated($status)
    {

        return BarcodeAssociated::with('user', 'order', 'warehouse_out_management', 'order.markets', 'admins', 'procurement_plans','procurement_plans.admins', 'supplier_managements', 'product_good', 'product_good.product')->oldest('updated_at')->whereCurrentState($status)->paginate(20);
    }
    public function quality_return($status)
    {
        return BarcodeAssociated::with('user', 'order', 'warehouse_out_management', 'order.markets', 'admins', 'procurement_plans','procurement_plans.admins', 'supplier_managements', 'product_good', 'product_good.product')->latest('updated_at')->whereCurrentState($status)->whereDescription('换进!')->paginate(20);
    }


    public function create_associated($data, $barcode_associated)
    {
        switch ($data['current_state']) {
            case 'borrow_to_sales' : { //借转销售 完成
                BarcodeAssociatedStatusServices::borrow_to_sales($data);
                break;
            }
            case 'loan_out_return' : {//借出换回 完成
                BarcodeAssociatedStatusServices::loan_out_return($data);
                break;
            }
            case 'returned_to_the_factory' : { //返厂在途 完成
                BarcodeAssociatedStatusServices::returned_to_the_factory($data);
                break;
            }
            case 'stock_returns' : {//进货退货 完成
                BarcodeAssociatedStatusServices::stock_returns($data);
                break;
            }
            case 'breakage' : { //报损 完成
                BarcodeAssociatedStatusServices::breakage($data);
                break;
            }
            case 'models_to_replace' : { //型号更换 完成
                BarcodeAssociatedStatusServices::models_to_replace($data);
                break;
            }
           case 'factory_return' : { //返厂返回 完成
                      BarcodeAssociatedStatusServices::factory_return($data);
                      break;
          }
            case 'quality_return' : { //质保返回 完成
                BarcodeAssociatedStatusServices::quality_return($data);
                break;
            }
            case 'quality_take_away' : { //质保取走 完成
                BarcodeAssociatedStatusServices::quality_take_away($data);
                break;
            }
            case 'escrow_to_storage' : { //代管转入库 完成
                BarcodeAssociatedStatusServices::escrow_to_storage($data);
                break;
            }
            case 'test_return' : { //测试品归还 完成
                BarcodeAssociatedStatusServices::test_return($data);
                break;
            }
            case 'test_to_procurement' : { // 测试品转采购 完成
                BarcodeAssociatedStatusServices::test_to_procurement($data);
                break;
            }
            case 'sell_return' : { // 销售退货 完成
                BarcodeAssociatedStatusServices::sell_return($data);
                break;
            }

            case 'warranty_replacement' : { //质保更换 完成
                BarcodeAssociatedStatusServices::warranty_replacement($data);
                break;
            }
            case 'quality_acceptance' : { //质保受理 完成
                BarcodeAssociatedStatusServices::quality_acceptance($data);
                break;
            }
            case 'loan_out_to_replace' : { //借转更换 完成
                BarcodeAssociatedStatusServices::loan_out_to_replace($data);
                break;
            }






       }
    }
}

?>