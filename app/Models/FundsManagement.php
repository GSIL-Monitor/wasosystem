<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//资金管理Model
class FundsManagement extends Model
{
    protected $casts = [];
    protected $fillable = ['user_id', 'type', 'price', 'comment', 'operate','market'];


    public function scopeMoneyRecord($query,$key)
    {
      return $query->when($key !='', function ($query) use ($key) {
          return $query->where('comment','like',"%$key%");//只能查看自己的订单
      });
    }

    public function scopeOutstandingCustomer($query)
    {

    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'operate','account');
    }
}