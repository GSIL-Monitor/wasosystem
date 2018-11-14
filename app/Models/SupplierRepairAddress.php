<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//供应商返修地址Model
class SupplierRepairAddress extends Model
{
   protected $casts=[];
   protected $fillable=['name','phone','email','address','admin','supplier_managements_id'];
   public function admins(){
       return $this->belongsTo(Admin::class,'admin','id');
   }
}