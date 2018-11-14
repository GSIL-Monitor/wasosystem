<?php

namespace App\Services;

use App\Models\ProcurementPlan;
use App\Models\Product;
use App\Models\ProductGood;
use App\Models\SupplierManagement;

class ProcurementPlanServices
{
    public function parameters($productId)
    {
        $arr['supplier_managements']=SupplierManagement::oldest('name')->pluck('name','id');
        $arr['product']=Product::oldest('bianhao')->pluck('title','id');
       $arr['product_goods']=ProductGood::whereProductId($productId)->oldest('name')->pluck('name','id');
        return $arr;
}
}

?>