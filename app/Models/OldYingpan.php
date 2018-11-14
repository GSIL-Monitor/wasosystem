<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//旧网站订单管理Model
class OldYingpan extends Model
{
   protected $casts=[];
   protected $fillable=[];

    public function orders()
    {
        return $this->belongsTo(OldOder::class,'userid','id');
   }

}