<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//旧网站订单管理Model
class OldGood extends Model
{
   protected $casts=[];
   protected $fillable=[];
    public function order(){
        return $this->belongsTo(OldOrder::class,'pay_id','proid');
    }
}