<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//服务管理Model
class Service extends Model
{
   protected $casts=['product_goods'=>'array','door_and_service_staff'=>'array'];
   protected $dates=['door_of_time'];
   protected $fillable=['serial_number','username','order_serial_number','quality_assurance_model','quality_assurance_status',
       'service_event','error_description','solution','product_goods','door_and_service_staff','door_of_time'];

    public function setProductGoodsAttribute($value)
    {
        return $this->attributes['product_goods']=json_encode($value,JSON_UNESCAPED_UNICODE);
   }
    public function setDoorAndServiceStaffAttribute($value)
    {
        return $this->attributes['door_and_service_staff']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    public function order()
    {
        return $this->hasOne(Order::class,'serial_number','order_serial_number');
    }
}