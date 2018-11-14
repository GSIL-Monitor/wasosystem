<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//条码关联Model
class BarcodeAssociated extends Model
{

   protected $casts=[];
   protected $fillable=['supplier_managements_id','user_id','order_id','procurement_plans_id','warehouse_out_management_id',
       'product_good_id','code','two_code','current_state','product_colour','postscript','description','location','associated_disposal','admin'

   ];

    public function procurement_plans()
    {
        return $this->belongsTo(ProcurementPlan::class,'procurement_plans_id','id');
    }
    public function warehouse_out_management()
    {
        return $this->belongsTo(WarehouseOutManagement::class,'warehouse_out_management_id','id');
    }
    public function supplier_managements()
    {
        return $this->belongsTo(SupplierManagement::class,'supplier_managements_id','id');
    }
    public function product_good(){
        return $this->belongsTo(ProductGood::class,'product_good_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function admins()
    {
        return $this->belongsTo(Admin::class,'admin','id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

}