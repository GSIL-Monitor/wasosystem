<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//供应商管理Model
class SupplierManagement extends Model
{
   protected $casts=[];
   protected $fillable=['name','code','linkman','phone','address','admin','factory_return_count','sales_return_count'];
   public function admins(){
       return $this->belongsTo(Admin::class,'admin','id');
   }

    public function procurement_plans(){
        return $this->hasMany(ProcurementPlan::class,'supplier_managements_id','id');
    }
    public function supplier_repair_addresses(){
        return $this->hasMany(SupplierRepairAddress::class,'supplier_managements_id','id');
    }

    public function numberPurchasing()
    {
        return $this->procurement_plans->sum('finish_procurement_number');
    }
    public function repairRate()
    {
            return  $this->numberPurchasing() > 0 ? round(($this->factory_return_count / $this->numberPurchasing() ) * 100,2) : 0;
    }
    public function returnRate()
    {
        return  $this->numberPurchasing() > 0 ?  round(($this->sales_return_count / $this->numberPurchasing() ) * 100,2) : 0;
    }
}