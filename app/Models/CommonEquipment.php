<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//常用配置管理Model
class CommonEquipment extends Model
{
   protected $casts=[];
    protected $fillable = ['user_id', 'order_id', 'name', 'machine_model', 'code', 'unit_price', 'total_prices', 'old_prices', 'num',
        'order_type','service_status', 'invoice_type', 'user_remark', 'company_remark','market'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class,'id','order_id');
    }
    /*----------------获取常用配置里的物料配件-------------------------*/
    public function common_equipment_product_goods()
    {
        return $this->belongsToMany(ProductGood::Class, 'common_equipment_materials', 'common_equipment_id', 'product_good_id')->withPivot('product_good_num','product_number','product_good_price','product_good_raid');
    }
}