<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    /**
     * 要触发的所有关联关系
     *
     * @var array
     */
    //protected $touches = ['warehouse_out_management'];
    protected $casts=['code'=>'array'];
    protected $fillable=['warehouse_out_management_id','product_good_id','product_good_num','product_good_number','code'];
    public function warehouse_out_management(){
        return $this->belongsTo(WarehouseOutManagement::class,'warehouse_out_management_id','id');
    }
    public function product_good(){
        return $this->belongsTo(ProductGood::class,'product_good_id','id');
    }
    public function setCodeAttribute($value)
    {
        return $this->attributes['code']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    public function inventory()
    {
        return $this->hasOne(InventoryManagement::class,'product_good_id','product_good_id');
    }
}
