<?php

namespace App\Services;

use App\Models\ProcurementPlan;
use App\Models\Product;
use App\Models\ProductGood;
use App\Models\PutInStorageManagement;
use App\Models\SupplierManagement;

class PutInStorageManagementServices
{
    public function parameters($productId)
    {
        $arr['supplier_managements']=SupplierManagement::oldest('name')->pluck('name','id');
        $arr['product']=Product::oldest('bianhao')->pluck('title','id');
        $arr['product_goods']=ProductGood::whereProductId($productId)->oldest('name')->pluck('name','id');
        return $arr;
    }
    public function code_in_storage($put_in_storage_management,$data)
    {
        $data['code']=explode(',',$data['code']);
        if($data['procurement_number'] == $data['finish_procurement_number']){
            $data['procurement_status']='finish';
        }else{
            $data['procurement_status']='unfinished';
        }
        if($put_in_storage_management){
            $put_in_storage_management->update($data);
        }else{
            $put_in_storage_management=ProcurementPlan::create($data);
        }
        if($put_in_storage_management->procurement_status == 'finish' && $put_in_storage_management->procurement_type == 'procurement'){
            $put_in_storage_management->inventory()->increment($put_in_storage_management->product_colour,$put_in_storage_management->finish_procurement_number);
        }
        if($put_in_storage_management->procurement_status == 'finish' && $put_in_storage_management->procurement_type == 'test'){
            $put_in_storage_management->inventory()->increment($put_in_storage_management->procurement_type,$put_in_storage_management->finish_procurement_number);
        }
    }
}

?>